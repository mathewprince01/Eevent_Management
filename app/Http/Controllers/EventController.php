<?php

namespace App\Http\Controllers;

use App\Exports\EventExport;
use App\Exports\SpeakerExport;
use App\Models\City;
use App\Models\Country;
use App\Models\Event;
use App\Models\EventSession;
use App\Models\Organizer;
use App\Models\Speaker;
use App\Models\TicketType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::with('organizer','sessions','tickets','registrations')->get();
        $cities = City::all();
        $organizers = Organizer::all();
        return view('event.view',compact('events','cities','organizers'));
    }


    public function create()
    {
        $countries  = Country::all();
        $organizers = Organizer::all();
        $speakers   = Speaker::all();
        return view('event.create',compact('countries','organizers','speakers'));
    }


    public function store(Request $request)
    {
        $eventData = $request->validate([
            'event_title'   => 'required|regex:/^[A-Za-z\s]+$/',
            'event_type'    => 'required',
            'start_date'    => 'required|date|after:today',
            'end_date'      => 'required|date|after:start_date',
            'venue'         => 'required',
            'city_id'       => 'required',
            'country_id'    => 'required',
            'organizer_id'  => 'required',
            'banner_image'  => 'file|image|mimes:jpg,png,max:1024',
            'description'   => 'required|max:50',
            'max_attendees' => 'required',
            'event_status'  => 'required'
        ]);
        do{
            $id = rand(001,999);
            $event_code = 'CONF-2025-'.$id;
        }while(Event::where('event_code',$event_code)->exists());

        if($request->has('banner_image')){
            $banner_image = $eventData['banner_image']->store('event_banners', 'public');
        }
        else{
            $banner_image = null;
        }
        $event = collect($eventData)->except('banner_image')->toArray();
        $event['event_code'] = $event_code;
        $event['banner_image'] = $banner_image;
        $newEvent = Event::create($event);

        $sessionData = $request->validate([
            'session' => 'required|array|max:10|min:1',
            'session.*.session_title' => 'required',
            'session.*.speaker_id'    => 'required',
            'session.*.start_time'    => 'required',
            'session.*.end_time'      => 'required',
            'session.*.description'   => 'nullable',
        ]);
        foreach($sessionData['session'] as $session){
            $newSession = collect($session)->toArray();
            $newSession['event_id'] = $newEvent->id;
            EventSession::create($newSession);
        }

        $ticketData = $request->validate([
            'ticket' => 'required|array|min:1|max:3',
            'ticket.*.ticket_type'   => 'required',
            'ticket.*.price'         => 'required|min:0',
            'ticket.*.max_quantity'  => 'required|min:1',
        ]);
        foreach($ticketData['ticket'] as $ticket){
            $newTicket = collect($ticket)->toArray();
            $newTicket['event_id'] = $newEvent->id;
            $newTicket['available_quantity']  = $ticket['max_quantity'];
            TicketType::create($newTicket);
        }
        return redirect()->route('event.index')->with('success', 'New Event Added Successfully!');
    }


    public function show(string $id)
    {
        $event = Event::find($id);
        if(!$event){
            return redirect()->route('event.index')->with('error','Record Not Found');
        }
        $event->with('sessions','tickets','registrations')->get();
        return view('event.show',compact('event'));
    }


    public function edit(string $id)
    {
        $event = Event::find($id);
        if(!$event){
            return redirect()->route('event.index')->with('error','Record Not Found');
        }
        $countries  = Country::all();
        $organizers = Organizer::all();
        $speakers   = Speaker::all();
        return view('event.edit',compact('event','countries','organizers','speakers'));
    }


    public function update(Request $request, Event $event)
    {
          $eventData = $request->validate([
            'event_title'   => 'required|regex:/^[A-Za-z\s]+$/',
            'event_type'    => 'required',
            'start_date'    => 'required|date|after:today',
            'end_date'      => 'required|date|after:start_date',
            'venue'         => 'required',
            'city_id'       => 'required',
            'country_id'    => 'required',
            'organizer_id'  => 'required',
            'banner_image'  => 'file|image|mimes:jpg,png,max:1024',
            'description'   => 'required|max:50',
            'max_attendees' => 'required',
            'event_status'  => 'required'
        ]);
        if($request->has('banner_image')){
            Storage::disk('public')->delete($event->banner_image);
            $banner_image = $eventData['banner_image'];
        }
        else
        {
            $banner_image= $event->banner_image;
        }
        $upd_event = collect($eventData)->except('banner_image')->toArray();
        $upd_event['banner_image'] = $banner_image;
        $event->update($upd_event);

         $sessionData = $request->validate([
            'session' => 'required|array|max:10|min:1',
            'session.*.session_title' => 'required',
            'session.*.speaker_id'    => 'required',
            'session.*.start_time'    => 'required',
            'session.*.end_time'      => 'required',
            'session.*.description'   => 'nullable',
        ]);
        foreach($sessionData['session'] as $session){
            $upd_session = collect($session)->toArray();
            if(!empty($session['id'])){
                EventSession::where('id',$session['id'])->where('event_id', $event->id)
                            ->update($upd_session);
            }
        }
        $ticketData = $request->validate([
            'ticket' => 'required|array|min:1|max:3',
            'ticket.*.ticket_type'   => 'required',
            'ticket.*.price'         => 'required|min:0',
            'ticket.*.max_quantity'  => 'required|min:1',
        ]);
        foreach($ticketData['ticket'] as $ticket){
            $upd_ticket = collect($ticket)->toArray();
            if(!empty($ticket['id'])){
                TicketType::where('id', $ticket['id'])->where('event_id',$event->id)
                            ->update($upd_ticket);
            }
        }
        return redirect()->route('event.index')->withSuccess('Event Updated Successfully!');
    }


    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('event.index')->with('success', 'Event Soft Deleted Successfully!');
    }

    public function softDeleted(){
        $events = Event::onlyTrashed()->get();
        return view('event.softlist',compact('events'));
    }
    public function restore($id){
        $event = Event::onlyTrashed()->find($id);
        $event->restore();
        return redirect()->route('event.index')->withSuccess('Event Details Restored Successfully!');
    }
    public function forceDelete($id){
        $event = Event::onlyTrashed()->find($id);
        $event->forceDelete();
        return redirect()->route('event.index')->withSuccess('Event Details  Deleted Permanently!');

    }

    public function getCity(Request $request){
        $cities = City::where('country_id', $request->country_id)->get();
        $options = "<option value=''>--Select City--</option>";
        foreach($cities as $city){
            $selected = ($city->id == $request->city_id) ?'selected':'';
            $options .= "<option value='{$city->id}'{$selected}>{$city->name}</option>";
        }
        return $options;
    }

    public function filterData(Request $request){
        $query = Event::with('sessions','tickets','registrations');
        if($request->event_type){
            $query->where('event_type', $request->event_type);
        }
        if($request->city_id){
            $query->where('city_id', $request->city_id);
        }
        if($request->organizer_id){
            $query->where('organizer_id', $request->organizer_id);
        }
        $events = $query->get();
        return view('event.listpartial',compact('events'));
    }
     public function speakerIndex(){
        $user = Auth::user();
        $query = EventSession::with('event','speaker');
        if($user->role == 'Speaker'){
            $speaker = Speaker::where('user_id', $user->id)->first();
            $query->where('speaker_id', $speaker->id);
        }
        $sessions = $query->get();
        return view('event.speaker',compact('sessions'));
     }
     public function speakerReport(){
        $session = EventSession::with('event','speaker')->get();
        return Excel::download(new SpeakerExport($session),'Speaker_report.csv');
     }
     public function organizerIndex(){
        $user = Auth::user();
        if($user->role == 'Organizer'){
            $organizer = Organizer::where('user_id',$user->id)->first();
        }
        $events = Event::where('organizer_id',$organizer->id)
                ->with('registrations','sessions','tickets')
                ->get();
        return view('event.organizer',compact('events'));
     }
     public function eventReport(){
        $event = Event::with('registrations','sessions','tickets')->get();
        return Excel::download(new EventExport($event),'event_summary.csv');
     }
     public function revenueReport($id){
        $event = Event::find($id);
        $event->with('registrations','sessions','tickets')->get();
        $pdf = Pdf::loadView('event.revenue',compact('event'));
        return $pdf->download('revenue.pdf');
     }
}

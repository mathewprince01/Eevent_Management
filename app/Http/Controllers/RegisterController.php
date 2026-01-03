<?php

namespace App\Http\Controllers;

use App\Events\SendEmailEvent;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\Registration;
use App\Models\TicketType;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $query = Registration::with('event','ticket','attendee');
        if($user->role == 'Attendee'){
            $attendee = Attendee::where('user_id', $user->id)->first();
            $query->where('attendee_id',$attendee->id)->get();
        }

        $purchases = $query->get();
        //  dd($purchases);
        return view('registration.list',compact('purchases'));

    }

    public function create()
    {
        $events = Event::all();
        return view('registration.create',compact('events'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if($user->role == 'Attendee'){
            $attendee = Attendee::where('user_id', $user->id)->first();
        }
        $validData = $request->validate([
            'event_id'       => 'required',
            'ticket_type_id' => 'required',
            'quantity'       => 'required'
        ],[
            'event_id.required' => 'Kindly select event.',
            'ticket_type_id.required' => 'Please Select Ticket type.'
        ]);
        $ticket = TicketType::find($validData['ticket_type_id']);
        $price = $ticket->price;
        $total_price = $price * $validData['quantity'];

        try{
            DB::transaction(function() use($request,$ticket,$total_price,$attendee){
                $avilable = $ticket->available_quantity;
                if($avilable < 1){
                    throw new Exception('Ticket Not Available');
                }
                Registration::create([
                    'event_id' => $request->event_id,
                    'ticket_type_id' => $request->ticket_type_id,
                    'attendee_id' => $attendee->id,
                    'quantity' => $request->quantity,
                    'total_price' => $total_price
                ]);
                $ticket->decrement('available_quantity',$request->quantity);
            });
            return redirect()->route('register.index');
        }catch(Exception $e){
            return back()->with('error',$e->getMessage());
        }
    }

    public function getTicketType(Request $request){
        $tickets = TicketType::where('event_id', $request->event_id)->get();
        $options = "<option value=''>--Select Ticket--</option>";
        foreach($tickets as $ticket){
            $selected = ($request->ticket_id == $ticket->id)?'selected':'';
            $options .= "<option value='{$ticket->id}' {$selected}>{$ticket->ticket_type}</option>";
        }
        return $options;
    }
    public function getQuantity(Request $request){
        $query = TicketType::where('id',$request->ticket_type_id)->first();
        $quantity = "<div class='m-2'>Availabel Quantity : {$query->available_quantity}</div>";
        return response()->json(['quantity' => $quantity, 'max' => $query->available_quantity]);
    }

    public function payment(Request $request){
        if($request->has('pay')){
            $purchase = Registration::find($request->purchase_id);
            $purchase->update(['status'=> 'Paid']);
            event(new SendEmailEvent($purchase));
            return back();
        }
        if($request->has('cancel')){
            $purchase = Registration::find($request->purchase_id);
            $purchase->update(['status'=> 'Cancelled']);
            $purchase->ticket->available_quantity += $purchase->quantity;
            $purchase->ticket->save();
            return redirect()->route('event.index');
        }
    }
     public function ticket_pdf($id){
        $purchase = Registration::find($id);
        $purchase->with('event','ticket')->get();
        $pdf = Pdf::loadView('event.ticket',compact('purchase'));
        return $pdf->download('e-ticket.pdf');
    }

}

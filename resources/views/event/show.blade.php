@extends('layout.app')
@section('title','Event Details')
@section('content')
    <div class="container">
        <div class="card m-3">
            <div class="card-header">
                <h3 class="text-center p-2">Event Summary</h3>
                <a href="{{route('register.create')}}" class="btn btn-primary justify-content-right">Register Now</a>
            </div>
            <div class="card-body">
                <h3>Event Details</h3>
                <table class="table table-bordered">
                    <tr>
                        <th>Event Code</th><td>{{$event->event_code}}</td>
                    </tr>
                    <tr>
                        <th>Event Title</th><td>{{$event->event_title}}</td>
                    </tr>
                    <tr>
                        <th>Event Type</th><td>{{$event->event_type}}</td>
                    </tr>
                    <tr>
                        <th>Venue </th><td>{{$event->venue}}</td>
                    </tr>
                    <tr>
                        <th>Organizer</th><td>{{$event->organizer->name}}</td>
                    </tr>
                    <tr>
                        <th>Event Banner</th>
                        <td><img src="{{asset('storage/'.$event->banner_image)}}" width="100" height="100" style="object-fit:cover "></td>
                    </tr>
                </table>
                <h3 class="text-center">Session Details</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Session Title</th>
                            <th>Speaker</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event->sessions as $session )
                            <tr>
                                <td>{{$session->session_title}}</td>
                                <td>{{$session->speaker->name}}</td>
                                <td>{{$session->start_time}}</td>
                                <td>{{$session->end_time}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h3 class="text-center">Ticket Details</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Ticket Type</th>
                            <th>Price</th>
                            <th>Available Tickets</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event->tickets as $ticket )
                            <tr>
                                <td>{{$ticket->ticket_type}}</td>
                                <td>{{$ticket->price}}</td>
                                <td>{{$ticket->available_quantity}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

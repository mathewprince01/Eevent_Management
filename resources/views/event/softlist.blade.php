@extends('layout.base')
@section('title','Softdeleted List')
@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h3 class="text-center p-2">Event List(Trashed)</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>S.NO</th>
                            <th>Event Title</th>
                            <th>Date</th>
                            <th>Venue</th>
                            <th>Organizer</th>
                            <th>Available Tickets</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$event->event_title}}</td>
                            <td>{{date_format(date_create($event->start_date),'d-M-Y')}}</td>
                            <td>{{$event->venue}}</td>
                            <td>{{$event->organizer->name}}</td>
                            <td>{{$event->tickets->sum('available_quantity')}}</td>
                            <td class="d-flex gap-2">
                                <a href="{{route('restore',$event->id)}}" class="btn btn-success">Restore</a>
                                <form action="{{route('force_delete',$event->id)}}" method="post" onsubmit="return confirm('Are You Sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Force Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

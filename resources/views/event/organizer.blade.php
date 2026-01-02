@extends('layout.base')
@section('title','organizer dashboard')
@section('content')
    <x-LogoutComponent/>
    <div class="container">
        <div class="card mt-5 p-2">
            <div class="card-header">
                <h3 class="d-flex justify-content-center">Organizer's Dashboard</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Total Sold</th>
                            <th>Revenue</th>
                            <th>Attendee Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event )
                            <tr>
                                <td>{{$event->registrations->sum('quantity')}}</td>
                                <td>{{$event->registrations->sum('total_price')}}</td>
                                <td>{{$event->registrations->sum('quantity')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

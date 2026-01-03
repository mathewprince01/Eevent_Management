@extends('layout.app')
@section('title','Speaker view')
@section('content')
    <x-LogoutComponent/>
    <div class="container">
        <div class="card mt-5 p-2">
            <div class="card-header">
                <h3 class="text-center">Speaker's Dashboard</h3>
            </div><div class="d-flex justify-content-end m-2">
                <a href="{{route('speaker_report')}}" class="btn btn-warning">Performence</a>
            </div>
            <div class="card-body">
                <table class="table table-stripped">
                    <thead class="table-primary">
                        <tr>
                            <th>S.NO</th>
                            <th>Speaker Name</th>
                            <th>Session Title</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessions as $session )
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$session->speaker->name}}</td>
                                <td>{{$session->session_title}}</td>
                                <td>{{$session->start_time}}</td>
                                <td>{{$session->end_time}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('layout.base')
@section('title','event List')
@section('content')
    <x-LogoutComponent/>
    <div class="container">
        <x-SessionComponent/>
        <div class="card m-5">
            <div class="card-header">
                <h3 class="text-center p-2">Event List</h3>
            </div>
            <div class="row m-3">
                @php
                    $event_types = ['Conference', 'Workshop', 'Meetup', 'Webinar'];
                @endphp
                <div class="col-4">
                    <label for="event_type" class="form-label">Filter By Event Type: </label>
                    <select name="event_type" id="event_type" class="form-select">
                        <option value="">--Select Event Type--</option>
                        @foreach ($event_types as $event_type)
                            <option value="{{$event_type}}" @selected($event_type == old('event_type'))>{{$event_type}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="city_id" class="form-label">Filter By City: </label>
                    <select name="city_id" id="city_id" class="form-select">
                        <option value="">--Select City--</option>
                        @foreach ($cities as $city )
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                     <label for="organizer_id" class="form-label">Filter By Organizer: </label>
                    <select name="organizer_id" id="organizer_id" class="form-select">
                        <option value="">--Select Organizer--</option>
                        @foreach ($organizers as $organizer )
                            <option value="{{$organizer->id}}">{{$organizer->name}}</option>
                        @endforeach
                    </select>
                </div>
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
                            <th>Revenue</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tbody id="partial">
                       @include('event.listpartial')
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('#event_type,#city_id,#organizer_id').on('change',function(){
                let event_type   = $('#event_type').val() || '';
                let city_id      = $('#city_id').val() || '';
                let organizer_id = $('#organizer_id').val() || '';
                $.ajax({
                    url : "{{route('filterData')}}",
                    method : "get",
                    data : {event_type, city_id, organizer_id},
                    success : function(data){
                        $('#partial').html(data)
                    }
                })
            });
            setTimeout(() => {
                $('.msg').slideUp('slow');
            }, 3000);
        });
    </script>
@endpush

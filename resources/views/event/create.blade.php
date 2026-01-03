@extends('layout.app')
@section('title','Event Creation')
@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h3 class="text-center p-2">Event Creation </h3>
            </div>
            <div class="card-body">
                <form action="{{route('event.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label for="event_title" class="form-label">Event Title: </label>
                        <input type="text" name="event_title" id="event_title" class="form-control" value="{{old('event_title')}}">
                        @error('event_title')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    @php
                        $event_types = ['Conference', 'Workshop', 'Meetup', 'Webinar'];
                    @endphp
                    <div class="mb-3">
                        <label for="event_type" class="form-label">Event Type: </label>
                        <select name="event_type" id="event_type" class="form-select">
                            <option value="">--Select Event Type--</option>
                            @foreach ($event_types as $event_type)
                                <option value="{{$event_type}}" @selected($event_type == old('event_type'))>{{$event_type}}</option>
                            @endforeach
                        </select>
                        @error('event_type')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="start_date" class="form-label">Start Date: </label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{old('start_date')}}">
                            @error('start_date')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label for="end_date" class="form-label">End Date: </label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{old('end_date')}}">
                            @error('end_date')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="venue" class="form-label"> Venue: </label>
                        <input type="text" name="venue" id="venue" class="form-control" value="{{old('venue')}}">
                        @error('venue')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="country_id" class="form-label"> Country: </label>
                        <select name="country_id" id="country_id" class="form-select">
                            <option value="">--Select Country--</option>
                            @foreach ($countries as $country)
                                <option value="{{$country->id}}" @selected($country->id == old('country_id'))>{{$country->name}}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city_id" class="form-label"> City: </label>
                        <select name="city_id" id="city_id" class="form-select">
                            <option value="">--Select City--</option>
                        </select>
                        @error('city_id')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                     <div class="mb-3">
                        <label for="organizer_id" class="form-label"> Organizer: </label>
                        <select name="organizer_id" id="organizer_id" class="form-select">
                            <option value="">--Select Organizer--</option>
                            @foreach ($organizers as $organizer)
                                <option value="{{$organizer->id}}" @selected($organizer->id == old('organizer_id'))>{{$organizer->name}}</option>
                            @endforeach
                        </select>
                        @error('organizer_id')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="banner_image" class="form-label"> Banner Image: </label>
                        <input type="file" name="banner_image" id="banner_image" class="form-control">
                        @error('banner_image')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label"> Description: </label>
                        <textarea name="description" id="description" rows="2" class="form-control">{{old('description')}}</textarea>
                        @error('description')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="max_attendees" class="form-label"> Max Attendees: </label>
                        <input type="number" name="max_attendees" id="max_attendees" class="form-control" value="{{old('max_attendees')}}">
                        @error('max_attendees')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    @php
                        $event_status = ['Upcoming', 'Ongoing', 'Completed', 'Cancelled'];
                    @endphp
                    <div class="mb-3">
                        <label for="event_status" class="form-label">Event Status: </label>
                        <select name="event_status" id="event_status" class="form-select">
                            <option value="">--Select Event Type--</option>
                            @foreach ($event_status as $status)
                                <option value="{{$status}}" @selected($status == old('event_status'))>{{$status}}</option>
                            @endforeach
                        </select>
                        @error('event_status')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="card-body">
                        @php
                            $oldDatas = old('session',[]);
                        @endphp
                        <div class="s_rowGroup border">
                            <div class="card-header p-2 m-2">
                                <h3 class="text-center">Session Management</h3>
                            </div>
                            @if (count($oldDatas) > 0)
                                @foreach ($oldDatas as $i=>$oldData )
                                    <div class="s_rowItem d-flex gap-2 p-2 m-2">
                                        <div class="col-2">
                                            <label for="session_title{{$i}}" class="form-label">Session Title:</label>
                                            <input type="text" name="session[{{$i}}][session_title]" id="session_title{{$i}}" class="form-control" value="{{$oldData['session_title']}}">
                                            @error("session.$i.session_title")
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-3">
                                            <label for="speaker_id{{$i}}" class="form-label"> Speaker:</label>
                                            <select name="session[{{$i}}][speaker_id]" id="speaker_id{{$i}}" class="form-select">
                                                <option value="">--Select Speaker--</option>
                                                @foreach ($speakers as $speaker )
                                                    <option value="{{$speaker->id}}" @selected($speaker->id == $oldData['speaker_id'])>{{$speaker->name}}</option>
                                                @endforeach
                                            </select>
                                            @error("session.$i.speaker_id")
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <label for="start_time{{$i}}" class="form-label">Session Start Time:</label>
                                            <input type="time" name="session[{{$i}}][start_time]" id="start_time{{$i}}" class="form-control" value="{{$oldData['start_time']}}">
                                            @error("session.$i.start_time")
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <label for="end_time{{$i}}" class="form-label">Session End Time:</label>
                                            <input type="time" name="session[{{$i}}][end_time]" id="end_time{{$i}}" class="form-control" value="{{$oldData['end_time']}}">
                                            @error("session.$i.end_time")
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <label for="description{{$i}}" class="form-label">Description:</label>
                                            <textarea name="session[{{$i}}][description]" id="description{{$i}}" class="form-control" rows="1">{{$oldData['description']}}</textarea>
                                            @error("session.$i.description")
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-1 text-center ">
                                            <a class="btn btn-danger s_removeRow mt-4">-</a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="s_rowItem d-flex gap-2 p-2 m-2">
                                    <div class="col-2">
                                        <label for="session_title0" class="form-label">Session Title:</label>
                                        <input type="text" name="session[0][session_title]" id="session_title0" class="form-control" value="{{old('session_title')}}">
                                        @error("session.0.session_title")
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-3">
                                        <label for="speaker_id0" class="form-label"> Speaker:</label>
                                        <select name="session[0][speaker_id]" id="speaker_id0" class="form-select">
                                            <option value="">--Select Speaker--</option>
                                            @foreach ($speakers as $speaker )
                                                <option value="{{$speaker->id}}" @selected($speaker->id == old('speaker_id'))>{{$speaker->name}}</option>
                                            @endforeach
                                        </select>
                                        @error("session.0.speaker_id")
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-2">
                                        <label for="start_time0" class="form-label">Session Start Time:</label>
                                        <input type="time" name="session[0][start_time]" id="start_time0" class="form-control" value="{{old('start_time')}}">
                                        @error("session.0.start_time")
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-2">
                                        <label for="end_time0" class="form-label">Session End Time:</label>
                                        <input type="time" name="session[0][end_time]" id="end_time0" class="form-control" value="{{old('end_time')}}">
                                        @error("session.0.end_time")
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-2">
                                        <label for="description0" class="form-label">Description:</label>
                                        <textarea name="session[0][description]" id="description0" class="form-control" rows="1">{{old('description')}}</textarea>
                                        @error("session.0.description")
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-1 text-center mt-4">
                                        <a class="btn btn-danger s_removeRow ">-</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="mt-3">
                            <a class="btn btn-success s_add">+</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @php
                            $oldTickets = old('ticket', []);
                            $ticketTypes = ['Regular', 'VIP', 'Student'];
                        @endphp
                        <div class="t_rowGroup border">
                            <div class="card-header">
                                <h3 class="text-center">Ticket Categories</h3>
                            </div>
                            @if (count($oldTickets) > 0)
                                @foreach ($oldTickets as $i=>$ticket )
                                    <div class="t_rowItem d-flex p-2 m-2 gap-3">
                                        <div class="col-4">
                                            <label for="ticket_type{{$i}}" class="form-label">Ticket Type: </label>
                                            <select name="ticket[{{$i}}][ticket_type]" id="ticket_type{{$i}}" class="form-select">
                                                <option value="">--Select Ticket--</option>
                                                @foreach ($ticketTypes as $type)
                                                    <option value="{{$type}}" @selected($type == $ticket['ticket_type'])>{{$type}}</option>
                                                @endforeach
                                            </select>
                                            @error("ticket.$i.ticket_type")
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-3">
                                            <label for="price{{$i}}" class="form-label">Price:</label>
                                            <input type="number" name="ticket[{{$i}}][price]" id="price{{$i}}" class="form-control" value="{{$ticket['price']}}">
                                            @error("ticket.$i.price")
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-3">
                                            <label for="max_quantity{{$i}}" class="form-label">Maximum Quantity:</label>
                                            <input type="number" name="ticket[{{$i}}][max_quantity]" id="max_quantity{{$i}}" class="form-control" value="{{$ticket['max_quantity']}}">
                                            @error("ticket.$i.max_quantity")
                                                <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                        <div class="col-2 text-center mt-4">
                                            <a class="btn btn-danger t_removeRow">-</a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="t_rowItem d-flex p-2 m-2 gap-3">
                                    <div class="col-4">
                                        <label for="ticket_type0" class="form-label">Ticket Type: </label>
                                        <select name="ticket[0][ticket_type]" id="ticket_type0" class="form-select">
                                            <option value="">--Select Ticket--</option>
                                            @foreach ($ticketTypes as $type)
                                                <option value="{{$type}}" @selected($type == old('ticket_type'))>{{$type}}</option>
                                            @endforeach
                                        </select>
                                        @error("ticket.0.ticket_type")
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-3">
                                        <label for="price0" class="form-label">Price:</label>
                                        <input type="number" name="ticket[0][price]" id="price0" class="form-control" value="{{old('price')}}">
                                        @error("ticket.0.price")
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-3">
                                        <label for="max_quantity0" class="form-label">Maximum Quantity:</label>
                                        <input type="number" name="ticket[0][max_quantity]" id="max_quantity0" class="form-control" value="{{old('max_quantity')}}">
                                        @error("ticket.0.max_quantity")
                                            <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="col-2 text-center mt-4">
                                        <a class="btn btn-danger t_removeRow">-</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="mt-3">
                            <a class="btn btn-success t_add">+</a>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('#country_id').on('change',function(){
                let country_id = $(this).val();
                let city_id = "{{old('city_id')}}";
                $.ajax({
                    url : "{{route('getCity')}}",
                    method : "GET",
                    data : {country_id, city_id},
                    success : function(data){
                        $('#city_id').html(data)
                    }
                })
            });
            let country = $('#country_id').val();
            if(country){
                $('#country_id').trigger('change');
            }

            $(document).on('click','.s_add',function(){
                let i = $('.s_rowItem').length;
                if(i <10){
                    let html =
                    `<div class="s_rowItem d-flex gap-2 p-2 m-2">
                        <div class="col-2">
                            <label for="session_title${i}" class="form-label">Session Title:</label>
                            <input type="text" name="session[${i}][session_title]" id="session_title${i}" class="form-control" >
                            @error('session.${i}.session_title')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-3">
                            <label for="speaker_id${i}" class="form-label"> Speaker:</label>
                            <select name="session[${i}][speaker_id]" id="speaker_id${i}" class="form-select">
                                <option value="">--Select Speaker--</option>
                                @foreach ($speakers as $speaker )
                                    <option value="{{$speaker->id}}" >{{$speaker->name}}</option>
                                @endforeach
                            </select>
                            @error('session.${i}.speaker_id')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-2">
                            <label for="start_time${i}" class="form-label">Session Start Time:</label>
                            <input type="time" name="session[${i}][start_time]" id="start_time${i}" class="form-control" >
                            @error('session.${i}.start_time')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-2">
                            <label for="end_time${i}" class="form-label">Session End Time:</label>
                            <input type="time" name="session[${i}][end_time]" id="end_time${i}" class="form-control" >
                            @error('session.${i}.end_time')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-2">
                            <label for="description${i}" class="form-label">Description:</label>
                            <textarea name="session[${i}][description]" id="description${i}" class="form-control" rows="1"></textarea>
                            @error('session.${i}.description')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-1 text-center mt-4">
                            <a class="btn btn-danger s_removeRow ">-</a>
                        </div>
                    </div>
                    `;
                    $('.s_rowGroup').append(html);
                    i++;
                }
            });
            $(document).on('click', '.s_removeRow',function(){
                let rowCount = $('.s_rowItem').length;
                if(rowCount > 1){
                    $(this).closest('.s_rowItem').remove();
                }
            });

            $(document).on('click','.t_add',function(){
                let i = $('.t_rowItem').length;
                if(i < 3){
                    let html =
                    `<div class="t_rowItem d-flex p-2 m-2 gap-3">
                        <div class="col-4">
                            <label for="ticket_type${i}" class="form-label">Ticket Type: </label>
                            <select name="ticket[${i}][ticket_type]" id="ticket_type${i}" class="form-select">
                                <option value="">--Select Ticket--</option>
                                @foreach ($ticketTypes as $type)
                                    <option value="{{$type}}" >{{$type}}</option>
                                @endforeach
                            </select>
                            @error('ticket.${i}.ticket_type')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-3">
                            <label for="price${i}" class="form-label">Price:</label>
                            <input type="number" name="ticket[${i}][price]" id="price${i}" class="form-control">
                            @error('ticket.${i}.price')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-3">
                            <label for="max_quantity${i}" class="form-label">Maximum Quantity:</label>
                            <input type="number" name="ticket[${i}][max_quantity]" id="max_quantity${i}" class="form-control" >
                            @error('ticket.${i}.max_quantity')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-2 text-center mt-4">
                            <a class="btn btn-danger t_removeRow">-</a>
                        </div>
                    </div>
                    `;
                    $('.t_rowGroup').append(html);
                    i++;
                }
            });
            $(document).on('click','.t_removeRow',function(){
                let rowCount = $('.t_rowItem').length;
                if(rowCount > 1){
                    $(this).closest('.t_rowItem').remove();
                }
            });
        });
    </script>
@endpush

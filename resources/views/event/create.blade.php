@extends('layout.app')
@section('main')
    <div class="continer">
        <div class="card mt-5">
            <div class="card-header">
                <h3>event creay\</h3>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="mb-2">
                        <label for="event_title" class="form-label">Event Title</label>
                        <input type="text" name="event_title" id="event_title" value="{{ old('event_title') }}"
                            class="form-control">
                        @error('event_title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @php
                        $event_types = ['Conference', 'Workshop', 'Meetup', 'Webinar'];
                    @endphp
                    <div class="mb-2">
                        <label for="event_type" class="form-label">Event Type</label>
                        <select name="event_type" id="event_type" class="form-control">
                            @foreach ($event_types as $event_type)
                                <option value="{{$event_type}}">{{$event_type}}</option>
                            @endforeach
                        </select>
                        @error('event_type')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{old("start_date")}}"class="form-conrol">
                        @error('start_date')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" name="end_date" value="{{old("end_date")}}" id="end_date">
                        @error('end_date')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                     <label for="venue" class="form-label">Venue</label>
                     <input type="text" name="venue" id="venue" value="{{old("venue")}}" class="form-control">
                     @error('venue')
                         <div class="text-danger">{{$message}}</div>
                     @enderror
                    </div>
                    @php
                        $countrys=['India','USA','UK','Canada','Singapore']
                    @endphp
                    <div class="mb-2">
                       <label for="country" class="form-label">Country</label>
                       <select name="country" id="country">
                        @foreach ($countrys as $country)
                            <option value="{{$country}}">{{$country}}</option>
                        @endforeach
                       </select>
                       @error('country')
                           <div class="text-danger">{{$message}}</div>
                       @enderror
                    </div>
                    <div class="mb-2">
                        <label for="city" class="form-label">City</label>
                        <select name="city" id="city">
                            @foreach ($citys as $city->$id)
                            <option value="{{$id}}">{{$city}}</option>
                            @endforeach
                        </select>
                         @error('city')
                                <div class="text-danger"></div>
                            @enderror
                            <div class="text-danger">{{$message}}</div>
                    </div>
                    <div class="mb-2">
                        <label for="organizer" class="form-label">Oraganizer</label>
                          <select name="organizer" id="organizer">
                            @foreach ($organizers as $organizer)
                                <option value="{{$organizer}}">{{$organizer}}</option>
                            @endforeach
                          </select>
                          @error('organizer')
                              <div class="text-danger">{{$message}}</div>
                          @enderror
                    </div>
                    <div class="mb-2">
                            <label for="banner_image" class="form-label">Banner Image</label>
                            <input type="file" name="banner_image" id="banner_image" value="{{old("banner_image")}}" class="form-control">
                            @error('banner_image')
                            <div class="text-danger">{{$message}}</div>
                            @enderror
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" value="{{old("description")}}"></textarea>
                        @error('description')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="max_attendees" class="form-label">Max_Attendee</label>
                        <input type="number" name="max_attendees" id="max_attendees" value="{{old('max_attendees')}}">
                        @error('max_attendees')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>

    </div>

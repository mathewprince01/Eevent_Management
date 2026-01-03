@extends('layout.app')
@section('title','Event Register')
@section('content')
    <div class="container">
        <x-SessionComponent/>
        <div class="card m-5">
            <div class="card-header">
                <h3 class="text-center">Event Registration</h3>
            </div>
            <div class="card-body">
                <form action="{{route('register.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="event_id" class="form-label">Event : </label>
                        <select name="event_id" id="event_id" class="form-select">
                            <option value="">--Select Event--</option>
                            @foreach ($events as $event )
                                <option value="{{$event->id}}" @selected($event->id == old('event_id'))>{{$event->event_title}}</option>
                            @endforeach
                        </select>
                        @error('event_id')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ticket_type_id" class="form-label">Ticket Type : </label>
                        <select name="ticket_type_id" id="ticket_type_id" class="form-select">
                            <option value="">--Select Ticket--</option>
                        </select>
                        @error('ticket_type_id')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label"> Quantity : </label>
                        <input type="number" name="quantity" id="quantity" min="1" class="form-control" value="{{old('quantity')}}">
                        <div id="available"></div>
                        @error('quantity')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-primary p-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $(document).on('change','#event_id',function(){
                let event_id = $(this).val();
                let ticket_id = "{{old('ticket_type_id')}}";
                $.ajax({
                    url : "{{route('getTicketType')}}",
                    method : "GET",
                    data : {event_id, ticket_id},
                    success : function(data){
                        $('#ticket_type_id').html(data);
                    }
                })
            });
            $('#ticket_type_id').on('change',function(){
                let ticket_type_id = $(this).val();
                $.ajax({
                    url : "{{route('getQuantity')}}",
                    method : "GET",
                    data : {ticket_type_id},
                    success : function(data){
                        $('#available').html(data.quantity)
                        $('#quantity').attr(data.max)
                    }
                })
            })
        });
    </script>
@endpush

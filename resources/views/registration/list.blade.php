@extends('layout.base')
@section('title','Registration List')
@section('content')
<x-LogoutComponent/>
    <div class="container">
        <div class="card m-5">
            <div class="card-header">
                <h3 class="text-center bg-light">Registration List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>S.No</th>
                            <th>Event Title</th>
                            <th>Ticket Type</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $purchase)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$purchase->event->event_title}}</td>
                                <td>{{$purchase->ticket->ticket_type}}</td>
                                <td>{{$purchase->quantity}}</td>
                                <td>{{$purchase->total_price}}</td>
                                <td class="d-flex gap-2">
                                    @if ($purchase->status == 'Pending')
                                        <form action="{{route('payment')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="purchase_id"  value="{{$purchase->id}}">
                                            <button class="btn btn-primary" name="pay">Pay</button>
                                            <button class="btn btn-danger" name="cancel">Cancel</button>
                                        </form>
                                    @endif
                                    @if ($purchase->status == 'Paid')
                                        <a class="btn btn-success">Paid</a>
                                        <a href="{{route('ticket_pdf',$purchase->id)}}" class="btn btn-warning">Ticket</a>
                                    @elseif ($purchase->status == 'Cancelled')
                                        <a class="btn btn-danger">Cancelled</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

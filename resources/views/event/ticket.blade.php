<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body{
            font-family: sans-serif;

        }
        th,td{
            border: 1px solid rgb(0, 0, 0);
            padding: 15px;
            text-align: center;
        }
        table{
            border-collapse: collapse;
            width: 100%;
            margin-top: 30px;
        }
        .conatainer{
            width: 100%;
        }
        h3{
            text-align: center;
        }
    </style>
    <title>Ticket</title>
</head>
<body>
    <div class="container">
        <h3>Event Ticket</h3>
        <h2>Event Details:</h2>
        <table>
            <tr>
                <th>Attendee Name </th>
                <td>{{$purchase->attendee->name}}</td>
            </tr>

            <tr>
                <th>Event Name </th>
                <td>{{$purchase->event->event_title}}</td>
            </tr>

            <tr>
                <th> Date </th>
                <td>{{$purchase->event->start_date}}</td>
            </tr>

            <tr>
                <th>Venue  </th>
                <td>{{$purchase->event->venue}}</td>
            </tr>

            <tr>
                <th> Oraganizer </th>
                <td>{{$purchase->event->organizer->name}}</td>
            </tr>
        </table>

        <h2>Ticket Category:</h2>
        <table>
            <tr>
                <th>Ticket Type</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
            <tr>
                <td>{{$purchase->ticket->ticket_type}}</td>
                <td>{{$purchase->quantity}}</td>
                <td>{{$purchase->total_price}}</td>
            </tr>
        </table>
    </div>
</body>
</html>

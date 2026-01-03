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
    <title>Revenue</title>
</head>
<body>
    <div class="container">
        <h3>Revenue Details:</h3>
        <table>
            <tr>
                <th>Event Name </th>
                <td>{{$event->event_title}}</td>
            </tr>
            <tr>
                <th>Event Type </th>
                <td>{{$event->event_type}}</td>
            </tr>
            <tr>
                <th>Attendee count </th>
                <td>{{$event->registrations->sum('quantity')}}</td>
            </tr>
            <tr>
                <th>Revenue </th>
                <td>{{$event->registrations->sum('total_price')}}</td>
            </tr>
        </table>
    </div>
</body>
</html>

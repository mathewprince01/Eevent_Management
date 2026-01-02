    @foreach ($events as $event)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$event->event_title}}</td>
            <td>{{date_format(date_create($event->start_date),'d-M-Y')}}</td>
            <td>{{$event->venue}}</td>
            <td>{{$event->organizer->name}}</td>
            <td>{{$event->tickets->sum('available_quantity')}}</td>
            <td>{{$event->registrations->sum('total_price')}}</td>
            <td class="d-flex gap-2">
                <a href="{{route('event.show',$event->id)}}" class="btn btn-info">Details</a>
                @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Organizer' )
                    <a href="{{route('event.edit',$event->id)}}" class="btn btn-warning">Edit</a>
                    <form action="{{route('event.destroy',$event->id)}}" method="post" onsubmit="return confirm('Are You Sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                    @if (auth()->user()->role == 'Admin')
                        <a href="{{route('revenue_pdf',$event->id)}}" class="btn btn-secondary">revenue</a>
                    @endif
                @endif
            </td>
        </tr>
    @endforeach

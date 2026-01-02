<header>
    <nav class="navbar navbar-expand navbar-dark bg-dark p-3">
        <div class="container-fluid">
            <h2 class="navbar-brand">{{config('app.name')}}</h2>

            <ul class="navbar-nav">
                @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Organizer')
                    <li class="nav-item">
                        <a href="{{route('event.index')}}" class="nav-link text-white">Event List</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('event.create')}}" class="nav-link text-bg-dark">Event Entry</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('softdeleted')}}" class="nav-link text-bg-dark">Trashed</a>
                    </li>
                    @endif
                    @if (auth()->user()->role == 'Attendee')
                    <li class="nav-item">
                        <a href="{{route('event.index')}}" class="nav-link text-bg-dark">Event List</a>
                    </li>
                @endif
                @if (auth()->user()->role == 'Organizer')
                <li class="nav-item">
                        <a href="{{route('organizer_index')}}" class="nav-link text-bg-dark">Organizer</a>
                    </li>
                    @endif
                    @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Attendee')

                    <li class="nav-item">
                        <a href="{{route('register.index')}}" class="nav-link text-bg-dark">Register List</a>
                    </li>

                    @endif
                    @if (auth()->user()->role == 'Admin')
                    <li class="nav-item">
                        <a href="{{route('event_report')}}" class="nav-link text-bg-dark">Event Report</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('speaker_index')}}" class="nav-link text-bg-dark">Speaker</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>


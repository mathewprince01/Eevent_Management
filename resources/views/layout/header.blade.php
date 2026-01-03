<header>
    <nav class="navbar navbar-expand navbar-dark bg-primary bg-gradient p-3">
        <div class="container-fluid">
            <h2 class="navbar-brand">{{config('app.name')}}</h2>

            <ul class="navbar-nav">
                @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Organizer')
                    <li class="nav-item">
                        <a href="{{route('event.index')}}" class="nav-link text-bg-primary">Event List</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('event.create')}}" class="nav-link text-bg-primary">Event Entry</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('softdeleted')}}" class="nav-link text-bg-primary">Trashed</a>
                    </li>
                    @endif
                    @if (auth()->user()->role == 'Attendee')
                    <li class="nav-item">
                        <a href="{{route('event.index')}}" class="nav-link text-bg-primary">Event List</a>
                    </li>
                @endif
                @if (auth()->user()->role == 'Organizer')
                <li class="nav-item">
                        <a href="{{route('organizer_index')}}" class="nav-link text-bg-primary">Organizer</a>
                    </li>
                    @endif
                    @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Attendee')

                    <li class="nav-item">
                        <a href="{{route('register.index')}}" class="nav-link text-bg-primary">Register List</a>
                    </li>

                    @endif
                    @if (auth()->user()->role == 'Admin')
                    <li class="nav-item">
                        <a href="{{route('event_report')}}" class="nav-link text-bg-primary">Event Report</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('speaker_index')}}" class="nav-link text-bg-primary">Speaker</a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>


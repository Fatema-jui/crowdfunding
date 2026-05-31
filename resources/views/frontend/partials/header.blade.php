
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2" style="background-color: #0f766e;">
    <div class="container">

        
        <a class="navbar-brand fw-bold position-absolate start-50 translate-middle-x"  href="#"  >CrisisHelp BD</a>

        {{-- Mobile Toggle --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">

            {{-- Nav Links --}}
            <ul class="navbar-nav ms-auto  mb-2 mb-lg-0 me-3">

                <li class="nav-item ">
                    <a class="nav-link text-white" href="{{ route('website') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link  text-white" href="{{ route('crisis.list') }}">Our Crisis</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('volunteer.list') }}">Volunteer</a>
                </li>
                
            </ul>

            
            <div class="d-flex gap-2 align-items-center">

                {{--  Volunteer Login --}}
                
                @if(session('volunteer_id'))

                    <div class="dropdown">

                        <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            {{ session('volunteer_name') }}
                        </button>
                        
                        <ul class="dropdown-menu dropdown-menu-end">
                            
                            <li style="border-bottom: 1px solid #d1d5db;">
                                <a class="dropdown-item" href="{{ route('webvolunteer.profile') }}">My Profile</a>
                            </li>

                            <li style="border-bottom: 1px solid #d1d5db;">
                                <a class="dropdown-item" href="{{ route('webvolunteer.application') }}">My Application</a>
                            </li>

                            <li>
                                <a class="dropdown-item " href="{{ route('webvolunteer.tasks') }}">Assigned Task</a>
                            </li>

                        </ul>

                    </div>

                    <a href="{{ route('webvolunteer.logout') }}" class="btn btn-outline-light btn-sm">Logout</a>

               
                 {{-- Donor/User Login --}}
                
                @elseif(auth()->check())

                    <div class="dropdown">

                        <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li style="border-bottom: 1px solid #d1d5db;">
                                <a class="dropdown-item"  href="{{ route('donor.profile') }}">My Profile</a>
                            </li>

                            <li >
                                <a class="dropdown-item" href="{{ route('donor.donations.list') }}">My Donations</a>
                            </li>
                        </ul>

                    </div>

                    <a href="#" class="btn btn-outline-light btn-sm"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                {{--  Not Logged In --}}
                @else

                <div class="dropdown">

                        <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Login
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li style="border-bottom: 1px solid #d1d5db;">
                                <a class="dropdown-item" href="{{ route('show.login') }}">As a Donor/Admin</a>
                                 
                            </li>

                            <li><a class="dropdown-item" href="{{ route('webvolunteer.login') }}">As a Volunteer</a></li>
                        </ul>
                    </div>

                    <a href="{{ route('show.register') }}" class="btn btn-outline-light btn-sm">Register</a>
                @endif

            </div>
        </div>
    </div>
</nav>
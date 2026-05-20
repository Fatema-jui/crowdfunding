
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2" style="background-color: #0f766e;">
  
    <div class="container">

        <a class="navbar-brand fw-bold" href="#">CrisisHelp BD</a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-3">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('website') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('crisis.list') }}">Our Crisis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('volunteer.list') }}">Volunteer</a>
                </li>
            </ul>

            <div class="d-flex gap-2 align-items-center">

                
               {{--  Volunteer Session Check --}}
                
               @if(session('volunteer_id'))

                    <div class="dropdown">
                        <button class="btn btn-outline-light btn-sm dropdown-toggle" 
                                type="button" 
                                id="volunteerDropdown" 
                                data-bs-toggle="dropdown" 
                                aria-expanded="false">
                             {{ session('volunteer_name') }}
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end" 
                            aria-labelledby="volunteerDropdown"
                            style="min-width: 180px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
                            
                            <li style="border-bottom: 1px solid #d1d5db;">
                                <a class="dropdown-item d-flex align-items-center gap-2" 
                                   href="{{ route('webvolunteer.profile') }}">
                                     My Profile
                                </a>
                            </li>
                            
                            <li style="border-bottom: 1px solid #d1d5db;">
                                <a class="dropdown-item d-flex align-items-center gap-2" 
                                   href="{{ route('webvolunteer.application') }}">
                                     My Application
                                </a>
                            </li>
                            
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2" 
                                   href="{{ route('webvolunteer.tasks') }}">
                                    Assigned Task
                                </a>
                            </li>
                            
                            <li><hr class="dropdown-divider"></li>
                            
                            <li>
                                <a class="dropdown-item d-flex align-items-center gap-2 text-danger" 
                                   href="{{ route('webvolunteer.logout') }}">
                                     Logout
                                </a>
                            </li>

                        </ul>
                    </div>

                {{--  Laravel Default Auth Check --}}
               
                @elseif(auth()->check())

                    <span class="btn btn-outline-light btn-sm">
                        {{ auth()->user()->name }}
                    </span>

                    <a href="#" class="btn btn-outline-light btn-sm"
                       onclick="event.preventDefault(); 
                                document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" 
                          method="POST" class="d-none">
                        @csrf
                    </form>

                {{--  without login --}}
                @else

                    <a href="{{ route('show.login') }}" 
                       class="btn btn-outline-light btn-sm">Login</a>

                    <a href="{{ route('show.register') }}" 
                       class="btn btn-outline-light btn-sm">Register</a>

                @endif

            </div>

        </div>
    </div>
</nav>
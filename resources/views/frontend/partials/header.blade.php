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
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('crisis.list') }}">Our Crisis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('volunteer.list')}}">Volunteer</a>
                </li>
            </ul>

            <div class="d-flex gap-2">
                @auth
                    
                    <span class="btn btn-outline-light btn-sm">
                         {{ auth()->user()->name }}
                    </span>
                    <a href="{{ route('login.submit') }}" class="btn btn-outline-light btn-sm"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    
                    <a href="{{ route('show.login') }}" class="btn btn-outline-light btn-sm">Login</a>
                    <a href="{{ route('show.register') }}" class="btn btn-outline-light btn-sm">Register</a>
                @endauth
            </div>

        </div>
    </div>
</nav>
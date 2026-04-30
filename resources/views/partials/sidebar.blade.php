<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary
            position-fixed start-0 vh-100"
     style="top:56px;">
                <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">crowdfunding system</h5> <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>


                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item"> <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{ route('dashboard') }}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Dashboard
                                </a> 
                            </li>


                            <li class="nav-item"> 
                                <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{ route('user')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                   Users
                                </a> 
                            </li>


                             <li class="nav-item">   
                             <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{ route('crisis.category')}}"> 
                                <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Crisis Category
                                </a> 
                            </li>


                            <li class="nav-item">   
                             <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{ route('crisis')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Crisis
                                </a> 
                            </li>


                            <li class="nav-item">   
                             <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{ route('donor')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Donor
                                </a> 
                            </li>


                            <li class="nav-item">   
                             <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{ route('donation')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Donation
                                </a> 
                            </li>


                            <li class="nav-item">   
                             <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{ route('volunteer')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    volunteer
                                </a> 
                            </li>

                            <li class="nav-item">   
                             <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{ route('expense')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Expense
                                </a> 
                            </li>


                            <li class="nav-item">   
                             <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="{{ route('report')}}"> <svg class="bi" aria-hidden="true">
                                        <use xlink:href="#house-fill"></use>
                                    </svg>
                                    Report
                                </a> 
                            </li>
                            
                        </ul>
                       
                        <hr class="my-3">
                        <ul class="nav flex-column mb-auto">
                            
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="nav-link d-flex align-items-center gap-2 border-0 bg-transparent w-100">
                                        <svg class="bi" aria-hidden="true">
                                            <use xlink:href="#door-closed"></use>
                                        </svg>
                                        Sign out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
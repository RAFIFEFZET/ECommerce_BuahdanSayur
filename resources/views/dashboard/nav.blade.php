<!-- Navbar start -->
<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">Jl. Raya Karadenan No.7, Karadenan, Kec. Cibinong, Kabupaten Bogor, Jawa Barat</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Greenmart@gmail.com</a></small>
            </div>
            <div class="top-link pe-2">
                <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="/" class="navbar-brand"><h1 class="text-primary display-6">GreenMart</h1></a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('allproducts.index') }}" class="nav-item nav-link {{ request()->routeIs('allproducts.index') ? 'active' : '' }}">Shop</a>
                    {{-- <a href="shop-detail.html" class="nav-item nav-link">Shop Detail</a> --}}
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('carts.index', 'unpaidordercustomer.index', 'testimonial', '404') ? 'active' : '' }}" data-bs-toggle="dropdown">My Order</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <a href="{{ route('carts.index') }}" class="dropdown-item {{ request()->routeIs('carts.index') ? 'active' : '' }}">Cart</a>
                            <a href="{{ route('unpaidordercustomer.index') }}" class="dropdown-item {{ request()->routeIs('unpaidordercustomer.index') ? 'active' : '' }}">Unpaid Order</a>
                            <a href="{{ route('sidebarpage.orderstatus') }}" class="dropdown-item {{ request()->routeIs('sidebarpage.orderstatus') ? 'active' : '' }}">Status Orderku</a>
                            {{-- <a href="testimonial.html" class="dropdown-item {{ request()->is('testimonial.html') ? 'active' : '' }}">Testimonial</a>
                            <a href="404.html" class="dropdown-item {{ request()->is('404.html') ? 'active' : '' }}">404 Page</a> --}}
                        </div>
                    </div>
                    {{-- <a href="{{ route('unpaidordercustomer.index') }}" class="nav-item nav-link {{ request()->routeIs('unpaidordercustomer.index') ? 'active' : '' }}">MyOrder</a> --}}
                    <a href="{{ route('dashboard.contact') }}" class="nav-item nav-link {{ request()->routeIs('dashboard.contact') ? 'active' : '' }}">Contact</a>
                </div>                
                <div class="d-flex m-3 me-0">
                    {{-- <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button> --}}
                    <a href="{{ route('carts.index') }}" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        @auth
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                                {{ auth()->user()->carts->count() }}
                            </span>
                        @endauth                        
                    </a>
                    <a href="{{ route('wishlists.index') }}" class="position-relative me-4 my-auto">
                        <i class="fa fa-heart fa-2x"></i>
                        @auth
                            <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                                {{ auth()->user()->wishlists->count() }}
                            </span>
                        @endauth                        
                    </a>
                    <a href="#" class="my-auto">

                        @if (Route::has('login'))
                        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                            @if (Auth::check())
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <div class="dropdown d-flex">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <a href="btn align-middle"></a>
                                        <span>{{ Auth::user()->name }}</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item text-success" href="{{ route('profile.index') }}">Profile&Order</a>
                                        </li>
                                        <li>
                                            <button type="submit" class="dropdown-item">Log Out</button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                            @else
                            <a href="{{ route('login') }}" class="btn align-middle font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                            @endif
                        </div>
                        @endif
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->


<!-- Modal Search Start -->
{{-- <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- Modal Search End -->
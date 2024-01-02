<div class="main-navbar shadow-sm sticky-top">
    <div class="top-navbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                    <h5 class="brand-name">Fit Shop</h5>
                </div>
                <div class="col-md-5 my-auto">
                    <form action="{{route('search')}}" methode="get" role="search">
                        <div class="input-group">
                            <input type="search" name="search" value="{{ request()->search }}" placeholder="Search Your Product" class="form-control" />
                            <button class="btn bg-white" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5 my-auto">
                    <ul class="nav justify-content-end">
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('cart')}}">
                                <i class="fa fa-shopping-cart"></i> Cart (<livewire:frontend.cart.cart-count/>)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('wishlists')}}">
                                <i class="fa fa-heart"></i> Wishlist (<livewire:frontend.wishlist.wishlist-count/>)
                            </a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{route('profile')}}"><i class="fa fa-user"></i> Profile</a></li>
                                    @if (Auth::user()->role_as == "1")
                                        <li><a class="dropdown-item" href="{{route('dashboard')}}"><i class="fa fa-home"></i> Dashboard</a></li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{route('orders')}}"><i class="fa fa-list"></i> My Orders</a></li>
                                    <li><a class="dropdown-item" href="{{route('wishlists')}}"><i class="fa fa-heart"></i> My Wishlist</a></li>
                                    <li><a class="dropdown-item" href="{{route('cart')}}"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
                <div class="mt-2">
                    @if (session('message'))
                        <div class="alert alert-danger">{{session('message')}}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand d-block d-sm-block d-md-none d-lg-none" href="#">
                Funda Ecom
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home_page')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories')}}">All Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('new_arrivals')}}">New Arrivals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('featured')}}">Featured Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Electronics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Fashions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Accessories</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
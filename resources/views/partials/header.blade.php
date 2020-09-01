    <!-- Header -->

    <style type="text/css">
    .notificationaa{ border-radius: 30px;
        position: absolute;
        top: -11.2px;
        top: -0.8rem;
        right: 0;
        background-color: #4aa36b;
        color: #fff;
        font-weight: 600;
        font-size: 9.799px;
        font-size: 0.7rem;
        display: inline-block;
        padding: 0.15rem 0.3rem 0.2rem 0.35rem;
        line-height: 1; }</style>
    <header id="header" class="light">

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <!-- Logo -->
                    <div class="module module-logo dark">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('image/setting/'.$setting->logo) }}" alt="Logo" >
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Navigation -->
                    <nav class="module module-navigation left mr-4">
                        <ul id="nav-main" class="nav nav-main">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/about-us') }}">About</a></li>
                            <li><a href="{{ URL::to('category/menu') }}">Menu</a></li>
                            
                            <li><a href="{{ url('/contact-us') }}">Contact</a></li>
                                        
                        @if (Auth::guest())
                            <li ><a href="{{ route('login') }}">Login</a></li>
                            <li ><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="has-dropdown">
                                <a href="#">My Account ({{ Auth::user()->username }})</a>
                                <div class="dropdown-container">
                                    <ul class="dropdown-mega">
                                        <li><a href="<?php echo URL::to('/').'/dashboard'; ?>">Dashboard</a></li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                    </ul>
                                </div>
                            </li>
                        @endif
                    
                        </ul>
                    </nav>
                    <div class="module left">
                        <a href="#odder" data-toggle="modal" class="btn btn-outline-secondary"><span>Order</span></a>
                    </div>
                </div>

                <div class="col-md-2">
                    @if (Auth::guest())
                    @else
                    <a href="#" class="module module-cart right" data-toggle="panel-cart">
                        <span class="cart-icon">
                            <i class="ti ti-shopping-cart"></i>
                            <span class="notificationaa"><?php echo (Session::has('cart_count'))?Session::get('cart_count'):$cart_count;?></span>
                        </span>
                        <span class="cart-value"></span>
                    </a>
                    @endif
                </div>
                
            </div>
        </div>

    </header>
    <!-- Header / End -->

    <!-- Header -->
    <header id="header-mobile" class="light">

        <div class="module module-nav-toggle">
            <a href="#" id="nav-toggle" data-toggle="panel-mobile"><span></span><span></span><span></span><span></span></a>
        </div>

        <div class="module module-logo">
            <a href="index.html">
                <img src="assets/img/logo-horizontal-dark.svg" alt="">
            </a>
        </div>

        <a href="#" class="module module-cart" data-toggle="panel-cart">
            <i class="ti ti-shopping-cart"></i>
            <span class="notificationaa">0</span>
        </a>

    </header>
    <!-- Header / End -->
    <!-- Header -->
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
                    <a href="#" class="module module-cart right" data-toggle="panel-cart">
                        <span class="cart-icon">
                            <i class="ti ti-shopping-cart"></i>
                            <span class="notification display-cart">0</span>
                        </span>
                        <span class="cart-value">$<span class="value">0.00</span></span>
                    </a>
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
            <span class="notification">0</span>
        </a>

    </header>
    <!-- Header / End -->
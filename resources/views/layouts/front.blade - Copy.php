<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="themes/assets/ico/favicon.ico">
    <title>Book Meals</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/fornt/themes/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="themes/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/fornt/themes/assets/css/carousel.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  </head>
<!-- NAVBAR
================================================== -->
  <body>
        <div class="navbar-wrapper">
      <div class="container">
        @include('partials._messages')
      </div>
    </div>
    <div class="navbar-wrapper">
      <div class="container">

        <div class="navbar navbar-inverse navbar-static-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{{ url('/') }}">Book Meals</a>
            </div>

            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="#tablebooking">Table Booking</a></li>

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Indina <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">DRINKS</a></li>
                    <li><a href="#">STARTERS</a></li>
                    <li><a href="#">TANDOORI - CLAY OVEN - DISHES</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">SEAFOOD MAIN COURSES</li>
                    <li><a href="#">CHICKEN MAIN COURSES</a></li>
                    <li><a href="#">LAMB MAIN COURSES</a></li>
                    <li><a href="#">RICE/BREDS</a></li>
                    <li><a href="#">ACCOMPANIMENTS</a></li>
                  </ul>
                </li>
        

                @if (Auth::guest())
                  <li><a href="{{ route('login') }}">Login</a></li>
                  <li><a href="{{ route('register') }}">Register</a></li>
                @else


                  <li>
                      <a href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                         {{ Auth::user()->username }} Logout
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                          </li>

                              
                @endif
               </ul>  



            </div>

             <div class="navbar-header"><a href="{{ route('register') }}">Cart </a><span class="display-cart"><?php echo Session::get('cart_count') ;?></span></div>
          </div>
        </div>

      </div>
    </div>



    
    <!-- Carousel
    ================================================== -->
    @yield('content')
      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->
      <footer>
    <div class="container">
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2018 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </div>
      </footer>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="{{ asset('css/fornt/themes/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('css/fornt/themes/assets/js/holder.js') }}"></script>

  </body>
</html>

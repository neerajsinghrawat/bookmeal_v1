<?php //echo'<pre>';print_r($cart_count);die; ?>


            <header>
                <!--Top Header Start -->
                <div class="top">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <ul class="list-inline float-left icon">
                                    <li class="list-inline-item"><a href="tel:<?php echo (!empty($setting->mobile))? $setting->mobile:'';?>"><i class="icofont icofont-phone"></i> Hotline :  <?php echo (!empty($setting->mobile))? $setting->mobile:'';?></a></li>

                                    <li class="list-inline-item "><a class="postcode_html">
                        <?php  if (Session::has('postcode')) {  echo Session::get('postcode.code'); } ?></a></li>
                                </ul>
                                <!-- Header Social Start -->
                                <ul class="list-inline float-right icon">
                                    <?php
                                        //echo url()->current();die;
                                     if(Auth::check()){ ?>
                                    <li class="list-inline-item"><a href="{{ url('/shopping-cart') }}"><i class="icofont icofont-cart-alt"></i> Cart <span class="display-cart"><?php echo (Session::has('cart_count'))?Session::get('cart_count'):$cart_count;?></span></a></li>
                                    <?php } ?>
                                      @if (Auth::guest())
                                    <li class="list-inline-item"><a href="{{ route('login') }}">Login</a></li>
                                    <li class="list-inline-item"><a href="{{ route('register') }}">Register</a></li>
                                @else
                                    <li class="list-inline-item dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-ui-user"></i> My Account ({{ Auth::user()->username }})</a>
                                        <ul class="dropdown-menu dropdown-menu-right drophover" aria-labelledby="dropdownMenuLink">
                                           
									 <li class="list-inline-item"><a href="<?php echo URL::to('/').'/dashboard'; ?>">Dashboard</a></li>
                                    <li class="dropdown-item"><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form></li>
                              
                                        </ul>
                                    </li>

                                      @endif
                                    <li class="list-inline-item">
                                        <ul class="list-inline social">
                                             <?php if(!empty($setting->facebook)){  ?> <li class="list-inline-item"><a href="<?php echo $setting->facebook;?>" target="_blank"><i class="icofont icofont-social-facebook"></i></a></li><?php } ?>
                                            <?php if(!empty($setting->twitter)){  ?> <li class="list-inline-item"><a href="<?php echo $setting->twitter;?>" target="_blank"><i class="icofont icofont-social-twitter"></i></a></li><?php } ?>
                                            <?php if(!empty($setting->g_plus)){  ?> <li class="list-inline-item"><a href="<?php echo $setting->g_plus;?>" target="_blank"><i class="icofont icofont-social-google-plus"></i></a></li><?php } ?>
                                            <?php if(!empty($setting->youtube_link)){  ?> <li class="list-inline-item"><a href="<?php echo $setting->youtube_link;?>" target="_blank"><i class="icofont icofont-social-youtube-play"></i></a></li><?php } ?>
                                        </ul>
                                    </li>
                                </ul>
                                <!-- Header Social End -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--Top Header End -->

                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <!-- Logo Start  -->
                            <div id="logo">
                                <a href="{{ url('/') }}"><img id="logo_img" class="img-fluid" src="{{ asset('image/setting/'.$setting->logo) }}" alt="logo" title="logo" /></a>
                            </div>
                            <!-- Logo End  -->
                        </div>

                        <div class="col-md-7 col-sm-6 col-xs-12 paddleft">
                            <!-- Main Menu Start  -->
                            <div id="menu"> 
                                <nav class="navbar navbar-expand-md">
                                    <div class="navbar-header">
                                        <span class="menutext d-block d-md-none">Menu</span>
                                        <button data-target=".navbar-ex1-collapse" data-toggle="collapse" class="btn btn-navbar navbar-toggler" type="button"><i class="icofont icofont-navigation-menu"></i></button>
                                    </div>
                                    <div class="collapse navbar-collapse navbar-ex1-collapse padd0">
                                        <ul class="nav navbar-nav">
                                            <li class="nav-item dropdown"><a href="{{ url('/') }}">HOME</a>
                                                
                                            </li>
                                             <li class="nav-item dropdown"><a href="{{ url('/about-us') }}">About us</a>
                                                
                                            </li>
 <?php
                if (isset($pages_detail[0]) && !empty($pages_detail)) {
                    
                 $index = 0;
                 foreach ($pages_detail as $pagedetail){

                 $index++;
                 ?>
                                <li class="nav-item dropdown"><a href="{{ url('/page-detail/'.$pagedetail->slug) }}">{{ ucwords($pagedetail->name) }}</a></li>
                               <?php } } ?>
                                            </li>
                                <li class="nav-item dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Our Menu</a>
                                                <div class="dropdown-menu">
                                                    <div class="dropdown-inner">
                                                        <ul class="list-unstyled">
                                            <?php
                if (isset($category_list[0]) && !empty($category_list)) {
                    
                 $index = 0;
                 foreach ($category_list as $categorylist){

                 $index++;
                 ?>
                                                            <li><a href="{{ URL::to('category/'.$categorylist['slug']) }}"><?php echo $categorylist['name']; ?></a></li>
                                                           

                                                            <?php } }?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nav-item dropdown"><a href="{{ url('/contact-us') }}">Contact us</a>
                                            <li class="nav-item dropdown"><a href="{{ url('/client') }}">Client</a>
                                           

                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <!-- Main Menu End -->
                        </div>
                    <!--     <div class="col-md-2 col-sm-12 col-xs-12 button-top paddleft">
                            <a class="btn-primary btn" href='reservation.html'>Book Your Table</a>
                        </div> -->
                    </div>
                </div>
            </header>
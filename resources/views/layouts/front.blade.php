 <?php $model = new App\Models\Setting;
       $setting = get_data($model); ?>
<!DOCTYPE html>
<html lang="en">
<head>

<!-- Meta -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<!-- Title -->
<title><?php echo (!empty($setting->site_title))? $setting->site_title:'';?> | @yield('title')</title>
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')"> 
<!-- Favicons -->
<link rel="shortcut icon" href="{{ asset('image/favicon-32x32.png') }}">
<link rel="apple-touch-icon" href="{{ asset('image/favicon-32x32.png') }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('image/favicon-32x32.png') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('image/favicon-32x32.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('image/favicon-32x32.png') }}">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&family=Raleway:wght@100;200;400;500&display=swap" rel="stylesheet">

<!-- CSS Core -->
<link rel="stylesheet" href="{{ asset('css/front/css/core.css') }}" />

<!-- CSS Theme -->
<link id="theme" rel="stylesheet" href="{{ asset('css/front/css/theme-beige.css') }}" />

</head>
    <body>
        @include('partials._front_messages')
        
    <div id="body-wrapper" class="animsition">
            <!--[if lt IE 8]>
               <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
           <![endif]-->  

            <!-- Loader Start -->
           <!--  <div class="loader">
                <div class="loader-inner">
                    <h4>Cooking in progress..</h4>
                    <div id="cooking">
                        <div class="bubble"></div>
                        <div class="bubble"></div>
                        <div class="bubble"></div>
                        <div class="bubble"></div>
                        <div class="bubble"></div>
                        <div id="area">
                            <div id="sides">
                                <div id="pan"></div>
                                <div id="handle"></div>
                            </div>
                            <div id="pancake">
                                <div id="pastry"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- Loader End -->

            <!--  Header Start  -->
        @include('partials.header')
            <!-- Header End   -->


    <div id="content">
                <!-- Order Start  -->
    @yield('content')
                <!-- Order End  -->

                <!-- Popular Dishes Start -->

                <!-- Popular Dishes End -->

                <!-- Food Menu Start -->

                <!-- Food Menu End -->

                <!-- Reservation Start -->

                <!-- Reservation End  -->

                <!-- Blog Start -->

                <!-- Blog End -->

                <!-- Newsletter Start -->

                <!-- Newsletter End -->

                <!-- Footer Start -->
    @include('partials.footer')
                <!-- Footer End  -->

    </div>
    <div id="panel-cart">
        <div class="panel-cart-container">
            <div class="panel-cart-title">
                <h5 class="title">Your Cart</h5>
                <button class="close" data-toggle="panel-cart"><i class="ti ti-close"></i></button>
            </div>
            <div class="panel-cart-content cart-details">




                                <table class="table-cart">
                                   <tbody>
                                        <?php $total = 0;
                                        if (!empty($cart_list[0])) {
                                                foreach ($cart_list as $key => $cartlistdetail) {  
                                                               $iImgPath = asset('image/no_product_image.jpg');
                                                              if(isset($cartlistdetail->product->image) && !empty($cartlistdetail->product->image)){
                                                                $iImgPath = asset('image/product/200x200/'.$cartlistdetail->product->image);
                                                              }
                                                $total += ($cartlistdetail->product->price * $cartlistdetail->qty);
                                         ?>
                                        <tr class="cart_{{ $cartlistdetail->id }}">
                                            <td class="title">
                                                <span class="name"><a href="#product-modal" data-toggle="modal">{{ ucwords($cartlistdetail->product->name) }}</a></span>
                                                <span class="caption text-muted">Large (500g)</span>
                                            </td>
                                            <td class="price">{{ getSiteCurrencyType().$cartlistdetail->product->price }}</td>
                                            <td class="actions">
                                                <a href="#product-modal" data-toggle="modal" class="action-icon"><i class="ti ti-pencil"></i></a>
                                                
                                                <button type="button" class="action-icon delete_cart delete_{{ $cartlistdetail->id }}" cart_id="{{ $cartlistdetail->id }}"><i class="ti ti-close"></i></button>
                                            </td>
                                        </tr>
                                       
                                        <?php } }else { ?>
                                        <tr>
                                            <td>No items found</td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                    <div class="cart-summary">
                                        <div class="row">
                                            <div class="col-7 text-right text-muted">Order total:</div>
                                            <div class="col-5"><strong><span class="cart-products-total">{{ getSiteCurrencyType().$total}}</span></strong></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-7 text-right text-muted">Devliery:</div>
                                            <div class="col-5"><strong><span class="cart-delivery"><?php $total_amount = $total; 
                                                    if (!empty($shipping_taxes->shipping_amount) && $shipping_taxes->shipping_type == 'Paid' ) {
                                                         $total_amount = $shipping_taxes->shipping_amount + $total_amount;       

                                                         echo getSiteCurrencyType().$shipping_taxes->shipping_amount;
                                                     }else{
                                                        echo 'Free';
                                                     } 


                                                    if ((Session::has('apply_coupon.amount')) && !empty(Session::get('apply_coupon.amount'))) {
                                                        if ($total_amount > Session::get('apply_coupon.amount')) {
                                                            $total_amount = $total_amount - Session::get('apply_coupon.amount');
                                                        }else{
                                                            $total_amount = 0;
                                                        }
                                                        
                                                    } ?></span></strong></div>
                                        </div>
                                        <hr class="hr-sm">
                                        <div class="row text-lg">
                                            <div class="col-7 text-right text-muted">Total:</div>
                                            <div class="col-5"><strong><span class="cart-total"><?php echo getSiteCurrencyType().$total_amount; ?></span></strong></div>
                                        </div>
                                    </div>
                <!-- <div class="cart-empty">
                    <i class="ti ti-shopping-cart"></i>
                    <p>Your cart is empty...</p>
                </div> -->
            </div>
        </div>
        <a href="checkout.html" class="panel-cart-action btn btn-secondary btn-block btn-lg"><span>Go to checkout</span></a>
    </div>

    <!-- Panel Mobile -->
    <nav id="panel-mobile">
        <div class="module module-logo bg-dark dark">
            <a href="#">
                <img src="assets/img/logo-light.svg" alt="" width="88">
            </a>
            <button class="close" data-toggle="panel-mobile"><i class="ti ti-close"></i></button>
        </div>
        <nav class="module module-navigation"></nav>
        <div class="module module-social">
            <h6 class="text-sm mb-3">Follow Us!</h6>
            <a href="#" class="icon icon-social icon-circle icon-sm icon-facebook"><i class="fa fa-facebook"></i></a>
            <a href="#" class="icon icon-social icon-circle icon-sm icon-google"><i class="fa fa-google"></i></a>
            <a href="#" class="icon icon-social icon-circle icon-sm icon-twitter"><i class="fa fa-twitter"></i></a>
            <a href="#" class="icon icon-social icon-circle icon-sm icon-youtube"><i class="fa fa-youtube"></i></a>
            <a href="#" class="icon icon-social icon-circle icon-sm icon-instagram"><i class="fa fa-instagram"></i></a>
        </div>
    </nav>

    <!-- Body Overlay -->
    <div id="body-overlay"></div>
</div>
<!-- Modal / Product -->
<div class="modal fade product-modal" id="product-modal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-lg dark bg-dark">
                <div class="bg-image"><img src="http://assets.suelo.pl/soup/img/photos/modal-add.jpg" alt=""></div>
                <h4 class="modal-title">Specify your dish</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti ti-close"></i></button>
            </div>
            <div class="modal-product-details">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h6 class="mb-1 product-modal-name">Boscaiola Pasta</h6>
                        <span class="text-muted product-modal-ingredients">Pasta, Cheese, Tomatoes, Olives</span>
                    </div>
                    <div class="col-3 text-lg text-right">$<span class="product-modal-price">9.00</span></div>
                </div>
            </div>
            <div class="modal-body panel-details-container">
                <!-- Panel Details / Size -->
                <div class="panel-details panel-details-size">
                    <h5 class="panel-details-title">
                        <label class="custom-control custom-radio">
                            <input name="radio_title_size" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                        </label>
                        <a href="#panel-details-sizes-list" data-toggle="collapse">Size</a>
                    </h5>
                    <div id="panel-details-sizes-list" class="collapse show">
                        <div class="panel-details-content">
                            <div class="product-modal-sizes">
                                <div class="form-group">
                                    <label class="custom-control custom-radio">
                                        <input name="radio_size" type="radio" class="custom-control-input" checked>
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Small - 100g ($9.99)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="custom-control custom-radio">
                                        <input name="radio_size" type="radio" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Medium - 200g ($14.99)</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="custom-control custom-radio">
                                        <input name="radio_size" type="radio" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Large - 350g ($21.99)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Panel Details / Additions -->
                <div class="panel-details panel-details-additions">
                    <h5 class="panel-details-title">
                        <label class="custom-control custom-radio">
                            <input name="radio_title_additions" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                        </label>
                        <a href="#panel-details-additions-content" data-toggle="collapse">Additions</a>
                    </h5>
                    <div id="panel-details-additions-content" class="collapse">
                        <div class="panel-details-content">
                            <!-- Additions List -->
                            <div class="row product-modal-additions">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Tomato ($1.29)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Ham ($1.29)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Chicken ($1.29)</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Cheese($1.29)</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input">
                                            <span class="custom-control-indicator"></span>
                                            <span class="custom-control-description">Bacon ($1.29)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Panel Details / Other -->
                <div class="panel-details panel-details-form">
                    <h5 class="panel-details-title">
                        <label class="custom-control custom-radio">
                            <input name="radio_title_other" type="radio" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                        </label>
                        <a href="#panel-details-other" data-toggle="collapse">Other</a>
                    </h5>
                    <div id="panel-details-other" class="collapse">
                        <form action="#">
                            <textarea cols="30" rows="4" class="form-control" placeholder="Put this any other informations..."></textarea>
                        </form>
                    </div>
                </div>
            </div>
            <button type="button" class="modal-btn btn btn-secondary btn-block btn-lg" data-action="add-to-cart"><span>Add to Cart</span></button>
            <button type="button" class="modal-btn btn btn-secondary btn-block btn-lg" data-action="update-cart"><span>Update</span></button>
        </div>
    </div>
</div>

<!-- Video Modal / Demo -->
<div class="modal modal-video fade" id="modalVideo" role="dialog">
    <button class="close" data-dismiss="modal"><i class="ti ti-close"></i></button>
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <iframe height="500"></iframe>
        </div>
    </div>
</div>

<!-- Modal / COVID -->
<div class="modal fade" id="covid-modal" role="dialog" data-timeout="1000" data-set-cookie="covid-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-lg dark bg-dark">
                <div class="bg-image"><img src="http://assets.suelo.pl/soup/img/photos/modal-covid.jpg" alt=""></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ti ti-close"></i></button>
            </div>
            <div class="modal-body">
                <h3>We are COVID-19 safe!</h3>
                <p>In sed massa tempus, dapibus est pulvinar, pellentesque tellus. Donec ultricies magna nec mauris ornare venenatis. Duis fermentum est diam, in molestie tellus venenatis id. In ut efficitur mi, vel hendrerit libero. Phasellus ac vulputate lorem, pharetra tempor leo. Fusce eu dui libero.</p>
                <button class="btn btn-secondary" data-dismiss="modal"><span>Ok, thanks!</span></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade product-modal" id="odder" role="dialog">
    <div class="modal-dialog" role="document" style="margin-left: 400px;
    margin-right: 660px;
    margin-top: 100px;">
            <div class="container" style="
    width: 1119px;
    height: 1165px;
">
                <div class="row justify-content-center">
                    <div class="col-lg-10  modal-content" style="padding-left: 0px;
    padding-right: 0px;">
                        
                        <!-- Book a Table -->
                        <div class="utility-box">
                            <div class="utility-box-title bg-dark dark">
                                <div class="bg-image"><img src="http://assets.suelo.pl/soup/img/photos/modal-review.jpg" alt=""></div>
                                <div>
                                    <span class="icon icon-primary"><i class="ti ti-bookmark-alt"></i></span>
                                    <h4 class="mb-0">Book a table</h4>
                                    <p class="lead text-muted mb-0">Details about your reservation.</p>
                                </div>
                            </div> 
                            <div class="row">
                            <div class="col-sm-6 special-offer-content">
                                <div class="bg-white p-4 p-md-5 mb-4">
                            
                                <h4 class="mb-0"><b>Opening Times</b></h4><br>
                                <?php 
                                foreach ($setting->openingTime as $key => $value) {
                                   //echo '<pre>';print_r($value);die;
                                ?>
                                <div class="row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <h6 class="mb-1 text-muted">{{ $value->day_name }}</h6>
                                        
                                    </div>
                                    <div class="col-sm-6">
                                        <?php if($value->is_close == 1){ ?>
                                        <h6 class="mb-1 text-muted">Day Off</h6>
                                        <?php }else{ ?>
                                        <h6 class="mb-1 text-muted">{{ date('h:i A', strtotime($value->start_time)) }} – {{ date('h:i A', strtotime($value->end_time)) }}</h6>
                                        <?php } ?>
                                    </div>
                                </div>
                                <hr class="hr-md" style="margin-top: 10px;margin-bottom: 10px;"> 
                                <?php } ?>
                                <br>
                        <h4 class="mb-0"><b>Call Us Now</b></h4>
                         <h6 class="mb-1 text-muted">{{ $setting->table_reservation_phone_number }}</h6>
                                

                                </div>
                            </div>
                            <div class="col-sm-6">

                               
                                <form action="" id="booking-form" class="booking-form">
                                    {{ csrf_field() }}
                                    <div class="utility-box-content"><div id="dispmsg" style="color: red"><b></b></div><div id="dispmsgSuccess" style="color: green"><b></b></div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label><b>People:</b></label>
                                                    <div class="select-container">
                                                    <select class="form-control" name="people_count" required>
                                                        <?php foreach ($people_count as $value) {  ?>
                                                        <option value="{{$value}}">{{$value}} people</option>
                                                        <?php  } ?>
                                                    </select>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label><b>Date *:</b></label>
                                                    <input type="date" name="reservation_date" class="form-control" id="date" required>
                                                </div>
                                            </div>                                            
                                        </div>   

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label><b>Time:</b></label>
                                                    <div class="select-container">
                                                    <select name="reservation_time" class="form-control" required>
                                                        <?php foreach ($timearray as $value) {
                                                             ?>
                                                        <option value="{{$value}}">{{$value}} people</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label><b>Name *:</b></label>
                                                    <input type="text" name="name" class="form-control" required id="name">
                                                </div>
                                            </div>
                                        </div>
                                                <div class="form-group">
                                                    <label><b>Email *:</b></label>
                                                    <input type="email" name="email" class="form-control" id="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label><b>Phone Number *:</b></label>
                                                    <input type="text" id="phone" name="phone" class="form-control" required>
                                                </div>
                                        <br>
                                        <button class="utility-box-btn btn btn-secondary btn-block btn-lg saveTablereservation" type="button">Make reservation!</button>
                                    </div>

                               
                                    
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<!-- Cookies Bar -->
<div id="cookies-bar" class="body-bar cookies-bar">
    <div class="body-bar-container container">
        <div class="body-bar-text">
            <h4 class="mb-2">Cookies & GDPR</h4>
            <p>This is a sample Cookies / GDPR information. You can use it easily on your site and even add link to <a href="#">Privacy Policy</a>.</p>
        </div>
        <div class="body-bar-action">
            <button class="btn btn-primary" data-accept="cookies"><span>Accept</span></button>
        </div>
    </div>
</div>
<!-- JS Core -->
<script src="{{ asset('css/front/js/jquery.min.js') }}"></script>
<script src="{{ asset('css/front/js/core.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	$(document).ready(function(){
        //alert('vfc');
		$('body').on('click','.close_popup_msg',function(){
			$('#popup_overlay').hide();
			$('#messageModel').hide();
		});
	});
</script>
<script src="{{ asset('js/admin/jquery.min2.1.3.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){

  $('.saveTablereservation').click(function(){
   // alert('mnlksdfjio');
    var name= $('#name').val();
    var email= $('#email').val();
    var phone= $('#phone').val();
    var date= $('#date').val();
    if (name !='' && email !='' && phone !='' && date !='') {
        var baseUrl = '{{ URL::to('/') }}';
        var formData = $('#booking-form').serialize();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url : baseUrl+'/pages/save_table_reservation',
            type : 'POST',
            data : $('#booking-form').serialize(),
            dataType : 'json',
            success : function(result){
              
            }
          }).done(function(result){
            
            if(result['success'] == 1){

                $('#dispmsgSuccess').html(result['msg']).show();
                setTimeout(function(){ jQuery("#dispmsgSuccess").hide(); }, 3000);

            }else{

                $('#dispmsg').html(result['msg']).show();
                setTimeout(function(){ jQuery("#dispmsg").hide(); }, 3000);

                //alert(result['msg']);
                //window.location.reload();
            }
          });
    }else{
        alert('Please Fill all * fields');
    }
  
  });

});
</script>
    </body>

</html>

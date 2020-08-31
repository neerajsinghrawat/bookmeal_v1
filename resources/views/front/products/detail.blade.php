@extends('layouts.front')
<?php $title = (!empty($product_details->meta_title))? $product_details->meta_title:(ucwords($product_details->category->name).' | '.ucwords($product_details->name));?>
@section('title', $title)
@section('description', (!empty($product_details->meta_description))? $product_details->meta_description:'')
@section('keywords', (!empty($product_details->meta_keyword))? $product_details->meta_keyword:'')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />   

        <!-- Section -->
        <section class="section bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <!-- Product Single -->
                        <div class="product-single">
                            <div class="product-image">
                                <?php if(!empty($productImages) && count($productImages) > 1){ ?>
                                <div class="container-product-slider">
                                    <div class="exzoom hidden" id="exzoom">
                                        <div class="exzoom_img_box">
                                            <ul class='exzoom_img_ul'>
                                            <?php foreach($productImages as $product_img){ ?>
                                                <li><img src="{{$product_img}}"/></li>
                                            <?php } ?>
                                            </ul>
                                        </div>
                                        <div class="exzoom_nav"></div>
                                        <p class="exzoom_btn">
                                            <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                            <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                                        </p>
                                    </div>
                                    </div>
                                <?php }else{ ?>
                                        <div class="image">
                                        <?php 

                                            $iImgPath = asset('image/no_product_image.jpg');
                                                  if(isset($product_details->image) && !empty($product_details->image)){
                                                    $iImgPath = asset('image/product/'.$product_details->image);
                                                  }
                                     ?>
                                        <img src="{{ $iImgPath }}" title="thumb image" alt="thumb image" class="img-fluid" style="width: 730px; height: 370px;" />
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="product-content">
                                <div class="product-header text-center">
                                    <h1 class="product-title">{{ ucwords($product_details->name) }}</h1>

                                    <span class="product-caption text-muted"><?php if(!empty($product_details->productItem) && count($product_details->productItem) > 0){  
                                        $i = 1;
                                        foreach ($product_details->productItem as $key => $productitem) {
                                               $slashs = ($i < count($productitem)) ? ', ' : '';
                                               echo ucwords($productitem->title.$slashs);
                                               $i++;                                             
                                              ?>
                                            
                                            <?php } } ?>
                                    </span>
                                    
                                </div>
                                <p class="lead"><?php echo $product_details->description ?></p>
                                <hr class="hr-primary">
                                <h5 class="text-center text-muted">Order details</h5>
                                <div class="panel-details-container">
                                    <!-- Panel Details / Size -->
                                    <div class="panel-details">
                                        <h5 class="panel-details-title">
                                            <label class="custom-control custom-radio">
                                                <input name="radio_title_size" type="radio" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                            </label>
                                            <a href="#panelDetailsSize" data-toggle="collapse">Size</a>
                                        </h5>
                                        <div id="panelDetailsSize" class="collapse">
                                            <div class="panel-details-content">
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
                                    <!-- Panel Details / Additions -->
                                    <div class="panel-details">
                                        <h5 class="panel-details-title">
                                            <label class="custom-control custom-radio">
                                                <input name="radio_title_additions" type="radio" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                            </label>
                                            <a href="#panelDetailsAdditions" data-toggle="collapse">Additions</a>
                                        </h5>
                                        <div id="panelDetailsAdditions" class="collapse">
                                            <div class="panel-details-content">
                                                <div class="row">
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
                                    <div class="panel-details">
                                        <h5 class="panel-details-title">
                                            <label class="custom-control custom-radio">
                                                <input name="radio_title_other" type="radio" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                            </label>
                                            <a href="#panelDetailsOther" data-toggle="collapse">Other</a>
                                        </h5>
                                        <div id="panelDetailsOther" class="collapse">
                                            <textarea cols="30" rows="4" class="form-control" placeholder="Put this any other informations..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">

                                    </div>
                                </div>
                                <h5 class="text-center text-muted">Order now!</h5>
                                <div class="product-price text-center">{{ getSiteCurrencyType().$product_details->price }}</div>
                                <div class="row">
<div class="common">
                                        <p class="qtypara float-left">
                                            <span id="minus1" class="minus"><i class="ti ti-minus"></i></span>
                                            <input type="text" name="quantity" value="1" size="2" id="input-quantity1" class="form-control qty" readonly="readonly">
                                            <span id="add1" class="add"><i class="ti ti-plus"></i></span>
                                            <input type="hidden" class="product_id" name="product_id" value="{{ $product_details->id }}">

                                            <input type="hidden" class="slug_id" name="slug_id" value="{{ $product_details->slug }}">
                                        </p>
                                        <div class="buttons">
                                            <!-- <a href="shopping-cart.html" class="btn btn-theme-alt btn-md">Order Now</a> -->
                                            <?php if(Auth::check()){ 
                                                 $code_status = 0;
                                              if (Session::has('postcode')) {
                                                $code_status = Session::get('postcode.code_status');
                                               } 

                                             if($code_status == 1){ ?>
                                            <a href="javascript:void(0)" class="btn btn-theme-alt btn-md addToCart">Add to cart</a>
                                            <?php }else{ ?>
                                             <a href="javascript:void(0)" data-toggle="modal" data-target="#postcode_popup" class="btn btn-theme-alt btn-md">Add to cart</a>
                                            <?php } ?>


                                            <?php }else{ ?>
                                            <a href="{{ URL::to('login/'.$product_details->slug) }}" class="btn btn-theme-alt btn-md">Add to cart</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <a href="menu-list-collapse.html" class="btn btn-link">Back to menu</a>
                                </div>
                            </div>
                            <h3 class="mt-5 mb-5 text-center">Reviews</h3>

                            <?php 
                                if(!empty($productReviews) && count($productReviews) > 0){
                                    
                                    foreach($productReviews as $product_review){
                                    
                                    $img = asset('image/no_product_image.jpg');
                                    if(!empty($product_review->user->picture)){
                                        $img = asset('image/user/150x150/'.$product_review->user->picture);
                                    }
                                    
                            ?>                            
                            <!-- Blockquote -->
                            <blockquote class="blockquote blockquote-lganimated" data-animation="fadeIn">
                                <div class="blockquote-content dark">
                                    <div class="rate rate-sm mb-3"> 
                                        <?php for($i = 1; $i <=5; $i++){ ?>
                                                    
                                            <i class="fa fa-star <?php echo ($i <= $product_review->rating) ? 'selected_star_rating' : 'not_selected_star_rating'; ?>"></i>
                                        <?php } ?>
                                    </div>
                                    <p><?php echo $product_review->review; ?></p>
                                </div>
                                <footer>
                                    <img src="{{ $img }}" alt="image">
                                    <span class="name"><?php echo $product_review->user->first_name .' '.$product_review->user->last_name; ?><span class="text-muted">, <?php $post_time = strtotime($product_review->created_at);
                                        $time = time() - $post_time; // to get the time since that moment
                                        $time = ($time<1)? 1 : $time;
                                        $tokens = array (
                                        31536000 => 'year',
                                        2592000 => 'month',
                                        604800 => 'week',
                                        86400 => 'day',
                                        3600 => 'hour',
                                        60 => 'minute',
                                        1 => 'second'
                                        );

                                        foreach ($tokens as $unit => $text) {
                                        if ($time < $unit) continue;
                                        $numberOfUnits = floor($time / $unit);
                                        echo  $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'').' ago';
                                        break;
                                         
                                        } ?></span></span>

                                </footer>
                            </blockquote>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style type="text/css">
    .ui-autocomplete
    {
        position:absolute;
        cursor:default;
        z-index:4000 !important
    }
</style>
<script type="text/javascript">

var baseUrl = '{{ URL::to('/') }}';

</script>
<script type="text/javascript"> 
$(document).ready(function() {

  var baseUrl = '{{ URL::to('/') }}';
      
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
 // var form = $( "#addToCartForm" ).serialize();

  $('.postcodesubmit').click(function(){
        
        var code = $('#postalAutoComplete').val(); 

            $.ajax({
      
                url: baseUrl+'/products/ajax_search_postalcode',
                
                type: 'post',
                
                data: {code: code,_token: CSRF_TOKEN},
                
                dataType: 'json',
                
                success: function(result) {

                  if (result.code_status == 1) {
                   $('<div id="successFlashMsg" class="msg msg-ok alert alert-success"><p>Food delivery able to your Postcode</p></div>').prependTo('.msgpostcode');
                  
                    $('.postcode_html').html(result.code);
                    window.setTimeout(function(){location.reload()},5000);
                  }else {

                    $('<div id="successFlashMsg" class="msg msg-ok alert alert-danger"><p>Food delivery not able to your Postcode</p></div>').prependTo('.msgpostcode');
                  }           
                  
                  
                  setTimeout(function(){
                    $("#successFlashMsg").fadeOut('slow');
                  },5000);
                  
                  
                
                }
                
              });
          
  });  
});
</script>

<script type="text/javascript"> 
$(document).ready(function() {

  var baseUrl = '{{ URL::to('/') }}';
      
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
 // var form = $( "#addToCartForm" ).serialize();

  $('.addToCart').click(function(){
        
        var productqty = $('.qty').val();     
        var productid = $('.product_id').val();     
        var slug = $('.slug_id').val();     
        //alert(productid);
        //alert(CSRF_TOKEN);
            $.ajax({
      
                url: baseUrl+'/products/add_to_cart',
                
                type: 'post',
                
                data: {productid: productid,productqty: productqty,slug: slug,_token: CSRF_TOKEN},
                
                dataType: 'json',
                
                success: function(result) {

                  //alert(result.response);
                  //$('#successFlashMsg').delay(1000).hide('highlight', {color: '#66cc66'}, 1500);
                  if (result.response == 1) {
                   $('<div id="successFlashMsg" class="msg msg-ok alert alert-success"><p>Item is successfully added into cart !</p></div>').prependTo('.msgcart');
                  
                    $('.display-cart').html(result.cart_count);
                  }else {

                    $('<div id="successFlashMsg" class="msg msg-ok alert alert-danger"><p>Item is not added into cart!</p></div>').prependTo('.msgcart');
                  }           
                  
                  
                  setTimeout(function(){
                    $("#successFlashMsg").fadeOut('slow');
                  },5000);
                  
                  
                
                }
                
              });
          
  });  
});
</script>


<script>
	$(document).ready(function(){
		
		$('.starRating').click(function(){
			
			var star = $(this).attr('number');
			
			$('.rating_value').val(star);
			
			 $( ".starRating" ).each(function() {
						
						var star_number = $(this).attr('number');
						
						if(star_number <= star){
							$(this).children().addClass('selected_star_rating');
						}else{
							$(this).children().removeClass('selected_star_rating');
						}
				  });
			
		});



		
	});
</script>

		
		<style>
			#exzoom {
				width: 730px;
				/*height: 400px;*/
			}
		</style>
		<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
		<link href="{{ asset('css/front/product_slider/jquery.exzoom.css') }}" rel="stylesheet">
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
		<script src="{{ asset('js/fornt/product_slider/jquery.exzoom.js') }}"></script>
		<script type="text/javascript">

		$('.container-product-slider').imagesLoaded( function() {

			$("#exzoom").exzoom({
				autoPlay: false,
			});
			$("#exzoom").removeClass('hidden')
		});

		</script>



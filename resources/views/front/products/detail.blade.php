@extends('layouts.front')
<?php $title = (!empty($product_details->meta_title))? $product_details->meta_title:(ucwords($product_details->category->name).' | '.ucwords($product_details->name));?>
@section('title', $title)
@section('description', (!empty($product_details->meta_description))? $product_details->meta_description:'')
@section('keywords', (!empty($product_details->meta_keyword))? $product_details->meta_keyword:'')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />   
            <!-- Breadcrumb Start -->
            <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2>{{ strtolower($product_details->name) }}</h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="{{ url('/') }}">HOME</a></li>
                            <li class="list-inline-item"><a href="{{ URL::to('category/'.$product_details->category->slug) }}">{{ ucwords($product_details->category->name) }}</a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)">{{ ucwords($product_details->name) }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb End -->

            <!-- Shop Start -->
            <div class="shop">
                <div class="container">
                    <div class="row">
					
                        <div class="col-md-12 msgcart">
                            <div class="row shopdetail">
                                <div class="col-sm-5 col-xs-12">
								
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
                                        <img src="{{ $iImgPath }}" title="thumb image" alt="thumb image" class="img-fluid" style="width: 445px; height: 370px;" />
                                    </div>
								<?php } ?>

                                    
                                </div>
<?php  $subcategory_name = getsubcategoryname($product_details['sub_category_id']);  ?>
<?php  $category_name = getmaincategoryname($product_details['category_id']);  

$subcategory_names = (!empty($subcategory_name->name))?'/'.ucwords($subcategory_name->name):'';?>
                                <div class="col-sm-7 col-xs-12">
                                    <h2>{{ ucwords($product_details->name) }}</h2>
									<h5 class="product_detail_cat_title">{{ ucwords($category_name->name) .' '.$subcategory_names}}</h5>
									<?php  $avg_rating = getProductAverageRating($productReviews);  ?>
										   
                                    <div class="rating">
                                      <?php for($i = 1; $i <=5; $i++){ ?>
										
										<i class="icofont icofont-star  <?php echo ($i <= $avg_rating) ? 'selected_star_rating' : 'not_selected_star_rating'; ?>"></i>

										<?php } ?>
                                    </div>
                                    <div class="price">{{ getSiteCurrencyType().$product_details->price }} </div>
                                    <?php echo $product_details->server_text_heading ?> 
                                    <h4>Items:-</h4>
                                        <?php  $product_tag = getProducttag($product_details['id']);  ?>                                                        
<!--                                                         <p class="des">
                                                            <?php  
                                                            /*$i = 1;
                                                            foreach ($product_tag as $key => $productag) {
                                                                $slashs = ($i < count($product_tag)) ? ' / ' : '';
                                                               echo '<a href="'.URL::to('product-tag/'.$productag->tag).'" >'.$productag->tag.$slashs.' </a>';
                                                           $i++; }*/ ?></p> -->
                                    
                                    <div class="food">
                                    <?php if(!empty($product_details->productItem) && count($product_details->productItem) > 0){ ?>                                        
                                        <ul>

                                            <?php  foreach ($product_details->productItem as $key => $productitem) {
                                              ?>
                                            <li><h3>{{ $productitem->title }}</h3></li>
                                            <?php } ?>
                                        </ul>
                                        <?php } ?>
                                    </div>
                                    <div class="common">
                                        <p class="qtypara float-left">
                                            <span id="minus1" class="minus"><i class="icofont icofont-minus"></i></span>
                                            <input type="text" name="quantity" value="1" size="2" id="input-quantity1" class="form-control qty" readonly="readonly">
                                            <span id="add1" class="add"><i class="icofont icofont-plus"></i></span>
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

                                <div class="col-sm-12 col-xs-12">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item"><a class="nav-link active" href="#tab-description" data-toggle="tab">description</a></li>
<!--                                         <li class="nav-item"><a class="nav-link" href="#tab-items" data-toggle="tab">Items</a></li> -->
                                        <li class="nav-item"><a class="nav-link" href="#tab-allergen" data-toggle="tab">Allergen Key</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#tab-review" data-toggle="tab">Reviews (<?php echo !empty($productReviews) ? count($productReviews) : 0; ?>)</a></li>
										
										 @if (Auth::guest())
											 
										 @else
											<li class="nav-item"><a class="nav-link" href="#tab-add" data-toggle="tab">add Review</a></li> 
										 @endif
                                        
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab-description">
                                            <?php echo $product_details->description ?> 

                                            <?php if(!empty($product_details->productItem) && count($product_details->productItem) > 0){ ?>
                                            <ul>
                                                <?php
                                                    foreach ($product_details->productItem as $key => $productitem) {
                                                  ?>
                                                <li><h6>{{ $productitem->title }}</h6><p><?php echo $productitem->description; ?></p></li>
                                                <?php } ?>
                                            </ul>
                                            <?php } ?>                                           
                                           
                                        </div>                                        

<!--                                         <div class="tab-pane" id="tab-items">
                                            <?php if(!empty($product_details->productItem) && count($product_details->productItem) > 0){ ?>
                                            <ul>
                                                <?php
                                                    foreach ($product_details->productItem as $key => $productitem) {
                                                  ?>
                                                <li><h3>{{ $productitem->title }}</h3></li>
                                                <?php } ?>
                                            </ul>
                                            <?php } ?>
                                        </div> -->

                                        <div class="tab-pane" id="tab-allergen">
                                            <?php echo $product_details->allergen_key ?>
                                        </div>

                                        <div class="tab-pane" id="tab-review">
										<?php 
											if(!empty($productReviews) && count($productReviews) > 0){
												
												foreach($productReviews as $product_review){
												
												$img = asset('image/no_product_image.jpg');
												if(!empty($product_review->user->picture)){
													$img = asset('image/user/150x150/'.$product_review->user->picture);
												}
												
										?>
                                            <div class="box">
                                                <img src="{{ $img }}" alt="image" title="image" class="mr-3 rating_user_img img-responsive img-circle"/>
                                                <div class="detail">
                                                    <h2><?php echo $product_review->user->first_name .' '.$product_review->user->last_name; ?></h2>
                                                    <span>
													<?php $post_time = strtotime($product_review->created_at);
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
														 
													} ?></span>
                                                    <div class="rating">
													<?php for($i = 1; $i <=5; $i++){ ?>
													
                                                        <i class="icofont icofont-star  <?php echo ($i <= $product_review->rating) ? 'selected_star_rating' : 'not_selected_star_rating'; ?>"></i>
													<?php } ?>
													
                                                    </div>
													

                                                    <p><?php echo $product_review->review; ?></p>
                                                </div>
                                            </div>
											<?php } } ?>
										   
										   </div>
                                        <div class="tab-pane" id="tab-add">
                                            
											<form class="form-horizontal" id="form-review" action="{{ url('/save_product_review') }}" enctype="multipart/form-data" method="POST" >
													 {{ csrf_field() }}

                                                <div class="form-group row required">
                                                    <div class="col-sm-12">
                                                        <textarea name="review" rows="5" id="input-review" placeholder="Your Reviews*" class="form-control" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
													<p> Your Rating*</p>
                                                         <div class="rating">
														 
                                                        <a href="javascript:void(0);" number='1' class="starRating"><i class="icofont icofont-star"></i></a>
                                                        <a href="javascript:void(0);" number='2' class="starRating"><i class="icofont icofont-star"></i></a>
                                                        <a href="javascript:void(0);" number='3' class="starRating"><i class="icofont icofont-star"></i></a>
                                                       <a href="javascript:void(0);" number='4' class="starRating"> <i class="icofont icofont-star"></i></a>
                                                       <a href="javascript:void(0);" number='5' class="starRating"> <i class="icofont icofont-star"></i></a>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="buttons clearfix">
												<input type="hidden" value="" class="rating_value" name="rating">
												<input type="hidden" name="product_id" value="<?php echo $product_details->id ?>">
												<input type="hidden" name="product_slug" value="<?php echo $product_details->slug; ?>">
                                                    <button type="submit" id="button-review" name="submit" value='saveProductReview'  class="btn btn-theme btn-wide">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
						

                            <div class="row">
                                <!-- Title Content Start -->
                                <div class="col-sm-12 commontop text-center">
                                    <h4>Related Food</h4>
                                    <div class="divider style-1 center">
                                        <span class="hr-simple left"></span>
                                        <i class="icofont icofont-ui-press hr-icon"></i>
                                        <span class="hr-simple right"></span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
                                </div>
                                <!-- Title Content End -->

                               <!-- Single Product Start -->
<?php 
if (isset($related_products[0]) && !empty($related_products[0])) {
                          
foreach ($related_products as $key => $relatproduct) {  
               $iImgPath = asset('image/no_product_image.jpg');
              if(isset($relatproduct->image) && !empty($relatproduct->image)){
                $iImgPath = asset('image/product/200x200/'.$relatproduct->image);
              }
 ?>

                                <div class="product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-12">
                                    <div class="product-thumb">
                                        <div class="image">
                                           <a href="{{ URL::to('product/'.$relatproduct['slug']) }}"><img src="{{ $iImgPath }}" alt="image" title="image" class="img-fluid product_homeitem_img" /></a>
                                        </div>
<?php  $subcategory_name = getsubcategoryname($relatproduct['sub_category_id']);  ?>
<?php  $category_name = getmaincategoryname($relatproduct['category_id']);   ?>
                                        <div class="caption">
                                            <h4 class="product_sub_cat_title"><?php echo (!empty($subcategory_name->name))?$subcategory_name->name:'' ?></h4>
                                          <a href="{{ URL::to('product/'.$relatproduct['slug']) }}"><h4 class="product_title">{{  ucwords($category_name->name).' '.ucwords($relatproduct['name']) }}</h4>
                                           </a>
<?php  $avg_rating = getProductAverageRatingfor_many_items($relatproduct['id']);  ?>
                                           
                                    <div class="rating">
                                      <?php for($i = 1; $i <=5; $i++){ ?>
                                        
                                            <i class="icofont icofont-star  <?php echo ($i <= $avg_rating) ? 'selected_star_rating' : 'not_selected_star_rating'; ?>"></i>
                                        <?php } ?>
                                    </div>
                                            <div class="price"><?php echo getSiteCurrencyType(); ?>{{ $relatproduct->price }}</div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <?php } } ?>
                                <!-- Single Product End -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shop End -->


<!-- Postcode popup -->
    <div id="postcode_popup" class="modal fade" role="dialog" >
        <div class="modal-dialog modal-lg" >
            <div class="modal-content" >
                <div class="modal-body msgpostcode" >

                              <!-- Order Start  -->
            <div class="order">
                <div class="container">
                    <div class="row justify-content-center">
                        <!-- Title Content Start -->
                        <div class="col-sm-12 commontop text-center">
                            <h4>Order Delivery and take out</h4>
                            <div class="divider style-1 center">
                                <span class="hr-simple left"></span>
                                <i class="icofont icofont-ui-press hr-icon"></i>
                                <span class="hr-simple right"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
                        </div>
                        <!-- Title Content End -->
                        <div class="col-lg-7 col-sm-12">
                            <!-- Search Form Start -->
        <form method="POST" class="form-horizontal search-icon" >

                                <fieldset>
                                    <div class="form-group">
                                        <input name="code" id="postalAutoComplete" value="" placeholder="Search Your Postcode"  class="form-control" type="text">
                                    </div>
                                    <button type="button" value="submit" class="btn btn-theme postcodesubmit"><i class="icofont icofont-search"></i>Search</button>
                                </fieldset>
                            </form>
                            <!-- Search Form End -->
                            <ul class="list-inline text-center">
                                <li class="list-inline-item postcodeimg">
                                    <i class="icofont icofont-fast-food"></i>
                                    <p>Select Food</p>
                                </li>
                                <li class="list-inline-item postcodeimg">
                                    <i class="icofont icofont-food-basket"></i>
                                    <p>Order Food</p>
                                </li>
                                <li class="list-inline-item postcodeimg">
                                    <i class="icofont icofont-fast-delivery"></i>
                                    <p>Delivery or Take Out</p>
                                </li>
                            </ul>
                            <img src="{{ asset('public/img/lines.png') }}" alt="line" title="line" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- Order End  -->
                </div>                 
            </div>
        </div>
    </div>
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
    $(function() {
      
        $("#postalAutoComplete").autocomplete({
          source: baseUrl+"/products/autocomplete_postcode",
          minLength: 1,
          select: function(event, ui) {
            
             console.log(ui);
          },
      
          html: true, // optional (jquery.ui.autocomplete.html.js required)
      
          
        });
        
      });
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
				width: 400px;
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



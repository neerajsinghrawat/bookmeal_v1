@extends('layouts.front')
 <?php $model = new App\Models\Setting;
       $setting = get_data($model); ?>
@section('title', 'Home')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
            <!-- Slider Start -->
            <div class="slide"> 
                <div class="slideshow owl-carousel">
                    <!-- Slider Backround Image Start -->
                    <?php 
					
foreach ($sliders as $key => $slider) {  
               $iImgPath = asset('image/no_product_image.jpg');
              if(isset($slider->image) && !empty($slider->image)){
                $iImgPath = asset('image/slider/'.$slider->image);
              }
 ?>
                    
                    <div class="item">
					<div class="slide-detail">
                    <div class="container">
                       <!-- <img src="{{ asset('image/setting/'.$setting->logo) }}" alt="logo1" title="logo1" class="img-responsive" /> -->
                        <div class="cd-headline clip">
                            <h4><?php echo $slider->sub_title ?></h4>
						</div>
                        <p><?php echo $slider->description ?></p>
                        <a class="btn-primary btn btn-wide" href="<?php echo $slider->button_url ?>"><?php echo $slider->button_text ?></a>
                    </div>
                </div> 
                        <img src="{{  $iImgPath }}" alt="banner" title="banner" class="img-responsive"/>
                    </div>
                    <?php } ?>
                   <!--  <div class="item">
                        <img src="{{ asset('public/img/background/banner-2.jpg') }}" alt="banner" title="banner" class="img-responsive"/>
                    </div>
                    <div class="item">
                        <img src="{{ asset('public/img/background/banner-3.jpg') }}" alt="banner" title="banner" class="img-responsive"/>
                    </div>
                    <div class="item">
                        <img src="{{ asset('public/img/background/banner-4.jpg') }}" alt="banner" title="banner" class="img-responsive"/>
                    </div> -->
                    <!-- Slider Backround Image End -->
                </div>

                <!-- Slide Detail Start  -->
                 
                <!-- Slide Detail End  -->
            </div>
            <!-- Slider End  -->


            <!-- Order Start  -->
            <div class="order">
                <div class="container">
                    <div class="row justify-content-center">
                        <!-- Title Content Start -->
                        <div class="col-sm-12 commontop text-center">
                            <h4>Order Delivery</h4>
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
        <form method="POST" class="form-horizontal search-icon" action="{{ route('products.search_postalcode.post') }}">
             {{ csrf_field() }}
                                <fieldset>
                                    <div class="form-group">
                                        <input name="code" id="postalAutoComplete" value="<?php  if (Session::has('postcode')) {  echo Session::get('postcode.postcode'); }else{
                                        echo '';
                                    } ?>" placeholder="Search Your Postcode"  class="form-control" type="text">
                                    </div>
                                    <button type="submit" value="submit" class="btn btn-theme"><i class="icofont icofont-search"></i><?php  if (Session::has('postcode')) {  echo Session::get('postcode.button_text'); }else{
                                        echo 'Search';
                                    } ?></button>
                                </fieldset>
                            </form>
                            <!-- Search Form End -->
                            <ul class="list-inline text-center">
                                <li class="list-inline-item">
                                    <i class="icofont icofont-fast-food"></i>
                                    <p>Search Post Code</p>
                                </li>
                                <li class="list-inline-item">
                                    <i class="icofont icofont-food-basket"></i>
                                    <p>Order Food</p>
                                </li>
                                <li class="list-inline-item">
                                    <i class="icofont icofont-fast-delivery"></i>
                                    <p>Delivery</p>
                                </li>
                            </ul>
                            <img src="{{ asset('public/img/lines.png') }}" alt="line" title="line" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- Order End  -->

 <!-- Food Menu Start -->
            <div class="menu">
                <div class="menu-inner">
                    <div class="container">
                        <div class="row ">
                            <!-- Title Content Start -->
                            <div class="col-sm-12 col-xs-12 commontop text-center">
                                <h4>Our Menu</h4>
                                <div class="divider style-1 center">
                                    <span class="hr-simple left"></span>
                                    <i class="icofont icofont-ui-press hr-icon"></i>
                                    <span class="hr-simple right"></span>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
                            </div>
                            <!-- Title Content End -->
                            <div class="col-sm-12 col-xs-12">
                                <!--  Menu Tabs Start  -->
                                <ul class="nav nav-tabs list-inline">
 <?php  $current_time = date("H:i:s");
        $current_time = strtotime($current_time);

if (isset($ourmenu_category_list) && count($ourmenu_category_list) > 0) {
    // echo '<pre>'; print_r($ourmenu_category_list); die;                       
foreach ($ourmenu_category_list as $key => $ourmenu_category) {
   
  
  $start_time = strtotime($ourmenu_category->start_time); //2888172 
  $end_time = strtotime($ourmenu_category->end_time); //3423222
                   
  $active_class = ($end_time >= $current_time && $start_time <= $current_time ) ? 'active' : '';         
 ?> 
                                    <li class="nav-item"> 
                                        <a class="nav-link {{ $active_class }}" href="#{{ $key }}" data-toggle="tab" aria-expanded="false">{{ $ourmenu_category->name }}</a>
                                    </li>
                                <?php } } ?>
                                  
                                   
                                </ul>
                                <!--  Menu Tabs Start  -->

                                <!--  Menu Tabs Content Start  -->
                                <div  class="tab-content">
                                 <?php 
        $current_timet = date("H:i:s");
        $current_timet = strtotime($current_timet);
if (isset($ourmenu_category_product) && count($ourmenu_category_product) > 0) {
                          
foreach ($ourmenu_category_product as $key => $category_product) {  
   
    $start_timet = strtotime($category_product['cat_detail']['start_time']); //2888172 
    $end_timet = strtotime($category_product['cat_detail']['end_time']); //3423222
    
               //echo '<pre>'; print_r($category_product); die;         
  $active_classt = ($end_timet >= $current_timet && $start_timet <= $current_timet ) ? 'active' : '';   

      // echo '<pre>'; print_r($category_product['product']); die;
 // $cat_name =  str_replace(' ', '-', $category_product->name);
  //$cat_name = strtolower(trim($cat_name));
 ?> 
                                    <!--  Menu Tab Start  -->
                                    <div class="tab-pane {{ $active_classt }}" id="{{ $key   }}">
                                        <div class="row">

                                            <?php 
if (isset($category_product['product']) && count($category_product['product']) > 0) {
   $i = 1;         
   
foreach ($category_product['product'] as $key => $productlist) {  
               $iImgPath = asset('image/no_product_image.jpg');
              if(isset($productlist['image']) && !empty($productlist['image'])){
                $iImgPath = asset('image/product/200x200/'.$productlist['image']);
              }
 ?>
                                            <div class="col-md-6 col-sm-6 col-xs-12 p_<?php  echo $i; ?>">
                                                <!-- Box Start -->
                                                <div class="box">
                                                    <div class="image">
                                                      <a href="{{ URL::to('product/'.$productlist['slug']) }}">  <img src="{{ $iImgPath }}" alt="{{ $productlist['name'] }}" title="{{ $productlist['name'] }}" class="img-fluid product_menu_img" /></a>
                                                    </div>
<?php  $category_name = getmaincategoryname($productlist['category_id']);  ?>
                                                    <div class="caption">
                                                    <a href="{{ URL::to('product/'.$productlist['slug']) }}"> <h4>{{ $category_name->name.' '.$productlist['name'] }}</h4></a>
<?php  $avg_rating = getProductAverageRatingfor_many_items($productlist['id']);  ?>


                                           
                                    <div class="rating">
                                      <?php for($i = 1; $i <=5; $i++){ ?>
                                        
                                            <i class="icofont icofont-star  <?php echo ($i <= $avg_rating) ? 'selected_star_rating' : 'not_selected_star_rating'; ?>"></i>
                                        <?php } ?>
                                    </div>
                                        <?php  $product_tag = getProducttag($productlist['id']);  ?>                                                        
<!--                                                         <p class="des">
                                                            <?php  
                                                            /*$i = 1;
                                                            foreach ($product_tag as $key => $productag) {
                                                                $slashs = ($i < count($product_tag)) ? ' / ' : '';
                                                               echo '<a href="'.URL::to('product-tag/'.$productag->tag).'" >'.$productag->tag.$slashs.' </a>';
                                                           $i++; }*/ ?></p> -->
<!--                                                         <span>{{ $productlist['short_description'] }}</span> -->
                                                        <div class="price"><?php echo getSiteCurrencyType(); ?>{{ $productlist['price'] }}</div>
                                                    </div>
                                                </div>
                                                <!-- Box End -->
                                            </div>
                                            
                                            <?php $i++; } } ?>
                                        </div>
                                    </div>
                                    <!--  Menu Tab End  -->
<?php } } ?>
                                </div>
                                <!--  Menu Tabs Content End  -->
 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Food Menu End -->

            <!-- Popular Dishes Start -->
            <div class="dishes">
                <div class="container">
                    <div class="row">
                        <!-- Title Content Start -->
                        <div class="col-sm-12 commontop text-center">
                            <h4>Our Popular Meals</h4>
                            <div class="divider style-1 center">
                                <span class="hr-simple left"></span>
                                <i class="icofont icofont-ui-press hr-icon"></i>
                                <span class="hr-simple right"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
                        </div>
                        <!-- Title Content End -->
                        <div class="col-sm-12">
                            <div class="dish owl-carousel">
<?php 
if (isset($products[0]) && !empty($products[0])) {
             
foreach ($products as $key => $product) {  
               $iImgPath = asset('image/no_product_image.jpg');
              if(isset($product->image) && !empty($product->image)){
                $iImgPath = asset('image/product/200x200/'.$product->image);
              }
 ?>
                                <div class="item">
                                    <!-- Box Start -->
                                    <div class="box">
                                        <a href="{{ URL::to('product/'.$product['slug']) }}"><img src="{{ $iImgPath }}" alt="{{ ucwords($product['name']) }}" title="{{ ucwords($product['name']) }}" class="img-fluid product_homeitem_img" /></a>
<?php  $subcategory_name = getsubcategoryname($product['sub_category_id']);  ?>
<?php  $category_name = getmaincategoryname($product['category_id']);  
//echo '<pre>';print_r($subcategory_name);die();           ?>
                                        <div class="caption">
                                            <h4><?php echo (!empty($subcategory_name->name))?$subcategory_name->name:''; ?></h4>
                                           <a href="{{ URL::to('product/'.$product['slug']) }}"><h4>{{ $category_name->name.' '.ucwords($product['name']) }}</h4>
                                           </a>
<?php  $avg_rating = getProductAverageRatingfor_many_items($product['id']);  ?>
                                           
                                    <div class="rating">
                                      <?php for($i = 1; $i <=5; $i++){ ?>
                                        
                                            <i class="icofont icofont-star  <?php echo ($i <= $avg_rating) ? 'selected_star_rating' : 'not_selected_star_rating'; ?>"></i>
                                        <?php } ?>
                                    </div>
                                            <p><?php echo getSiteCurrencyType(); ?>{{ $product['price'] }}</p>
                                        </div>
                                    </div>
                                    <!-- Box End -->
                                </div>
                               <?php } } ?>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Popular Dishes End -->

           
 <!-- Testimonials Start  -->
            <div class="testimonials">
                <div class="container">
                    <div class="testimonials-inner">
                        <div class="row ">
                            <!-- Title Content Start -->
                            <div class="col-sm-12 col-xs-12 commontop white text-center">
                                <h4>What Our Customers Say</h4>
                                <div class="divider style-1 center">
                                    <span class="hr-simple left"></span>
                                    <i class="icofont icofont-ui-press hr-icon"></i>
                                    <span class="hr-simple right"></span>
                                </div>
                            </div>
                            <!-- Title Content End -->
                            <div class="col-sm-12 col-xs-12">
                                <div class="owl-carousel owl-theme owl-testi">
                            <?php      
                            if (isset($testimonials[0]) && !empty($testimonials[0])) {
                                         
                            foreach ($testimonials as $key => $testimonial) {  
                                         
                             ?>
                                    <div class="item">
                                        <p><?php echo $testimonial->description; ?></p>
                                        <span>- {{ ucwords($testimonial->name) }}</span> 
                                       <span><b> -{{ ucwords($testimonial->designation) }}</b></span>
                                    </div>
                            <?php } }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Testimonials End  -->
@endsection

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
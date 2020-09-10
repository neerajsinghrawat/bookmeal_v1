@extends('layouts.front')
@section('title',  (!empty($categories->meta_title))?ucwords($categories->meta_title):'Menu')
@section('description', (!empty($categories->meta_description))? $categories->meta_description:'')
@section('keywords', (!empty($categories->meta_keyword))? $categories->meta_keyword:'')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
   .categoryPageSection {
   display: flex;
   flex-direction: column;
   width:100%;
   }
   <?php if(!empty($subCatArr)){
      foreach($subCatArr as $sub_cat){
      ?>
   .categoryPageSection > .sub_cat_list_<?php echo $sub_cat['id'] ?> {order: <?php echo $sub_cat['sort_number'] ?>; display: block; } 
   <?php 
      }
      } ?>
</style>
        <!-- Page Title -->
        <div class="page-title bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-4">
                        <h1 class="mb-0">Menu List</h1>
                        <h4 class="text-muted mb-0">Some informations about our restaurant</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="page-content">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-3">
                        <!-- Menu Navigation -->
                        <nav id="menu-navigation" class="stick-to-content" data-local-scroll>
                            <ul class="nav nav-menu bg-dark dark">
                              
                              <?php $i = 1;
                                if (!empty($categories)) {
                                  foreach ($categories as $key => $category) { ?>
                                <li><a href="#{{ $category['slug'] }}">{{ $category['name'] }}</a></li>
                                <?php } } ?>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-9">
                        <!-- Menu Category / Burgers -->
                        <?php if (!empty($products)) {
                          foreach ($products as $key => $product) {
                          $keyarr=explode('~', $key);
                          //echo '<pre>';print_r($keyarr);die; ?>
                        <div id="{{ $keyarr[2] }}" class="menu-category">
                            <div class="menu-category-title">
                                <div class="bg-image"><img src="{{ asset('image/category/400X330/'.$keyarr[1]) }}" alt="category"></div>
                                <h2 class="title">{{ ucwords($keyarr[0]) }}</h2>
                            </div>
                            <div class="menu-category-content">
                              <?php 
                                foreach ($product as $key => $food) {  
                                           
                               ?>
                                <!-- Menu Item -->
                                <div class="menu-item menu-list-item">
                                    <div class="row align-items-center">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <h6 class="mb-0"><a href="{{ URL::to('product/'.$food['slug']) }}">{{ ucwords($food['name']) }}</a></h6>
                                            <span class="text-muted text-sm">
                                            <?php  $product_items = getProductitems($food['id']); ?>
                                            <?php 
                                              $i = 1;
                                              if(isset($product_items) && count($product_items) > 0 ){
                                              
                                                foreach ($product_items as $key => $product_item) {
                                                   $slashs = ($i < count($product_items)) ? ', ' : '';
                                                   echo ucwords($product_item->title.$slashs);
                                                   $i++; 
                                                 } 

                                               } ?>
                                                </span>




                                        </div>
                                        <div class="col-sm-6 text-sm-right">
                                            <span class="text-md mr-4"><span class="text-muted">from</span> <?php echo getSiteCurrencyType(); ?><span data-product-base-price>{{ $food['price'] }}</span></span>
                                            
                                            <!-- <button class="btn btn-outline-secondary btn-sm addToCart" product_id="{{ $food['id'] }}"><span>Add to cart</span></button> -->
                                            <a href="#productModal" data-toggle="modal" class="btn btn-outline-secondary productDetail" product_id="{{$food['id']}}"><span>Add to cart</span></a>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                
                            </div>
                        </div>
                        <?php } }?>
                        
                    </div>
                </div>
            </div>
        </div>


<div class="modal fade" id="productModal" role="dialog">
    <div class="modal-dialog" role="document">

        <div class="modal-content" id="product_detail">
        </div>
    </div>
</div>


@endsection

<script src="{{ asset('js/admin/jquery.min2.1.3.js') }}"></script>

<script type="text/javascript"> 
$(document).ready(function() {

  var baseUrl = '{{ URL::to('/') }}';
      
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
 // var form = $( "#addToCartForm" ).serialize();

  $('.addToCart').click(function(){
        
        var productid = $(this).attr('product_id');     
        //alert(productid);
        
            $.ajax({
      
                url: baseUrl+'/products/add_to_cart',
                
                type: 'post',
                
                data: {productid: productid,_token: CSRF_TOKEN},
                
                dataType: 'json',
                
                success: function(result) {

                  /*alert(result.response);
                  //$('#successFlashMsg').delay(1000).hide('highlight', {color: '#66cc66'}, 1500);*/
                  
                  $('<div id="successFlashMsg" class="msg msg-ok alert alert-success"><p>Item is successfully added into cart !</p></div>').prependTo('body');
                  
                  $('.display-cart').html(result.cart_count);
                  
                  //$('#totalProductInCart').html(result.totalProduct);
                  
                  //$('#totalAmountInCart').html(result.totalAmount);
                  
                  
                  
                  setTimeout(function(){
                    $("#successFlashMsg").fadeOut('slow');
                  },2000);
                  
                  
                
                }
                
              });
          
  });


  $('.productDetail').click(function(){
        
        var productid = $(this).attr('product_id');     
        //alert(productid);
        
            $.ajax({
      
                url: baseUrl+'/products/product_detail',
                
                type: 'post',
                
                data: {productid: productid,_token: CSRF_TOKEN},
                
                dataType: 'html',
                
                success: function(result) {

                //console.log(result);
                  
                  $('#product_detail').html(result);
                  
                  
                  
                  
                
                }
                
              });
          
  });  

  $(document).on('click','.attributes',function(){
    var totalAmount = $('.totalAmount').val();
    var totalPrice = parseFloat(0);
    if($('.attributes:checked').length){
        
        $(".attributes:checked").each(function() {
          var pricetype = $(this).attr('pricetype');
          var amount = $(this).attr('amount');
          var productAmount = $(this).attr('productAmount');
          
          
          if (pricetype == 'Increment') {
              totalPrice = parseFloat(productAmount)+parseFloat(amount);
          } else if (pricetype == 'Decrement'){
              totalPrice = parseFloat(productAmount)-parseFloat(amount);
          }else{
              totalPrice = parseFloat(productAmount);
          }
         $(".totalPrice").html(totalPrice);
         $('.totalAmount').val(totalPrice);
        });      
    }else{
        $(".totalPrice").html(parseFloat(productAmount));
        //$('.totalAmount').val(totalPrice);
    }
    /*if($(this).prop('checked')){
        var totalPrice = parseFloat(0);
        if (pricetype == 'Increment') {
            totalPrice = parseFloat(productAmount)+parseFloat(amount);
        } else if (pricetype == 'Decrement'){
            totalPrice = parseFloat(productAmount)-parseFloat(amount);
        }else{
            totalPrice = parseFloat(productAmount);
        }
       $(".totalPrice").html(totalPrice);
       $('.totalAmount').val(totalPrice);
    }else{
        $(".totalPrice").html(parseFloat(productAmount));
        $('.totalAmount').val(totalPrice);
    }*/

  });  
  
  $(document).on('click','.submitCart',function(){
   
        var baseUrl = '{{ URL::to('/') }}';
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            url : baseUrl+'/products/add_to_cart_new',
            type : 'POST',
            data : $('#AddToCART').serialize(),
            dataType : 'json',
            success : function(result){
              
            }
          }).done(function(result){
            
                  if (result.response == 1) {
                   $('<div id="successFlashMsg" class="msg msg-ok alert alert-success"><p>Item is successfully added into cart !</p></div>').prependTo('.msgcart');
                  
                    $('.notificationaa').html(result.cart_count);
                    $('.notification_amount').html(result.cart_amount);
                  }else {

                    $('<div id="successFlashMsg" class="msg msg-ok alert alert-danger"><p>Item is not added into cart!</p></div>').prependTo('.msgcart');
                  }    
                  setTimeout(function(){
                    $("#successFlashMsg").fadeOut('slow');
                  },2000);

          });    
  
  });
});
</script>
@extends('layouts.front')

@section('content')


  
<meta name="csrf-token" content="{{ csrf_token() }}" />        
<div class="highlightSection" style="margin-top: 100px;">
  <div class="container">
    <div class="row">

      <?php
      //echo '<pre>';print_r($_SERVER);die;
            if (isset($products[0]) && !empty($products)) {
              
             $index = 0;
             foreach ($products as $product_data): 
             $index++;
             $iImgPath = asset('image/no_product_image.jpg');
              if(isset($product_data->image) && !empty($product_data->image)){
                $iImgPath = asset('image/product/200x200/'.$product_data->image);
              }

             ?>
        <div class="col-lg-4" style="margin-bottom: 10px;">
        <div class="media">
          <img src="{{ $iImgPath }}" alt="nepali-momo">
          <h3 class="media-heading text-primary-theme">{{ $product_data->name }}</h3>
          <?php if(Auth::check()){ ?>
          <a href="javascript:void(0)" class="btn btn-default addToCart" product_id="{{ $product_data->id }}" >Add To Cart</a>
          <?php } else{ ?>
          <a href="{{ URL::to('login?data[redirect_url]='.$_SERVER['REDIRECT_URL']) }}" class="btn btn-default">Add To Cart</a>
          <?php } ?>
        </div>
        </div>
      
      <?php endforeach; } ?> 
           
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
        alert(productid);
        //alert('zfsdfsdffsd');
            $.ajax({
      
                url: baseUrl+'/products/add_to_cart',
                
                type: 'post',
                
                data: {productid: productid,_token: CSRF_TOKEN},
                
                dataType: 'json',
                
                success: function(result) {

                  alert(result.response);
                  //$('#successFlashMsg').delay(1000).hide('highlight', {color: '#66cc66'}, 1500);
                  
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
});
</script>


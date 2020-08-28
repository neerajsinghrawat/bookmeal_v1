@extends('layouts.front')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />   
            <!-- Breadcrumb Start -->
            <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2>Shopping Cart</h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="{{ url('/') }}">HOME</a></li>
                            <li class="list-inline-item"><a href="#">Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb End -->

            <!-- Cart Start  -->
            <div class="mycart">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 ">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" href="#tab-cart" data-toggle="tab"><span>1</span>shopping cart</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab-info" data-toggle="tab"><span>2</span>shopping info</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab-payment" data-toggle="tab"><span>3</span>payment method</a></li>
                            </ul>
                            <div class="bor"></div>
                            <div class="tab-content msgcart">
                                <div class="tab-pane active" id="tab-cart">
                                    <form action="{{ route('payments.paypal.post') }}" method="post" id="paypalForm" enctype="multipart/form-data">
                                        <h2>You have <span>{{ (!empty($cart_list))?count($cart_list):0 }} items</span> in your order.</h2>
                                        <div class="table-responsive-md">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td class="text-center">Name</td>
                                                        <td class="text-center">Price</td>
                                                        <td class="text-center">Qty.</td>
                                                        <td class="text-center">Total</td>
                                                        <td></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
<?php 
$total = 0;
            if (!empty($cart_list[0])) {
                    foreach ($cart_list as $key => $cartlistdetail) {  
                                   $iImgPath = asset('image/no_product_image.jpg');
                                  if(isset($cartlistdetail->product->image) && !empty($cartlistdetail->product->image)){
                                    $iImgPath = asset('image/product/200x200/'.$cartlistdetail->product->image);
                                  }
                    $total += ($cartlistdetail->product->price * $cartlistdetail->qty);
 ?>
                                                    <tr class="cart_{{ $cartlistdetail->id }}">
                                                        <td>
                                                            <a href="#">
                                                                <img src="{{ $iImgPath }}" class="img-fluid" alt="thumb" title="thumb" style="width: 100px;height: 100px;" />
                                                            </a>
                                                            <div class="name">
                                                                <h4>{{ ucwords($cartlistdetail->product->name) }}</h4>
                                                                <p></p>
                                                                <div class="rating">
                                                                    <i class="icofont icofont-star"></i>
                                                                    <i class="icofont icofont-star"></i>
                                                                    <i class="icofont icofont-star"></i>
                                                                    <i class="icofont icofont-star"></i>
                                                                    <i class="icofont icofont-star"></i>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">{{ '$ '.$cartlistdetail->product->price }}</td>

                <input type="hidden" name="cart_id[]" value="{{ $cartlistdetail->id }}"> 
                  <input type="hidden" name="product_id[]" value="{{ $cartlistdetail->product->id }}">
                 <!--  <input type="hidden" name="amount" value="0.1">
                  <input name="currency_code" value="USD" type="hidden">
                  <input type="hidden" name="custom" value="1">
                  <input type="hidden" name="user_id" value="555555555555555"> -->

                                                        <td class="text-center">
                                                            <p class="qtypara">
                                                                <span id="minus1" class="minus button_change    cart_product_qty_{{ $cartlistdetail->id }}"  cart_id="{{ $cartlistdetail->id }}" product_id="{{ $cartlistdetail->product->id }}"
                                                                    product_price="{{ $cartlistdetail->product->price }}" qty="{{ $cartlistdetail->qty }}" button_type="sub"><i class="icofont icofont-minus"></i></span>
                                                                <input type="text" value="{{ $cartlistdetail->qty }}" size="2" id="input-quantity1" class="form-control qty" readonly="readonly" />
                                                                <span id="add1" class="add button_change    cart_product_qty_{{ $cartlistdetail->id }}" cart_id="{{ $cartlistdetail->id }}" product_id="{{ $cartlistdetail->product->id }}" qty="{{ $cartlistdetail->qty }}" product_price="{{ $cartlistdetail->product->price }}"  button_type="add" ><i class="icofont icofont-plus"></i></span>
                                                            </p>
                                                        </td>
                                                        <td class="text-center cart_product_total_{{ $cartlistdetail->id }}">{{ '$ '.($cartlistdetail->product->price * $cartlistdetail->qty)  }}</td>
                                                        <td class="text-center">
                                                            <button type="button" class="delete_cart delete_{{ $cartlistdetail->id }}" cart_id="{{ $cartlistdetail->id }}"><i class="icofont icofont-close-line"></i></button>
                                                        </td>
                                                    </tr>
                                                    <?php } }else { ?>
                                                        <tr>
                                                            <td>No items found</td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td colspan="5">
                                                            <h3 class="text-right grand_total">SUBTOTAL - {{ '$ '.$total}}</h3>
                                                            <div class="buttons float-left">
                                                               <!--  <a href="shop.html" class="btn btn-theme btn-md btn-wide">Continue Shopping</a> -->
                                                            </div>


 
          {{ csrf_field() }}   
                  <!-- Identify your business so that you can collect the payments. -->
                <!--   <input name="business" value="info@codexworld.com" type="hidden">  -->
                  <input name="business" value="rawat.neeraj.510-facilitator@gmail.com" type="hidden">
         
                  <!-- Specify a Buy Now button. -->
                  <input name="cmd" value="_xclick" type="hidden">         
                  <!-- Specify details about the item that buyers will purchase. -->
             


                  <input type='hidden' name='cancel_return' value='{{ URL::to('admin/products/cancel') }}'>
                   <input type='hidden' name='notify_url' value='{{ URL::to('admin/products/notify') }}'>
                  <input type='hidden' name='return' value='{{ URL::to('admin/products/success') }}'>

                                                            <div class="buttons float-right">
                                                                <input  class="btn btn-theme btn-md btn-wide" type="submit" value="Checkout">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane col-md-12 col-12" id="tab-info">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-6 col-12">
                                            <h6>Shopping Address</h6>
                                            <form method="post" enctype="multipart/form-data">  
                                                <fieldset>  
                                                    <div class="form-group">
                                                        <input name="india" value="" placeholder="Country" id="input-india" class="form-control" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="state" value="" placeholder="State" id="input-state" class="form-control" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="City" value="" placeholder="City" id="input-City" class="form-control" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="code" value="" placeholder="Zip Code" id="input-code" class="form-control" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="address" value="" placeholder="Address" id="input-address" class="form-control" type="text">
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>

                                        <div class="col-lg-2 d-none d-lg-block"></div>
                                        <div class="col-lg-5 col-md-6 col-12">
                                            <h6>Contact information</h6>
                                            <form method="post" enctype="multipart/form-data">  
                                                <fieldset>  
                                                    <div class="form-group">
                                                        <input name="firstname" value="" placeholder="First Name" id="input-firstname" class="form-control" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="lastname" value="" placeholder="Last Name" id="input-lastname" class="form-control" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="email" value="" placeholder="Email" id="input-email" class="form-control" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="phone" value="" placeholder="Phone Number" id="input-phone" class="form-control" type="text">
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="buttons float-left">
                                                <a href="#tab-cart" data-toggle="tab" class="btn btn-theme btn-md btn-wide">Shopping Cart</a>
                                            </div>
                                            <div class="buttons float-right">
                                                <a href="#tab-payment" data-toggle="tab" class="btn btn-theme btn-md btn-wide">Continue</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane col-md-12 col-12"  id="tab-payment">
                                    <form class="form-horizontal" method="post">
                                        <fieldset>
                                            <div class="form-group ">
                                                <ul class="list-inline text-center link">
                                                    <li class="list-inline-item active">
                                                        <a href="#"><img src="assets/images/shop/visacard.png" alt="visa" title="visa" class="img-fluid"></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#"><img src="assets/images/shop/master.png" alt="master" title="master" class="img-fluid"></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#"><img src="assets/images/shop/discovers.png" alt="discover" title="discover" class="img-fluid"></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="#"><img src="assets/images/shop/pay.png" alt="paypal" title="paypal" class="img-fluid"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="form-group row">    
                                                <div class="col-sm-12">
                                                    <input class="form-control" id="input-card" placeholder="Card Holder Name" value="" name="holder" required="" type="text">
                                                </div>
                                            </div>  
                                            <div class="form-group row">    
                                                <div class="col-sm-12">
                                                    <input class="form-control" id="input-expiry" placeholder="Card Number" value="" name="card" required="" type="text">
                                                </div>
                                            </div>  
                                            <div class="form-group row">
                                                <label>Expiry Date</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" placeholder="Month" value="" name="month" required="" type="text">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input class="form-control" placeholder="Year" value="" name="Year" required="" type="text">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input class="form-control" id="input-cvv" placeholder="cvv" value="" name="cvv" required="" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-12 col-12 text-center">
                                                    <div class="buttons">
                                                        <a href="#tab-cart" data-toggle="tab" class="btn btn-theme btn-md btn-wide">Shopping Cart</a>
                                                        <a href="thank-you.html" class="btn btn-theme btn-md btn-wide">Place Order</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>

                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cart End  -->
@endsection

<script src="{{ asset('js/admin/jquery.min2.1.3.js') }}"></script>

<script type="text/javascript"> 
$(document).ready(function() {

  var baseUrl = '{{ URL::to('/') }}';
      
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
 // var form = $( "#addToCartForm" ).serialize();

  $('.button_change').click(function(){
          
        var qty = $(this).attr('qty'); 
       
        var cart_id = $(this).attr('cart_id');         
        var product_id = $(this).attr('product_id'); 
        var product_price = $(this).attr('product_price'); 
        var button_type = $(this).attr('button_type'); 
        
       
            $.ajax({
      
                url: baseUrl+'/products/update-cart',
                
                type: 'post',
                
                data: {qty: qty,product_id: product_id,product_price: product_price,button_type: button_type,cart_id: cart_id,_token: CSRF_TOKEN},
                
                dataType: 'json',
                
                success: function(result) {

                  //alert(result.total);
                  
                  if (result.response == 1) {
                   // alert('.cart_product_qty_'+result.cart_id+'===>'+result.qty);
                    //alert(result.qty);
                    $('.cart_product_total_'+result.cart_id).html('$ '+result.producttotal);
                    $('.cart_product_qty_'+result.cart_id).attr('qty',result.qty);
                    $('.grand_total').html('SUBTOTAL - $ '+result.total);
                    


                  }else {

                    $('.display-cart').html(result.cart_count);
                    location.reload();
                 
                  }           
                  
                  
                  setTimeout(function(){
                    $("#successFlashMsg").fadeOut('slow');
                  },5000);
                  
                  
                
                }
                
              });
          
  });  


  $('.delete_cart').click(function(){
        
        var cartid = $(this).attr('cart_id'); 
        
            $.ajax({
      
                url: baseUrl+'/delete-cart',
                
                type: 'post',
                
                data: {cartid: cartid,_token: CSRF_TOKEN},
                
                dataType: 'json',
                
                success: function(result) {

                  alert(result.response);
                  
                  if (result.response == 1) {

                    $('.cart_'+cartid).remove();

                   $('<div id="successFlashMsg" class="msg msg-ok alert alert-success"><p>Item Remove from cart successfully !</p></div>').prependTo('.msgcart');
                  
                    $('.display-cart').html(result.cart_count);
                    location.reload();
                  }else {

                    $('<div id="successFlashMsg" class="msg msg-ok alert alert-danger"><p>Item is not Remove from cart!</p></div>').prependTo('.msgcart');
                  }           
                  
                  
                  setTimeout(function(){
                    $("#successFlashMsg").fadeOut('slow');
                  },5000);
                  
                  
                
                }
                
              });
          
  });  
});
</script>

@extends('layouts.front')
@section('title', 'Cart')
@section('description', 'Cart')
@section('keywords', 'food','Cart')
@section('content')
<style type="text/css">
    .coupon_color{
        background-color:yellowgreen !important;
    } 
    .coupon_text_color{
        color:green !important;
    }
    .coupon_popup_size{
        width: 1000px;
        left: -93px;
    }

    .table-cart {
        line-height: 1.25;
        width: 100% ;
    }    

    .table-cart th, .table-cart td {
        vertical-align: middle;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #e0e0e0;
    }
    .apply_coupon{cursor:pointer;font-size: 13px;color: #ddae71; margin-right: 15px;}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />   

    <!-- Content -->
    <div id="content">

        <!-- Page Title -->
        <div class="page-title bg-dark dark">
            <!-- BG Image -->
            <div class="bg-image bg-parallax"><img src="http://assets.suelo.pl/soup/img/photos/bg-croissant.jpg" alt=""></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-4">
                        <h1 class="mb-0">Checkout</h1>
                        <h4 class="text-muted mb-0">Some informations about our restaurant</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section -->
        <section class="section bg-light">

            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="panel-cart-content cart-details shadow bg-white stick-to-content mb-4">
                            <div class="bg-dark dark p-4"><h5 class="mb-0">You order</h5> </div>
                             <form action="{{ route('payments.paypal.post') }}" class="form-horizontal" method="post" id="paypalForm" enctype="multipart/form-data">
                            {{ csrf_field() }}   
                            <table class="table-cart">
                                <?php $total = 0;
                                if (!empty($cart_list[0])) {
                                        foreach ($cart_list as $key => $cartlistdetail) {  
                                                       $iImgPath = asset('image/no_product_image.jpg');
                                                      if(isset($cartlistdetail->product->image) && !empty($cartlistdetail->product->image)){
                                                        $iImgPath = asset('image/product/200x200/'.$cartlistdetail->product->image);
                                                      }
                                        $attributes = getAttributeDetail($cartlistdetail->productItem_ids) ;              
                                        $total += (($cartlistdetail->product->price+$attributes['amount']) * $cartlistdetail->qty);
                                 ?>
                                <tr class="cart_{{ $cartlistdetail->id }}">
                                    <td class="title">
                                        <span class="name"><a href="#productcartDetail" class="productcartDetail" data-toggle="modal" product_id="{{$cartlistdetail->product->id}}" 
        cart_id="{{$cartlistdetail->id }}">{{ ucwords($cartlistdetail->product->name) }}</a></span><br>
                                        <span class="caption text-muted">{{$attributes['name']}}</span>
                                    </td>
                                    <td class="price">{{ getSiteCurrencyType().(($cartlistdetail->product->price+$attributes['amount'])  * $cartlistdetail->qty)  }}</td>
                                    <td class="actions">
                                        <!-- <a href="#product-modal" data-toggle="modal" class="action-icon"><i class="ti ti-pencil"></i></a> -->
                                       <span class="action-icon delete_cart delete_{{ $cartlistdetail->id }}" cart_id="{{ $cartlistdetail->id }}"><i class="ti ti-trash"></i></span>
                                    </td>
                                </tr>

                                <?php } }else { ?>
                                <tr>
                                    <td>No items found</td>
                                </tr>
                                <?php } ?>
                            </table>
                            <div class="cart-summarys" style="display: block;">
                                <div class="row">
                                    <div class="col-7 text-right text-muted">Order total:</div>
                                    <div class="col-5"><strong><span class="grand_total">{{ getSiteCurrencyType().$total}}</span></strong></div>
                                </div>
                                <div class="row">
                                    <div class="col-7 text-right text-muted">Coupon discount:</div>
                                    <div class="col-5"><strong><span class="coupon_discount"><?php echo (!empty(Session::get('apply_coupon.amount')))?getSiteCurrencyType().Session::get('apply_coupon.amount'):getSiteCurrencyType().'0'; ?></span></strong></div>
                                </div>
                                <div class="row">
                                    <div class="col-7 text-right text-muted">Tax:</div>
                                    <div class="col-5"><strong><span class="tax_total"><?php

                                                    $total_amount = $total;
                                                                if (!empty($shipping_taxes->tax_percent) && $shipping_taxes->tax_percent > 0) {   
                                                                    $total_amount = ($total * $shipping_taxes->tax_percent) / 100 + $total;       
                                                                    echo  ''.getSiteCurrencyType().($total * $shipping_taxes->tax_percent) / 100;
                                                                } else{
                                                                  echo ''.getSiteCurrencyType().'0';
                                                                }?></span></strong></div>
                                </div>
                                <div class="row">
                                    <div class="col-7 text-right text-muted">Devliery:</div>
                                    <div class="col-5"><strong><span class="shipping_total"><?php  
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
                                <div class="row">
                                    <div class="col-7 text-right text-muted"><i class="ti ti-ticket apply_coupon" data-toggle="modal" data-target="#apply_coupon_popup"><b>Apply Coupon</b></i>Total:</div>
                                    <div class="col-5"><strong><span class="main_total"><?php echo getSiteCurrencyType().$total_amount; ?></span></strong></div>
                                </div>
                            </div>
                            <!-- <div class="cart-empty" style="display: none;">
                                <i class="ti ti-shopping-cart"></i>
                                <p>Your cart is empty...</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 order-lg-first">
                        <div class="bg-white p-4 p-md-5 mb-4">
                            <h4 class="border-bottom pb-4"><i class="ti ti-user mr-3 text-primary"></i>Basic informations</h4>
                            <input type='hidden' name='user[id]' value='{{ Auth::user()->id }}'>
                                <fieldset>   
                                    <div class="form-group">
                                        <label>First Name:</label>
                                        <input name="" value="{{ Auth::user()->first_name }}" placeholder="First Name" id="input-firstname" class="form-control" type="text" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name:</label>
                                        <input name="" value="{{ Auth::user()->last_name }}" placeholder="Last Name" id="input-lastname" class="form-control" type="text" readonly>
                                    </div>
                                    <!-- <div class="form-group">
                                        <input name="email" value="" placeholder="Email" id="input-email" class="form-control" type="text">
                                    </div> -->
                                    <div class="form-group">
                                        <label>Phone Number:</label>
                                        <input name="" value="{{ Auth::user()->phone }}" placeholder="Phone Number" id="input-phone" class="form-control" type="number" readonly>
                                    </div>
                                </fieldset><br>

                            <h4 class="border-bottom pb-4"><i class="ti ti-package mr-3 text-primary"></i>Delivery</h4>
                                <div class="icon_class">
                                    <?php if(isset($addressesArr['home']->title)){ ?>
                                       <span class="deliveryAddress" type="home" address_id="<?php echo $addressesArr['home']->id;?>" title="<?php echo $addressesArr['home']->title;?>" style="cursor:pointer;"><i class="ti ti-home" style="cursor:pointer;font-size: 20px;color: #ddae71;"/></i><b><?php echo $addressesArr['home']->title;?></b>
                                       </span> 
                                    <?php } if(isset($addressesArr['office']->title)){?>
                                        <span class="deliveryAddress" type="office" address_id="<?php echo $addressesArr['office']->id;?>"  title="<?php echo $addressesArr['office']->title;?>" style="cursor:pointer;"><i class="ti ti-world" style="cursor:pointer;font-size: 20px;color: #ddae71;"/></i><b><?php echo ucwords($addressesArr['office']->title);?></b></span>
                                    <?php } 
                                     if(isset($addressesArr['other']) && count($addressesArr['other']) > 0){
                                        foreach ($addressesArr['other'] as $key => $addressesAr) {  ?>
                                        <span class="deliveryAddress" type="other" address_id="<?php echo $addressesAr->id;?>"  title="<?php echo $addressesAr->title;?>"  style="cursor:pointer;"><i class="icofont icofont-location-pin" style="cursor:pointer;color: #e54c2a;font-size: 30px;"/></i><b>{{ ucwords($addressesAr->title) }}</b>
                                        </span>
                                    <?php } } ?>
                                </div><br>                            
                                <fieldset>  
                                    <h6 class="selectedDeliveryAddress">Default</h6>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="deliveryAddress[address]" placeholder="Address" id="delivery_address" class="form-control" >{{ Auth::user()->address }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Post Code</label>
                                        <input name="deliveryAddress[postcode]" placeholder="Post Code" id="delivery_code" class="form-control postalAutoComplete" type="text" value="{{ Auth::user()->postcode }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input name="deliveryAddress[phone]" placeholder="Post Code" id="delivery_phone" class="form-control" type="text" value="{{ Auth::user()->phone }}">
                                    </div>
                                    <input name="deliveryAddress[address_id]"  id="delivery_address_id" class="form-control" type="hidden" value="0">
                                </fieldset>

                            <!-- <h4 class="border-bottom pb-4"><i class="ti ti-wallet mr-3 text-primary"></i>Payment</h4>
                            <div class="row text-lg">
                                <div class="col-md-4 col-sm-6 form-group">
                                    <label class="custom-control custom-radio">
                                        <input type="radio" name="payment_type" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">PayPal</span>
                                    </label>
                                </div>
                                <div class="col-md-4 col-sm-6 form-group">
                                    <label class="custom-control custom-radio">
                                        <input type="radio" name="payment_type" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Credit Card</span>
                                    </label>
                                </div>
                                <div class="col-md-4 col-sm-6 form-group">
                                    <label class="custom-control custom-radio">
                                        <input type="radio" name="payment_type" class="custom-control-input">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">Cash</span>
                                    </label>
                                </div>
                            </div> -->
                        </div>
                       
                            <!-- Identify your business so that you can collect the payments. -->
                            <!--   <input name="business" value="info@codexworld.com" type="hidden">  -->
                            <input name="business" value="rawat.neeraj.510-facilitator@gmail.com" type="hidden">
                            <input type="hidden" name="custom" value="2232||12||13">

                            <!-- Specify a Buy Now button. -->
                            <input name="cmd" value="_xclick" type="hidden">         




                            <input type='hidden' name='cancel_return' value='{{ URL::to('admin/products/cancel') }}'>
                            <input type='hidden' name='notify_url' value='{{ URL::to('admin/products/notify') }}'>
                            <input type='hidden' name='return' value='{{ URL::to('admin/products/success') }}'>



                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg"><span>Order now!</span></button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>

        <!-- Footer / End -->

    </div>
    <!-- Content / End -->

    

<!-- apply_coupon_popup popup -->
<div id="apply_coupon_popup" class="modal fade " role="dialog">
    <div class="modal-dialog modal-lg">

      <div class="modal-content coupon_popup_size">
        <div class="modal-header">
          <button type="button" class="close float-right" data-dismiss="modal">&times;</button>
      <!--     <h4 class="modal-title float-left">Apply Coupon</h4> -->
        </div>
        <div class="modal-body">

          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Code</th>
                <th>Coupon Details</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (!empty($couponcode_list[0])) {
                
               $index = 0;
               foreach ($couponcode_list as $value): 
               $index++;
               ?>
                <tr class="<?php echo (Session::has('apply_coupon') && Session::get('apply_coupon.id') == $value['id'])?'coupon_color':'';?>" >
                  <td><?php echo ucwords($value['code']); ?></td>
                  <td><?php echo $value['description']; ?></td>            
                  <td > <a class="btn btn-theme btn-md btn-wide" href="<?php echo url('apply-coupon/'.$value['id'].'/'.$total) ?>"><?php echo (Session::has('apply_coupon') && Session::get('apply_coupon.id') == $value['id'])?'Applied':'Apply';?></a></td>                
                </tr>
                <?php endforeach; } ?> 
            </tbody>
          </table>                    
        </div>                 
      </div>
    </div>
</div>
@endsection
<script type="text/javascript">
    var baseUrl = '{{ URL::to('/') }}';
</script>
<script src="{{ asset('js/admin/jquery.min2.1.3.js') }}"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="{{ asset('js/fornt/devlopment.js') }}"></script>
<script type="text/javascript"> 

$(window).load(function(){
   
   var baseUrl = '{{ URL::to('/') }}';
      
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  
  
  <?php if(Session::has('shoppingstep.user.address_id')){ ?>
  var address_id = '<?php echo Session::get('shoppingstep.user.address_id') ?>';
  
   $.ajax({
      
                url: baseUrl+'/products/ajaxSelectDeliveryAddress',
                
                type: 'post',
                
                data: {address_id: address_id,requestType : 'selectAddress',_token: CSRF_TOKEN},
                
                dataType: 'json',
                
                success: function(resultData) {
                    
                    if(resultData.result == 1){
                        
                       $('.selectedDeliveryAddress').html(resultData.delivery_title);
                        $('#delivery_address').val(resultData.delivery_address);
                        $('#delivery_code').val(resultData.delivery_postcode);
                        $('#delivery_phone').val(resultData.delivery_phone);
                        $('#delivery_address_id').val(resultData.delivery_address_id);
                    }
                           
                 
                
                }
                
              });
  <?php } ?>
 
});

$(document).ready(function() {

  var baseUrl = '{{ URL::to('/') }}';
      
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
 // var form = $( "#addToCartForm" ).serialize();

  $('.button_change').click(function(){
         // alert('jkjbj');
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
                    $('.cart_product_total_'+result.cart_id).html('<?php echo getSiteCurrencyType(); ?>'+result.producttotal);
                    $('.cart_product_qty_'+result.cart_id).attr('qty',result.qty);
                    $('.grand_total').html('SUBTOTAL - '+'<?php echo getSiteCurrencyType(); ?>'+result.total.toFixed(2));
                    $('.tax_total').html('TAX - '+'<?php echo getSiteCurrencyType(); ?>'+result.tax_amount);

                    $('.coupon_discount').html('COUPON DISCOUNT - '+'<?php echo getSiteCurrencyType(); ?>'+result.coupon_discount);

                    if (result.shippingamount == 0) {
                    $('.shipping_total').html('SHIPPING CHARGES - Free');

                    }else {
                        $('.shipping_total').html('SHIPPING CHARGES - '+'<?php echo getSiteCurrencyType(); ?>'+result.shippingamount);

                    }
                    
                    $('.main_total').html('TOTAL AMOUNT - '+'<?php echo getSiteCurrencyType(); ?>'+result.Maintotal.toFixed(2));                   


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

                  //alert(result.response);
                  
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
  
  
  $('.deliveryAddress').click(function(){
      var address_type = $(this).attr('type');
      var address_id = $(this).attr('address_id');
      var address_title = $(this).attr('title');
      
      
      $.ajax({
      
                url: baseUrl+'/products/ajaxSelectDeliveryAddress',
                
                type: 'post',
                
                data: {address_id: address_id,address_type: address_type,requestType : 'selectAddress',_token: CSRF_TOKEN},
                
                dataType: 'json',
                
                success: function(resultData) {
                    
                    if(resultData.result == 1){
                       $('.selectedDeliveryAddress').html(address_title);
                        $('#delivery_address').val(resultData.delivery_address);
                        $('#delivery_code').val(resultData.delivery_postcode);
                        $('#delivery_phone').val(resultData.delivery_phone);
                        $('#delivery_address_id').val(resultData.delivery_address_id);
                    }
                           
                 
                
                }
                
              });
              
      
  })
});
</script>

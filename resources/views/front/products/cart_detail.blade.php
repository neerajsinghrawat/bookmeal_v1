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
</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />   
<!-- <section class="section bg-light">

    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="cart-details shadow bg-white stick-to-content mb-4">
                    <div class="bg-dark dark p-4"><h5 class="mb-0">You order</h5></div>
                    <table class="cart-table">
                        <tr>
                            <td class="title">
                                <span class="name"><a href="#product-modal" data-toggle="modal">Pizza Chicked BBQ</a></span>
                                <span class="caption text-muted">26”, deep-pan, thin-crust</span>
                            </td>
                            <td class="price">$9.82</td>
                            <td class="actions">
                                <a href="#product-modal" data-toggle="modal" class="action-icon"><i class="ti ti-pencil"></i></a>
                                <a href="#" class="action-icon"><i class="ti ti-close"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="title">
                                <span class="name"><a href="#product-modal" data-toggle="modal">Beef Burger</a></span>
                                <span class="caption text-muted">Large (500g)</span>
                            </td>
                            <td class="price">$9.82</td>
                            <td class="actions">
                                <a href="#product-modal" data-toggle="modal" class="action-icon"><i class="ti ti-pencil"></i></a>
                                <a href="#" class="action-icon"><i class="ti ti-close"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="title">
                                <span class="name"><a href="#product-modal" data-toggle="modal">Extra Burger</a></span>
                                <span class="caption text-muted">Small (200g)</span>
                            </td>
                            <td class="price text-success">$0.00</td>
                            <td class="actions">
                                <a href="#product-modal" data-toggle="modal" class="action-icon"><i class="ti ti-pencil"></i></a>
                                <a href="#" class="action-icon"><i class="ti ti-close"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="title">
                                <span class="name">Weekend 20% OFF</span>
                            </td>
                            <td class="price text-success">-$8.22</td>
                            <td class="actions"></td>
                        </tr>
                    </table>
                    <div class="cart-summary">
                        <div class="row">
                            <div class="col-7 text-right text-muted">Order total:</div>
                            <div class="col-5"><strong>$<span class="cart-products-total">0.00</span></strong></div>
                        </div>
                        <div class="row">
                            <div class="col-7 text-right text-muted">Devliery:</div>
                            <div class="col-5"><strong>$<span class="cart-delivery">0.00</span></strong></div>
                        </div>
                        <hr class="hr-sm">
                        <div class="row text-lg">
                            <div class="col-7 text-right text-muted">Total:</div>
                            <div class="col-5"><strong>$<span class="cart-total">0.00</span></strong></div>
                        </div>
                    </div>
                    <div class="cart-empty">
                        <i class="ti ti-shopping-cart"></i>
                        <p>Your cart is empty...</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-7 order-lg-first">
                <div class="bg-white p-4 p-md-5 mb-4">
                    <h4 class="border-bottom pb-4"><i class="ti ti-user mr-3 text-primary"></i>Basic informations</h4>
                    <div class="row mb-5">
                        <div class="form-group col-sm-6">
                            <label>Name:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Surename:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Street and number:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>City:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Phone number:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>E-mail address:</label>
                            <input type="email" class="form-control">
                        </div>
                    </div>

                    <h4 class="border-bottom pb-4"><i class="ti ti-package mr-3 text-primary"></i>Delivery</h4>
                    <div class="row mb-5">
                        <div class="form-group col-sm-6">
                            <label>Delivery time:</label>
                            <div class="select-container">
                                <select class="form-control">
                                    <option>As fast as possible</option>
                                    <option>In one hour</option>
                                    <option>In two hours</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <h4 class="border-bottom pb-4"><i class="ti ti-wallet mr-3 text-primary"></i>Payment</h4>
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
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary btn-lg"><span>Order now!</span></button>
                </div>
            </div>
        </div>
    </div>

</section> -->

<!-- Cart Start  -->
<div class="mycart">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link {{ (Session::get('shoppingstep.step') == '')?'active':'dactive' }}" href="{{ (Session::get('shoppingstep.step') == '')?'#tab-cart':'' }}" data-toggle="tab"><span>1</span>Cart</a></li>
                    <li class="nav-item"><a class="nav-link {{ (Session::get('shoppingstep.step') == 'step_1')?'active':'dactive' }}" href="{{ (Session::get('shoppingstep.step') == 'step_1')?'#tab-info':'' }}" data-toggle="tab"><span>2</span>Delivery Address</a></li>
                    <li class="nav-item"><a class="nav-link {{ (Session::get('shoppingstep.step') == 'step_2')?'active':'dactive' }}" href="{{ (Session::get('shoppingstep.step') == 'step_2')?'#tab-payment':'' }}" data-toggle="tab" ><span>3</span>payment method</a></li>
                </ul>
                <div class="bor"></div>
                <div class="tab-content msgcart">
                    <div class="tab-pane {{ (Session::has('shoppingstep'))?'':'active' }}" id="tab-cart">
                        <form action="{{ route('products.cart-step.post') }}" method="post" id="paypalForm" enctype="multipart/form-data">
                            {{ csrf_field() }} 
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
                                            <td>
                                                <a href="{{ URL::to('product/'.$cartlistdetail->product->slug) }}">
                                                    <img src="{{ $iImgPath }}" class="img-fluid" alt="{{ ucwords($cartlistdetail->product->name) }}" title="{{ ucwords($cartlistdetail->product->name) }}" style="width: 100px;height: 100px;" />
                                                </a>
                                                <div class="name">
                                                    <a href="{{ URL::to('product/'.$cartlistdetail->product->slug) }}"><h4>{{ ucwords($cartlistdetail->product->name) }}</h4></a>

<?php  $categoryname = getcategoryname_byproduct_id($cartlistdetail->product->id);  ?>   
                                                    <p><?php echo $categoryname; ?></p>
                                                    <?php $avg_rating = getProductAverageRatingfor_many_items($cartlistdetail['product']['id']);  ?>
                                                    <div class="rating">
                                                        <?php for($i = 1; $i <=5; $i++){ ?>
                                                        <i class="icofont icofont-star  <?php echo ($i <= $avg_rating) ? 'selected_star_rating' : 'not_selected_star_rating'; ?>"></i>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ getSiteCurrencyType().$cartlistdetail->product->price }}
                                            </td>
                                            <input type="hidden" name="cart_id[]" value="{{ $cartlistdetail->id }}">
                                            <input type="hidden" name="product_id[]" value="{{ $cartlistdetail->product->id }}">

                                            <td class="text-center">
                                                <p class="qtypara">
                                                    <span id="minus1" class="minus button_change    cart_product_qty_{{ $cartlistdetail->id }}"  cart_id="{{ $cartlistdetail->id }}" product_id="{{ $cartlistdetail->product->id }}"
                                                        product_price="{{ $cartlistdetail->product->price }}" qty="{{ $cartlistdetail->qty }}" button_type="sub"><i class="icofont icofont-minus"></i></span>
                                                    <input type="text" value="{{ $cartlistdetail->qty }}" size="2" id="input-quantity1" class="form-control qty" readonly="readonly" />
                                                    <span id="add1" class="add button_change    cart_product_qty_{{ $cartlistdetail->id }}" cart_id="{{ $cartlistdetail->id }}" product_id="{{ $cartlistdetail->product->id }}" qty="{{ $cartlistdetail->qty }}" product_price="{{ $cartlistdetail->product->price }}"  button_type="add" ><i class="icofont icofont-plus"></i></span>
                                                </p>
                                            </td>
                                            <td class="text-center cart_product_total_{{ $cartlistdetail->id }}">{{ getSiteCurrencyType().($cartlistdetail->product->price * $cartlistdetail->qty)  }}</td>
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
                                                <h3 class="text-right grand_total">SUBTOTAL - {{ getSiteCurrencyType().$total}}</h3>                                                
                                                <p class="float-left coupon_text_color"><?php echo Session::get('apply_coupon.message'); 
                                                //echo '<pre>';print_r(Session::get('apply_coupon'));die; ?></p>
                                                <h3 class="text-right coupon_discount">COUPON DISCOUNT - <?php echo (!empty(Session::get('apply_coupon.amount')))?getSiteCurrencyType().Session::get('apply_coupon.amount'):getSiteCurrencyType().'0'; ?></h3>
                                                <h3 class="text-right tax_total">TAX <?php

$total_amount = $total;
            if (!empty($shipping_taxes->tax_percent) && $shipping_taxes->tax_percent > 0) {   
                $total_amount = ($total * $shipping_taxes->tax_percent) / 100 + $total;       
                echo  '- '.getSiteCurrencyType().($total * $shipping_taxes->tax_percent) / 100;
            } else{
              echo '- '.getSiteCurrencyType().'0';
            }?></h3>

                                                <h3 class="text-right shipping_total">SHIPPING CHARGES 

                                                - <?php  
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
            
        } ?></h3>

                                                <h3 class="text-right main_total">TOTAL AMOUNT

                                                - <?php echo getSiteCurrencyType().$total_amount; ?></h3>                                                
                                                <div class="buttons float-left">
                                                
                                                <a class="btn btn-theme btn-md btn-wide"  data-toggle="modal" data-target="#apply_coupon_popup" href="">Apply Coupon</a>
                                                
                                                </div>
                                                <input type='hidden' name='step' value='step_1'>
                                              

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

                    <div class="tab-pane col-md-12 col-12 {{ (Session::get('shoppingstep.step') == 'step_1')?'active':'' }}" id="tab-info">
                        <div class="row">
                            <div class="col-lg-5 col-md-6 col-12">
                                <h6>Delivery Address</h6>
                                <div class="icon_class">
                                    <?php if(isset($addressesArr['home']->title)){ ?>
                                       <a href="javascript:void(0)" class="deliveryAddress" type="home" address_id="<?php echo $addressesArr['home']->id;?>" title="<?php echo $addressesArr['home']->title;?>" ><i class="icofont icofont-home" style="cursor:pointer;font-size: 30px;color: #e54c2a;"/></i><b><?php echo $addressesArr['home']->title;?></b>
                                       </a> 
                                    <?php } if(isset($addressesArr['office']->title)){?>
                                        <a href="javascript:void(0)" class="deliveryAddress" type="office" address_id="<?php echo $addressesArr['office']->id;?>"  title="<?php echo $addressesArr['office']->title;?>"><i class="icofont icofont-building" style="cursor:pointer;font-size: 30px;color: #e54c2a;"/></i><b><?php echo ucwords($addressesArr['office']->title);?></b></a>
                                    <?php } 
                                     if(isset($addressesArr['other']) && count($addressesArr['other']) > 0){
                                        foreach ($addressesArr['other'] as $key => $addressesAr) {  ?>
                                        <a href="javascript:void(0)" class="deliveryAddress" type="other" address_id="<?php echo $addressesAr->id;?>"  title="<?php echo $addressesAr->title;?>"><i class="icofont icofont-location-pin" style="cursor:pointer;color: #e54c2a;font-size: 30px;"/></i><b>{{ ucwords($addressesAr->title) }}</b>
                                        </a>
                                    <?php } } ?>
                                </div>

                                <form action="{{ route('products.cart-step.post') }}" method="post"  enctype="multipart/form-data">
                                 {{ csrf_field() }}

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
                        </div>
                        <div class="col-lg-2 d-none d-lg-block"></div>
                        <div class="col-lg-5 col-md-6 col-12">
                            <h6>Contact information</h6>
                            <input type='hidden' name='step' value='step_2'>
                            <input type='hidden' name='user[id]' value='{{ Auth::user()->id }}'>
                            <fieldset>  
                                <div class="form-group">
                                    <input name="" value="{{ Auth::user()->first_name }}" placeholder="First Name" id="input-firstname" class="form-control" type="text" readonly>
                                </div>
                                <div class="form-group">
                                    <input name="" value="{{ Auth::user()->last_name }}" placeholder="Last Name" id="input-lastname" class="form-control" type="text" readonly>
                                </div>
                                <!-- <div class="form-group">
                                    <input name="email" value="" placeholder="Email" id="input-email" class="form-control" type="text">
                                </div> -->
                                <div class="form-group">
                                    <input name="" value="{{ Auth::user()->phone }}" placeholder="Phone Number" id="input-phone" class="form-control" type="number" readonly>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="buttons float-left">
                                <a href="<?php echo url('back-to-cart/') ?>" class="btn btn-theme btn-md btn-wide">Back to Cart</a>
                            </div>
                            <div class="buttons float-right">
                                <input  class="btn btn-theme btn-md btn-wide" type="submit" value="Continue">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

                                <div class="tab-pane col-md-12 col-12 {{ (Session::get('shoppingstep.step') == 'step_2')?'active':'' }}"  id="tab-payment">
                                    
                                        <form action="{{ route('payments.paypal.post') }}" class="form-horizontal" method="post" id="paypalForm" enctype="multipart/form-data">
                                        {{ csrf_field() }}   
                  <!-- Identify your business so that you can collect the payments. -->
                <!--   <input name="business" value="info@codexworld.com" type="hidden">  -->
                  <input name="business" value="rawat.neeraj.510-facilitator@gmail.com" type="hidden">
                  <input type="hidden" name="custom" value="2232||12||13">
				  
                  <!-- Specify a Buy Now button. -->
                  <input name="cmd" value="_xclick" type="hidden">         
                 

<!-- <?php $i=1;
if (Session::has('shoppingstep.product')) {

    foreach(Session::get('shoppingstep.product') as $value)
    {
        ?>
        <input type="hidden" name="item_number_<?php echo $i ?>" value="<?php echo $i ?>">
        <input type="hidden" name="item_name_<?php echo $i ?>" value="{{ $value['product'] }}" />

        <input type="hidden" name="amount_<?php echo $i ?>" value="{{ $value['price'] }}">
        <input type="hidden" name="item_quantity_<?php echo $i ?>" value="{{ $value['qty'] }}">

        <?php
        $i++;
    } }?>
              -->


                  <input type='hidden' name='cancel_return' value='{{ URL::to('admin/products/cancel') }}'>
                   <input type='hidden' name='notify_url' value='{{ URL::to('admin/products/notify') }}'>
                  <input type='hidden' name='return' value='{{ URL::to('admin/products/success') }}'>




                                        <fieldset>
                                            <div class="form-group ">
                                                <ul class="list-inline text-center link">
                                                    
                                                    <li class="list-inline-item">
                                                        <!-- <a href="#"> --><img src="{{ asset('public/img/shop/pay.png') }}" alt="paypal" title="paypal" class="img-fluid"><!-- </a> -->
                                                    </li>
                                                </ul>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <div class="col-md-12 col-12 text-center">
                                                    <div class="buttons">
                                                        <a href="<?php echo url('back-to-cart/') ?>" class="btn btn-theme btn-md btn-wide">Back to Cart</a>
                                                        <input type="submit" class="btn btn-theme btn-md btn-wide" value="Place Order">
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

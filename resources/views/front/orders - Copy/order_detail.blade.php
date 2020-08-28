@extends('layouts.front')
@section('title','Order')
@section('description','Order')
@section('keywords','Order')
@section('content')


<!-- Breadcrumb Start -->
<div class="bread-crumb">
    <div class="container">
        <div class="matter">
            <h2>Cart</h2>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="<?php echo URL::to('/'); ?>">HOME</a></li>
                <li class="list-inline-item"><a href="#">Orders</a></li>
                <li class="list-inline-item"><a href="#"><?php echo $orderDetail->order_number ?></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
			

<div class="container invoice_page">
    <div class="row">
        <div class="col-sm-12">
    		<div class="invoice-title">
    			<h3 class="">ORDER ID: <?php echo $orderDetail->order_number ?></h3> <br/>
				<h6>You have <span><?php echo count($orderDetail->order_items); ?> items</span> in your order.</h6>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-sm-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					<?php echo $orderDetail->user->first_name.' '.$orderDetail->user->last_name; ?><br>
    					<?php echo $orderDetail->user->address.', '.$orderDetail->user->postcode; ?><br>
    					<?php echo $orderDetail->user->email; ?><br>
    					<?php echo $orderDetail->user->phone; ?><br>
						
    				</address>
    			</div>
    			<div class="col-sm-6 text-right">
    				<address>
        			<strong>Delivery Address:</strong><br>
    					<?php echo $orderDetail->user->first_name.' '.$orderDetail->user->last_name; ?><br>
    					<?php echo $orderDetail->delivery_address.', '.$orderDetail->delivery_postcode; ?><br>
    					<?php echo $orderDetail->delivery_phone; ?><br>
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-sm-6">
    				<!--<address>
    					<strong>Payment Method:</strong><br>
    					Visa ending **** 4242<br>
    					jsmith@email.com
    				</address> -->
    			</div>
    			<div class="col-sm-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					<?php echo date('d/m/Y H:i A', strtotime($orderDetail->created_at)); ?><br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body ">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Image</strong></td>
                                    <!-- <td class="text-center"><strong>Category</strong></td> -->
        							<td class="text-center"><strong>Item</strong></td>
        							<td class="text-center"><strong>Rating</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<?php 

									if(!empty($orderDetail->order_items)){
										foreach($orderDetail->order_items as $order_item){ 
										
										$product_slug = getProductSlugByProductId($order_item->product_id);
										$iImgPath = asset('image/no_product_image.jpg');
										  if(isset($order_item->image) && !empty($order_item->image)){
											$iImgPath = asset('image/product/200x200/'.$order_item->image);
										  }
                                        //echo '<pre>';print_r($order_item);die;
								?>
                                <?php  $categoryname = getcategoryname_byproduct_id($order_item->product_id);  ?>   
								<tr>
                                    								

                                    <td><a href="{{ URL::to('product/'.$product_slug) }}"><img src="<?php echo $iImgPath ?>" class="img-fluid order_item_img" alt="thumb" title="<?php echo $order_item->product_name ?>"  /></a></td>
                             <!--        <td></td>     -->
    								<td class="text-center"><a href="{{ URL::to('product/'.$product_slug) }}"><?php echo $order_item->product_name ?> </a><br>{{ $categoryname }}
									
									</td>
    								<td class="text-center"><?php  $avg_rating = getProductAverageRatingfor_many_items($order_item->product_id);  ?>
                                           
                                    <div class="rating">
                                      <?php for($i = 1; $i <=5; $i++){ ?>
                                        
                                            <i class="icofont icofont-star  <?php echo ($i <= $avg_rating) ? 'selected_star_rating' : 'not_selected_star_rating'; ?>"></i>
                                        <?php } ?>
                                    </div></td>
    								<td class="text-center"><?php echo getSiteCurrencyType(); ?><?php echo $order_item->amount ?></td>
    								<td class="text-center"><?php echo $order_item->qty ?></td>
    								<td class="text-right"><?php echo getSiteCurrencyType(); ?><?php echo $order_item->total_amount ?></td>
    							</tr>
                               <?php } ?>
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right"><?php echo getSiteCurrencyType(); ?><?php echo $orderDetail->total_amount ?></td>
    							</tr>

    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right"><?php echo getSiteCurrencyType(); ?><?php echo $orderDetail->total_amount ?></td>
    							</tr>
								<?php } ?>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
	
	<div class="row">
        <div class="col-md-12">
		<h3 class="panel-title"><strong>Track Order:</strong></h3><hr>
            <ol class="progtrckr" data-progtrckr-steps="4">
                <li class="progtrckr-<?php echo isset($orderDeliveryStatusArr['confirmed']) ? 'done' : 'todo'; ?>">Order Confirmed <?php echo isset($orderDeliveryStatusArr['confirmed']) ? '('.date('h:i A', strtotime($orderDeliveryStatusArr['confirmed']->updated_at)).')' : '';  ?></li>
                <li class="progtrckr-<?php echo isset($orderDeliveryStatusArr['assign_staff']) ? 'done' : 'todo'; ?>">Food Pack & Assign <?php echo isset($orderDeliveryStatusArr['assign_staff']) ? '('.date('h:i A', strtotime($orderDeliveryStatusArr['assign_staff']->updated_at)).')' : '';  ?></li>
                <li class="progtrckr-<?php echo isset($orderDeliveryStatusArr['out_for_delivery']) ? 'done' : 'todo'; ?>">Out For Delivery <?php echo isset($orderDeliveryStatusArr['out_for_delivery']) ? '('.date('h:i A', strtotime($orderDeliveryStatusArr['out_for_delivery']->updated_at)).')' : '';  ?></li>
                <li class="progtrckr-<?php echo isset($orderDeliveryStatusArr['delivered']) ? 'done' : 'todo'; ?>">Delivered <?php echo isset($orderDeliveryStatusArr['delivered']) ? '('.date('h:i A', strtotime($orderDeliveryStatusArr['delivered']->updated_at)).')' : '';  ?></li>
            </ol>
		</div>
    </div>
						
	<div class="clearfix"></div>
	<?php 
		if(isset($orderDeliveryStatusArr['assign_staff']) && !empty($orderDeliveryStatusArr['assign_staff'])){
	?>	
	<div class="row">
        <div class="col-md-12 ">
				<div class="col-sm-offset-3 col-sm-4 delevery_staff_detail_box">
				
					<p class="text-muted well well-sm no-shadow">
					<?php if(!empty($deliveryUserDetailArr)){ ?>
						<span><strong>Name: </strong> <?php echo $deliveryUserDetailArr['name']; ?></span><br/>
						<span><strong>Email: </strong> <?php echo $deliveryUserDetailArr['email']; ?></span><br/>
						<span><strong>Phone: </strong> <?php echo isset($deliveryUserDetailArr['phone']) ? $deliveryUserDetailArr['phone'] : ''; ?></span><br/>
						<span><strong>Mobile: </strong> <?php echo isset($deliveryUserDetailArr['mobile']) ? $deliveryUserDetailArr['mobile'] : ''; ?></span>
						
					<?php } ?>
					</p>
				</div>
		</div>
	</div>
	<?php  } ?>

    <div class="row" style="margin-bottom: 50px;"><div class="col-md-12 "><div class="col-sm-offset-3 col-sm-4 "></div></div></div>
</div>
           

<style>
ol.progtrckr {
    margin: 0;
    padding: 0;
    list-style-type none;
}

ol.progtrckr li {
    display: inline-block;
    text-align: center;
    line-height: 3.5em;
}

ol.progtrckr[data-progtrckr-steps="2"] li { width: 49%; }
ol.progtrckr[data-progtrckr-steps="3"] li { width: 33%; }
ol.progtrckr[data-progtrckr-steps="4"] li { width: 24%; }
ol.progtrckr[data-progtrckr-steps="5"] li { width: 19%; }
ol.progtrckr[data-progtrckr-steps="6"] li { width: 16%; }
ol.progtrckr[data-progtrckr-steps="7"] li { width: 14%; }
ol.progtrckr[data-progtrckr-steps="8"] li { width: 12%; }
ol.progtrckr[data-progtrckr-steps="9"] li { width: 11%; }

ol.progtrckr li.progtrckr-done {
    color: black;
    border-bottom: 4px solid yellowgreen;
}
ol.progtrckr li.progtrckr-todo {
    color: silver; 
    border-bottom: 4px solid silver;
}

ol.progtrckr li:after {
    content: "\00a0\00a0";
}
ol.progtrckr li:before {
    position: relative;
    bottom: -2.5em;
    float: left;
    left: 50%;
    line-height: 1em;
}
ol.progtrckr li.progtrckr-done:before {
    content: "\2713";
    color: white;
    background-color: yellowgreen;
    height: 2.2em;
    width: 2.2em;
    line-height: 2.2em;
    border: none;
    border-radius: 2.2em;
}
ol.progtrckr li.progtrckr-todo:before {
    content: "\039F";
    color: silver;
    background-color: white;
    font-size: 2.2em;
    bottom: -1.2em;
}


</style>

        			
@endsection

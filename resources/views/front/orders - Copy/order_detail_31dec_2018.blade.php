@extends('layouts.front')

@section('content')


            <!-- Breadcrumb Start -->
            <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2>Shopping Cart</h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="index.html">HOME</a></li>
                            <li class="list-inline-item"><a href="#">Orders</a></li>
                            <li class="list-inline-item"><a href="#"><?php echo $orderDetail->order_number ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb End -->

            <!-- Cart Start  -->
            <div class="mycart">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            
                            
                            <div class="tab-content">
                                <div class="" id="tab-cart">
									<h2 class="">ORDER ID: <?php echo $orderDetail->order_number ?></h2>
                                        <h2>You have <span><?php echo count($orderDetail->order_items); ?> items</span> in your order.</h2>
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

													if(!empty($orderDetail->order_items)){
														foreach($orderDetail->order_items as $order_item){ 
														
														$iImgPath = asset('image/no_product_image.jpg');
														  if(isset($order_item->image) && !empty($order_item->image)){
															$iImgPath = asset('image/product/200x200/'.$order_item->image);
														  }
												?>
                                                    <tr>
                                                        <td>
                                                            <a href="#">
                                                                <img src="<?php echo $iImgPath ?>" class="img-fluid order_item_img" alt="thumb" title="thumb"  />
                                                            </a>
                                                            <div class="name">
                                                                <h4><?php echo $order_item->product_name ?></h4>

<?php  $avg_rating = getProductAverageRatingfor_many_items($order_item->product_id);  ?>
                                           
                                    <div class="rating">
                                      <?php for($i = 1; $i <=5; $i++){ ?>
                                        
                                            <i class="icofont icofont-star  <?php echo ($i <= $avg_rating) ? 'selected_star_rating' : 'not_selected_star_rating'; ?>"></i>
                                        <?php } ?>
                                    </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center"><?php echo getSiteCurrencyType(); ?><?php echo $order_item->amount ?></td>
                                                        <td class="text-center">
                                                            <?php echo $order_item->qty ?>
                                                        </td>
                                                        <td class="text-center"><?php echo getSiteCurrencyType(); ?><?php echo $order_item->total_amount ?></td>
                                                        
                                                    </tr>
												<?php } ?>
													<tr>
                                                        <td colspan="5">
                                                            <h3 class="text-right">TOTAL - <?php echo getSiteCurrencyType(); ?><?php echo $orderDetail->total_amount ?></h3>
                                                            
                                                            
                                                        </td>
                                                    </tr>
													<?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    
                                </div>
							</div>	
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cart End  -->

        			
@endsection

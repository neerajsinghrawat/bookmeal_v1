@extends('layouts.front')
@section('title', 'Dashboard')
@section('description', 'Dashboard')
@section('keywords', 'food','Dashboard')
@section('content')

<!-- Breadcrumb Start -->
<div class="bread-crumb">
    <div class="container">
        <div class="matter">
            <h2>Dashboard</h2>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="<?php echo URL::to('/'); ?>">HOME <?php //echo $_COOKIE['first_name']; ?></a></li>
                <li class="list-inline-item"><a href="#">Dashboard</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Login Start -->
<div class="dashboard">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 commontop text-center">
                <h4>User Dashboard</h4>
                <div class="divider style-1 center">
                    <span class="hr-simple left"></span>
                    <i class="icofont icofont-ui-press hr-icon"></i>
                    <span class="hr-simple right"></span>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
            </div>

            <div class="col-lg-12 col-md-12 user-profile">
                <div class="row">
                    <div class="col-md-3 col-lg-2">
                        <div class="user-profile-tabs">
                            <!--  Menu Tabs Start  -->
                            <ul class="nav nav-tabs flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active dashboardTab overview_tab" data-toggle="tab" href="#overview" aria-expanded="true">
                                        <i class="icofont icofont-dashboard-web"></i>
                                        <span>Overview</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link dashboardTab profile_tab" data-toggle="tab" href="#profile" aria-expanded="true">
                                        <i class="icofont icofont-ui-user"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link dashboardTab addresses_tab" data-toggle="tab" href="#addresses" aria-expanded="true">
                                        <i class="icofont icofont-ui-home"></i>
                                        <span>Addresses</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link dashboardTab history_tab" data-toggle="tab" href="#history" aria-expanded="true">
                                        <i class="icofont icofont-history"></i>
                                        <span>Order History</span>
                                    </a>
                                </li>
                                
								<?php if(isset($userOrderNumbers[0]) && !empty($userOrderNumbers[0])){ ?>
                                <li class="nav-item">
                                    <a class="nav-link dashboardTab complaint_tab" data-toggle="tab" href="#complaint" aria-expanded="true">
                                        <i class="icofont icofont-support-faq"></i>
                                        <span>Complaint</span>
                                    </a>
                                </li>
								<?php } ?>

                            </ul>
                            <!--  Menu Tabs Start  -->
                        </div>
                    </div>

                    <div class="col-md-9 col-lg-10">
                        <div class="tab-content">
                            <div id="overview" class="tab-pane fade overview_tab1">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="brief-info">
                                            <div class="media">
                                                <?php  $img = asset('image/no_product_image.jpg');
                                                            if(!empty($userDetail['picture'])){
                                                                $img = asset('image/user/150x150/'.$userDetail['picture']);
                                                            }
                                                            ?>
                                                            <img class="mr-3 img-thumbnail" src="{{ $img }}" alt="" style="width: 100px;height: 100px;">
                                           
                                                <div class="media-body">
                                                    <h4><?php echo $userDetail['first_name'].' '.$userDetail['last_name'] ?></h4>
                                                    <p><i class="icofont icofont-envelope"></i> <?php echo $userDetail['email'] ?></p>
                                                    <p><i class="icofont icofont-phone"></i> <?php echo $userDetail['phone'] ?></p>
                                                    <p><i class="icofont icofont-location-pin"></i>  <?php //echo $userDetail['city'].', '.$userDetail['country']. ?></p>
                                                </div>
                                            </div>
                                             <!--<div class="brief-info-footer">
                                               <a href="#"><i class="icofont icofont-edit"></i>Edit Profile</a> 
                                            </div>-->
                                        </div>

                                        <div class="most-recent-order">
                                            <h5>Recent Orders</h5>
            							<?php 
            								if(!empty($recentOrders) && count($recentOrders) > 0){
            									foreach($recentOrders as $order){
            									//echo '<pre>order'; print_R($order); die;
            							?>
            							   <div class="field-entry">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <p><?php echo $order->order_number ?></p>
                                                    </div>
            										<div class="col">
                                                        <p class=""><?php echo date('d/m/Y', strtotime($order->created_at)) ?></p>
                                                    </div>
            										
            										<div class="col">
                                                        <p class="confirmed"><?php echo getSiteCurrencyType(); ?><?php echo $order->total_amount ?></p>
                                                    </div>
                                                   <!-- <div class="col">
                                                        <p class="confirmed"><i class="icofont icofont-check"></i>Confirmed</p>
                                                    </div>
                                                    <div class="col text-right">
                                                        <a href="#">Detail</a>
                                                    </div> -->
                                                </div>
                                            </div>
            								<?php } }else{ ?>
            									 <div class="field-entry">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p>No any order</p>
                                                    </div>
            										
                                                </div>
                                            </div>
            								<?php } ?> 

            							   </div>
                                    </div>

                                    <!-- <div class="col-lg-6">
                                        <div class="user-profile-offer">
                                            <h5>Offers For You</h5>
                                            <div class="offer-body">
                                                <div class="offer-entry">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 align-self-center offer-left text-center">	
                                                            <p>25% OFF</p>
                                                        </div>
                                                        <div class="col-md-8 col-sm-8 offer-right">
                                                            <p>Get 25% OFF on Lunch when you pay with your Bank of America Credit Card. <a href="#">Book Now</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="offer-entry">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 align-self-center offer-left text-center">	
                                                            <p>35% OFF</p>
                                                        </div>
                                                        <div class="col-md-8 col-sm-8 offer-right">
                                                            <p>Get 25% OFF on Dinner when you pay with your SBI Credit Card. <a href="#">Book Now</a></p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="user-notification">
                                            <h5>Notification</h5>
                                            <div class="notification-body">
                                                <div class="notification-entry">
                                                    <p><i class="icofont icofont-lunch"></i> Lunch Starting from $199 <span>1 hr ago</span></p>
                                                </div>
                                                <div class="notification-entry">
                                                    <p><i class="icofont icofont-pizza"></i> 20% Cashback on Pizza <span>1 hr ago</span></p>
                                                </div>
                                                <div class="notification-entry">
                                                    <p><i class="icofont icofont-food-cart"></i> 50% off on all items <span>2 Days ago</span></p>
                                                </div>
                                                <div class="notification-entry">
                                                    <p><i class="icofont icofont-sun-alt"></i> New Year special offer <span>1 Month ago</span></p>
                                                </div>

                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>

                            <div id="profile" class="tab-pane fade profile_tab1">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="user-personal-info">
                                            <h5>Personal Information</h5>
                                            <div class="user-info-body">
                                            {!! Form::open(array('url' => url('users/edit_profile/'.Auth::user()->id),'files'=>true ,'method'=>'put')) !!}
                                            
                                            {{ csrf_field() }}
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <input name="first_name" required="required" placeholder="First Name" class="form-control" type="text" value="{{ Auth::user()->first_name }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input name="last_name" required="required" placeholder="Last Name" class="form-control" type="text" value="{{ Auth::user()->last_name }}">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-12">
                                                        <input name="email" required="required" placeholder="Enter Email" class="form-control" type="email" value="{{ Auth::user()->email }}">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-12">
                                                        <input name="phone" required="required" placeholder="Contact Number" class="form-control" type="number" value="{{ Auth::user()->phone }}">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <label class="col-12">Date Of Birth</label>
                                                    <div class="col-12 form-group">
                                                        <input name="dob" class="form-control" placeholder="Date Of Birth" type="date" value="{{ Auth::user()->dob }}" >
                                                    </div>
                                            
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-12">
                                                        <textarea placeholder="Your Current Address" id="current-address" class="form-control" rows="3">{{ Auth::user()->address }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-6">
                                                        <input name="postcode" class="form-control" placeholder="Zip Code" type="text" value="{{ Auth::user()->postcode }}" required="required">
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <input name="city" class="form-control" placeholder="City" type="text" value="{{ Auth::user()->city }}" >
                                                    </div>
                                                </div>
                                                <div class="form-row">

                                                    <div class="form-group col-6">
                                                        <input name="state" class="form-control" placeholder="State" type="text" value="{{ Auth::user()->state }}" >
                                                    </div>
                                                   <div class="form-group col-6">
                                                       <select class="form-control" name="country_id">
                                                        <option value="">-Select Country-</option>
                                                       @foreach($countries as $country)
                                                          <option value="{{ $country->id }}" {{ (Auth::user()->country_id == $country->id)?'selected':'' }}>{{ $country->name }}</option>
                                                        @endforeach                                                         
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-12">
                                                        <label>Upload Photo</label>
                                                        <input name="picture" class="upload-pic form-control-file" type="file"><br>
                                                        <?php  $img = asset('image/no_product_image.jpg');
                                                        if(!empty(Auth::user()->picture)){
                                                            $img = asset('image/user/150x150/'.Auth::user()->picture);
                                                        }
                                                        ?>
                                                        <img class="img-thumbnail" src="{{ $img }}" alt="" style="width: 100px;height: 100px;">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group mb-0 pt-4 col-12 text-center">
                                                        <button class="btn btn-theme btn-md" type="submit">SAVE CHANGES</button>
                                                       
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="user-change-password">
                                            <h5>Change Password</h5>
                                            <div class="change-password-body">
                                                <form action="{{ route('users.change_password.post') }}" method="POST" >
                                                    {{ csrf_field() }}
                                                    <div class="form-group">
                                                        <input placeholder="Old Password" class="form-control" name="old_password" type="password" required="required">
                                                        @if ($errors->has('old_password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('old_password') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <input placeholder="New Password" class="form-control" name="new_password" type="password" required="required">
                                                        @if ($errors->has('new_password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('new_password') }}</strong>
                                                        </span>
                                                        @endif

                                                    </div>
                                                    <div class="form-group">
                                                        <input placeholder="Confirm Password" class="form-control" name="confirm_password" type="password" required="required">
                                                        @if ($errors->has('confirm_password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('confirm_password') }}</strong>
                                                        </span>
                                                        @endif                                                                    
                                                    </div>

                                                    <div class="form-group mb-0 pt-4 text-center">
                                                    <button class="btn btn-theme btn-md" type="submit">SAVE CHANGES</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="addresses" class="tab-pane fade addresses_tab1">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="user-personal-info">
                                            <h5>Addresses</h5>
                                            <div class="user-info-body">
                                                {!! Form::open(array('url' => url('users/user_address/'.Auth::user()->id),'files'=>true ,'method'=>'put')) !!}
                                                {{ csrf_field() }}

                                                <label><b>Home Address</b></label>
                                                <div class="form-row">
                                                    <div class="form-group col-12">
                                                        <textarea name="address[home][address]" placeholder="Enter Address" class="form-control" ><?php echo isset($addressesArr['home']->address) ? $addressesArr['home']->address : '' ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-12">
                                                        <input name="address[home][postcode]" value="<?php echo isset($addressesArr['home']->postcode) ? $addressesArr['home']->postcode : '' ?>" placeholder="Enter Postcode" class="form-control postalAutoComplete" type="text">
                                                    </div>
                                                </div>

                                                <input name="address[home][title]" type="hidden" value="Home">
                                                <input name="address[home][type]" type="hidden" value="home">

                                                <div class="form-row">
                                                    <div class="form-group col-12">
                                                        <input name="address[home][phone]" value="<?php echo isset($addressesArr['home']->phone) ? $addressesArr['home']->phone : '' ?>" placeholder="Enter Phone No." class="form-control" type="number">
                                                    </div>
                                                </div>

                                                <label><b>Office Address</b></label>
                                                <div class="form-row">
                                                    <div class="form-group col-12">
                                                        <textarea name="address[office][address]" placeholder="Enter Address" class="form-control" ><?php echo isset($addressesArr['office']->address) ? $addressesArr['office']->address : '' ?></textarea>
                                                    </div>
                                                </div>

                                                <input name="address[office][title]" type="hidden" value="office">
                                                <input name="address[office][type]" type="hidden" value="office">

                                                <div class="form-row">
                                                    <div class="form-group col-12">
                                                        <input name="address[office][postcode]" value="<?php echo isset($addressesArr['office']->postcode) ? $addressesArr['office']->postcode : '' ?>" placeholder="Enter Postcode" class="form-control postalAutoComplete" type="text">
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-12">
                                                        <input name="address[office][phone]" value="<?php echo isset($addressesArr['office']->phone) ? $addressesArr['office']->phone : '' ?>" placeholder="Enter Phone No." class="form-control" type="number">
                                                    </div>
                                                </div>

                                                <div class="addAddress_fields">
                                                    <?php if(isset($addressesArr['other']) && count($addressesArr['other']) > 0){
                                                            foreach ($addressesArr['other'] as $key => $addressesAr) { ?>

                                                    <div class="address{{ $addressesAr->id }}"> 
                                                        <label><b>{{ $addressesAr->title }}</b></label>
                                                        <i class="icofont icofont-bin delete_address" address_id="{{ $addressesAr->id }}" style="cursor:pointer;color: #d33b3b;float:right;"/></i>

                                                        <div class="form-row">
                                                            <div class="form-group col-12">
                                                                <textarea name="address[other][<?php echo $key;?>][address]" placeholder="Enter Address" class="form-control" >{{ $addressesAr->address }}</textarea>
                                                            </div>
                                                        </div>

                                                        <input name="address[other][<?php echo $key;?>][title]" type="hidden" value="{{ $addressesAr->title }}">
                                                        <input name="address[other][<?php echo $key;?>][type]" type="hidden" value="other">

                                                        <div class="form-row">
                                                            <div class="form-group col-12">
                                                                <input name="address[other][<?php echo $key;?>][postcode]" value="{{ $addressesAr->postcode }}" placeholder="Enter Postcode" class="form-control postalAutoComplete" type="text">
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-12">
                                                                <input name="address[other][<?php echo $key;?>][phone]" value="{{ $addressesAr->phone }}" placeholder="Enter Phone No." class="form-control" type="number">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <?php } } ?>
                                                </div>   

                                                <div class="form-row">
                                                    <div class="form-group col-12">
                                                       <a href="javascript:void(0)" class="add_address">Add Address</a>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group mb-0 pt-4 col-12 text-center">
                                                        <button class="btn btn-theme btn-md" type="submit">SAVE CHANGES</button>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>                    
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="history" class="tab-pane fade history_tab1">
                        		<?php 
                        			if(!empty($orders) && count($orders) > 0){
                        				foreach($orders as $order){ ?>
                                <div class="item-entry">
                                    <span class="order-id">Order ID: <?php echo $order->order_number; ?></span>
                        			<a href="<?php echo URL::to('/'); ?>/order/<?php echo $order->order_number; ?>"><span class="order-id view_order_button"> View Order</span></a>
                                    
                                    <div class="item-content">
                                        <div class="item-body">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                        							<h4>Items </h4>
                                        			<?php
                                        				$i = 1;
                                        				foreach($order->order_items as $order_item){
															$product_slug = getProductSlugByProductId($order_item->product_id);
													?>
                                                        <p><?php echo $i; ?>. <a href="{{ URL::to('product/'.$product_slug) }}"><?php echo $order_item->product_name ?></a> </p>
                            				        <?php $i++; } ?>				
                                                </div>

                                                <div class="col-md-4 col-sm-3 text-right">
                                                    <h5><strong>Order Date: </strong> <?php echo date('d M Y', strtotime($order->created_at)); ?><strong> <br/><br/>Order Total: </strong> <?php echo getSiteCurrencyType(); ?><?php echo $order->total_amount; ?>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        			<?php } } ?>
                            </div>

                            <div id="complaint" class="tab-pane fade complaint_tab1">
                             <div class="recent-complaint">
                                <h4>Service Requests</h4>
                                <div class="complaint-tabs">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item" ><a data-toggle="tab" href="#active-complaint" class="nav-link text-center active" aria-expanded="false"><i class="icofont icofont-flash"></i> Active (<?php echo count($activeComplaintArr); ?>)</a></li>
                                        <li class="nav-item"><a data-toggle="tab" href="#resolved-complaint" class="nav-link text-center" aria-expanded="false"><i class="icofont icofont-history"></i> Resolved (<?php echo count($resolvedComplaintArr); ?>)</a></li>	
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div id="active-complaint" class="tab-pane fade active show">
                                        <div id="accordion_active_complaint">
                                    	    <h3  style="display:none">test</h3><div style="display:none"><p>test</p></div>
                                    		   
                                              <?php if(!empty($activeComplaintArr) && count($activeComplaintArr) >0){ 
                                            			foreach($activeComplaintArr as $key => $active_complaint){ 	
                                            	?>
                                            <h3>Order ID <?php echo $key ?>:
                                              <?php 
                                            	$i = 1;
                                            	foreach($active_complaint as $complaint){ 
                                            		if($i == 1){
                                            			echo $complaint['subject'];
                                            		}
                                            	$i++; } ?>
                                            </h3>
                                            <div>
                                                <p>
                                                	<label class="switch">
                                                      <input type="checkbox" class="issue_resolved_checkbox" value="1" order_number="<?php echo $key ?>" user_id="<?php echo $user_id; ?>">
                                                      <span class="slider round"></span>
                                                    </label>
                                                    Resolved ? <br/>
                                                    Note: please on this switch button if your issue resolved.
                                                	       <?php foreach($active_complaint as $complaint){  ?>
                                                        <div class="<?php echo ($complaint['user_type'] == 'customer') ? 'user' : 'admin'; ?>_complaint_text">
                                                            <span class="complaint_usertype"><?php echo ($complaint['user_type'] == 'customer') ? 'You: ' : 'Admin: '; ?>            
                                                            </span>
                                                    		<span class="complaint_problem"><?php echo $complaint['problem']; ?> <br/><?php echo $complaint['created_at']; ?>
                                                            </span>
                                                		</div>
                                                	<?php } ?>
                                                </p>
                                            </div>
                                		    <?php } } ?>
                                        </div>
                                    </div>
                                    <div id="resolved-complaint" class="tab-pane">
                        		      <div id="resolved_active_complaint">
                        		          <h3 style="display:none">test</h3>
                                        <div style="display:none"><p>test</p></div>
                                        													
                                        <?php if(!empty($resolvedComplaintArr) && count($resolvedComplaintArr) >0){ 
                                        			foreach($resolvedComplaintArr as $key => $resolved_complaint){ 	
                                        	?>
                                          <h3>Order ID <?php echo $key ?>:
                                          <?php 
                                        	$i = 1;
                                        	foreach($resolved_complaint as $complaint){ 
                                        		if($i == 1){
                                        			echo $complaint['subject'];
                                        		}
                                        	$i++; } ?>
                                          </h3>
                                          <div>
                                            <p>
                                        	<?php foreach($resolved_complaint as $complaint){  ?>
                                        		<div class="<?php echo ($complaint['user_type'] == 'customer') ? 'user' : 'admin'; ?>_complaint_text"><span class="complaint_usertype"><?php echo ($complaint['user_type'] == 'customer') ? 'You: ' : 'Admin: '; ?></span> <!--<span class="complaint_subject"><?php echo $complaint['subject']; ?></span><br/>-->
                                        		<span class="complaint_problem"><?php echo $complaint['problem']; ?> <br/><?php echo $complaint['created_at']; ?></span>
                                        			</div>
                                        	<?php } ?>
                                            </p>
                                          </div>
                        		          <?php } } ?>
                                     </div>
                                    </div>

                                    <h4 class="mt-5">New Requests</h4>
                                    <div class="submit-complaint">
                                        <form action="{{ url('/save_complaint') }}" enctype="multipart/form-data" method="POST" >
                        				 {{ csrf_field() }}
                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                   
                        							<?php if(isset($userOrderNumbers[0]) && !empty($userOrderNumbers[0])){?>
                        							
                        							<select class="form-control" name="order_number" required>
                        								<option value="">-Select Order ID-</option>
                        								<?php foreach($userOrderNumbers as $order_number){ ?>
                        									<option value="<?php echo $order_number->order_number; ?>"><?php echo $order_number->order_number; ?></option>
                        								<?php } ?>
                        							</select>
                        								
                        							<?php } ?>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <input class="form-control" name="subject" placeholder="Subject" type="text" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-12">
                                                    <textarea class="form-control" rows="4" name="problem" placeholder="Your Issue"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-12 text-center mb-0">
                                                    <button class="btn btn-theme btn-md btn-wide submitComplaint" name="submitComplaint" type="submit">SUBMIT REQUEST</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                             </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login End -->

 <input type="hidden" id="totaladdress" value="<?php echo (isset($addressesArr['other']) && count($addressesArr['other']) > 0)?count($addressesArr['other']):0; ?>" />
@endsection
<script type="text/javascript">
    var baseUrl = '{{ URL::to('/') }}';

</script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="{{ asset('js/fornt/devlopment.js') }}"></script>
<script type="text/javascript">
  $( function() {
    $( "#accordion_active_complaint" ).accordion();
  } );
 
 
 $( function() {
    $( "#resolved_active_complaint" ).accordion();
  } );
  
  
  $(window).load(function(){
	  var cookie_tab_name = getCookie("username"); 
	  //alert(cookie_tab_name);
	  $('.dashboardTab').removeClass('active');
      $('.'+cookie_tab_name+'_tab').addClass('active');
	  $('.'+cookie_tab_name+'_tab1').addClass('active show');
	  var tab = '#'+cookie_tab_name;
	  
  })
  
  $(document).ready(function(){
	  $('.issue_resolved_checkbox').click(function(){
		  var order_number = $(this).attr('order_number');
		  var user_id = $(this).attr('user_id');
		  var baseUrl = '{{ URL::to('/') }}';
		  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		  
		  $.ajax({
      
			  url: baseUrl+'/users/saveResolvedOrderComplaints',
			  
			  type: 'post',
			  
			  data: {order_number: order_number,user_id: user_id,_token: CSRF_TOKEN,requestType : 'submitResolvedRequest'},
			  
			  dataType: 'json',
			  
			  success: function(result) {
				  //alert(result); return false;
				if(result == 1){
					alert('Thank You: Your order compalint has been resolved successfully')
					location.reload();
					return false;
				} else {
				 
				}    
			  
			  }
			  
			  });
		  
	  });
	  
	  
	  $('.dashboardTab').click(function(){
		  var tab_name = $(this).attr('href');
		  tab_name = tab_name.replace("#", "");
		  
		  setCookie("username", tab_name, 365);
		  
		 
		 
		  
		  /*var baseUrl = '{{ URL::to('/') }}';
		  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		  
		  $.ajax({
      
			  url: baseUrl+'/users/setDashboardTabSession',
			  
			  type: 'post',
			  
			  data: {tab_name: tab_name,_token: CSRF_TOKEN,requestType : 'setDashboardTab'},
			  
			  dataType: 'json',
			  
			  success: function(result) {
				  alert('test'+result); return false;
				}
			  
			  }).done(function(){
				  alert('test1'+result); return false;
			  });*/
	  })
	  

  })
  
  	  
	  function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
  </script>

<script type="text/javascript">
$(document).ready(function() {
  
  $(document).on('click','.add_address',function(){
     var baseUrl = '{{ URL::to('/') }}';
    var totaladdress = $("#totaladdress").val();
     totaladdress = parseInt(totaladdress) + 1;
     $("#totaladdress").val(totaladdress);

     $(".addAddress_fields").append('<div><label><b>Other Address</b></label><i class="icofont icofont-bin deleteCurrentRow_1" style="cursor:pointer;color: #d33b3b;float:right;"/></i><div class="form-row"><div class="form-group col-12"><input name="address[other]['+totaladdress+'][title]" required="required" placeholder="Enter Title" class="form-control" type="text"></div></div><input name="address[other]['+totaladdress+'][type]" type="hidden" value="other"><div class="form-row"><div class="form-group col-12"><textarea name="address[other]['+totaladdress+'][address]" required="required" placeholder="Enter Address" class="form-control" ></textarea></div></div><div class="form-row"><div class="form-group col-12"><input name="address[other]['+totaladdress+'][postcode]" required="required" placeholder="Enter Postcode" class="form-control postalAutoComplete" type="text"></div></div><div class="form-row"><div class="form-group col-12"><input name="address[other]['+totaladdress+'][phone]" required="required" placeholder="Enter Phone No." class="form-control" type="number"></div></div></div>');

  });
  
  $(document).on('click','.deleteCurrentRow_1',function(){
    if (confirm('Are You Sure?')){
       $(this).parent().remove();
    }
  }); 

    $('.delete_address').click(function(){
        var baseUrl = '{{ URL::to('/') }}';
        var address_id = $(this).attr('address_id');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
         //alert(address_id);
          $.ajax({
            url : baseUrl+'/users/delete_ajax_address',
            type : 'POST',
            data : {address_id : address_id,_token: CSRF_TOKEN},
            dataType : 'json',
            success : function(result){
              
            }
          }).done(function(result){
            
            if(result['success'] == 1){

              $('.address'+address_id).remove();

            }
          });
    });
   

});
</script>
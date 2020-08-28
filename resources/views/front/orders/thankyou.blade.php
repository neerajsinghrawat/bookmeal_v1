@extends('layouts.front')
@section('title','Thank You')
@section('description','Thank You')
@section('keywords','Thank You')
@section('content')

<div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2>Thank You</h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="<?php echo URL::to('/'); ?>">HOME</a></li>
                            <li class="list-inline-item"><a href="#">Thank You</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb End -->
			
<!-- Service Start  -->
            <div class="page-not-found">
                <div class="container">
                    <div class="row ">
                        <!-- Title Content Start -->
                        <div class="col-sm-12 col-xs-12 commontop text-center">
                            <h4>Thank You</h4>
                            <div class="divider style-1 center">
                                <span class="hr-simple left"></span>
                                <i class="icofont icofont-ui-press hr-icon"></i>
                                <span class="hr-simple right"></span>
                            </div>
                            <div class="thanks-content">
                                <h3><i class="icofont icofont-tick-mark"></i> Congratulations. <br>Your order was Completed Successfully.</h3>
                                <p><strong>Hi <?php echo (isset($lastOrder) && !empty($lastOrder)) ? $lastOrder->user->first_name : ''; ?>,</strong></p>
                                <p>We have received your order.<br> We will send you an Email and SMS the moment your order items are dispatched to your address.</p>
                                <p>Your Order ID: <strong><?php echo (isset($lastOrder) && !empty($lastOrder)) ? $lastOrder->order_number : ''; ?></strong></p>
                                <a class="btn btn-theme btn-wide" href="<?php echo URL::to('/'); ?>">Go to home</a>
                            </div>
                        </div>
                        <!-- Title Content End -->
                    </div>
                </div>
            </div>
            <!-- Service End   -->

			
@endsection

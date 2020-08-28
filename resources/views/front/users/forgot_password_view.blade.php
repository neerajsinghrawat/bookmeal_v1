@extends('layouts.front')
@section('title','Login')
@section('description','Login')
@section('keywords', 'Login')
@section('content')

            <!-- Breadcrumb Start -->
            <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2>Forgot Password</h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="{{ url('/') }}">HOME</a></li>
                            <li class="list-inline-item"><a href="#">Forgot Password</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Breadcrumb End -->

            <!-- Login Start -->
            <div class="login">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 commontop text-center">
                            <h4>Forgot Password</h4>
                            <div class="divider style-1 center">
                                <span class="hr-simple left"></span>
                                <i class="icofont icofont-ui-press hr-icon"></i>
                                <span class="hr-simple right"></span>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-10">
                            <div class="row">
                                <div class="col-sm-10 col-md-12">
                                    <div class="loginnow forgotpasswordnow">
                                        <form method="post" enctype="multipart/form-data" action="{{ route('forgot_password') }}">
                                          {{ csrf_field() }}
                                          
                                            <div class="form-group">
                                                <i class="icofont icofont-ui-message"></i><input type="email" name="email" value="" placeholder="Enter Register Email Id" id="email" class="form-control" required/>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                            </div>

                                            <div class="form-group">
                                                <input type="submit" value="SEND" class="btn btn-theme btn-md btn-wide" />
                                            </div>
                                        </form>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login End -->
@endsection

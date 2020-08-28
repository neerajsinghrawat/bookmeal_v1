@extends('layouts.front')
@section('title','Register')
@section('description','Register')
@section('keywords', 'Register')
@section('content')

            <!-- Breadcrumb Start -->
            <div class="bread-crumb">
                <div class="container">
                    <div class="matter">
                        <h2>Register</h2>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="{{ url('/') }}">HOME</a></li>
                            <li class="list-inline-item"><a href="#">Register</a></li>
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
                            <h4>Create an Account</h4>
                            <div class="divider style-1 center">
                                <span class="hr-simple left"></span>
                                <i class="icofont icofont-ui-press hr-icon"></i>
                                <span class="hr-simple right"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam efficitur placerat nulla, in suscipit erat sodales id. Nullam ultricies eu turpis at accumsan. Mauris a sodales mi, eget lobortis nulla.</p>
                        </div>
                        <div class="col-lg-10 col-md-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-10">
                                    <div class="loginnow" style="height:90%">
                                        <h5>Register</h5>
                                        <p>Do You have an account? So <a href="{{ route('login') }}">login</a> And starts less than a minute</p>
                                        <form method="post" enctype="multipart/form-data" method="POST" action="{{ route('register') }}">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <i class="icofont icofont-ui-user"></i><input type="text" name="first_name" value="" placeholder="FIRST NAME" id="input-name" class="form-control" required/>
                                            @if ($errors->has('first_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                            <div class="form-group">
                                                <i class="icofont icofont-ui-user"></i><input type="text" name="last_name" value="" placeholder="LAST NAME" id="input-name" class="form-control" required/>
                                            @if ($errors->has('last_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                            @endif
                                            </div>

                                            <div class="form-group">
                                                <i class="icofont icofont-ui-message"></i><input type="text" name="email" value="" placeholder="EMAIL" id="email" class="form-control" required/>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                            </div>

                                            <div class="form-group">
                                                <i class="icofont icofont-lock"></i><input type="password" name="password" value="" placeholder="PASSWORD" id="input-password" class="form-control" required/>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                            </div>

                                            <div class="form-group">
                                                <i class="icofont icofont-lock"></i><input type="password" name="password_confirmation" value="" placeholder="REPEAT PASSWORD" id="input-confirm" class="form-control" required/>
                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif  
                                            </div>

                                            <div class="form-group">
                                                <i class="icofont icofont-ui-user"></i><input type="phone" name="phone" value="" placeholder="PHONE NO." id="input-name" class="form-control" required/>
                                            @if ($errors->has('phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                            </div>

                                            <div class="form-group">
                                                <i class="icofont icofont-ui-user"></i><input type="text" name="address" value="" placeholder="ADDRESS" id="input-name" class="form-control" required/>
                                             @if ($errors->has('address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                            </div>

                                            <div class="form-group">
                                                <i class="icofont icofont-ui-user"></i><input type="text" name="postcode" value="" placeholder="POSTCODE" id="input-name" class="form-control" required/>
                                            @if ($errors->has('postcode'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('postcode') }}</strong>
                                                </span>
                                            @endif
                                            </div>

                                            <div class="form-group">
                                                <div class="links">
                                                    <label><input type="checkbox" class="checkbox-inline"/> By signing up I agree with <a href="#">terms & conditions.</a> </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" value="SIGN UP" class="btn btn-theme btn-md btn-wide" />
                                            </div>
                                        </form>
                                    </div>
                                </div>

<!--                                 <div class="col-sm-12 col-md-6">
                                    <div class="loginto loginnow">
                                        <h5>Login via social accounts</h5>
                                        <ul class="list-unstyled text-center">
                                            <li><a href="#" target="_blank"><i class="icofont icofont-social-facebook"></i> Login with Facebook</a></li>
                                            <li><a href="#" target="_blank"><i class="icofont icofont-social-twitter"></i> Login with Twitter</a></li>
                                            <li><a href="#" target="_blank"><i class="icofont icofont-social-google-plus"></i> Login with Google+</a></li>
                                        </ul>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login End -->
@endsection

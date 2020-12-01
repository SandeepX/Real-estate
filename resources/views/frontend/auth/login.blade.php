@extends('frontend.layouts.master')
@section('title','Login')
@section('content')

    <section class="index-property login-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-wrapper">
                        <div class="login-title">
                            <h4 class="inner-title text_white">login Account</h4>
                        </div>
                        <div class="login-desc">
                            <figure>
                                <img src="{{asset('common/images/'.$setting->site_logo)}}" class="img-fluid" alt="">
                            </figure>
                            <p>Welcome to {{$setting->site_title}}<span>please Login here!!</span></p>

                            <div class="login-register-msg">
                                @include('partials.messages') 
                            </div> 
                            <form action="{{route('fe.login')}}" method="post">

                                {{ csrf_field()}}


                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email Address">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                        <div class="remember-forgot">
                                            <label>
                                                <input type="checkbox">
                                                Remember me
                                            </label>
                                            <a href="{{route('user.password.request')}}" class="forgot-password">Forgot Password</a>
                                        </div>
                                        <button type="submit" name="login" class="btn login-btn">LogIn</button>
                                        <div class="row m-t-20">
                                            <div class="col-lg-6">
                                                {{--<button class="btn login-btn-facebook"><i class="fab fa-facebook-f"></i>Login With Facebook</button>--}}
                                                <a href="{{route('social.redirect','Facebook')}}" class="btn login-btn-facebook" role="button"><i class="fab fa-facebook-f"></i>Login With Facebook</a>
                                            </div>
                                            <div class="col-lg-6">
                                             {{--   <button class="btn login-btn-google"><i class="fab fa-google"></i>Login With Google</button>--}}

                                                <a href="{{route('social.redirect','Google')}}" class="btn login-btn-google" role="button"><i class="fab fa-google"></i>Login With Google</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="login-footer">
                            <p>Don't have and account?</p>
                            <a href="{{route('fe.getRegisterForm')}}">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
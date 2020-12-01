@extends('frontend.layouts.master')
@section('title','Forgot Password')
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
                            <p>Welcome to {{$setting->site_title}}<span>please enter your email!!</span></p>

                            @include('partials.messages')

                            <form action="{{route('user.password.email')}}" method="post">

                                {{ csrf_field()}}


                                <div class="row">
                                    <div class="col-lg-12">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email Address">

                                        <button type="submit" name="login" class="btn login-btn">Reset Password</button>
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
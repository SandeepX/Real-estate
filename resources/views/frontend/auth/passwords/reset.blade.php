@extends('frontend.layouts.master')
@section('title','Reset Password')
@section('content')

    <section class="index-property login-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-wrapper">
                        <div class="login-title">
                            <h4 class="inner-title text_white">Reset Account</h4>
                        </div>
                        <div class="login-desc">
                            <figure>
                                <img src="{{asset('frontend/img/logo.png')}}" class="img-fluid" alt="">
                            </figure>
                            <p>Welcome to Real Estate<span>please reset here!!</span></p>

                            @include('partials.messages')

                            <form id="registerForm" action="{{route('user.password.update')}}" method="post" class="register-form">

                                {{ csrf_field()}}
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="row">
                                    <div class="col-lg-12">
                                       <label for="email">Email Address *</label>
                                        <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control" placeholder="" required>
                                        <label for="password">Password *</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="" required>
                                        <label for="password-confirm">Confirm Password *</label>
                                        <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                        <div class="row">

                                            <button id="btn-register" type="submit" class="btn register-btn">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="login-footer">
                            <p>Already have an account?</p>
                            <a href="{{route('fe.getLoginForm')}}">Sign In</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection


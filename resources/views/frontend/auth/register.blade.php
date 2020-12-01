@extends('frontend.layouts.master')
@section('title','Register')
@section('content')

    <section class="index-property login-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="login-wrapper">
                        <div class="login-title">
                            <h4 class="inner-title text_white">Register Account</h4>
                        </div>
                        <div class="login-desc">
                            <figure>
                                <img src="{{asset('common/images/'.$setting->site_logo)}}" class="img-fluid" alt="logo">
                            </figure>
                            <p>Welcome to Real Estate<span>please Register here!!</span></p>
                            <div class="login-register-msg">
                                @include('partials.messages')
                            </div>

                            <form id="registerForm" action="{{route('fe.registerUser')}}" method="post" class="register-form">

                                {{ csrf_field()}}

                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="name">Full name *</label>
                                        <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control" placeholder="Please Enter Full Name" required>
                                        <label for="email">Email Address *</label>
                                        <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control" placeholder="" required>
                                        <label for="password">Password *</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="" required>
                                        <label for="password-confirm">Confirm Password *</label>
                                        <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                        <label for="phone">Phone Number *</label>
                                        <input type="text" id="phone" name="phone" value="{{old('phone')}}" class="form-control" placeholder="" required>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label for="">Address *</label>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="second-lvl" for="Province">Province *</label>
                                                <select name="province" id="province" class="custom-select d-block w-100" required>
                                                    <option value="" selected disabled>Choose...</option>

                                                    @foreach($provinces as $province)
                                                        <option data-provinceurl="{{route('province.districts',$province->id)}}" value="{{$province->id}}" {{old('province') == $province->id ? 'selected' : ''}}>
                                                            {{$province->province_name}}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="second-lvl">District *</label>
                                                <select name="district" id="district" class="custom-select d-block w-100" required>
                                                    <option value="" selected disabled>Choose...</option>

                                                    {{--@foreach($districts as $district)
                                                        <option data-url="{{route('district.municipals',$district->id)}}" value="{{$district->id}}">{{$district->district_name}}</option>
                                                    @endforeach--}}
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="second-lvl">Municipality *</label>
                                                <select name="municipal" id="municipal" class="custom-select d-block w-100" required>
                                                    <option value="" selected disabled>Choose...</option>

                                                    {{--@foreach($municipals as $municipal)
                                                        <option value="{{$municipal->id}}">{{$municipal->municipal_name}}</option>
                                                    @endforeach--}}
                                                </select>
                                            </div>
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control m-t-10" name="address" value="{{old('address')}}" placeholder="Enter address" required>
                                                <div class="remember-forgot">
                                                    <label>
                                                        <input type="checkbox" id="terms_conditions_checkbox" name="terms_accepted" {{old('terms_accepted') ? 'checked' : ''}}>
                                                        <a href="#termsandcondition" data-toggle="modal">Accept terms and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                            <button id="btn-register" type="submit" name="login" class="btn register-btn" disabled="disabled">Register</button>
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
                <div class="modal fade bd-example-modal-lg register-terms" id="termsandcondition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Terms & Conditions</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body register-modal-scroll">
                                @foreach($termsAndConditions as $term)
                                    <ul>
                                        <li>
                                            <h6>
                                                {{$term->topic}}
                                            </h6>
                                            <p>
                                                {{$term->description}}
                                            </p>
                                        </li>
                                    </ul>

                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn accept-btn" data-dismiss="modal">Accept</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')

    @include('frontend.auth.register-scripts')
@endpush
@extends('frontend.layouts.master')
@section('title','Privacy Policies')
@section('content')

<!--     <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-area">
                        <h2>Privacy Policy</h2>
                        <ul class="breadcrumb-ul">
                            <li><a href="{{route('fe.home')}}">Home</a></li>
                            <li><i class="fas fa-chevron-right"></i></li>
                            <li class="active">Privacy Policy</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <h2>Privacy Policy</h2>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <ul class="breadcrumb-ul">
                        <li><a href="{{route('fe.home')}}">Home</a></li>
                        <li><i class="fas fa-chevron-right"></i></li>
                        <li class="active">Privacy Policy</li>
                    </ul>
                </div>
            </div>
        </div> 
    </section>

    <section class="terms-condition-section bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 bg-white-terms">
                    <h3 class="featured-prop-title">Real Estate Privacy Policy</h3>
                    <div class="bod-bot-div"></div>
                    <div class="terms-condition-div">
                        <ul class="terms-condition-ul">

                            @foreach($policies as $policy)
                                <li>
                                    <h6>
                                        {{$policy->topic}}
                                    </h6>
                                    <p>
                                        {{$policy->description}}
                                    </p>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="advance-form terms-advance-search">
                        <h5>Advance Search</h5>
                        @include('frontend.pages.partials.advance-search-sidebar')
                    </div>
                    <div class="faq-right" style="overflow: hidden;">
                        <div class="faq-contact" style="position: relative; padding: 0; margin: 0; width: 100%; height: 100%; overflow: hidden;">
                            <img src="img/contact.jpg" alt="" class="imgfix_src_img" style="opacity: 1;">
                            <div class="hovered align-self-center">
                                <p>Contact us for more Query. </p>
                                <button type="button" class="btn request-info-btn" data-toggle="modal" data-target="#privacy-contact-btn">
                                    Contact Us
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="privacy-contact-btn" tabindex="-1" role="dialog" aria-labelledby="privacy-contact-btn-title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-custom-width" role="document">
                        <div class="modal-content">
                            <div class="modal-header request-header">
                                <h5 class="modal-title" id="terms-contact-btn-title">Contact Us Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @include('frontend.pages.partials.contact-modal')
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
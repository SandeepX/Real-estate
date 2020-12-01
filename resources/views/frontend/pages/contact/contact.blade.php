@extends('frontend.layouts.master')
@section('title','Contact Us')
@section('content')


    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <h2>Contact Us</h2>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <ul class="breadcrumb-ul">
                        <li><a href="{{route('fe.home')}}">Home</a></li>
                        <li><i class="fas fa-chevron-right"></i></li>
                        <li class="active"><a href="{{route('fe.contact')}}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div> 
    </section>


    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                    <div class="contact-form">
                        <h3 class="feel-free">Feel Free To contact us</h3>

                        @include('partials.messages')

                        <form id="contact_form" method="post" action="{{route('fe.contact.store')}}">

                            {{csrf_field()}}

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="name" value="{{old('name')}}" class="input-text form-control" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="email" name="email"  value="{{old('email')}}" class="input-text form-control" placeholder="Enter email">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="subject" value="{{old('subject')}}" class="input-text form-control" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="phone" value="{{old('phone')}}" class="input-text form-control" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 clearfix">
                                    <div class="form-group">
                                        <textarea class="input-text form-control" name="message" placeholder="Write message" required style="margin: 0px; width: 100%; height: 100px;">{{old('message')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-6 col-sm-12">
                                    <div class="form-group send-btn mb-0">
                                        <button type="submit" class="btn btn-contact-msg">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6">
                    <div class="contact-details">
                        <div class="media">
                            <div class="media-left">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="media-body address-div">
                                <h4>Office Address</h4>
                                <p>{{$setting->address}}</p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-left m-t-10">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="media-body">
                                <h4>Phone Number</h4>
                                <p>
                                    <a href="tel:0477-0477-8556-552">office: {{$setting->phone}}</a>
                                </p>
                                <p>
                                    <a href="tel:+55-417-634-7071">Mobile: {{$setting->mobile}}</a>
                                </p>
                            </div>
                        </div>
                        <div class="media mb-0">
                            <div class="media-left  m-t-10">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="media-body">
                                <h4>Email Address</h4>
                                <p>
                                    <a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                                </p>
                                <p>
                                    <a href="mailto:{{$setting->alt_email}}">{{$setting->alt_email}}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--section-subscribe-->
    @include('frontend.pages.home.sections.section-subscribe')
    <!--/section-subscribe-->



@endsection

@push('scripts')
    <!--jquery validation-->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>

        $(document).ready(function () {

            $('#contact_form').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true,
                        maxlength:191,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    phone: {
                        required: true,
                        maxlength:191,
                    },
                    subject: {
                        required: true,
                        maxlength:191,
                    },
                    message: {
                        required: true,
                    },

                },
                messages: {
                    name: {
                        required: "Please Enter Your Full Name.",
                        maxlength :"Too Long."
                    },
                    email: {
                        required: "Please Enter Your Email.",
                        maxlength :"Please Enter Your Valid Email."
                    },
                    subject: {
                        required: "Please Enter Subject.",
                        maxlength :"Too Long."
                    },
                    phone: {
                        required: "Please Enter Your Phone Number.",
                        maxlength :"Too Long."
                    },
                    message: {
                        required: "Please Enter Your Message.",
                    },


                },
            });

        });
    </script>
@endpush
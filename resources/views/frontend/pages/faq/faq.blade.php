@extends('frontend.layouts.master')
@section('title','Faq')
@section('content')

    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <h2>FAQ</h2>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <ul class="breadcrumb-ul">
                        <li><a href="{{route('fe.home')}}">Home</a></li>
                        <li><i class="fas fa-chevron-right"></i></li>
                        <li class="active"><a href="{{route('fe.faq')}}">FAQ</a></li>
                    </ul>
                </div>
            </div>
        </div> 
    </section>

    <section class="faq-section bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h3 class="featured-prop-title">Frequently Asked Question(FAQ)</h3>
                    <div class="bod-bot-div"></div>
                    <p class="faq-p"></p>
                    <div class="card m-b-0">

                        @foreach($faqs as $faq)
                            <div class="card-header">
                                <a class="card-title collapsed" data-toggle="collapse" data-parent="#faq" href="#faq{{$loop->iteration}}" aria-expanded="false">
                                    <span><i class="fas fa-chevron-down"></i></span>
                                    {!! $faq->question !!}
                                </a>
                            </div>
                            <div id="faq{{$loop->iteration}}" class="card-block collapse" style="">
                                <div class="p-text">
                                    {!! $faq->answer !!}

                                    @if(isset($faq->video_id))
                                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$faq->video_id}}?rel=0&modestbranding=1" frameborder="0" allowfullscreen></iframe>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="recent-prop recent-prop-page">
                        <h4>Recent Properties</h4>
                        @foreach($recentProperties as $property)
                            <div class="media page-media-wrapper">
                                <div class="media-left">
                                    @if($property->featured_image)
                                        <img class="media-object" src="{{asset('common/images/small/'.$property->featured_image)}}" alt="{{$property->title}}">
                                    @else
                                        <img class="media-object" src="{{asset('common/images/no-photo.png')}}" alt="{{$property->title}}">
                                    @endif
                                </div>
                                <div class="media-body page-media-body">
                                    <h6 class="media-heading">
                                        <a href="{{route('fe.singleProperty',$property->slug)}}">{{$property->title}}</a>
                                    </h6>
                                    <p>{{date('M j,Y',strtotime($property->created_at))}}</p>
                                    <div class="price">
                                       Rs.{{$property->price}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="faq-right" style="overflow: hidden;">
                        <div class="faq-contact" style="position: relative; padding: 0; margin: 0; width: 100%; height: 100%; overflow: hidden;">
                            <img src="img/contact.jpg" alt="" class="imgfix_src_img" style="opacity: 1;">
                            <div class="hovered align-self-center">
                                <p>Contact us for more Query. </p>
                                <button type="button" class="btn request-info-btn" data-toggle="modal" data-target="#faq-contact-btn">
                                    Contact Us
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="faq-contact-btn" tabindex="-1" role="dialog" aria-labelledby="faq-contact-btn-title" aria-hidden="true">
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
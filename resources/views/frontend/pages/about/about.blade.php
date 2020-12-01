@extends('frontend.layouts.master')
@section('title','About Us')
@section('content')

    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <h2>About Us</h2>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <ul class="breadcrumb-ul">
                        <li><a href="{{route('fe.home')}}">Home</a></li>
                        <li><i class="fas fa-chevron-right"></i></li>
                        <li class="active"><a href="{{route('fe.about')}}">About Us</a></li>
                    </ul>
                </div>
            </div>
        </div> 
    </section>

    <section class="msg-ceo-section bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="msg-ceo-div">
                        <h3 class="featured-prop-title">Message From CEO</h3>
                        <div class="bod-bot-div"></div>
                       {!! $aboutUs->ceo_message !!}
                    </div>
                </div>
                <div class="col-lg-5">
                    <figure class="ceo-img">
                        <img src="{{asset('common/images/'.$aboutUs->ceo_image)}}" alt="CEO Image" class="img-fluid">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="msg-ceo-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="featured-prop-title text-center">ABOUT US</h3>
                    <div class="bod-bot-div div-center"></div>
                </div>
                <div class="col-lg-3">
                    <div class="nav flex-column nav-pills abt-tabs" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="overview-tab-id" data-toggle="pill" href="#overview-tab" role="tab" aria-controls="overview-tab" aria-selected="true">Overview</a>
                        <a class="nav-link" id="mission-tab-id" data-toggle="pill" href="#mission-tab" role="tab" aria-controls="mission-tab" aria-selected="false">Our Mission</a>
                        <a class="nav-link" id="vision-tab-id" data-toggle="pill" href="#vision-tab" role="tab" aria-controls="vision-tab" aria-selected="false">Our Vision</a>
                        <a class="nav-link" id="statement-tab-id" data-toggle="pill" href="#statement-tab" role="tab" aria-controls="statement-tab" aria-selected="false">Our Statements</a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active abt-tab-content" id="overview-tab" role="tabpanel" aria-labelledby="overview-tab-id">
                            {!! $aboutUs->overview !!}
                        </div>
                        <div class="tab-pane fade abt-tab-content" id="mission-tab" role="tabpanel" aria-labelledby="mission-tab-id">
                            {!! $aboutUs->our_mission !!}
                        </div>
                        <div class="tab-pane fade abt-tab-content" id="vision-tab" role="tabpanel" aria-labelledby="vision-tab-id">
                            {!! $aboutUs->our_vision !!}
                        </div>
                        <div class="tab-pane fade abt-tab-content" id="statement-tab" role="tabpanel" aria-labelledby="statement-tab-id">
                            {!! $aboutUs->our_statements !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="msg-ceo-section bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="featured-prop-title text-center">OUR BOARD MEMBERS</h3>
                    <div class="bod-bot-div div-center"></div>
                </div>

                @forelse($boardMembers as $member)
                    <div class="col-lg-3">
                        <div class="team-wrapper">
                            <div class="team-photo">
                                <a href="#">
                                    @if($member->image)
                                        <img class="img-fluid" src="{{asset('common/images/'.$member->image)}}" alt="{{$member->name}}">
                                    @else
                                        <img class="img-fluid" src="{{asset('common/images/default-user.png')}}" alt="{{$member->name}}">
                                    @endif
                                </a>
                                <ul class="social-list clearfix">
                                    <li><a href="{{$member->facebook}}" class="facebook" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="{{$member->linkedin}}" class="linkedin" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                            <div class="team-details">
                                <h5>{{$member->name}}</h5>
                                <h6>{{$member->designation_id ? $member->designation->title : ''}}</h6>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse

            </div>
            <div class="row m-t-20">
                <div class="col-lg-12">
                    <h3 class="featured-prop-title text-center">OUR TECHNICAL TEAM</h3>
                    <div class="bod-bot-div div-center"></div>
                </div>

                @forelse($techMembers as $member)
                    <div class="col-lg-3">
                        <div class="team-wrapper">
                            <div class="team-photo">
                                <a href="#">
                                    @if($member->image)
                                        <img class="img-fluid" src="{{asset('common/images/'.$member->image)}}" alt="{{$member->name}}">
                                    @else
                                        <img class="img-fluid" src="{{asset('common/images/default-user.png')}}" alt="{{$member->name}}">
                                    @endif
                                </a>
                                <ul class="social-list clearfix">
                                    <li><a href="{{$member->facebook}}" class="facebook" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="{{$member->linkedin}}" class="linkedin" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                            <div class="team-details">
                                <h5>{{$member->name}}</h5>
                                <h6>{{$member->designation_id ? $member->designation->title : ''}}</h6>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </section>



    <!--section-subscribe-->
    @include('frontend.pages.home.sections.section-subscribe')
    <!--/section-subscribe-->


    <!--section-7-->
    @include('frontend.pages.home.sections.section-clients')
    <!--/section-7-->

@endsection
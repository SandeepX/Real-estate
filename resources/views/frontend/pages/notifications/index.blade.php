@extends('frontend.layouts.search-master')
@section('title','Notifications')
@section('content')
<section class="user-dashboard bg-grey">
    <div class="container-fluid">
        <div class="row">
            @include('frontend.pages.partials.user-navigation')
            <div class="col-lg-10">
                <div class="my-prop-wrapper">
                    <h3>All Notifications</h3>

                    <div class="notification-page-wrapper">
                        @foreach($unreadNotifications as $notification)
                            <a href="{{isset($notification['data']['action']) ?$notification['data']['action'] : '' }}" class="active unread_notification"
                               data-id="{{route('user.notifications.markAllRead.single',$notification['id'])}}">
                                <div class="row">
                                    <div class="col-lg-1">
                                        <figure class="notification-figure">

                                            @if(isset($notification['data']['image']))

                                                <img src="{{asset('common/images/'.$notification['data']['image'])}}" class="img-fluid" alt="{{$notification['data']['image']}}">

                                            @else
                                                <img src="{{asset('common/images/default-user.png')}}" class="img-fluid" alt="image">
                                            @endif

                                        </figure>
                                    </div>
                                    <div class="col-lg-11 notification-right-div">
                                        <div class="notification-header-div">
                                            <h5 class="notification-title">
                                                @if(isset($notification['data']['message']))
                                                    {{$notification['data']['message']}}
                                                @endif
                                            </h5>
                                            <p class="notification-time"><i class="far fa-clock"></i>{{ Carbon\Carbon::parse($notification['created_at'])->diffForHumans()}}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        @foreach($readNotifications as $notification)
                                <a href="{{isset($notification['data']['action']) ?$notification['data']['action'] : '' }}">
                                    <div class="row">
                                        <div class="col-lg-1">
                                            <figure class="notification-figure">

                                                @if(isset($notification['data']['image']))

                                                    <img src="{{asset('common/images/'.$notification['data']['image'])}}" class="img-fluid" alt="{{$notification['data']['image']}}">

                                                @else
                                                    <img src="{{asset('common/images/default-user.png')}}" class="img-fluid" alt="image">
                                                @endif

                                            </figure>
                                        </div>
                                        <div class="col-lg-11 notification-right-div">
                                            <div class="notification-header-div">
                                                <h5 class="notification-title">
                                                    @if(isset($notification['data']['message']))
                                                        {{$notification['data']['message']}}
                                                    @endif
                                                </h5>
                                                <p class="notification-time"><i class="far fa-clock"></i>{{ Carbon\Carbon::parse($notification['created_at'])->diffForHumans()}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                    </div> 
                </div>
                <div class="col-12">
                   {{$readNotifications->links()}}
                </div>
                <div class="dashboard-copyright">
                    @include('frontend.pages.partials.search-master-footer')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
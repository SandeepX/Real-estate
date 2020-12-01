@extends('admin.layout.master')

@section('title','Notifications')

@section('content')
    <!-- Site Content -->
    <div class="dt-content">

        <!-- Grid breadcrumbs -->
        <div class="row dt-masonry">

            <!-- Grid Item -->
            <div class="col-md-12 dt-masonry__item">

                <!-- Breadcrumbs -->

                <ol class="mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="active breadcrumb-item"><a href="{{route('admin.notifications')}}">Notifications</a> </li>
                </ol>
                <!-- /breadcrumbs -->

            </div>
            <!-- /grid item -->

        </div>
        <!-- /grid breadcrumbs -->

        <!-- Page Header -->
        <div class="dt-page__header">
            <h1 class="dt-page__title"></h1>
        </div>
        <!-- /page header -->

    @include('partials.messages')

    <!-- Grid -->
        <div class="row dt-masonry">

            <!-- Grid Item ,form-->
            <div class="col-md-12 dt-masonry__item ">
                <!-- Card -->
                <div class="dt-card">

                    <!-- Card Header -->
                    <div class="dt-card__header">

                        <!-- Card Heading -->
                        <div class="dt-card__heading">
                            <h3 class="dt-card__title">All Notifications</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">


                        <!-- Grid Item -->
                        <div class="col-md-12">

                            <!-- Card -->
                            <div class="">

                                <!-- Card Body -->
                                <div class="dt-card__body p-0 max-h-400 ps-custom-scrollbar">
                                    <!-- Widget -->
                                    <div class="dt-widget dt-widget-hover">

                                    @foreach($unreadNotifications as $notification)
                                            <a href="{{isset($notification['data']['action']) ?$notification['data']['action'] : '' }}"
                                               data-id="{{route('admin.notifications.markAllRead.single',$notification['id'])}}" class="unread_notification d-block m-b-10">
                                                <!-- Widget Item -->
                                                <div class="dt-widget__item">

                                                    <!-- Widget Image -->
                                                    <div class="dt-widget__img">
                                                        <!-- Avatar -->

                                                        @if(isset($notification['data']['user']) && isset($notification['data']['user']['user_image']))
                                                            <img class="dt-avatar size-35" src="{{asset('common/images/'.$notification['data']['user']['user_image'])}}" alt="User">

                                                        @else
                                                            <img class="dt-avatar size-35" src="{{asset('common/images/default-user.png')}}" alt="User">
                                                    @endif
                                                    <!-- /avatar -->
                                                    </div>
                                                    <!-- /widget image -->

                                                    <!-- Widget Info -->
                                                    <div class="dt-widget__info text-truncate">
                                                        <!-- Media Body -->
                                                        <span class="media-body">
                                                    <span class="message">
                                                       @if(isset($notification['data']['user']))
                                                            <span class="user-name">{{$notification['data']['user']['name']}}</span>
                                                        @endif

                                                        @if(isset($notification['data']['message']))
                                                            {{$notification['data']['message']}}
                                                        @endif


                                                    </span>
                                                        <br>
                                                    <span class="meta-date"> {{ Carbon\Carbon::parse($notification['created_at'])->diffForHumans()}} </span>
                                                  </span>
                                                        <!-- /media body -->

                                                    </div>
                                                    <!-- /widget info -->


                                                </div>
                                                <!-- /widgets item -->

                                            </a>

                                    @endforeach

                                        @foreach($readNotifications as $notification)
                                            <a href="{{isset($notification['data']['action']) ?$notification['data']['action'] : '' }}"
                                               class="unread_notification">
                                                <!-- Widget Item -->
                                                <div class="dt-widget__item">

                                                    <!-- Widget Image -->
                                                    <div class="dt-widget__img">
                                                        <!-- Avatar -->

                                                        @if(isset($notification['data']['user']) && isset($notification['data']['user']['user_image']))
                                                            <img class="dt-avatar size-35" src="{{asset('common/images/'.$notification['data']['user']['user_image'])}}" alt="User">

                                                        @else
                                                            <img class="dt-avatar size-35" src="{{asset('common/images/default-user.png')}}" alt="User">
                                                    @endif
                                                    <!-- /avatar -->
                                                    </div>
                                                    <!-- /widget image -->

                                                    <!-- Widget Info -->
                                                    <div class="dt-widget__info text-truncate">
                                                        <!-- Media Body -->
                                                        <span class="media-body">
                                                    <span class="message">
                                                       @if(isset($notification['data']['user']))
                                                            <span class="user-name">{{$notification['data']['user']['name']}}</span>
                                                        @endif

                                                        @if(isset($notification['data']['message']))
                                                            {{$notification['data']['message']}}
                                                        @endif


                                                    </span>
                                                        <br>
                                                    <span class="meta-date"> {{ Carbon\Carbon::parse($notification['created_at'])->diffForHumans()}} </span>
                                                  </span>
                                                        <!-- /media body -->

                                                    </div>
                                                    <!-- /widget info -->


                                                </div>
                                                <!-- /widgets item -->

                                            </a>

                                        @endforeach


                                    </div>
                                    <!-- /widget -->

                                    {{$readNotifications->links()}}
                                </div>
                                <!-- /card body -->

                            </div>
                            <!-- /card -->

                        </div>
                        <!-- /grid item -->

                    </div>
                    <!-- /card body -->
                </div>
            </div>


        </div>

    </div>
@endsection




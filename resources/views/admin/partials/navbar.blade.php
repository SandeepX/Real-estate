<header class="dt-header">

    <!-- Header container -->
    <div class="dt-header__container">

        <!-- Brand -->
        <div class="dt-brand">

            <!-- Brand tool -->
            <div class="dt-brand__tool" data-toggle="main-sidebar">
                <div class="hamburger-inner"></div>
            </div>
            <!-- /brand tool -->

            <!-- Brand logo -->
            <span class="dt-brand__logo">
        <a class="dt-brand__logo-link" href="{{route('admin.dashboard')}}">
          <img class="dt-brand__logo-img d-none d-sm-inline-block" src="{{asset('common/images/'.$setting->site_logo)}}" alt="Drift">
          <img class="dt-brand__logo-symbol d-sm-none" src="{{asset('common/images/'.$setting->site_logo)}}" alt="Drift">
        </a>
      </span>
            <!-- /brand logo -->

        </div>
        <!-- /brand -->

        <!-- Header toolbar-->
        <div class="dt-header__toolbar">


            <!-- Header Menu Wrapper -->
            <div class="dt-nav-wrapper">


                <!-- Header Menu -->
                <ul class="dt-nav">
                    <li class="dt-nav__item dt-notification dropdown">

                        <!-- Dropdown Link -->
                        <a href="dashboard-real-estate.html#" class="dt-nav__link dropdown-toggle no-arrow" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false"> <i class="icon icon-notification2 icon-fw dt-icon-alert"></i>
                        </a>
                        <!-- /dropdown link -->

                        <!-- Dropdown Option -->
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                            <!-- Dropdown Menu Header -->
                            <div class="dropdown-menu-header">
                                <h4 class="title">Notifications ({{count($unReadNotifications)}})</h4>

                                <div class="ml-auto action-area">
                                    <a href="{{route('admin.notifications.markAllRead')}}">Mark All Read</a>
                                </div>
                            </div>
                            <!-- /dropdown menu header -->

                            <!-- Dropdown Menu Body -->
                            <div class="dropdown-menu-body ps-custom-scrollbar">

                                <div class="h-auto">

                                    @if($unReadNotifications)
                                        @foreach($unReadNotifications as $notification)
                                        <!-- Media -->
                                            <a href="{{isset($notification['data']['action']) ?$notification['data']['action'] : '' }}"
                                               data-id="{{route('admin.notifications.markAllRead.single',$notification['id'])}}" class="media unread_notification">


                                                @if(isset($notification['data']['user']) && isset($notification['data']['user']['user_image']))
                                                    <img class="dt-avatar mr-3" src="{{asset('common/images/'.$notification['data']['user']['user_image'])}}" alt="User">

                                                @else
                                                    <img class="dt-avatar mr-3" src="{{asset('common/images/default-user.png')}}" alt="User">
                                                @endif
                                                <!-- avatar -->

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
                                                    <span class="meta-date"> {{ Carbon\Carbon::parse($notification['created_at'])->diffForHumans()}} </span>
                                                  </span>
                                                <!-- /media body -->

                                            </a>
                                            <!-- /media -->
                                        @endforeach
                                    @endif

                                </div>

                            </div>
                            <!-- /dropdown menu body -->

                            <!-- Dropdown Menu Footer -->
                            <div class="dropdown-menu-footer">
                                <a href="{{route('admin.notifications')}}" class="card-link"> See All <i class="icon icon-arrow-right icon-fw"></i>
                                </a>
                            </div>
                            <!-- /dropdown menu footer -->
                        </div>
                        <!-- /dropdown option -->

                    </li>
                </ul>
                <!-- /header menu -->


                <!-- Header Menu -->
                <ul class="dt-nav">
                    <li class="dt-nav__item dropdown">

                        <!-- Dropdown Link -->
                        <a href="dashboard-real-estate.html#" class="dt-nav__link dropdown-toggle no-arrow dt-avatar-wrapper"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="dt-avatar size-30" src="{{asset('common/images/'.Auth::user()->user_image)}}" alt="{{auth()->user()->name}}">
                            <span class="dt-avatar-info d-none d-sm-block">
                <span class="dt-avatar-name">{{auth()->user()->name}}</span>
              </span> </a>
                        <!-- /dropdown link -->

                        <!-- Dropdown Option -->
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dt-avatar-wrapper flex-nowrap p-6 mt-n2 bg-gradient-purple text-white rounded-top">
                                <img class="dt-avatar" src="{{asset('common/images/'.Auth::user()->user_image)}}" alt="{{auth()->user()->name}}">
                                <span class="dt-avatar-info">
                  <span class="dt-avatar-name">{{auth()->user()->name}}</span>
                  <span class="f-12">Administrator</span>
                </span>
                            </div>
                            <a class="dropdown-item" href="{{route('admin.editProfile')}}"> <i class="icon icon-user icon-fw mr-2 mr-sm-1"></i>Account
                            </a>
                            <a class="dropdown-item" href="{{route('admin.changePassword')}}"> <i class="icon icon-user icon-fw mr-2 mr-sm-1"></i>Change Password
                            </a>
                            <a class="dropdown-item" href="{{route('admin.siteSetting')}}">
                                <i class="icon icon-settings icon-fw mr-2 mr-sm-1"></i>Setting </a>

                            @auth

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();"> <i class="icon icon-editors icon-fw mr-2 mr-sm-1"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            @endauth
                        </div>
                        <!-- /dropdown option -->

                    </li>
                </ul>
                <!-- /header menu -->
            </div>
            <!-- Header Menu Wrapper -->

        </div>
        <!-- /header toolbar -->

    </div>
    <!-- /header container -->

</header>
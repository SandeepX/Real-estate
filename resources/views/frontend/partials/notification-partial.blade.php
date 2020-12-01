<li class="notification-bell">
    <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                data-id="{{route('user.notifications.markAllRead')}}" aria-haspopup="true" aria-expanded="false">
            <i class="far fa-bell"></i><span class="badge badge-light notification-bell-span">{{count($unReadNotifications) > 0 ? count($unReadNotifications) : ''}}</span>
        </button>

            @if($unReadNotifications)
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <div class="mark-read-div">
                    <a href="{{route('user.notifications.markAllRead')}}" class="mark-read-notification">Mark all read</a>
                </div>

                <div class="notification-a-wrapper">


                    @foreach($unReadNotifications as $notification)
                        <a class="dropdown-item unread_notification" href="{{isset($notification['data']['action']) ?$notification['data']['action'] : '' }}"
                           data-id="{{route('user.notifications.markAllRead.single',$notification['id'])}}">
                            <div class="row">
                                <div class="col-lg-3">
                                    <figure class="notification-header-figure">

                                        @if(isset($notification['data']['image']))

                                            <img src="{{asset('common/images/'.$notification['data']['image'])}}" class="img-fluid" alt="{{$notification['data']['image']}}">

                                        @else
                                            <img src="{{asset('common/images/default-user.png')}}" class="img-fluid" alt="image">
                                        @endif

                                    </figure>
                                </div>
                                <div class="col-lg-9">
                                    <div class="notification-header-div">
                                        <h5 class="notification-title">
                                            @if(isset($notification['data']['message']))
                                                {{$notification['data']['message']}}
                                            @endif
                                        </h5>
                                        <p class="notification-time"><i class="far fa-clock"></i> {{ Carbon\Carbon::parse($notification['created_at'])->diffForHumans()}}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="see-all-notification-div">

                    <a href="{{route('user.notifications')}}" class="see-all-notification">
                        see all notification
                    </a>

                </div>
            </div>

            @else
            <div class="dropdown-menu noNotifications" aria-labelledby="dropdownMenuButton">
                <p class="no-notification-p">No Notifications</p>
            </div>
            @endif


    </div>
</li>
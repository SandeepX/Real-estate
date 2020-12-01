<div class="col-lg-2 p-l-r-0">
    <div class="user-dashboard-left">
        <figure>
            <img src="{{asset('frontend/img/user-dashboard-left.jpg')}}" class="img-fluid" alt="">
        </figure>
        <div class="navbar-profile">
            @php( $user = \Illuminate\Support\Facades\Auth::user())

            <figure>

                @if(Auth::user()->user_image)
                    <img src="{{asset('common/images/'.Auth::user()->user_image)}}" alt="" class="img-fluid">

                @elseif(Auth::user()->provider_image)
                    <img src="{{asset('common/images/'.Auth::user()->provider_image)}}" alt="" class="img-fluid">
                @else
                    <img src="{{asset('common/images/default-user.png')}}" alt="" class="img-fluid">
                @endif

            </figure>
            <h4>{{$user->name}}</h4>
            <p>User</p>
        </div>
        <div class="navbar-info">
            <ul>
                <li class="{{request()->routeIs('user.profile')? "active" : ""}}"><a href="{{route('user.profile')}}"><i class="far fa-user"></i>My Profile</a></li>
                <li class="{{request()->routeIs('user.property.create')? "active" : ""}}"><a href="{{route('user.property.create')}}"><i class="far fa-plus-square"></i>Post Properties</a></li>
                <li class="{{request()->routeIs('user.property.index')? "active" : ""}}"><a href="{{route('user.property.index')}}"><i class="far fa-building"></i>My Properties</a></li>
                <li class="{{request()->routeIs('user.property.manager.index')? "active" : ""}}"><a href="{{route('user.property.manager.index')}}"><i class="far fa-building"></i>My Managers</a></li>
                @role('Manager')
                    <li class="{{request()->routeIs('manager.property.index')? "active" : ""}}"><a href="{{route('manager.property.index')}}"><i class="far fa-building"></i>My Managed Property</a></li>
                @endrole
                <li class="{{request()->routeIs('user.notifications')? "active" : ""}}"><a href="{{route('user.notifications')}}"><i class="far fa-heart"></i>Notifications</a></li>
                <li class="{{request()->routeIs('fe.user.property.favourites')? "active" : ""}}"><a href="{{route('fe.user.property.favourites')}}"><i class="far fa-heart"></i>Favourite Property</a></li>

                @auth
                    <li><a href="{{ route('fe.logout')}}"  onclick="event.preventDefault();
                       document.getElementById('logout-form1').submit();">
                            <i class="fas fa-sign-out-alt"></i>Logout</a>
                    </li>

                    <form id="logout-form1" action="{{ route('fe.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                @endauth
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

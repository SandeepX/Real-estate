<section class="section-header-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="header-contact">
                    <a href="{{route('fe.faq')}}" target="_blank">FAQ</a>
                    <a href="{{route('fe.conditions')}}" target="_blank">Terms & Condition</a>
                    <a href="{{route('fe.policy')}}" target="_blank">privacy Policy</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="top-header-right">
                    <span class="header-social-link">
                        <a target="_blank" href="https://www.twitter.com/" class="btn btn-neutral btn-icon btn-twitter btn-round btn-lg" data-original-title="Follow us" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a target="_blank" href="https://www.facebook.com/" class="btn btn-neutral btn-icon btn-facebook btn-round btn-lg" data-original-title="Like us" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a target="_blank" href="https://www.linkedin.com/company-beta/9430489/" class="btn btn-neutral btn-icon btn-linkedin btn-lg btn-round" data-original-title="Follow us" title="Linkedin">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </span>
                    <a href="javascript:void(0)"><img src="{{asset('frontend/img/nepal-flag.png')}}" title="Nepali Language" class="img-fluid" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</section>
<nav class="navbar navbar-expand-md stroke header-nav">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <a class="logo-img-a" href="{{route('fe.home')}}">
                    <img src="{{asset('common/images/'.$setting->site_logo)}}" alt="Logo" class="img-fluid">
                </a>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="col-lg-12">
                    <form id="nav_search_form" class="navbar-form" role="search" method="get" action="{{route('fe.nav.search')}}">
                        <div class="input-group search-input-grp">
                            <div class="col-lg-3 col-md-3 col-sm-3 p-l-r-0">
                                <div class="form-group top-search-edit">
                                    <select name="municipal" class="custom-select city-search-header js-example-basic-single" id="inputGroupSelect01">
                                        <option value="" selected>Top Cities</option>
                                        @foreach($municipals as $municipal)
                                        <option value="{{$municipal->id}}">{{$municipal->municipal_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 p-l-r-0 search-responsive">
                                <div class="form-group">
                                    <input type="text"  name="search" class="form-control header-search" placeholder="Search Your Property here" >
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 p-l-r-0 search-responsive-btn">
                                <div class="input-group-append">
                                    <button class="btn header-search-btn" id="nav_search_btn" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-12">
                    <a class="responsive-menu-logo" href="{{route('fe.home')}}">
                        <img src="{{asset('common/images/'.$setting->site_logo)}}" alt="Logo" class="img-fluid">
                    </a>
                    <button class="navbar-toggler nav-btn-res" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fas fa-bars"></i>
                    </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav header-navigation">
                            <li class="nav-item ">
                                <a class="nav-link {{Request::is('/')? "active" : ""}}" href="{{route('fe.home')}}">
                                    HOME <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{request()->routeIs('fe.about')? "active" : ""}}" href="{{route('fe.about')}}">ABOUT US</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{request()->routeIs('fe.properties')? "active" : ""}}" href="{{route('fe.properties')}}">PROPERTY</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{request()->routeIs('fe.blogs')? "active" : ""}}" href="{{route('fe.blogs')}}">BLOG</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{request()->routeIs('fe.contact')? "active" : ""}}" href="{{route('fe.contact')}}">CONTACT</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category <i class="fas fa-chevron-down"></i></a>
                                <ul class="dropdown-menu">
                                    @foreach($sitePropertyStatuses as $status)
                                    <li><a class="dropdown-item" href="{{route('fe.status.properties',$status->slug)}}">{{$status->title}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3">
                <div class="user-responsive-ul">
                    <ul>
                        <li class="nav-item dropdown user-right-a">
                            <a class="user-icon-a nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <figure>
                                    @auth
                                    @if(Auth::user()->user_image)
                                    <img src="{{asset('common/images/'.Auth::user()->user_image)}}" alt="" class="img-fluid">
                                    @elseif(Auth::user()->provider_image)
                                    <img src="{{asset('common/images/'.Auth::user()->provider_image)}}" alt="" class="img-fluid">
                                    @else
                                    <img src="{{asset('common/images/default-user.png')}}" alt="" class="img-fluid">
                                    @endif
                                    @else
                                    <img src="{{asset('frontend/img/user-icon.png')}}" alt="" class="img-fluid">
                                    @endauth
                                </figure>
                            </a>
                            <div class="dropdown-menu p-t-0" aria-labelledby="navbarDropdown">
                                @auth
                                <a class="dropdown-item" href="{{route('user.profile')}}"><i class="fas fa-list-ul"></i>Profile</a>
                                <a class="dropdown-item" href="{{route('fe.user.property.favourites')}}"><i class="far fa-heart"></i>Favourites</a>
                                <a  class="dropdown-item b-t-0" href="{{ route('fe.logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('fe.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                @else
                                <a class="dropdown-item b-t-0" href="{{route('fe.getLoginForm')}}"><i class="far fa-user"></i>LOGIN</a>
                                <a class="dropdown-item" href="{{route('fe.getRegisterForm')}}"><i class="fas fa-list-ul"></i>REGISTER</a>
                                @endauth
                            </div>
                        </li>

                        @auth

                          @include('frontend.partials.notification-partial')

                        @endauth
                        
                        <li class="user-right-btn">
                            <a href="{{route('user.property.create')}}" class="btn btn-post-prop" >Post Property</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
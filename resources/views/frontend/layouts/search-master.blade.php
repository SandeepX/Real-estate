<!doctype html>
<html class="no-js" lang="">

<head>
    @include('frontend.partials.head')
</head>

<body>
{{--<div id="preloader">
    <img class="loader-img" src="{{asset('frontend/img/pin-1.png')}}" alt="">
    <div id="loader">
    </div>
</div>--}}

<header id="topheader" class="fixed-header">

    <!--mobile-app-->
    @include('frontend.partials.mobile-app-header')
    <!--/mobile-app-->
    @include('frontend.partials.header')
</header>

<!-- Site Content -->
@yield('content')
<!-- /site content -->


{{--footer--}}
{{--no footer}}

{{--scripts--}}
@include('frontend.partials.search-scripts')

{{--contains select2 js and search script--}}
@include('frontend.partials.header-search-scripts')

{{--contains noitification script--}}
@include('frontend.partials.notification-script')

{{--gallery scripts--}}
<script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
<script>
    // Magnify activation
    $('.property-magnify-gallery').each(function() {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery:{enabled:true}


        });
    });
</script>


@stack('scripts')

</body>
</html>

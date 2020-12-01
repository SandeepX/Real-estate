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

<div class="modal fade" id="phnhover" tabindex="-1" role="dialog" aria-labelledby="phnhover" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"> 
            <form id="phone_form" action="{{route('user.updateContact')}}" method="post">
            <div class="modal-body">

                @if( session('phone') == 'phone')
                    @include('partials.messages')
                @endif
                    {{ csrf_field()}}
                    <p class="add-phn-load">Add your phone number</p>
                    <div class="form-group">
                        <!-- <label for="">Phone Number: </label> -->
                        <input type="text" name="phone" value="{{old('phone')}}" class="form-control add-phn-input" placeholder="Phone Number">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-load-number">Save Number</button>
            </div>
            </form>
        </div>
    </div>
</div>


<header id="topheader">
    <!--mobile-app-->
    @include('frontend.partials.mobile-app-header')
    <!--/mobile-app-->

    @include('frontend.partials.header')
</header>

<!-- Site Content -->
@yield('content')
<!-- /site content -->


{{--footer--}}
@include('frontend.partials.footer')

{{--scripts--}}
@include('frontend.partials.scripts')

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

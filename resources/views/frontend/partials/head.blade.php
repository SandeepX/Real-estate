<meta charset="utf-8">

<title>@yield('title') | {{$setting->site_title}}</title>
<meta property="og:url"   content="{{Request::url()}}" />
<meta property="og:type"   content="website" />
<meta property="og:title"  content="@yield('title') "/>
<meta property="og:description"  content="@yield('og-des')" />
<meta property="og:image"    content="@yield('og-image')" />

<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">


<meta name="csrf-token" content="{{ csrf_token() }}">


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-147742282-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-147742282-1');
</script>

<link rel="apple-touch-icon" href="{{$setting->site_favicon}}">
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('frontend/css/jquery-ui.css')}}">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/all.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/normalize.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/flaticons.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/lightcase.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/star-rating.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/ionskin.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/range.css')}}">
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<link rel="stylesheet" href="{{asset('frontend/css/main.css')}}">


<!-- multiple select CSS -->
<link rel="stylesheet" href="{{ asset('backend/assets/css/custom/select2.min.css') }}" >

<!-- Summernote CSS -->
<link href="{{asset('backend/node_modules/summernote/dist/summernote-bs4.css')}}" rel="stylesheet">

<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}">


<!-- Meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Drift - A fully responsive, HTML5 based admin template">
<meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, jQuery, web design, CSS3, sass">

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- /meta tags -->

<title> @yield('title')</title>

<!-- Site favicon -->
<link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}" type="image/x-icon">
<!-- /site favicon -->

<!-- Font Icon Styles -->
<link rel="stylesheet" href="{{asset('backend/node_modules/flag-icon-css/css/flag-icon.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/vendors/gaxon-icon/styles.css')}}">
<!-- /font icon Styles -->

<!-- Perfect Scrollbar stylesheet -->
<link rel="stylesheet" href="{{asset('backend/node_modules/perfect-scrollbar/css/perfect-scrollbar.css')}}">
<!-- /perfect scrollbar stylesheet -->

<!-- Load Styles -->
<link rel="stylesheet" href="{{asset('backend/assets/css/semidark-style-1.min.css')}}">
<!-- /load styles -->

<!-- multiple select CSS -->
<link rel="stylesheet" href="{{ asset('backend/assets/css/custom/select2.min.css') }}" >

<!-- Summernote CSS -->
<link href="{{asset('backend/node_modules/summernote/dist/summernote-bs4.css')}}" rel="stylesheet">

<!--custom css-->
<link href="{{asset('backend/assets/css/custom/custom.css')}}" rel="stylesheet">

<!--font-awesome-->
<link href="{{asset('common/css/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">

<!-- Load Styles -->    <!-- Data table stylesheet -->
<link href="{{asset('backend/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">

<link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet">
<!-- /data table stylesheet -->


<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet">
<!--drag and drop-->{{--
<link rel="stylesheet" href="{{asset('backend/node_modules/dropzone/dist/min/dropzone.min.css')}}">--}}

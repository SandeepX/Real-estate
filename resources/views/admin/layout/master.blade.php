<!DOCTYPE html>
<html lang="en">
<head>

    @include('admin.partials.head')

</head>
<body class="dt-sidebar--fixed dt-header--fixed">

<!-- Loader -->
<div class="dt-loader-container">
    <div class="dt-loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
    </div>
</div>
<!-- /loader -->
<!-- Root -->
<div class="dt-root">
    <div class="dt-root__inner">

        <!-- Header -->
        @include('admin.partials.navbar')
        <!-- /header -->

        <!-- Site Main -->
        <main class="dt-main">

            <!-- Sidebar -->
           @include('admin.partials.sidebar')
            <!-- /sidebar -->

            <!-- Site Content Wrapper -->
            <div class="dt-content-wrapper">

                <!-- Site Content -->
                @yield('content')
                <!-- /site content -->

                <!-- Footer -->
                @include('admin.partials.footer')

                <!-- /footer -->
            </div>
            <!-- /site content wrapper -->

            <!-- Theme Chooser -->

            <!-- /theme chooser -->

            <!-- Customizer Sidebar -->

            <!-- /customizer sidebar -->
        </main>
    </div>
</div>
<!-- /root -->

<!--scripts-->
@include('admin.partials.scripts')

@stack('scripts')

</body>
</html>


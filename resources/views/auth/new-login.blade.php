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
        <!-- Login Container -->
        <div class="dt-login--container">

            <!-- Login Content -->
            <div class="dt-login__content-wrapper">



                <!-- Login Background Section -->
                <div class="dt-login__bg-section">

                    <div class="dt-login__bg-content">
                        <!-- Login Title -->
                        <h1 class="dt-login__title">Login</h1>
                        <!-- /login title -->

                        <p class="f-16">Sign in and explore in-built apps of Drift.</p>
                    </div>



                    <!-- Brand logo -->
                    <div class="dt-login__logo">
                        <a class="dt-brand__logo-link" href="index.html">
                            <img class="dt-brand__logo-img" src="{{asset('backend/assets/images/logo-white.png')}}" alt="Drift">
                        </a>
                    </div>
                    <!-- /brand logo -->

                </div>
                <!-- /login background section -->

                <!-- Login Content Section -->
                <div class="dt-login__content">

                    <!-- Login Content Inner -->
                    <div class="dt-login__content-inner">

                    @include('partials.messages')
                        <!-- Form -->
                        <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Form Group -->
                            <div class="form-group">
                                <label class="sr-only" for="email-1">Email address</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email-1" aria-describedby="email-1"
                                       placeholder="Enter email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label class="sr-only" for="password-1">Password</label>
                                <input type="password" name="password" class="form-control" id="password-1" placeholder="Password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="dt-checkbox d-block mb-6">
                                <input type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="dt-checkbox-content" for="remember">
                                    Keep me login on this device
                                </label>
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary text-uppercase">Login</button>

                            </div>
                            <!-- /form group -->



                        </form>
                        <!-- /form -->

                    </div>
                    <!-- /login content inner -->

                    <!-- Login Content Footer -->
                    <div class="dt-login__content-footer">

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif

                    </div>
                    <!-- /login content footer -->

                </div>
                <!-- /login content section -->

            </div>
            <!-- /login content -->

        </div>
        <!-- /login container -->
    </div>
</div>
<!-- /root -->

<!--scripts-->
@include('admin.partials.scripts')

@stack('scripts')

</body>
</html>
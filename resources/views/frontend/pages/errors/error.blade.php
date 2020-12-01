@extends('frontend.layouts.master')
@section('title','About Us')
@section('content')
<section class="error-page-section">
	<div class="container">
		<div class="row">
			<div class="col-6 align-self-center">
				<div class="error-page-wrapper">
					<div class="error-icon-i">
						<i class="far fa-frown"></i>
					</div>	  
					<div class="error-code">
						<strong>404</strong>
					</div>
					<div class="error-message">
						<h3>Oops... Page Not Found!</h3>
					</div>
					<div class="error-body">
						<p>
							Try using the button below to go to main page of the site
						</p> 
						<a href="index.html" class="btn btn-primary error-btn-home"><i class="fas fa-home"></i> Go to Home Page</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6 text-right">
				<img class="img-fluid" src="{{asset('frontend/img/404.png')}}" alt="">
			</div>
		</div>
	</div>
</section>
<!--section-subscribe-->
@include('frontend.pages.home.sections.section-subscribe')
<!--/section-subscribe-->
<!--section-7-->
@include('frontend.pages.home.sections.section-clients')
<!--/section-7-->
@endsection
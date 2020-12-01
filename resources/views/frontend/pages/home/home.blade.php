@extends('frontend.layouts.master')
@section('title','Home')

@section('og-des',str_limit(strip_tags($setting->description),100))
@section('og-image',asset('frontend/img/real-state-logo.png'))
@section('content')


    <!--banner-slider-->
    @include('frontend.pages.home.sections.slider')
    <!--/banner-slider-->

    <!--section-featured-->
    @include('frontend.pages.home.sections.section-featured')
    <!--/section-featured-->

    <!--section-services-->
    @include('frontend.pages.home.sections.section-services')
    <!--/section-services-->

    <!--section-newproperties-->
    @include('frontend.pages.home.sections.section-newproperties')
    <!--/section-newproperties-->

    <!--section-midbanner-->
    @include('frontend.pages.home.sections.section-midbanner')
    <!--/section-midbanner-->

    <!--section-trending-->
    @include('frontend.pages.home.sections.section-trending')
    <!--/section-trending-->

    <!--section-subscribe-->
    @include('frontend.pages.home.sections.section-subscribe')
    <!--/section-subscribe-->

    <!--section-blogs-->
    @include('frontend.pages.home.sections.section-blogs')
    <!--/section-blogs-->

    <!--section-7-->
    @include('frontend.pages.home.sections.section-clients')
    <!--/section-7-->



@endsection

@push('scripts')

    @include('frontend.pages.home.home-scripts')

   @include('frontend.partials.map')

   <script src="{{asset('common/js/mapMarkerCluster.js')}}"></script>
    {{--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrPMYf0pq2cXXte1SxJOdMJR8F9dMxKdg&callback=initMap"></script>--}}
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrPMYf0pq2cXXte1SxJOdMJR8F9dMxKdg&libraries=places&callback=initMap"
           async defer></script>
@endpush



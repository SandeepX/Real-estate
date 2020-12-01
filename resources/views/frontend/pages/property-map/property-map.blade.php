@extends('frontend.layouts.master')
@section('title','Map View')
@section('content')

 

<section class="banner-map">
    <button id="know" class="btn btn-primary map-location-btn">
        <img src="{{asset('frontend/img/map-location.png')}}" alt="" class="img-fluid" title="Locate">
    </button>
    <div class="google-map-div-index">
        <input id="pac-input" class="form-control controls search-map-box google-search-input" type="text" placeholder="Search Address">
        <a href="#" class="search-loca-a"><i class="fas fa-search-location"></i></a>
    </div> 
    <div id="mapCanvas" class="map-div" data-dismiss="alert" aria-label="Close"></div>
    <!-- <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="mapCanvas" class="map-div"></div> -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="map-navigation-positioning">
                    <div class="map-navigation-wrapper">
                        <form method="get" action="{{route('fe.search')}}" class="clear">

                            <div class="form-group">
                                <label>Location</label>
                                <div class="select-wrapper">

                                    <select name="municipal" id="select-location" class="form-control js-example-basic-single">
                                        <option value="" selected disabled>Choose...</option>

                                        @foreach($municipals as $municipal)
                                            <option value="{{$municipal->id}}">{{$municipal->municipal_name}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Property Type</label>
                                <div class="select-wrapper">
                                    <select class="form-control js-example-basic-single" name="property_type">
                                        <option value="" selected disabled>Choose...</option>

                                        @foreach($propertyTypes as $propertyType)
                                            <option value="{{$propertyType->id}}">{{$propertyType->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="amount">Price range:</label>
                                <input type="text" class="form-control header-map-amt" id="amount" name="price">
                                <input type="text" class="form-control" id="min_price" name="min_price" hidden>
                                <input type="text" class="form-control" id="max_price" name="max_price" hidden>
                                <div id="slider-range"></div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn map-filter-search-btn btn-block" value="Search">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
   

    

@endsection

@push('scripts')

   @include('frontend.partials.map')

   <script src="{{asset('common/js/mapMarkerCluster.js')}}"></script>
    {{--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrPMYf0pq2cXXte1SxJOdMJR8F9dMxKdg&callback=initMap"></script>--}}
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrPMYf0pq2cXXte1SxJOdMJR8F9dMxKdg&libraries=places&callback=initMap"
           async defer></script>
@endpush
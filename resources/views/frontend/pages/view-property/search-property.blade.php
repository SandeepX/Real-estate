@extends('frontend.layouts.search-master')
@section('title','Search Property')
@section('content')
    <section class="search-map-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row search-property-div">
                        @forelse($feProperties as $property)
                            <div class="col-lg-6">
                                <div class="property-box-trend">
                                    <div class="property-photo ">
                                        @if($property->featured_image)
                                            <img class="img-fluid" src="{{asset('common/images/medium/'.$property->featured_image)}}" alt="{{$property->title}}">
                                        @else
                                            <img class="img-fluid" src="{{asset('common/images/no-photo.png')}}" alt="{{$property->title}}">
                                        @endif

                                        <div class="property-overlay">
                                            <a href="{{route('fe.singleProperty',$property->slug)}}" class="overlay-link">
                                                <i class="fas fa-link"></i>
                                            </a>

                                            @if($property->information && $property->information->yt_url)
                                                <a href="https://www.youtube.com/embed/{{$property->information->yt_url}}" class="overlay-link" data-rel="lightcase">
                                                    <i class="far fa-play-circle"></i>
                                                </a>
                                            @endif

                                            <div class="property-magnify-gallery">

                                                @if($property->featured_image)
                                                    <a href="{{asset('common/images/'.$property->featured_image)}}" class="overlay-link">
                                                        <i class="far fa-images"></i>
                                                    </a>
                                                @endif

                                                @foreach($property->images as $image)
                                                    <a href="{{asset('common/images/'.$image->image)}}" class="hidden"></a>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    <div class="on-sale list-prop-sale">
                                        <p>
                                            {{$property->property_status_id ? $property->saleStatus->title : ''}}
                                        </p>
                                    </div>

                                    <div class="feartured-prop-cat list-prop-feature">
                                        <a href="{{route('fe.cat.properties',$property->property_category_id?$property->category->slug : 'Undefined')}}" class="color-green"> {{$property->property_category_id ? $property->category->name : ''}}</a>
                                        <a href="{{route('fe.subcat.properties',$property->property_subcategory_id?$property->subCategory->slug : 'Undefined')}}" class="color-blue"> {{$property->property_subcategory_id ? $property->subCategory->name : ''}}</a>
                                    </div>
                                    <div class="property-price list-prop-price">
                                        <span>Rs.</span> {{$property->price}}
                                    </div>
                                    <div class="detail">
                                        <div class="heading">
                                            <h3>
                                                <a href="{{route('fe.singleProperty',$property->slug)}}">{{$property->title}}</a>
                                            </h3>
                                            <div class="location">
                                                <i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i>
                                                {{$property->address ? $property->address->address : ''}}
                                            </div>
                                        </div>


                                        <div class="featured-prop-icon index-property-feature">
                                            <p class="featured-bed-p">
                                                <img src="{{asset('frontend/img/bed-icon.png')}}" class="img-fluid" alt="">
                                                <span>: {{$property->bedrooms}}</span>
                                            </p>
                                            <p class="featured-bath-p">
                                                <img src="{{asset('frontend/img/shower-icon.png')}}" class="img-fluid" alt="">
                                                <span>: {{$property->bathrooms}}</span>
                                            </p>
                                            <p class="featured-sqft-p">
                                                <img src="{{asset('frontend/img/square-ft.png')}}" class="img-fluid" alt="">
                                                <span>: {{$property->area_size}} {{$property->area_size_postfix}}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-lg-6">
                               <h3>"Result Not Found"</h3>
                            </div>
                        @endforelse

                    </div>
                </div>
                <div class="col-lg-6 p-l-0">
                    <div class="search-map-pos"> 
                        <div class="google-map-div-index">
                            <input id="pac-input" class="form-control controls search-map-box google-search-input" type="text" placeholder="Search Address">
                            <a href="#" class="search-loca-a"><i class="fas fa-search-location"></i></a>
                        </div>
                        <div id="mapCanvas" class="search-map-prop"></div>
                         <button id="know" class="btn btn-primary map-location-btn-search">
                            <img src="{{asset('frontend/img/map-location.png')}}" alt="" class="img-fluid" title="Locate">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    @include('frontend.pages.view-property.search-property-scripts')

    <script src="{{asset('common/js/mapMarkerCluster.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrPMYf0pq2cXXte1SxJOdMJR8F9dMxKdg&libraries=places&callback=initMap"
            async defer></script>

@endpush
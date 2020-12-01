@extends('frontend.layouts.master')
@section('title',$property->title)
@section('og-des',str_limit(strip_tags($property->description),100))
@section('og-image',asset('common/images/'.$property->featured_image))
@section('content')

    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <h2>{{$property->title}}</h2>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <ul class="breadcrumb-ul">
                        <li><a href="{{route('fe.home')}}">Home</a></li>
                        <li><i class="fas fa-chevron-right"></i></li>
                        <li class="active">{{$property->title}}</li>
                    </ul>
                </div>
            </div>
        </div> 
    </section>

    <section class="index-property bg-grey">
        <div class="container">
            <div class="row">

                <div class="col-lg-8">

                    <div id="partial_message">
                        @if( session('request') == 'request')
                            @include('partials.messages')
                        @endif
                    </div>

                    <div class="heading-single-properties clear">
                        <div class="heading-single-properties-left">
                            <h3>{{$property->title}}</h3>
                            <p>
                                <i class="fas fa-map-marker-alt"></i>
                                {{$property->address ? $property->address->address : ''}}
                            </p>
                        </div>
                        <div class="heading-single-properties-right">
                            <h3><span>RS.{{number_format($property->price)}}</span></h3>
                            <h5>
                                {{$property->price_postfix}}
                            </h5>
                        </div>
                    </div>
                    <div class="Properties-details-section clear">
                        <div class="properties-detail-slider">
                            @auth
                                <div class="property-detail-fav">
                                    <a href="{{route('fe.user.property.markFavourite',$property->slug)}}" class="{{$fav ? 'active' :''}}" id="fav_btn">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </div>
                            @endauth

                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">

                                    @forelse($propertyGallery as $gallery)
                                        <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                                            <img class="d-block w-100 img-fluid" src="{{asset('common/images/'.$gallery->image)}}" alt="{{$property->title}}">
                                        </div>
                                    @empty
                                        <div class="carousel-item active">
                                            <img class="d-block w-100 img-fluid" src="{{asset('common/images/'.$property->featured_image)}}" alt="{{$property->title}}">
                                        </div>
                                    @endforelse

                                </div>
                                <ol class="carousel-indicators list-prop-slider-ol">

                                    @forelse($propertyGallery as $gallery)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class="{{$loop->first ? 'active' : ''}}">
                                            <img src="{{asset('common/images/'.$gallery->image)}}" alt="">
                                        </li>
                                    @empty

                                    @endforelse
                                </ol>
                            </div>
                        </div>
                        <div class="single-Property-description">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="desc-single-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="single-facility-tab" data-toggle="tab" href="#facility" role="tab" aria-controls="facility" aria-selected="false">Facilities</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="single-floor-tab" data-toggle="tab" href="#floor" role="tab" aria-controls="floor" aria-selected="false">Floor Plan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="single-location-tab" data-toggle="tab" href="#location" role="tab" aria-controls="location" aria-selected="false">Location</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="single-video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="Video" aria-selected="false">Video</a>
                                </li>

                                @if(!is_null($propertyUser))
                                    <li class="nav-item">
                                        <a class="nav-link" id="information-tab" data-toggle="tab" href="#information" role="tab" aria-controls="information" aria-selected="false">Information</a>
                                    </li>
                                @endif
                            </ul>
                            <div class="tab-content single-prop-tab-desc" id="myTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="desc-single-tab">
                                    {!! $property->description !!}
                                </div>
                                <div class="tab-pane fade" id="facility" role="tabpanel" aria-labelledby="single-facility-tab">
                                    <div class="row">

                                        @forelse($singlePropertyFeatures as $feature)
                                            <div class="col-lg-4">
                                                <div class="facility-icon-div">
                                                    <i class="far fa-check-square"></i>
                                                    {{$feature->title}}
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse

                                        @if(!empty($additionalFeatures))
                                            @foreach($additionalFeatures as $feature)
                                                <div class="col-lg-4">
                                                    <div class="facility-icon-div">
                                                        <i class="far fa-check-square"></i>
                                                        {{$feature}}
                                                    </div>
                                                </div>

                                            @endforeach
                                            @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="floor" role="tabpanel" aria-labelledby="single-floor-tab">
                                    @if(!empty($additionalFeatures))
                                        @foreach($floors as $floor)

                                            <div class="floor-plan">
                                                <h6>{{$floor->floor_title}}</h6>
                                                <div class="floor-plan-desc">
                                                    <table class="floor-table" class="table-responsive">
                                                        <tbody>
                                                        <tr>
                                                            <td><strong>Size ({{$floor->floor_area_size_postfix}})</strong></td>
                                                            <td><strong>Rooms</strong></td>
                                                            <td><strong>Bathrooms</strong></td>
                                                            <td><strong>Price</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{$floor->floor_area_size}}</td>
                                                            <td>{{$floor->floor_bedrooms}}</td>
                                                            <td>{{$floor->floor_bathrooms}}</td>
                                                            <td>{{$floor->floor_price}} {{$floor->floor_price_postfix}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                @if($floor->floor_image)
                                                    <figure>
                                                        <img src="{{asset('common/images/'.$floor->floor_image)}}" alt="floor-plans" class="img-fluid">
                                                    </figure>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                                <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="single-location-tab">
                                    <div class="location-map-frame">
                                      {{--  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.0227822892152!2d85.33243421438408!3d27.685690733051636!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19e21b62dc9b%3A0x90b4ce7f6bd8a20b!2sHeaven+Maker+Group%2C+kathmandu+Office!5e0!3m2!1sen!2snp!4v1563252245796!5m2!1sen!2snp" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen>
                                        </iframe>--}}
                                        <div id="map-location"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="single-video-tab">
                                    @if($propertyInformation  && $propertyInformation->yt_url)
                                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$propertyInformation->yt_url}}?rel=0&modestbranding=1" frameborder="0" allowfullscreen></iframe>
                                    @endif
                                </div>

                                @if(!is_null($propertyUser))
                                    <div class="tab-pane fade" id="information" role="tabpanel" aria-labelledby="information-tab">
                                        <div class="owner-info-detail">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Owner Info</th>
                                                @if(!is_null($propertyManager) && $propertyInformation->isApprovedManager ==1)
                                                    <th>Manager Info</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="owner-info-detail-item">
                                                        <label for="">Owner Name:</label>
                                                        <p>{{$propertyInformation->owner_name}}</p>
                                                    </div>
                                                    <div class="owner-info-detail-item">
                                                        <label for="">Posted By:</label>
                                                        <p>{{$propertyUser->name}}</p>
                                                    </div>
                                                    <div class="owner-info-detail-item">
                                                        <label for="">Contact Number:</label>
                                                        <p>{{$propertyUser->phone}}</p>
                                                    </div>
                                                    <div class="owner-info-detail-item">
                                                        <label for="">Address:</label>
                                                        <p>{{$propertyUser->address}}</p>
                                                    </div>
                                                    <div class="owner-info-detail-item">
                                                        <label for="">Email:</label>
                                                        <p>{{$propertyUser->email}}</p>
                                                    </div>
                                                        <div class="owner-info-detail-item">
                                                            <div class="alternative-contact-div">
                                                                <p class="alternative-contact-p">Alternative Contact:</p>
                                                            </div>

                                                            <table class="table table-bordered alternative-contact">
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Contact</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{isset($propertyInformation->ref_owner_name_1)? $propertyInformation->ref_owner_name_1 : ''}}
                                                                    </td>
                                                                    <td>
                                                                        {{isset($propertyInformation->ref_owner_phone_1)? $propertyInformation->ref_owner_phone_1 : ''}}
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        {{isset($propertyInformation->ref_owner_name_2)? $propertyInformation->ref_owner_name_2 : ''}}
                                                                    </td>
                                                                    <td>
                                                                        {{isset($propertyInformation->ref_owner_phone_2)? $propertyInformation->ref_owner_phone_2 : ''}}
                                                                    </td>
                                                                </tr>
                                                            </table>


                                                        </div>

                                                </td>
                                                @if(!is_null($propertyManager) && $propertyInformation->isApprovedManager ==1)
                                                    <td>
                                                    <div class="owner-info-detail-item">
                                                        <label for="">Manager Name:</label>
                                                        <p>{{$propertyManager->name}}</p>
                                                    </div>
                                                    <div class="owner-info-detail-item">
                                                        <label for="">Contact Number:</label>
                                                        <p>{{$propertyManager->phone}}</p>
                                                    </div>
                                                    <div class="owner-info-detail-item">
                                                        <label for="">Address:</label>
                                                        <p>{{$propertyManager->address}}</p>
                                                    </div>
                                                    <div class="owner-info-detail-item">
                                                        <label for="">Email:</label>
                                                        <p>{{$propertyManager->email}}</p>
                                                    </div>
                                                </td>
                                                @endif
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                        @include('frontend.pages.partials.property-review')

                </div>
                <div class="col-lg-4">
                    <div class="single-properties-right-wrapper">
                        <div class="property-summary">
                            <h5>Property Summary</h5>
                            <ul>
                                <li>
                                    <h6>Property Name:</h6><span>{{$property->title}}</span>
                                </li>
                                <li>
                                    <h6>Listing Type:</h6><span>For {{$property->property_status_id ? $property->saleStatus->title : ''}}</span>
                                </li>
                                <li>
                                    <h6>Property Type:</h6><span>{{$property->property_subcategory_id ? $property->subCategory->name : ''}}</span>
                                </li>
                                <li>
                                    <h6>Price:</h6><span>RS.{{number_format($property->price)}} {{$property->price_postfix}}</span>
                                </li>
                                <li>
                                    <h6>Area:</h6><span>{{$property->area_size}} {{$property->area_size_postfix}}</span>
                                </li>
                                <li>
                                    <h6>Bedroom:</h6><span>{{$property->bedrooms}}</span>
                                </li>
                                <li>
                                    <h6>Bathroom:</h6><span>{{$property->bathrooms}}</span>
                                </li>
                                <li>
                                    <h6>Car Garage:</h6><span>{{$property->garages}}</span>
                                </li>

                            </ul>
                        </div>

                        @include('frontend.pages.partials.property-sidebar')
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="modal fade" id="request-info-id" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-custom-width" role="document">
                            <div class="modal-content">
                                <div class="modal-header request-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Request Form</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="request_form" action="{{route('fe.guest.request.property',$property->slug)}}" method="post">

                                        {{ csrf_field()}}
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input type="text" class="form-control" name="name" placeholder="Full Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" name="email" placeholder="Email address">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="text" class="form-control" name="phone" placeholder="+977-**********">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" class="form-control" name="address" placeholder="Address">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Message</label>
                                                    <textarea class="form-control" name="message" placeholder="Message..."></textarea>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn request-info-btn">Request</button>
                                            </div>


                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-lg-12">
                    <h3 class="featured-prop-title">Related Properties</h3>
                    <div class="bod-bot-div"></div>
                </div>
                <div class="col-lg-12">
                    <div class="owl-related owl-carousel">

                        @foreach($relatedProperties as $property)
                            <div class="featured-slider-item">
                                <div class="property-photo">

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
                                <div class="on-sale">
                                    <p>
                                        {{$property->property_status_id ? $property->saleStatus->title : ''}}
                                    </p>
                                </div>
                                <div class="feartured-prop-cat">
                                    <a href="{{route('fe.singleProperty',$property->slug)}}" class="color-green">
                                        {{$property->property_category_id ? $property->category->name : ''}}
                                    </a>
                                    <a href="{{route('fe.singleProperty',$property->slug)}}" class="color-blue">
                                        {{$property->property_subcategory_id ? $property->subCategory->name : ''}}
                                    </a>

                                </div>
                                <div class="featured-prop-price">
                                    <span>Rs.</span>{{$property->price}}
                                </div>
                                <div class="featured-prop-desc">
                                    <h4><a href="{{route('fe.singleProperty',$property->slug)}}">{{$property->title}}</a></h4>
                                    <p class="featured-prop-sub-title" title="{{$property->address ? $property->address->address : ''}}">
                                        {{$property->address ? str_limit(strip_tags($property->address->address ),80) : ''}}
                                    </p>

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
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.pages.partials.subscribe-us')

@endsection

@push('scripts')
    @include('frontend.pages.partials.property-review-scripts')
    @include('frontend.pages.partials.property-request-scripts')

    @include('frontend.pages.partials.emi-result-scripts')

    <!--favourite property scripts-->
    <script>
        $(document).ready(function () {

            $('#fav_btn').on('click',function (e) {

                e.preventDefault();

                let url = $(this).attr('href');

                toggleFav(url);

               $(this).toggleClass('active');
            });

            function toggleFav(url) {
                $.ajax(
                    {
                        type: 'GET',
                        url: url,
                        datatype: "html",
                    }).done(function (data) {
                    $("#partial_message").empty().html(data);
                }).fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log("Error: " + errorThrown);
                    console.log("Status: " + status);
                    console.dir(xhr);
                });

            }
        });
    </script>

    <!--map scripts-->
    <script>

        let map;
        let cmarker;


        function initAutocomplete() {

            let propertyLatitude = "{{$propertyAddress->latitude}}";
            let propertyLongitude = "{{$propertyAddress->longitude}}";

            // The location of nepal
            var location = {lat: parseFloat(propertyLatitude), lng: parseFloat(propertyLongitude)};

            var mapOptions = {
                zoom: 16,
                center: location,
            };


            map = new google.maps.Map(document.getElementById('map-location'),mapOptions);

            // The marker, positioned at nepal
            cmarker = new google.maps.Marker({
                position: location,
                map: map,
                animation: google.maps.Animation.DROP,
            });

        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrPMYf0pq2cXXte1SxJOdMJR8F9dMxKdg&libraries=places&callback=initAutocomplete"
            async defer></script>
@endpush
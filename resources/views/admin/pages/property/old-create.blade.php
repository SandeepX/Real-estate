@extends('admin.layout.master')

@section('title','Add Property')

@section('content')
    <!-- Site Content -->
    <div class="dt-content">


        <!-- Grid breadcrumbs -->
        <div class="row dt-masonry">

            <!-- Grid Item -->
            <div class="col-md-12 dt-masonry__item">

                <!-- Breadcrumbs -->

                <ol class="mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Property</a></li>
                    <li class="active breadcrumb-item">Create</li>
                </ol>
                <!-- /breadcrumbs -->

            </div>
            <!-- /grid item -->

        </div>
        <!-- /grid breadcrumbs -->

        <!-- Page Header -->
        <div class="dt-page__header">
            <h1 class="dt-page__title"></h1>
        </div>
        <!-- /page header -->


        <!-- Grid -->
        <div class="row dt-masonry">

            <!-- Grid Item -->
            <div class="col-md-12 dt-masonry__item">

                <!-- Card -->
                <div class="dt-card">

                    <!-- Card Header -->
                    <div class="dt-card__header">

                        <!-- Card Heading -->
                        <div class="dt-card__heading">
                            <h3 class="dt-card__title">Property</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->



                    <!-- Card Body -->
                    <div class="dt-card__body tabs-container tabs-vertical">

                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs flex-column" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab-pane-1" role="tab"
                                   aria-controls="tab-pane-1" aria-selected="true">Basic Information
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-pane-2" role="tab"
                                   aria-controls="tab-pane-2" aria-selected="true">Map
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="navs.html#tab-pane-5" role="tab"
                                   aria-controls="tab-pane-5" aria-selected="true">Messages
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="navs.html#tab-pane-6" role="tab"
                                   aria-controls="tab-pane-6" aria-selected="true">Settings
                                </a>
                            </li>
                        </ul>
                        <!-- /tab navigation -->

                        <!-- Tab Content -->
                        <div class="tab-content">

                            <!-- Tab Pane -->
                            <div id="tab-pane-1" class="tab-pane active">
                                <div class="card-body">
                                    <!-- Form -->
                                    <form id="form" method="post" action="" enctype="multipart/form-data">

                                    {{ csrf_field()}}

                                    <!-- Form Group -->
                                        <div class="form-group">
                                            <label for="name">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                                                   placeholder="Enter Property Title">
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        </div>
                                        <!-- /form group -->

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="property_type">Property Type</label>

                                                    <select name="property_type[]" id="property_type" class="form-control js-example-basic-single"  required>
                                                        <option selected disabled>Select Property Type</option>

                                                    @foreach($propertyCategories as $category)

                                                            <optgroup label="{{$category->name}}">
                                                                @forelse($category->propertySubCategories as $subCategory)
                                                                    <option value="{{$category->id}},{{$subCategory->id}}"  {{ old('property_type') == $category->id,$subCategory->id ? 'selected' : '' }}> {{$category->name}} : {{$subCategory->name}}</option>
                                                                @empty
                                                                    <p class="text-center">Zero Type</p>
                                                                @endforelse

                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="property_status">Property Status</label>

                                                    <select name="property_status" id="property_status" class="form-control js-example-basic-single"  required>
                                                        @foreach($propertyStatus as $status)

                                                            <option value="{{$status->id}}"  {{ old('property_status') == $status->id? 'selected' : '' }}> {{$status->title}}</option>

                                                            <p class="text-center">Zero Type</p>


                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="summernote" rows="3" name="description" placeholder="Short Description">{{ old('description') }}</textarea>
                                        </div>
                                        <!-- /form group -->

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="price">Sale or Rent Price (Only digits)</label>
                                                    <input type="number" min="0" class="form-control" id="price" name="price" value="{{old('price')}}"
                                                           placeholder="Enter Price">
                                                    <small  class="form-text">
                                                        Example Vlaue: 435000
                                                    </small>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="price_postfix" class="label-color">Price Postfix</label>

                                                    <input id="price_postfix" type="text" value="{{old('price_postfix')}}" class="form-control" name="price_postfix"
                                                           placeholder="Example: Per Month">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="area_size">Area Size (Only digits)</label>
                                                    <input type="number" min="0" class="form-control" id="area_size" name="area_size" value="{{old('area_size')}}"
                                                           placeholder="Enter area size">
                                                    <small  class="form-text">
                                                        Example Vlaue: 25000
                                                    </small>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="area_size_postfix" class="label-color">Area Size Postfix</label>

                                                    <input id="area_size_postfix" type="text" value="{{old('area_size_postfix')}}" class="form-control" name="area_size_postfix"
                                                           placeholder="Example: sq ft">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="lot_size">Lot Size (Only digits)</label>
                                                    <input type="number" min="0" class="form-control" id="lot_size" name="lot_size" value="{{old('lot_size')}}"
                                                           placeholder="Enter lot size">
                                                    <small  class="form-text">
                                                        Example Vlaue: 3000
                                                    </small>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="lot_size_postfix" class="label-color">Lot Size Postfix</label>

                                                    <input id="lot_size_postfix" type="text" value="{{old('lot_size_postfix')}}" class="form-control" name="lot_size_postfix"
                                                           placeholder="Example: sq ft">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="bedroom_num">Bedrooms</label>
                                                    <input type="number" min="0" class="form-control" id="bedroom_num" name="bedroom_num" value="{{old('bedroom_num')}}"
                                                           placeholder="Enter Number Of Bedrooms">
                                                    <small  class="form-text">
                                                        Example Value: 4
                                                    </small>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="bathroom_num" class="label-color">Bathrooms</label>

                                                    <input id="bathroom_num" type="text" value="{{old('bathroom_num')}}" class="form-control" name="bathroom_num"
                                                           placeholder="Enter Number Of Bathrooms">

                                                    <small  class="form-text">
                                                        Example Value: 2
                                                    </small>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="garage_num">Garages</label>
                                                    <input type="number" min="0" class="form-control" id="garage_num" name="garage_num" value="{{old('garage_num')}}"
                                                           placeholder="Enter Number Of Garages">
                                                    <small  class="form-text">
                                                        Example Value: 2
                                                    </small>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="year_built" class="label-color">Year Built</label>

                                                    <input id="year_built" type="text" value="{{old('year_built')}}" class="form-control" name="year_built"
                                                           placeholder="Enter year it was built">

                                                    <small  class="form-text">
                                                        Example Value: 2019 A.D
                                                    </small>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-xl-6">
                                                <!-- Input Group -->
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="featured_image" id="inputGroupFile01">
                                                        <label class="custom-file-label" for="inputGroupFile01">Choose featured image</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="garage_num">Mark this property as featured?</label>

                                                    <!-- Checkbox -->
                                                    <div class="custom-control custom-checkbox mb-3">
                                                        <input type="checkbox" id="customcheckboxInline5"
                                                               name="customcheckboxInline1"
                                                               class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckboxInline5">Featured</label>
                                                    </div>
                                                    <!-- /checkbox -->
                                                </div>


                                            </div>


                                        </div>

                                        @if($propertyFeatures->count() > 0)

                                            <div class="form-group">
                                                <div class="row">
                                                    <label>Property Features</label>
                                                </div>

                                                @foreach($propertyFeatures as $propertyFeature)

                                                    <!-- Checkbox -->
                                                    <div class="custom-control custom-checkbox custom-control-inline">
                                                        <input type="checkbox"
                                                               name="{{$propertyFeature->title}}" id="{{$propertyFeature->title}}"
                                                               class="custom-control-input" {{old($propertyFeature->title) ? 'checked' : ''}}>
                                                        <label class="custom-control-label"  for="{{$propertyFeature->title}}">{{$propertyFeature->title}}</label>
                                                    </div>
                                                    <!-- /checkbox -->
                                                    @endforeach


                                            </div>

                                            <!-- Form Group -->
                                        @endif

                                        <div class="form-group">
                                            <label>Additional Features</label>

                                            <div class="fields">

                                                <div class="entry input-group col-xs-3">
                                                    <input class="form-control" name="fields[]" type="text" placeholder="Type something" />
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-success btn-add" type="button">
                                                            <span class="fa fa-plus"></span>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- /form group -->

                                        <button class="btn btn-primary" type="submit">Create</button>


                                    </form>
                                </div>
                            </div>
                            <!-- /tab pane-->

                            <!-- Tab Pane -->
                            <div id="tab-pane-2" class="tab-pane">
                                <div class="map_tab">
                                    <div id="map"></div>

                                    <div class="card-body">

                                        <!-- Form Group -->
                                        <div class="form-group">
                                            <label for="name">Address</label>

                                            <input id="pac-input"  class="form-control controls" type="text" placeholder="Enter Address">

                                        </div>
                                        <!-- /form group -->

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <!-- Form Group -->
                                                <div class="form-group">
                                                    <label for="name">Latitude</label>
                                                    <input type="text" class="form-control lat-long" id="latitude" name="latitude" value="{{ old('latitude') }}"
                                                           placeholder="Enter Latitude">
                                                </div>
                                                <!-- /form group -->
                                            </div>
                                            <div class="col-xl-6">
                                                <!-- Form Group -->
                                                <div class="form-group">
                                                    <label for="name">Longitude</label>
                                                    <input type="text" class="form-control lat-long" id="longitude" name="longitude" value="{{ old('longitude') }}"
                                                           placeholder="Enter Longitude">
                                                </div>
                                                <!-- /form group -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /tab pane-->

                            <!-- Tab Pane -->
                            <div id="tab-pane-5" class="tab-pane">
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong>A wonderful serenity has taken possession</strong> of my
                                        entire soul,
                                        like these sweet mornings of spring which I enjoy with my whole
                                        heart. I am alone, and feel the charm of existence in this spot,
                                        which was created for the bliss of souls like mine.
                                    </p>
                                    <p class="card-text">
                                        I am so happy, my dear friend, so absorbed in the exquisite
                                        sense of mere tranquil existence, that I neglect my talents. I
                                        should be incapable of drawing a single stroke at the present
                                        moment; and yet I feel that I never was a greater artist than
                                        now.
                                    </p>
                                </div>
                            </div>
                            <!-- /tab pane-->

                            <!-- Tab Pane -->
                            <div id="tab-pane-6" class="tab-pane">
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong>Thousand unknown plants are noticed by me:</strong> when I
                                        hear the buzz
                                        of the little world among the stalks, and grow familiar with the
                                        countless indescribable forms of the insects and flies, then I
                                        feel the presence of the Almighty, who formed us in his.
                                    </p>
                                    <p class="card-text">I am alone, and feel the charm of existence in this
                                        spot, which
                                        was created for the bliss of souls like mine. I am so happy, my
                                        dear friend, so absorbed in the exquisite sense of mere tranquil
                                        existence, that I neglect my talents. I should be incapable of
                                        drawing.
                                    </p>
                                </div>
                            </div>
                            <!-- /tab pane-->

                        </div>
                        <!-- /tab content -->

                    </div>
                    <!-- /card body -->

                </div>
                <!-- /card -->

            </div>
            <!-- /grid item -->

        </div>
    </div>
@endsection

@push('scripts')

    <script>

        let map;
        let cmarker;
        let latitude=  document.getElementById('latitude');
        let longitude=  document.getElementById('longitude');

        // This example adds a search box to a map, using the Google Place Autocomplete
        // feature. People can enter geographical searches. The search box will return a
        // pick list containing a mix of places and predicted search terms.

        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        function initAutocomplete() {

            // The location of nepal
            var location = {lat: 28.3949, lng: 84.1240};

            var mapOptions = {
                zoom: 7,
                center: location,
            };


            map = new google.maps.Map(document.getElementById('map'),mapOptions);

            // The marker, positioned at nepal
            cmarker = new google.maps.Marker({
                position: location,
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
            });

            cmarker.addListener('drag', function (event) {
                latitude.value = event.latLng.lat();
                longitude.value = event.latLng.lng();
            });



            //for autocomplete search--google code
            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });

            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length === 0) {
                    return;
                }


                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }


                    cmarker.setPosition(place.geometry.location);

                    latitude.value=place.geometry.location.lat();
                    longitude.value= place.geometry.location.lng();

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }


        $(".lat-long ").on('keyup',function () {

            //getting input from lat & lang field
            var latlng = new google.maps.LatLng(latitude.value, longitude.value);

            //setting marker position
            cmarker.setPosition(latlng);

            //adjusting and making map camera center
            map.setCenter(cmarker.getPosition());

        });

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrPMYf0pq2cXXte1SxJOdMJR8F9dMxKdg&libraries=places&callback=initAutocomplete"
            async defer></script>

    <script src="{{asset('backend/node_modules/summernote/dist/summernote-bs4.js')}}"></script>

    <script src="{{asset('backend/assets/js/custom/editor-summernote.js')}}"></script>

    <script>


        $(document).on('click', '.btn-add', function(e)
        {
            e.preventDefault();

            var controlForm = $('.fields:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);

            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="fa fa-minus"></span>');
        }).on('click', '.btn-remove', function(e)
        {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });




    </script>



@endpush
@extends('admin.layout.master')

@section('title','Edit Property')

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
                    <li class="breadcrumb-item"><a href="{{route('property.index')}}">Property</a></li>
                    <li class="active breadcrumb-item"><a href="{{route('property.edit',$property->id)}}">Edit</a></li>
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

    @include('partials.messages')

    <!-- Grid -->
        <div class="row dt-masonry">

            <!-- Grid Item -->
            <div class="col-md-12 dt-masonry__item">

                <!-- Card Body -->
                <div class="tabs-container">

                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" role="tablist">

                        @php($tabName = session('tabName'))

                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#floor_plan" role="tab" aria-controls="floor_plan" aria-selected="true">Floor Plan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#more_info" role="tab" aria-controls="more_info" aria-selected="true">More Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#documents" role="tab" aria-controls="more_info" aria-selected="true">Documents</a>
                        </li>
                    </ul>
                    <!-- /tab navigation -->

                    <!-- Tab Content -->
                    <div class="tab-content">

                        <!-- Tab Pane -->
                        <div id="general" class="tab-pane active">
                            <div class="card-body">

                                <!-- Card Body -->
                                <div id="edit_tab" class="tabs-container tabs-vertical">

                                    <!-- Tab Navigation -->
                                    <!-- Tab Navigation -->
                                    <ul class="nav nav-tabs flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tab-pane-1" role="tab"
                                               aria-controls="tab-pane-1" aria-selected="true">Basic Information
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab-pane-2" role="tab"
                                               aria-controls="tab-pane-2" aria-selected="true" >Map
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab-pane-3" role="tab"
                                               aria-controls="tab-pane-5" aria-selected="true">Gallery
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- /tab navigation -->

                                    <!-- Form -->
                                    <form id="form-edit" method="post" action="{{route('property.update',$property->id)}}" enctype="multipart/form-data">

                                    {{ csrf_field()}}

                                        <input type="hidden" name="_method" value="PUT">

                                    <!-- Tab Content -->
                                        <div class="tab-content">

                                            <!-- Tab Pane basic info-->
                                            <div id="tab-pane-1" class="tab-pane active">
                                                <div class="card-body">


                                                    <!-- Form Group -->
                                                    <div class="form-group">
                                                        <label for="title">Title</label>
                                                        <input type="text" class="form-control" id="title" name="title" value="{{$property->title }}"
                                                               placeholder="Enter Property Title">
                                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                                    </div>
                                                    <!-- /form group -->

                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label for="property_type">Property Type</label>

                                                                <select name="property_type" id="property_type"  class="form-control js-example-basic-single"  >
                                                                    <option selected disabled>Select Property Type</option>

                                                                    @foreach($propertyCategories as $category)

                                                                        <optgroup label="{{$category->name}}">
                                                                            @forelse($category->propertySubCategories as $subCategory)
                                                                                <option value="{{$category->id}},{{$subCategory->id}}"
                                                                                        {{ $property->property_category_id.','.$property->property_subcategory_id === $category->id.','.$subCategory->id  ? 'selected' : '' }}
                                                                                >
                                                                                    {{$category->name}} : {{$subCategory->name}}
                                                                                </option>
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

                                                                <select name="property_status" id="property_status" class="form-control js-example-basic-single" >

                                                                    <option selected disabled>Select Property Status</option>

                                                                    @foreach($propertyStatus as $status)

                                                                        <option value="{{$status->id}}"  {{ $property->property_status_id == $status->id? 'selected' : '' }}> {{$status->title}}</option>

                                                                        <p class="text-center">Zero Type</p>


                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <!-- Form Group -->
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea class="form-control" id="summernote" rows="3" name="description" placeholder="Short Description">{{ $property->description }}</textarea>
                                                    </div>
                                                    <!-- /form group -->

                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label for="price">Sale or Rent Price (Only digits)</label>
                                                                <input type="number" min="0" class="form-control" id="price" name="price" value="{{$property->price}}"
                                                                       placeholder="Enter Price">
                                                                <small  class="form-text">
                                                                    Example Vlaue: 435000
                                                                </small>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label for="price_postfix" class="label-color">Price Postfix</label>

                                                                <input id="price_postfix" type="text" value="{{$property->price_postfix}}" class="form-control" name="price_postfix"
                                                                       placeholder="Example: Per Month">

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label for="area_size">Area Size (Only digits)</label>
                                                                <input type="number" min="0" class="form-control" id="area_size" name="area_size" value="{{$property->area_size}}"
                                                                       placeholder="Enter area size">
                                                                <small  class="form-text">
                                                                    Example Vlaue: 25000
                                                                </small>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label for="area_size_postfix" class="label-color">Area Size Postfix</label>

                                                               {{-- <input name="area_size_postfix" id="area_size_postfix" type="text" value="{{$property->area_size_postfix}}" class="form-control"
                                                                       placeholder="Example: sq ft">--}}
                                                                <select name="area_size_postfix" id="area_size_postfix" class="form-control js-example-basic-single" >

                                                                    <option selected disabled>Select Area Size Postfix</option>

                                                                    @foreach($areaPostfix as $postfix)

                                                                        <option value="{{$postfix}}"  {{$property->area_size_postfix == $postfix? 'selected' : '' }}> {{$postfix}}</option>

                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{--lot size--}}

                                                  {{--  <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label for="lot_size">Lot Size (Only digits)</label>
                                                                <input type="number" min="0" class="form-control" id="lot_size" name="lot_size" value="{{$property->lot_size}}"
                                                                       placeholder="Enter lot size">
                                                                <small  class="form-text">
                                                                    Example Vlaue: 3000
                                                                </small>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label for="lot_size_postfix" class="label-color">Lot Size Postfix</label>

                                                                <input id="lot_size_postfix" type="text" value="{{$property->lot_size_postfix}}" class="form-control" name="lot_size_postfix"
                                                                       placeholder="Example: sq ft">

                                                            </div>
                                                        </div>
                                                    </div>--}}

                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label for="bedrooms">Bedrooms</label>
                                                                <input type="number" min="1" class="form-control" id="bedrooms" name="bedrooms" value="{{$property->bedrooms}}"
                                                                       placeholder="Enter Number Of Bedrooms">
                                                                <small  class="form-text">
                                                                    Example Value: 4
                                                                </small>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label for="bathrooms" class="label-color">Bathrooms</label>

                                                                <input id="bathrooms" type="number" min="1" value="{{$property->bathrooms}}" class="form-control" name="bathrooms"
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
                                                                <label for="garages">Garages</label>
                                                                <input type="number" min="1" class="form-control" id="garages" name="garages" value="{{$property->garages}}"
                                                                       placeholder="Enter Number Of Garages">
                                                                <small  class="form-text">
                                                                    Example Value: 2
                                                                </small>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label for="year_built" class="label-color">Year Built</label>

                                                                <input id="year_built" type="text" value="{{$property->year_built}}" class="form-control" name="year_built"
                                                                       placeholder="Enter year it was built">

                                                                <small  class="form-text">
                                                                    Example Value: 2019 A.D
                                                                </small>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label for="front_face">Front Face</label>
                                                                <input type="text" class="form-control" id="garages" name="front_face" value="{{$property->front_face}}"
                                                                       placeholder="Enter Front Face">
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6">
                                                            <div class="form-group">
                                                                <label for="back_face" class="label-color">Back Face</label>

                                                                <input id="back_face" type="text" value="{{$property->back_face}}" class="form-control" name="back_face"
                                                                       placeholder="Enter Back Face">

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
                                                                    <input type="file" class="custom-file-input upload_img1" name="featured_image" id="inputGroupFile01">
                                                                    <label class="custom-file-label" for="inputGroupFile01">Choose featured image</label>
                                                                </div>
                                                            </div>

                                                            <div id="image_preview1">

                                                            </div>

                                                            @if(isset($property->featured_image))
                                                                <div class="db_images">

                                                                    <a class='parent_images'>
                                                                        <i data-url="{{route('property.single.images.destroy',$property->id)}}" class='remove-db-img fa fa-times' ></i>
                                                                        <img class='img'  src="{{asset('common/images/'.$property->featured_image)}}">
                                                                    </a>

                                                                </div>

                                                            @endif

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
                                                                           name="property_features[]" id="{{$propertyFeature->title}}" value="{{$propertyFeature->id}}"
                                                                           class="custom-control-input"
                                                                           @if(is_array($featuresOfProperty) && in_array($propertyFeature->id,$featuresOfProperty)) checked @endif
                                                                    >
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

                                                            @if(isset($additionalFeatures) && count($additionalFeatures)> 0 )

                                                                @foreach($additionalFeatures as $field)
                                                                    <div class="entry input-group col-xs-3">
                                                                        <input class="form-control" name="additional_features[]" value="{{$field}} " type="text" placeholder="Type something" />
                                                                        <span class="input-group-btn">
                                                            <button class="btn btn-danger btn-remove" type="button">
                                                                <span class="fa fa-minus"></span>
                                                            </button>
                                                        </span>
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                            <div class="entry input-group col-xs-3">
                                                                <input class="form-control" name="additional_features[]" value="" type="text" placeholder="Type something" />
                                                                <span class="input-group-btn">
                                                        <button class="btn btn-success btn-add" type="button">
                                                            <span class="fa fa-plus"></span>
                                                        </button>
                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- /form group -->

                                                    {{--<div class="form-group">--}}
                                                        {{--<label for="garage_num">Status</label>--}}
                                                        {{----}}
                                                        {{--<div class="custom-control custom-checkbox mb-3">--}}
                                                            {{--<input type="checkbox" id="status"--}}
                                                                   {{--name="status"--}}
                                                                   {{--class="custom-control-input"  {{$property->status === 1 ? 'checked' : ''}}>--}}
                                                            {{--<label class="custom-control-label" for="status">Active</label>--}}
                                                        {{--</div>--}}
                                                       {{----}}
                                                    {{--</div>--}}

                                                    <button class="btn btn-primary btn-back-next" data-btn-type="next" data-toggle="tab" href="#tab-pane-2">Next</button>

                                                </div>
                                            </div>
                                            <!-- /tab pane-->

                                            <!-- Tab Pane map-->
                                            <div id="tab-pane-2" class="tab-pane">
                                                <div class="map_tab">
                                                    <div class="google-map-div">
                                                        <input id="pac-input" class="form-control controls google-search-input" type="text" placeholder="Search Address">
                                                        <a href="#" class="search-loca-a"><i class="fa fa-search"></i></a>
                                                    </div>
                                                    <div id="map"></div>

                                                    <div class="card-body">

                                                        <div class="row">
                                                            <div class="col-xl-6">
                                                                <!-- Form Group -->
                                                                <div class="form-group">
                                                                    <label for="pac-input">Address</label>

                                                                    <input id="address" name="address" value="{{$propertyAddress? $propertyAddress->address : ''}}"
                                                                           class="form-control controls" type="text" placeholder="Enter Address">

                                                                </div>
                                                                <!-- /form group -->
                                                            </div>

                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="province">Province</label>


                                                                    <select class="form-control" name="province" id="province">
                                                                        <option value="" selected disabled>Choose...</option>
                                                                        @foreach($provinces as $province)
                                                                            <option data-provinceurl="{{route('province.districts',$province->id)}}" value="{{$province->id}}" {{$propertyAddress->province_id == $province->id ? 'selected' : ''}}>
                                                                                {{$province->province_name}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-xl-6">
                                                                <!-- Form Group -->
                                                                <div class="form-group">
                                                                    <label for="district">District*</label>

                                                                    <select class="form-control"  name="district" id="district">
                                                                        <option value="" selected disabled>Choose...</option>
                                                                        @foreach($propertyDistricts as $district)
                                                                            <option data-url="{{route('district.municipals',$district->id)}}" value="{{$district->id}}"
                                                                                    {{$propertyAddress->district_id == $district->id ? 'selected' : ''}}>
                                                                                {{$district->district_name}}
                                                                            </option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                                <!-- /form group -->
                                                            </div>

                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="municipal">Municipality*</label>

                                                                    <select class="form-control" name="municipal" id="municipal">
                                                                        <option value="" selected disabled>Choose...</option>
                                                                        @foreach($propertyMunicipals as $municipal)
                                                                            <option  value="{{$municipal->id}}"
                                                                                    {{$propertyAddress->municipality_id == $municipal->id ? 'selected' : ''}}>
                                                                                {{$municipal->municipal_name}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-xl-6">
                                                                <!-- Form Group -->
                                                                <div class="form-group">
                                                                    <label for="name">Latitude</label>
                                                                    <input type="text" class="form-control lat-long" id="latitude" name="latitude" value="{{$property->address  && $property->address->latitude ? $property->address->latitude : '28.3949'}}"
                                                                           placeholder="Enter Latitude">
                                                                </div>
                                                                <!-- /form group -->
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <!-- Form Group -->
                                                                <div class="form-group">
                                                                    <label for="name">Longitude</label>
                                                                    <input type="text" class="form-control lat-long" id="longitude" name="longitude" value="{{$property->address && $property->address->longitude ? $property->address->longitude : '84.1240'}}"
                                                                           placeholder="Enter Longitude">
                                                                </div>
                                                                <!-- /form group -->
                                                            </div>
                                                        </div>

                                                        <button class="btn btn-primary btn-back-next" data-toggle="tab" href="#tab-pane-1">Back</button>


                                                        <button class="btn btn-primary btn-back-next" data-btn-type="next" data-toggle="tab" href="#tab-pane-3">Next</button>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- /tab pane-->

                                            <!-- Tab Pane gallery-->
                                            <div id="tab-pane-3" class="tab-pane">
                                                <div class="card-body">

                                                    <div class="image-upload-wrap">
                                                        <input class="file-upload-input" type='file' id="upload_file" name="gallery_images[]" accept="image/*" multiple/>
                                                        <div class="drag-text">
                                                            <h3>Drag and drop a file or select add Image</h3>
                                                        </div>
                                                    </div>

                                                    <div id="image_preview">

                                                    </div>

                                                    <div id="blank">
                                                        @if(count($propertyImages) > 0)
                                                            <div class="db_images">
                                                                <hr>
                                                                @foreach($propertyImages as $image)
                                                                    <a class='parent_images'>
                                                                        <i data-url="{{route('property.images.destroy',$image->id)}}" class='remove-db-img fa fa-times' ></i>
                                                                        <img class='img'  src="{{asset('common/images/'.$image->image)}}">
                                                                    </a>
                                                                @endforeach
                                                            </div>

                                                        @endif
                                                    </div>

                                                    <button class="btn btn-primary btn-back-next"  data-toggle="tab" href="#tab-pane-2">Back</button>


                                                    <button class="btn btn-primary float-right" type="submit">Update Property</button>

                                                </div>
                                            </div>
                                            <!-- /tab pane-->

                                        </div>
                                        <!-- /tab content -->

                                    </form>

                                </div>
                                <!-- /card body -->

                            </div>
                        </div>
                        <!-- /tab pane-->

                        <!-- Tab Pane -->
                        <div id="floor_plan" class="tab-pane">
                            <div class="card-body">
                               @include('admin.pages.property.property.floor.floor')
                            </div>
                        </div>
                        <!-- /tab pane-->

                        <!-- Tab Pane -->
                        <div id="more_info" class="tab-pane">
                            <div class="card-body">
                                @include('admin.pages.property.property.more-info.info')
                            </div>
                        </div>
                        <!-- /tab pane-->

                        <!-- Tab Pane -->
                        <div id="documents" class="tab-pane">
                            <div class="card-body">
                                @include('admin.pages.property.property.documents.new-document')
                            </div>
                        </div>
                        <!-- /tab pane-->

                    </div>
                    <!-- /tab content -->

                </div>
                <!-- /card body -->


            </div>
            <!-- /grid item -->

        </div>
    </div>
@endsection

@push('scripts')

    @include('admin.pages.property.property.property-scripts')

    @include('admin.pages.property.property.floor.floor-scripts')

    @include('admin.pages.property.property.more-info.more-info-scripts')

    @include('admin.pages.property.property.documents.new-document-scripts')

    {{--get districts,municipals on change of province--}}
    <script>
        $(document).ready(function () {

            function updateOptionsOfDistricts(id,options) {
                //make select option empty
                $(id).empty();
                $('#municipal').empty();

                let disabledOption= "<option value='' selected disabled>Choose...</option>";

                $('#municipal').append(disabledOption);

                let districtroute= "{{url('/district/municipals/')}}";

                //append new options from json data
                $(id).append(disabledOption);

                options.forEach(function (option) {
                    $(id).append("<option data-url='"+districtroute+'/'+option['id']+"' value='" + option['id'] + "'>" + option['district_name'] + "</option>");
                });

            }

            function updateOptionsDistricts(selectorId,url) {
                $.ajax(
                    {
                        type: 'GET',
                        url: url,
                        datatype: "json",
                    }).done(function (data) {
                    updateOptionsOfDistricts(selectorId,data);
                }).fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log("Error: " + errorThrown);
                    console.log("Status: " + status);
                    console.dir(xhr);
                });

            }

            $('#province').on('change', function () {

                var provinceUrl = $(this).children(":selected").data('provinceurl');

                //ajax call to update districts
                updateOptionsDistricts('#district',provinceUrl);

            });

            function updateOptionsOfMunicipals(id,options) {
                //make select option empty
                $(id).empty();

                let disabledOption= "<option value='' selected disabled>Choose...</option>";

                //append new options from json data
                $(id).append(disabledOption);
                options.forEach(function (option) {
                    $(id).append("<option value='" + option['id'] + "'>" + option['municipal_name'] + "</option>");
                });
            }

            function updateOptionsMunicipals(selectorId,url) {
                $.ajax(
                    {
                        type: 'GET',
                        url: url,
                        datatype: "json",
                    }).done(function (data) {
                    updateOptionsOfMunicipals(selectorId,data);
                }).fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log("Error: " + errorThrown);
                    console.log("Status: " + status);
                    console.dir(xhr);
                });

            }

            $('#district').on('change', function () {

                var districtUrl = $(this).children(":selected").data('url');

                //ajax call to update options
                updateOptionsMunicipals('#municipal',districtUrl);

            });

        });
    </script>

    <!--multi step form for edit scripts-->
    <script>
        $(document).ready(function () {

            $('select').on('click',function () {
                $(this).removeClass('error');
            });
            //tab change..multi step form
            $('.btn-back-next').on('click',function (e) {

                e.preventDefault();

                let form = $('#form-edit');

                let isNextBtn= $(this).attr("data-btn-type");

                let hrefValue =  $(this).attr('href');

                let navSelector ='#edit_tab .nav-tabs li.nav-item a';


                // For some browsers, `attr` is undefined; for others,
                // `attr` is false.  Check for both.
                //if next button then only need to validate...no need to validate back button
                if (isNextBtn==="next" && typeof isNextBtn !== typeof undefined && isNextBtn !== false ) {
                    if(form.valid() === true){

                        //console.log( $(navSelector+'[href="' +hrefValue+ '"]'));
                        //$('.nav-tabs li a[href="' + $(this).attr('href') + '"]').trigger('click');

                        // $('.nav-tabs li.nav-item a[href="' +hrefValue+ '"]').tab('show');
                        //$('.nav-tabs li.nav-item a[href="' +hrefValue+ '"]').trigger('click');


                        //tab change
                        changeTab(navSelector,hrefValue);

                        //scrolltop
                        $("html, body").animate({ scrollTop: 0 }, 100);
                        // $( "html, body" ).scrollTop(300);
                    }
                    else {
                        //alert('a');
                        $(this).removeAttr( "data-toggle");
                        $('select').removeClass('error');
                        $(this).attr( "data-toggle");
                    }
                }
                else{
                    changeTab(navSelector,hrefValue);
                }


            });

            function changeTab(navSelector,hrefValue) {
                $(navSelector+'[href="' +hrefValue+ '"]').tab('show');
                $(navSelector+'[href="' +hrefValue+ '"]').trigger('click');
            }

        });
    </script>

    <!--for data table-->
    <script src="{{asset('backend/node_modules/datatables.net/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('backend/assets/js/custom/data-table.js')}}"></script>

    <!--for redirecting to specific tab-->
    <script>
         let tabName = "<?php echo session('tabName'); ?>";
         //console.log(tabName);
         if (tabName){
             $('.nav-tabs li.nav-item a[href="#' +tabName+ '"]').tab('show');
             $('.nav-tabs li.nav-item a[href="#' +tabName+ '"]').trigger('click');
         }
    </script>


    <!-- Sweet Alert -->
    <script src="{{asset('backend/node_modules/sweetalert2/dist/sweetalert2.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('.parameter-alert').on("click", function (e) {

                e.preventDefault();
                let dataId = $(this).data('id');
                console.log(dataId);
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success mb-2',
                    cancelButtonClass: 'btn btn-danger mr-2 mb-2',
                    buttonsStyling: false,
                });

                swalWithBootstrapButtons({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        /* swalWithBootstrapButtons(
                             'Deleted!',
                             'Your file has been deleted.',
                             'success'
                         ),*/
                        $(".confirm_delete"+dataId).off("submit").submit();
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons(
                            'Cancelled',
                            'Your imaginary file is safe :)',
                            'error'
                        )
                    }
                });
            });


        });
    </script>

@endpush
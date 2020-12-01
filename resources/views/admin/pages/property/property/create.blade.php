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

    @include('partials.messages')

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
                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs flex-column" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab-pane-1" role="tab"
                                   aria-controls="tab-pane-1" aria-selected="true">Basic Information
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-pane-2" role="tab"
                                   aria-controls="tab-pane-2" aria-selected="true">More Information
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-pane-3" role="tab"
                                   aria-controls="tab-pane-3" aria-selected="true" >Map
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab-pane-4" role="tab"
                                   aria-controls="tab-pane-4" aria-selected="true">Gallery
                                </a>
                            </li>
                        </ul>
                        <!-- /tab navigation -->

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('property.store')}}" enctype="multipart/form-data">

                        {{ csrf_field()}}

                            <!-- Tab Content -->
                            <div class="tab-content">

                                    <!-- Tab Pane basic info-->
                                <div id="tab-pane-1" class="tab-pane active">
                                    <div class="card-body">


                                        <!-- Form Group -->
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
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
                                                                        <option value="{{$category->id}},{{$subCategory->id}}"  {{ old('property_type') === $category->id.','.$subCategory->id  ? 'selected' : '' }}> {{$category->name}} : {{$subCategory->name}}</option>
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
                                                        <input type="number" min="1" class="form-control" id="area_size" name="area_size" value="{{old('area_size')}}"
                                                               placeholder="Enter area size">
                                                        <small  class="form-text">
                                                            Example Vlaue: 25000
                                                        </small>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="area_size_postfix" class="label-color">Area Size Postfix</label>
{{--
                                                        <input name="area_size_postfix" id="area_size_postfix" type="text" value="{{old('area_size_postfix')}}" class="form-control"
                                                               placeholder="Example: sq ft">--}}

                                                        <select name="area_size_postfix" id="area_size_postfix" class="form-control js-example-basic-single" >

                                                            <option selected disabled>Select Area Size Postfix</option>

                                                            @foreach($areaPostfix as $postfix)

                                                                <option value="{{$postfix}}"  {{ old('area_size_postfix') == $postfix? 'selected' : '' }}> {{$postfix}}</option>

                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>

                                            {{--<div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="lot_size">Lot Size (Only digits)</label>
                                                        <input type="number" min="1" class="form-control" id="lot_size" name="lot_size" value="{{old('lot_size')}}"
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
                                            </div>--}}

                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="bedrooms">Bedrooms</label>
                                                        <input type="number" min="1" class="form-control" id="bedrooms" name="bedrooms" value="{{old('bedrooms')}}"
                                                               placeholder="Enter Number Of Bedrooms">
                                                        <small  class="form-text">
                                                            Example Value: 4
                                                        </small>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="bathrooms" class="label-color">Bathrooms</label>

                                                        <input id="bathrooms" type="number" min="1" value="{{old('bathrooms')}}" class="form-control" name="bathrooms"
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
                                                        <input type="number" min="1" class="form-control" id="garages" name="garages" value="{{old('garages')}}"
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
                                                <div class="form-group">
                                                    <label for="front_face">Front Face</label>
                                                    <input type="text" class="form-control" id="garages" name="front_face" value="{{old('front_face')}}"
                                                           placeholder="Enter Front Face">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <div class="form-group">
                                                    <label for="back_face" class="label-color">Back Face</label>

                                                    <input id="back_face" type="text" value="{{old('back_face')}}" class="form-control" name="back_face"
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
                                                            <input type="file" class="custom-file-input upload_img1" name="featured_image upload_img" id="inputGroupFile01">
                                                            <label class="custom-file-label" for="inputGroupFile01">Choose featured image</label>
                                                        </div>
                                                    </div>

                                                    <div id="image_preview1">

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
                                                                   name="property_features[]" id="{{$propertyFeature->title}}" value="{{$propertyFeature->id}}"
                                                                   class="custom-control-input"
                                                                   @if(is_array(old('property_features')) && in_array($propertyFeature->id,old('property_features'))) checked @endif
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
                                                    @php($oldFields = session('oldFields'))

                                                    @if(isset($oldFields) && count($oldFields)> 0 )

                                                        @foreach($oldFields as $field)
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
                                                        <input class="form-control" name="additional_features[]" type="text" placeholder="Type something" />
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-success btn-add" type="button">
                                                                <span class="fa fa-plus"></span>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- /form group -->

                                      {{--  <div class="form-group">
                                            <label for="garage_num">Status</label>

                                            <!-- Checkbox -->
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" id="status"
                                                       name="status"
                                                       class="custom-control-input"  {{old('status') ? 'checked' : ''}}>
                                                <label class="custom-control-label" for="status">Active</label>
                                            </div>
                                            <!-- /checkbox -->
                                        </div>--}}

                                            <button class="btn btn-primary btn-back-next" data-btn-type="next" href="#tab-pane-2">Next</button>

                                    </div>
                                </div>
                                <!-- /tab pane-->


                                <!-- Tab Pane more info-->
                                <div id="tab-pane-2" class="tab-pane">
                                    @include('admin.pages.property.property.more-info.new-info')
                                </div>

                                <!-- Tab Pane map-->
                                <div id="tab-pane-3" class="tab-pane">
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
                                                        <label for="address">Address</label>

                                                        <input id="address" name="address" value="{{old('address') ? old('address') : 'Kathmandu, Nepal'}}" class="form-control controls" type="text" placeholder="Enter Address">

                                                    </div>
                                                    <!-- /form group -->
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="province">Province</label>

                                                        <select class="form-control" name="province" id="province">
                                                            <option value="" selected disabled>Choose...</option>
                                                            @foreach($provinces as $province)
                                                                <option data-provinceurl="{{route('province.districts',$province->id)}}" value="{{$province->id}}" {{old('province') == $province->id ? 'selected' : ''}}>
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
                                                        </select>
                                                    </div>
                                                    <!-- /form group -->
                                                </div>

                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label for="municipal">Municipality*</label>

                                                        <select class="form-control" name="municipal" id="municipal">
                                                            <option value="" selected disabled>Choose...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <!-- Form Group -->
                                                    <div class="form-group">
                                                        <label for="latitude">Latitude</label>
                                                        <input type="text" class="form-control lat-long" id="latitude" name="latitude" value="{{ old('latitude') ? old('latitude'): '28.3949' }}"
                                                               placeholder="Enter Latitude">
                                                    </div>
                                                    <!-- /form group -->
                                                </div>
                                                <div class="col-xl-6">
                                                    <!-- Form Group -->
                                                    <div class="form-group">
                                                        <label for="longitude">Longitude</label>
                                                        <input type="text" class="form-control lat-long" id="longitude" name="longitude" value="{{ old('longitude') ? old('longitude') : '84.1240' }}"
                                                               placeholder="Enter Longitude">
                                                    </div>
                                                    <!-- /form group -->
                                                </div>
                                            </div>

                                            <button class="btn btn-primary btn-back-next"  href="#tab-pane-2">Back</button>


                                            <button class="btn btn-primary btn-back-next" data-btn-type="next"  href="#tab-pane-4">Next</button>
                                        </div>
                                    </div>

                                </div>
                                <!-- /tab pane-->

                                <!-- Tab Pane gallery-->
                                <div id="tab-pane-4" class="tab-pane">
                                    <div class="card-body">

                                        <div class="image-upload-wrap">
                                            <input class="file-upload-input" type='file' id="upload_file" name="gallery_images[]" accept="image/*" multiple/>
                                            <div class="drag-text">
                                                <h3>Drag and drop a file or select add Image</h3>
                                            </div>
                                        </div>

                                        <div id="image_preview"></div>


                                        <button class="btn btn-primary btn-back-next" href="#tab-pane-3">Back</button>


                                        <button class="btn btn-primary float-right" type="submit">Create Property</button>

                                    </div>
                                </div>
                                <!-- /tab pane-->



                            </div>
                            <!-- /tab content -->

                        </form>

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

   @include('admin.pages.property.property.property-scripts')

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

               //console.log(options);

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


   <!--multi step form for create scripts-->
   <script>
       $(document).ready(function () {

           $('select').on('click',function () {
               $(this).removeClass('error');
           });
           //tab change..multi step form
           $('.btn-back-next').on('click',function (e) {

               e.preventDefault();

               let form = $('#form');

               let isNextBtn= $(this).attr("data-btn-type");

               let hrefValue =  $(this).attr('href');

               let navSelector ='.nav-tabs li.nav-item a';

               // For some browsers, `attr` is undefined; for others,
               // `attr` is false.  Check for both.
               //if next button then only need to validate...no need to validate back button
               if (isNextBtn==="next" && typeof isNextBtn !== typeof undefined && isNextBtn !== false ) {
                   if(form.valid() === true){

                       //console.log( $(navSelector+'[href="' +hrefValue+ '"]'));
                       //$('.nav-tabs li a[href="' + $(this).attr('href') + '"]').trigger('click');

                       // $('.nav-tabs li.nav-item a[href="' +hrefValue+ '"]').tab('show');
                       //$('.nav-tabs li.nav-item a[href="' +hrefValue+ '"]').trigger('click');

                       $(navSelector+'[href="' +hrefValue+ '"]').removeClass('disabled');

                       //tab change
                       changeTab(navSelector,hrefValue);

                       //scrolltop
                       $("html, body").animate({ scrollTop: 0 }, 100);
                       // $( "html, body" ).scrollTop(300);
                   }
                   else {
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

@endpush
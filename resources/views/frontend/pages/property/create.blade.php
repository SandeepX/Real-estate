@extends('frontend.layouts.search-master')
@section('title','Property')
@section('content')
    <section class="user-dashboard bg-grey">
        <div class="container-fluid">
            <div class="row">

                @include('frontend.pages.partials.user-navigation')

                <div class="col-lg-10">
                    <div class="dashboard-content-right">
                        <h4>Post Property</h4>
                        <div class="dashboard-content-info">
                            <div class="row">
                                <div class="col-lg-3 p-r-0">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                         aria-orientation="vertical">
                                        <a class="nav-link active" id="user-basic-info" data-toggle="pill"
                                           href="#user-basic-info-id" role="tab" aria-controls="user-basic-info-id"
                                           aria-selected="true">Basic Information</a>
                                        <a class="nav-link" id="user-more-info" data-toggle="pill"
                                           href="#user-more-info-id" role="tab" aria-controls="user-basic-info-id"
                                           aria-selected="true">More Information</a>
                                        <a class="nav-link" id="user-location-info" data-toggle="pill"
                                           href="#user-location-id" role="tab" aria-controls="user-location-id"
                                           aria-selected="false">Location</a>
                                        <a class="nav-link" id="user-photo-gallery" data-toggle="pill"
                                           href="#user-photo-gallery-id" role="tab"
                                           aria-controls="user-photo-gallery-id" aria-selected="false">Property
                                            Gallery</a>
                                    </div>
                                </div>
                                <div class="col-lg-9 p-l-0">

                                @include('partials.messages')
                                <!-- Form -->
                                    <form id="property_form" method="post" action="{{route('user.property.store')}}"
                                          enctype="multipart/form-data">

                                        {{ csrf_field()}}

                                        <div class="tab-content" id="v-pills-tabContent">

                                            <div class="tab-pane fade show active post-prop-wrapper"
                                                 id="user-basic-info-id" role="tabpanel"
                                                 aria-labelledby="user-basic-info">
                                                <div class="row">

                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Property Title</label>
                                                            <input type="text" class="form-control" name="title"
                                                                   value="{{ old('title') }}"
                                                                   placeholder="Property Title">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group select-edit-css">
                                                            <label for="property_type">Property Type</label>
                                                            <select name="property_type" id="property_type"
                                                                    class="form-control js-example-basic-single">
                                                                <option selected disabled>Select Property Type</option>

                                                                @foreach($propertyCategories as $category)

                                                                    <optgroup label="{{$category->name}}">
                                                                        @forelse($category->propertySubCategories as $subCategory)
                                                                            <option value="{{$category->id}},{{$subCategory->id}}" data-subcat="{{$subCategory->slug}}"
                                                                                    {{ old('property_type') === $category->id.','.$subCategory->id  ? 'selected' : '' }}>
                                                                                {{$category->name}}
                                                                                : {{$subCategory->name}}
                                                                            </option>
                                                                        @empty
                                                                            <p class="text-center">Zero Type</p>
                                                                        @endforelse

                                                                    </optgroup>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group select-edit-css">
                                                            <label>Property Status</label>

                                                            <select name="property_status" id="property_status"
                                                                    class="form-control js-example-basic-single">

                                                                <option selected disabled>Select Property Status
                                                                </option>

                                                                @foreach($propertyStatus as $status)

                                                                    <option value="{{$status->id}}" {{ old('property_status') == $status->id? 'selected' : '' }}> {{$status->title}}</option>

                                                                    <p class="text-center">Zero Type</p>


                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Property Description</label>
                                                            <textarea class="form-control" id="summernote"
                                                                      name="description"
                                                                      placeholder="Short Description">{{ old('description') }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="price">Sale or Rent Price (Only digits)</label>
                                                            <input type="number" min="1" class="form-control" id="price"
                                                                   name="price" value="{{old('price')}}"
                                                                   placeholder="Enter Price">
                                                            <small class="form-text">
                                                                Example Value: 435000
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">

                                                            <label for="price_postfix">Price Postfix</label>

                                                            <input id="price_postfix" type="text"
                                                                   value="{{old('price_postfix')}}" class="form-control"
                                                                   name="price_postfix"
                                                                   placeholder="Example: Per Month">

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="area_size">Area Size (Only digits)</label>
                                                            <input type="number" min="1" class="form-control"
                                                                   id="area_size" name="area_size"
                                                                   value="{{old('area_size')}}"
                                                                   placeholder="Enter area size">
                                                            <small class="form-text">
                                                                Example Value: 25000
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group prop-hei-size">

                                                            <label for="area_size_postfix">Area Size Postfix</label>

                                                            <select name="area_size_postfix" id="area_size_postfix"
                                                                    class="form-control js-example-basic-single">

                                                                <option selected disabled>Select Area Size Postfix
                                                                </option>

                                                                @foreach($areaPostfix as $postfix)

                                                                    <option value="{{$postfix}}" {{ old('area_size_postfix') == $postfix? 'selected' : '' }}> {{$postfix}}</option>

                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>

                                                    {{--<div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="lot_size">Lot Size (Only digits)</label>
                                                            <input type="number" min="1" class="form-control" id="lot_size" name="lot_size" value="{{old('lot_size')}}"
                                                                   placeholder="Enter lot size">
                                                            <small  class="form-text">
                                                                Example Value: 3000
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="lot_size_postfix">Lot Size Postfix</label>

                                                            <input id="lot_size_postfix" type="text" value="{{old('lot_size_postfix')}}" class="form-control" name="lot_size_postfix"
                                                                   placeholder="Example: sq ft">
                                                        </div>
                                                    </div>--}}

                                                    <div class="col-lg-6 col-md-6 col-sm-12 land_hide">
                                                        <div class="form-group">
                                                            <label for="bedrooms">Bedrooms</label>
                                                            <input type="number" min="1" class="form-control"
                                                                   id="bedrooms" name="bedrooms" value=""
                                                                   placeholder="Enter Number Of Bedrooms">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 land_hide">
                                                        <div class="form-group">
                                                            <label for="bathrooms" class="label-color">Bathrooms</label>

                                                            <input id="bathrooms" type="number" min="1"
                                                                   value="{{old('bathrooms')}}" class="form-control"
                                                                   name="bathrooms"
                                                                   placeholder="Enter Number Of Bathrooms">

                                                            <small class="form-text">
                                                                Example Value: 2
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 land_hide">
                                                        <div class="form-group">
                                                            <label for="garages">Garages</label>
                                                            <input type="number" min="1" class="form-control"
                                                                   id="garages" name="garages"
                                                                   value="{{old('garages')}}"
                                                                   placeholder="Enter Number Of Garages">
                                                            <small class="form-text">
                                                                Example Value: 2
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 land_hide">
                                                        <div class="form-group">
                                                            <label for="year_built" class="label-color">Year
                                                                Built</label>

                                                            <input id="year_built" type="text"
                                                                   value="{{old('year_built')}}" class="form-control"
                                                                   name="year_built"
                                                                   placeholder="Enter year it was built">

                                                            <small class="form-text">
                                                                Example Value: 2019 A.D
                                                            </small>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="front_face">Front Face</label>
                                                            <input type="text" class="form-control" id="front_face"
                                                                   name="front_face" value="{{old('front_face')}}"
                                                                   placeholder="Enter Front Face">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="back_face" class="label-color">Back Face</label>

                                                            <input id="back_face" type="text"
                                                                   value="{{old('back_face')}}" class="form-control"
                                                                   name="back_face"
                                                                   placeholder="Enter Back Face">

                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label>Featured Image</label>
                                                        <div class="input-group mb-3">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input upload_img1"
                                                                       name="featured_image" id="uploaded_image"
                                                                       accept="image/*">
                                                                <label class="custom-file-label" for="uploaded_image">Upload
                                                                    image</label>
                                                            </div>
                                                        </div>


                                                        <div id="image_preview1">

                                                        </div>
                                                    </div>



                                                    @if($propertyFeatures->count() > 0)
                                                            <div class="col-lg-12 land_hide">
                                                                <div class="form-group m-b-10">
                                                                    <label for="garage_num" class="m-b-0">Property
                                                                        Features</label>
                                                                </div>
                                                            </div>

                                                        @foreach($propertyFeatures as $propertyFeature)

                                                            <!-- Checkbox -->
                                                                <div class="col-lg-3 col-md-6 col-sm-6 land_hide">
                                                                    <div class="custom-control custom-checkbox feature-label">
                                                                        <input type="checkbox" class="custom-control-input"
                                                                               name="property_features[]"
                                                                               id="{{$propertyFeature->title}}"
                                                                               value="{{$propertyFeature->id}}"
                                                                               @if(is_array(old('property_features')) && in_array($propertyFeature->id,old('property_features'))) checked @endif
                                                                        >
                                                                        <label class="custom-control-label"
                                                                               for="{{$propertyFeature->title}}">{{$propertyFeature->title}}</label>
                                                                    </div>
                                                                </div>
                                                                <!-- /checkbox -->
                                                            @endforeach

                                                    @endif

                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Additional Features</label>
                                                            <div class="fields">
                                                                @php($oldFields = session('oldFields'))

                                                                @if(isset($oldFields) && count($oldFields)> 0 )

                                                                    @foreach($oldFields as $field)
                                                                        <div class="entry input-group col-xs-3 m-t-10">
                                                                            <input class="form-control delete-feild-input"
                                                                                   name="additional_features[]"
                                                                                   value="{{$field}} " type="text"
                                                                                   placeholder="Type something"/>
                                                                            <span class="input-group-btn">
                                                                    <button class="btn btn-danger btn-remove"
                                                                            type="button">
                                                                        <span class="fa fa-minus"></span>
                                                                    </button>
                                                                </span>
                                                                        </div>
                                                                    @endforeach
                                                                @endif

                                                                <div class="entry input-group col-xs-3">
                                                                    <input class="form-control"
                                                                           name="additional_features[]" type="text"
                                                                           placeholder="Type something"/>
                                                                    <span class="input-group-btn">
                                                                <button class="btn btn-success btn-add" type="button">
                                                                    <span class="fa fa-plus"></span>
                                                                </button>
                                                            </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    {{--<div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="garage_num">Status</label>
                                                            <div class="custom-control custom-checkbox feature-label">
                                                                <input type="checkbox" id="status" name="status" class="custom-control-input" {{old('status') ? 'checked' : ''}}>
                                                                <label class="custom-control-label" for="status">Active</label>
                                                            </div>
                                                        </div>
                                                    </div>--}}

                                                    <div class="col-lg-12">
                                                        {{-- <a href="#user-location-id" class="btn post-prop-btn" data-toggle="pill" href="#user-location-id" role="tab">
                                                             NEXT
                                                         </a>--}}
                                                        <button class="btn post-prop-btn btn-back-next"
                                                                data-btn-type="next" href="#user-more-info-id">Next
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="user-more-info-id" role="tabpanel"
                                                 aria-labelledby="user-more-info">

                                                @include('frontend.pages.property.more-info.create-more-info')
                                            </div>

                                            <div class="tab-pane fade" id="user-location-id" role="tabpanel"
                                                 aria-labelledby="user-location-info">
                                                <div class="dashboard-map">
                                                    <div class="row">
                                                        <!-- <div class="col-lg-12"><h6>Locations</h6></div> -->
                                                        <div class="col-lg-12">
                                                            <div class="google-map-div">
                                                                <input id="pac-input"
                                                                       class="form-control controls google-search-input"
                                                                       type="text" placeholder="Search Address">
                                                                <a href="#" class="search-loca-a"><i
                                                                            class="fas fa-search-location"></i></a>
                                                            </div>

                                                            <div id="map-location"></div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="name">Address</label>

                                                                <input id="address" name="address"
                                                                       value="{{old('address') ? old('address') : 'Kathmandu, Nepal'}}"
                                                                       class="form-control controls" type="text"
                                                                       placeholder="Enter Address">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group select-edit-css">
                                                                <label for="province">Province*</label>
                                                                <div class="dropdown bootstrap-select search-fields">
                                                                    <select class="form-control" name="province"
                                                                            id="province">
                                                                        <option value="" selected disabled>Choose...
                                                                        </option>
                                                                        @foreach($provinces as $province)
                                                                            <option data-provinceurl="{{route('province.districts',$province->id)}}"
                                                                                    value="{{$province->id}}" {{old('province') == $province->id ? 'selected' : ''}}>
                                                                                {{$province->province_name}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group select-edit-css">
                                                                <label for="district">District*</label>
                                                                <div class="dropdown bootstrap-select search-fields">
                                                                    <select class="form-control" name="district"
                                                                            id="district">
                                                                        <option value="" selected disabled>Choose...
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Municipality*</label>
                                                                <div class="dropdown bootstrap-select search-fields">
                                                                    <select class="form-control" name="municipal"
                                                                            id="municipal">
                                                                        <option value="" selected disabled>Choose...
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="name">Latitude</label>
                                                                <input type="text" class="form-control lat-long"
                                                                       id="latitude" name="latitude"
                                                                       value="{{ old('latitude') ? old('latitude'): '28.3949' }}"
                                                                       placeholder="Enter Latitude">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="name">Longitude</label>
                                                                <input type="text" class="form-control lat-long"
                                                                       id="longitude" name="longitude"
                                                                       value="{{ old('longitude') ? old('longitude') : '84.1240' }}"
                                                                       placeholder="Enter Longitude">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <button class="btn post-prop-btn btn-back-next"
                                                                    data-btn-type="prev" href="#user-basic-info-id">Prev
                                                            </button>

                                                            <button class="btn post-prop-btn btn-back-next"
                                                                    data-btn-type="next" href="#user-photo-gallery-id">
                                                                Next
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="user-photo-gallery-id" role="tabpanel"
                                                 aria-labelledby="user-photo-gallery">
                                                <div class="dashboard-gallery">
                                                    <div class="col-lg-12">
                                                        <div class="image-upload-wrap">
                                                            <input class="file-upload-input" type='file'
                                                                   id="upload_file" name="gallery_images[]"
                                                                   accept="image/*" multiple/>
                                                            <div class="drag-text">
                                                                <h3>Drag and drop a file or Click here</h3>
                                                            </div>
                                                        </div>
                                                        <div class="image_preview"></div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button class="btn post-prop-btn btn-back-next"
                                                                data-btn-type="prev" href="#user-location-id">Prev
                                                        </button>
                                                        <button class="btn post-prop-btn" type="submit">Create</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-copyright">
                        @include('frontend.pages.partials.search-master-footer')
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')

    @include('frontend.pages.property.feproperty-scripts')

    @include('frontend.pages.property.create-scripts')

    @include('scipts.property-scritps')

@endpush

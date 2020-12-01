<div class="dashboard-content-info">
    <div class="row">
        <div class="col-lg-3 p-r-0">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="user-basic-info" data-toggle="pill" href="#user-basic-info-id" role="tab" aria-controls="user-basic-info-id" aria-selected="true">Basic Information</a>
                <a class="nav-link" id="user-location-info" data-toggle="pill" href="#user-location-id" role="tab" aria-controls="user-location-id" aria-selected="false">Location</a>
                <a class="nav-link" id="user-photo-gallery" data-toggle="pill" href="#user-photo-gallery-id" role="tab" aria-controls="user-photo-gallery-id" aria-selected="false">Property Gallery</a>
            </div>
        </div>
        <div class="col-lg-9 p-l-0">
            <!-- Form -->
            <form id="property_edit_form" method="post" action="{{route('user.property.update',$property->slug)}}"
                  enctype="multipart/form-data">

                {{ csrf_field()}}

                <input type="hidden" name="_method" value="PUT">

                <div class="tab-content" id="v-pills-tabContent">

                    <div class="tab-pane fade show active post-prop-wrapper" id="user-basic-info-id" role="tabpanel" aria-labelledby="user-basic-info">
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Property Title</label>
                                    <input type="text" class="form-control" name="title" value="{{$property->title }}" placeholder="Property Title">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group select-edit-css">
                                    <label for="property_type">Property Type</label>

                                    <select name="property_type" id="property_type"  class="form-control js-example-basic-single"  >
                                        <option selected disabled>Select Property Type</option>

                                        @foreach($propertyCategories as $category)

                                            <optgroup label="{{$category->name}}">
                                                @forelse($category->propertySubCategories as $subCategory)
                                                    <option value="{{$category->id}},{{$subCategory->id}}" data-subcat="{{$subCategory->slug}}"
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

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group select-edit-css">
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

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Property Description</label>
                                    <textarea class="form-control summernote"  name="description" placeholder="Short Description">{{$property->description}}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="price">Sale or Rent Price (Only digits)</label>
                                    <input type="number" min="1" class="form-control" id="price" name="price" value="{{$property->price}}"
                                           placeholder="Enter Price">
                                    <small  class="form-text">
                                        Example Vlaue: 435000
                                    </small>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">

                                    <label for="price_postfix">Price Postfix</label>

                                    <input id="price_postfix" type="text" value="{{$property->price_postfix}}" class="form-control" name="price_postfix"
                                           placeholder="Example: Per Month">

                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="area_size">Area Size (Only digits)</label>
                                    <input type="number" min="1" class="form-control" id="area_size" name="area_size" value="{{$property->area_size}}"
                                           placeholder="Enter area size">
                                    <small  class="form-text">
                                        Example Vlaue: 25000
                                    </small>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">

                                    <label for="area_size_postfix">Area Size Postfix</label>

                                    <select name="area_size_postfix" id="area_size_postfix" class="form-control js-example-basic-single" >

                                        <option selected disabled>Select Area Size Postfix</option>

                                        @foreach($areaPostfix as $postfix)

                                            <option value="{{$postfix}}"  {{$property->area_size_postfix == $postfix? 'selected' : '' }}> {{$postfix}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                           {{-- <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="lot_size">Lot Size (Only digits)</label>
                                    <input type="number" min="1" class="form-control" id="lot_size" name="lot_size" value="{{$property->lot_size}}"
                                           placeholder="Enter lot size">
                                    <small  class="form-text">
                                        Example Vlaue: 3000
                                    </small>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="lot_size_postfix">Lot Size Postfix</label>

                                    <input id="lot_size_postfix" type="text" value="{{$property->lot_size_postfix}}" class="form-control" name="lot_size_postfix"
                                           placeholder="Example: sq ft">
                                </div>
                            </div>--}}

                            <div class="col-lg-6 col-md-6 col-sm-12 land_hide">
                                <div class="form-group">
                                    <label for="bedrooms">Bedrooms</label>
                                    <input type="number" min="1" class="form-control" id="bedrooms" name="bedrooms" value="{{$property->bedrooms}}"
                                           placeholder="Enter Number Of Bedrooms">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 land_hide">
                                <div class="form-group">
                                    <label for="bathrooms" class="label-color">Bathrooms</label>

                                    <input id="bathrooms" type="number" min="1" value="{{$property->bathrooms}}" class="form-control" name="bathrooms"
                                           placeholder="Enter Number Of Bathrooms">

                                    <small  class="form-text">
                                        Example Value: 2
                                    </small>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 land_hide">
                                <div class="form-group">
                                    <label for="garages">Garages</label>
                                    <input type="number" min="1" class="form-control" id="garages" name="garages" value="{{$property->garages}}"
                                           placeholder="Enter Number Of Garages">
                                    <small  class="form-text">
                                        Example Value: 2
                                    </small>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 land_hide">
                                <div class="form-group">
                                    <label for="year_built" class="label-color">Year Built</label>

                                    <input id="year_built" type="text" value="{{$property->year_built}}" class="form-control" name="year_built"
                                           placeholder="Enter year it was built">

                                    <small  class="form-text">
                                        Example Value: 2019 A.D
                                    </small>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="front_face">Front Face</label>
                                    <input type="text" class="form-control" id="garages" name="front_face" value="{{$property->front_face}}"
                                           placeholder="Enter Front Face">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="back_face" class="label-color">Back Face</label>

                                    <input id="back_face" type="text" value="{{$property->back_face}}" class="form-control" name="back_face"
                                           placeholder="Enter Back Face">

                                </div>
                            </div>

                            <div class="col-xl-6">
                                <label>Featured Image</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input upload_img1" name="featured_image" id="uploaded_image" accept="image/*">
                                        <label class="custom-file-label" for="uploaded_image">Upload image</label>
                                    </div>
                                </div>
                                <div id="image_preview1">

                                </div>

                                @if(isset($property->featured_image))
                                    <div class="db_images">

                                        <a class='parent_images'>
                                            <i data-url="{{route('user.property.single.images.destroy',$property->id)}}" class='remove-db-img fa fa-times' ></i>
                                            <img class='img'  src="{{asset('common/images/'.$property->featured_image)}}">
                                        </a>

                                    </div>

                                @endif



                            </div>

                            @if($propertyFeatures->count() > 0)

                                    <div class="col-lg-12 land_hide">
                                        <div class="form-group m-b-10">
                                            <label for="garage_num" class="m-b-0">Property Features</label>
                                        </div>
                                    </div>

                                @foreach($propertyFeatures as $propertyFeature)

                                    <!-- Checkbox -->
                                        <div class="col-lg-3 col-md-6 col-sm-6 land_hide">
                                            <div class="custom-control custom-checkbox feature-label">
                                                <input type="checkbox" class="custom-control-input" name="property_features[]" id="{{$propertyFeature->title}}" value="{{$propertyFeature->id}}"
                                                       @if(is_array($featuresOfProperty) && in_array($propertyFeature->id,$featuresOfProperty)) checked @endif
                                                >
                                                <label class="custom-control-label"  for="{{$propertyFeature->title}}">{{$propertyFeature->title}}</label>
                                            </div>
                                        </div>
                                        <!-- /checkbox -->
                                    @endforeach

                            @endif

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Additional Features</label>
                                    <div class="fields">
                                        @if(isset($additionalFeatures) && count($additionalFeatures)> 0 )

                                            @foreach($additionalFeatures as $field)
                                                <div class="entry input-group col-xs-3">
                                                    <input class="form-control delete-feild-input" name="additional_features[]" value="{{$field}} " type="text" placeholder="Type something" />
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
                            </div>


                         {{--   <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="garage_num">Status</label>
                                    <div class="custom-control custom-checkbox feature-label">
                                        <input type="checkbox" id="status" name="status" class="custom-control-input" {{$property->status === 1 ? 'checked' : ''}}>
                                        <label class="custom-control-label" for="status">Active</label>
                                    </div>
                                </div>
                            </div>--}}

                            <div class="col-lg-12">

                                <button class="btn post-prop-btn btn-back-next" data-btn-type="next"  href="#user-location-id">Next</button>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="user-location-id" role="tabpanel" aria-labelledby="user-location-info">
                        <div class="dashboard-map">
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="google-map-div">
                                        <input id="pac-input" class="form-control controls google-search-input" type="text" placeholder="Search Address">
                                        <a href="#" class="search-loca-a"><i class="fas fa-search-location"></i></a>
                                    </div>

                                    <div id="map-location"></div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Address</label>

                                        <input id="address" name="address" value="{{$propertyAddress? $propertyAddress->address : ''}}"
                                               class="form-control controls" type="text" placeholder="Enter Address">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="province">Province*</label>
                                        <div class="dropdown bootstrap-select search-fields">
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

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="district">District*</label>
                                        <div class="dropdown bootstrap-select search-fields">
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
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Municipality*</label>
                                        <div class="dropdown bootstrap-select search-fields">
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

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Latitude</label>
                                        <input type="text" class="form-control lat-long" id="latitude" name="latitude"
                                               value="{{$propertyAddress  && $propertyAddress->latitude ? $propertyAddress->latitude : '28.3949'}}"
                                               placeholder="Enter Latitude">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Longitude</label>
                                        <input type="text" class="form-control lat-long" id="longitude" name="longitude"
                                               value="{{$propertyAddress  && $propertyAddress->longitude ? $propertyAddress->longitude : '84.1240'}}"
                                               placeholder="Enter Longitude">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <button class="btn post-prop-btn btn-back-next" data-btn-type="prev"  href="#user-basic-info-id">Prev</button>

                                    <button class="btn post-prop-btn btn-back-next" data-btn-type="next"  href="#user-photo-gallery-id">Next</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="user-photo-gallery-id" role="tabpanel" aria-labelledby="user-photo-gallery">
                        <div class="dashboard-gallery">
                            <div class="col-lg-12">

                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" type='file' id="upload_file" name="gallery_images[]" accept="image/*" multiple/>
                                    <div class="drag-text">
                                        <h3>Drag and drop a file or Click here</h3>
                                    </div>
                                </div>
                                <div class="image_preview"></div>

                                <div id="blank">
                                    @if(count($propertyImages) > 0)
                                        <div class="db_images">
                                            <hr>
                                            @foreach($propertyImages as $image)
                                                <a class='parent_images'>
                                                    <i data-url="{{route('user.property.images.destroy',$image->id)}}" class='remove-db-img fa fa-times' ></i>
                                                    <img class='img'  src="{{asset('common/images/'.$image->image)}}">
                                                </a>
                                            @endforeach
                                        </div>

                                    @endif
                                </div>

                            </div>
                            <div class="col-lg-12">
                                <button class="btn post-prop-btn btn-back-next" data-btn-type="prev" href="#user-location-id">Prev</button>
                                <button class="btn post-prop-btn" type="submit">Update</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
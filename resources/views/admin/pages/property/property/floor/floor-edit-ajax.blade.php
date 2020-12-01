<form id="floor_edit_form" method="post" action="{{route('floors.update',[$property->id,$floor->id])}}" enctype="multipart/form-data">

{{ csrf_field()}}

    <input type="hidden" name="_method" value="PUT">

<!-- Form Group -->
    <div class="form-group">
        <label for="floor_title">Title</label>
        <input type="text" class="form-control" id="floor_title" name="floor_title" value="{{ $floor->floor_title }}"
               placeholder="Enter Property Title">
        <span class="text-danger">{{ $errors->first('floor_title') }}</span>
    </div>
    <!-- /form group -->

    <!-- Form Group -->
    <div class="form-group">
        <label for="floor_description">Description</label>
        <textarea class="form-control" id="summernote" rows="3" name="floor_description" placeholder="Short Description">{{ $floor->floor_description}}</textarea>
    </div>
    <!-- /form group -->

    <div class="row">
        <div class="col-xl-6">
            <div class="form-group">
                <label for="floor_price">Sale or Rent Price (Only digits)</label>
                <input type="number" min="0" class="form-control" id="floor_price" name="floor_price" value="{{$floor->floor_price}}"
                       placeholder="Enter Price">
                <small  class="form-text">
                    Example Vlaue: 435000
                </small>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="form-group">
                <label for="floor_price_postfix" class="label-color">Price Postfix</label>

                <input id="floor_price_postfix" type="text" value="{{$floor->floor_price_postfix}}" class="form-control" name="floor_price_postfix"
                       placeholder="Example: Per Month">

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="form-group">
                <label for="floor_area_size">Area Size (Only digits)</label>
                <input type="number" min="0" class="form-control" id="floor_area_size" name="floor_area_size" value="{{$floor->floor_area_size}}"
                       placeholder="Enter area size">
                <small  class="form-text">
                    Example Vlaue: 25000
                </small>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="form-group">
                <label for="floor_area_size_postfix" class="label-color">Area Size Postfix</label>

                <input name="floor_area_size_postfix" id="floor_area_size_postfix" type="text" value="{{$floor->floor_area_size_postfix}}" class="form-control"
                       placeholder="Example: sq ft">

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-6">
            <div class="form-group">
                <label for="floor_bedrooms">Bedrooms</label>
                <input type="number" min="0" class="form-control" id="floor_bedrooms" name="floor_bedrooms" value="{{$floor->floor_bedrooms}}"
                       placeholder="Enter Number Of Bedrooms">
                <small  class="form-text">
                    Example Value: 4
                </small>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="form-group">
                <label for="floor_bathrooms" class="label-color">Bathrooms</label>

                <input id="floor_bathrooms" type="number" min="0" value="{{$floor->floor_bathrooms}}" class="form-control" name="floor_bathrooms"
                       placeholder="Enter Number Of Bathrooms">

                <small  class="form-text">
                    Example Value: 2
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
                    <input type="file" class="custom-file-input" name="floor_image" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose image</label>
                </div>
            </div>
        </div>


    </div>


    <button class="btn btn-primary" type="submit">Update Floor</button>

</form>

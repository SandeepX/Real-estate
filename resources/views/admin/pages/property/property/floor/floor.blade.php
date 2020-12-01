<div class="tabs-container tabs-vertical">

    <!-- Tab Navigation -->
    <!-- Tab Navigation -->
    <ul class="nav nav-tabs flex-column" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#add_floor" role="tab"
               aria-controls="tab-pane-1" aria-selected="true">Add Floor
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="nav-all-floor" data-toggle="tab" href="#all_floor" role="tab"
               aria-controls="tab-pane-2" aria-selected="true" >All Floor
            </a>
        </li>
    </ul>
    <!-- /tab navigation -->


    <!-- Tab Content -->
        <div class="tab-content">

            <!-- Tab Pane add floor-->
            <div id="add_floor" class="tab-pane active">
                <div class="card-body">
                    <!-- Form -->
                    <form id="floor_form" method="post" action="{{route('floors.store',$property->id)}}" enctype="multipart/form-data">

                    {{ csrf_field()}}

                    <!-- Form Group -->
                    <div class="form-group">
                        <label for="floor_title">Title</label>
                        <input type="text" class="form-control" id="floor_title" name="floor_title" value="{{ old('floor_title') }}"
                               placeholder="Enter Floor Title">
                        <span class="text-danger">{{ $errors->first('floor_title') }}</span>
                    </div>
                    <!-- /form group -->

                    <!-- Form Group -->
                    <div class="form-group">
                        <label for="floor_description">Description</label>
                        <textarea class="form-control" id="summernote" rows="3" name="floor_description" placeholder="Short Description">{{ old('floor_description') }}</textarea>
                    </div>
                    <!-- /form group -->

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="floor_price">Sale or Rent Price (Only digits)</label>
                                <input type="number" min="1" class="form-control" id="floor_price" name="floor_price" value="{{old('floor_price')}}"
                                       placeholder="Enter Floor Price">
                                <small  class="form-text">
                                    Example Vlaue: 435000
                                </small>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="floor_price_postfix" class="label-color">Price Postfix</label>

                                <input id="floor_price_postfix" type="text" value="{{old('floor_price_postfix')}}" class="form-control" name="floor_price_postfix"
                                       placeholder="Example: Per Month">

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="floor_area_size">Area Size (Only digits)</label>
                                <input type="number" min="1" class="form-control" id="floor_area_size" name="floor_area_size" value="{{old('floor_area_size')}}"
                                       placeholder="Enter area size">
                                <small  class="form-text">
                                    Example Vlaue: 25000
                                </small>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="floor_area_size_postfix" class="label-color">Area Size Postfix</label>

                                <input name="floor_area_size_postfix" id="floor_area_size_postfix" type="text" value="{{old('floor_area_size_postfix')}}" class="form-control"
                                       placeholder="Example: sq ft">

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="floor_bedrooms">Bedrooms</label>
                                <input type="number" min="0" class="form-control" id="floor_bedrooms" name="floor_bedrooms" value="{{old('floor_bedrooms')}}"
                                       placeholder="Enter Number Of Bedrooms">
                                <small  class="form-text">
                                    Example Value: 4
                                </small>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="form-group">
                                <label for="floor_bathrooms" class="label-color">Bathrooms</label>

                                <input id="floor_bathrooms" type="number" min="0" value="{{old('floor_bathrooms')}}" class="form-control" name="floor_bathrooms"
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


                    <button class="btn btn-primary" type="submit">Add Floor</button>

                    </form>

                </div>
            </div>
            <!-- /tab pane-->

            <!-- Tab Pane floor all-->
            <div id="all_floor" class="tab-pane">
                <div class="card-body">

                    <div id="floor-tab">
                        <!-- Tables -->
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($propertyFloors as $floor)
                                    <tr class="gradeX">

                                        <td>{{$floor->floor_title}}</td>
                                        <td>{!! str_limit(strip_tags($floor->floor_description), 80) !!}</td>

                                        <td>

                                            <div>
                                                <a  href="{{route('floors.edit',[$property->id,$floor->id])}}"  type="button" class="edit-button btn btn-xs btn-warning mr-2 mb-2">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <form class="confirm_delete{{$floor->id}}" action="{{route('floors.destroy',[$property->id,$floor->id])}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" data-id="{{$floor->id}}" class="btn btn-xs btn-danger mr-2 mb-2 parameter-alert">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </div>

                                        </td>

                                    </tr>
                                @empty
                                    <p class="text-center">
                                        No Records Found!
                                    </p>
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                        <!-- /tables -->
                    </div>

                    <div id="dynamic-content">

                    </div>

                </div>

            </div>
            <!-- /tab pane-->

        </div>
        <!-- /tab content -->


</div>
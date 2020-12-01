<div class="dashboard-content-info">
    <div class="row">
        <div class="col-lg-3 p-r-0">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="view-floor-plan" data-toggle="pill" href="#view-floor-plan-id" role="tab" aria-controls="view-floor-plan-id" aria-selected="false">All Floor</a>
                <a class="nav-link " id="add-floor-plan" data-toggle="pill" href="#add-floor-plan-id" role="tab" aria-controls="add-floor-plan-id" aria-selected="true">Add Floor Plan</a>
            </div>
        </div>

        <div class="col-lg-9 p-l-0">

            <div class="tab-content" id="v-pills-tabContent">

                <div class="tab-pane fade show active table-responsive" id="view-floor-plan-id" role="tabpanel" aria-labelledby="view-floor-plan">
                    <div id="floor-tab">
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
                                    {{--  <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac placerat lacus...</td>--}}
                                    <td>{!! str_limit(strip_tags($floor->floor_description), 80) !!}</td>

                                    <td>
                                        <ul class="floor-user-edit-ul">
                                            <li>
                                                <a class="edit-button" href="{{route('users.floors.edit',[$property->id,$floor->id])}}" title="edit"><i class="far fa-edit"></i></a>
                                            </li>
                                            <li>
                                                <form class="confirm_delete{{$floor->id}}" action="{{route('users.floors.delete',[$property->id,$floor->id])}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" data-id="{{$floor->id}}" class="deleteFloor parameter-alert"
                                                            onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="far fa-trash-alt" aria-hidden="true"></i>
                                                    </button>

                                                </form>
                                            </li>
                                        </ul>

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

                    <div id="dynamic-content">

                    </div>
                </div>

                <div class="tab-pane fade " id="add-floor-plan-id" role="tabpanel" aria-labelledby="add-floor-plan">
                    <form id="floor_form" method="post" action="{{route('users.floors.store',$property->id)}}" enctype="multipart/form-data">

                        {{ csrf_field()}}

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="floor_title">Title</label>
                                    <input type="text" class="form-control" id="floor_title" name="floor_title"
                                           value="{{ old('floor_title') }}"
                                           placeholder="Enter Floor Title">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="floor_description">Description</label>
                                    <textarea class="summernote form-control" rows="3" name="floor_description" placeholder="Short Description">{{old('floor_description')}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="floor_price">Sale or Rent Price (Only digits)</label>
                                    <input type="number" min="1" class="form-control" id="floor_price" name="floor_price" value="{{old('floor_price')}}"
                                           placeholder="Enter Floor Price">
                                    <small  class="form-text">
                                        Example Vlaue: 435000
                                    </small></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="floor_price_postfix" class="label-color">Price Postfix</label>
                                    <input id="floor_price_postfix" type="text" value="{{old('floor_price_postfix')}}" class="form-control" name="floor_price_postfix"
                                           placeholder="Example: Per Month">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="floor_area_size">Area Size (Only digits)</label>
                                    <input type="number" min="1" class="form-control" id="floor_area_size" name="floor_area_size" value="{{old('floor_area_size')}}"
                                           placeholder="Enter area size">
                                    <small  class="form-text">
                                        Example Vlaue: 25000
                                    </small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="floor_area_size_postfix" class="label-color">Area Size Postfix</label>
                                    <input name="floor_area_size_postfix" id="floor_area_size_postfix" type="text" value="{{old('floor_area_size_postfix')}}" class="form-control"
                                           placeholder="Example: sq ft">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="floor_bedrooms">Bedrooms</label>
                                    <input type="number" min="1" class="form-control" id="floor_bedrooms" name="floor_bedrooms" value="{{old('floor_bedrooms')}}"
                                           placeholder="Enter Number Of Bedrooms">
                                    <small  class="form-text">
                                        Example Value: 4
                                    </small>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="floor_bathrooms" class="label-color">Bathrooms</label>
                                    <input id="floor_bathrooms" type="number" min="0" value="{{old('floor_bathrooms')}}" class="form-control" name="floor_bathrooms"
                                           placeholder="Enter Number Of Bathrooms">

                                    <small  class="form-text">
                                        Example Value: 2
                                    </small>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label>Upload FLoor plan Image</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="floor_image" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Upload image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="send-btn">
                                    <button type="submit" class="btn btn-basic-info">Add Floor</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>


            </div>
        </div>
    </div>
</div>
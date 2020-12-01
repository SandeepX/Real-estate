@extends('admin.layout.master')

@section('title','Subcategories')

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
                    <li class="breadcrumb-item active"><a href="{{route('subcategories.index')}}">Sub Type</a></li>
                </ol>
                <!-- /breadcrumbs -->

            </div>
            <!-- /grid item -->

        </div>
        <!-- /grid breadcrumbs -->

        <!-- Page Header -->
        <div class="dt-page__header">

        </div>
        <!-- /page header -->

    @include('partials.messages')

    <!-- Grid -->
        <div class="row">

            <!-- Grid Item ,form-->
            <div class="col-xl-5">

                <!-- Card -->
                <div class="dt-card" id="dynamic-content">

                    <!-- Card Header -->
                    <div class="dt-card__header">

                        <!-- Card Heading -->
                        <div class="dt-card__heading">
                            <h3 class="dt-card__title">Create Property Subtype</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('subcategories.store')}}">

                        {{ csrf_field()}}

                        <!-- Form Group -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                       aria-describedby="emailHelp1"
                                       placeholder="Enter Subtype Name">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <!-- /form group -->

                            <div class="form-group">
                                <label for="category">Parent Property Type</label>

                                <select name="category[]" id="category" class="form-control js-example-basic-multiple" multiple required>
                                    @forelse($propertyCategories as $category)
                                        <option value="{{$category->id}}" {{ old('category') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                    @empty
                                        <option value="">Zero Parent Type Available!</option>
                                    @endforelse
                                </select>
                            </div>


                            <div class="form-group">

                                <!-- Checkbox -->
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" id="customcheckboxInline5"
                                           name="status"
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckboxInline5">Active</label>
                                </div>
                                <!-- /checkbox -->
                            </div>

                            <button class="btn btn-primary" type="submit">Create</button>


                        </form>
                        <!-- /form -->

                    </div>
                    <!-- /card body -->

                </div>
                <!-- /card -->

            </div>
            <!-- /grid item,form -->

            <!-- Grid Item ,table-->
            <div class="col-xl-7">
                <!-- Card -->
                <div class="dt-card">

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Tables -->
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Subtype Name</th>
                                    <th>Parent Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($propertySubCategories as $subCategory)
                                    <tr class="gradeX">
                                        <td>{{$subCategory->name}}</td>
                                        <td>
                                            @forelse($subCategory->propertyCategories as $category)
                                                <span class="badge badge-secondary"> {{$category->name}}</span>
                                                <br>
                                                <br>

                                            @empty
                                                <p class="text-center">Undefined</p>
                                            @endforelse
                                        </td>
                                        <td>
                                            <i class="fa {{$subCategory->status? 'fa-check' : 'fa-ban'}}" aria-hidden="true"></i>
                                        </td>

                                        <td style="">

                                            <div>
                                                <a  href="{{route('subcategories.edit',$subCategory->id)}}"  type="button" class="edit-button btn btn-xs btn-warning mr-2 mb-2">Edit
                                                </a>
                                                <form action="{{route('subcategories.destroy',$subCategory->id)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit"  class="btn btn-xs btn-danger mr-2 mb-2"  onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
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
                    <!-- /card body -->

                </div>
                <!-- /card -->
            </div>
            <!-- /grid item -->

        </div>
    </div>
@endsection

@push('scripts')

    <script src="{{asset('backend/assets/js/my-scripts/select2.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>


    <!--for data table-->
    <script src="{{asset('backend/node_modules/datatables.net/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('backend/assets/js/custom/data-table.js')}}"></script>


    <!--jquery validation-->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>

        $(document).ready(function () {

            $('#form').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true
                    },
                    category:{
                        required: true
                    }
                }
            });
        });
    </script>


@endpush
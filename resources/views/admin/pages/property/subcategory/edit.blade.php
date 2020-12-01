@extends('admin.layout.master')

@section('title','Subtype')

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
                    <li class="breadcrumb-item"><a href="{{route('subcategories.index')}}">Subtype</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('subcategories.edit',$propertySubCategory->id)}}">Edit</a></li>
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
            <div class="col-xl-12">

                <!-- Card -->
                <div class="dt-card" id="dynamic-content">

                    <!-- Card Header -->
                    <div class="dt-card__header">

                        <!-- Card Heading -->
                        <div class="dt-card__heading">
                            <h3 class="dt-card__title">Edit Subtype</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('subcategories.update',$propertySubCategory->id)}}">

                            {{ csrf_field()}}

                            <input type="hidden" name="_method" value="PUT">

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $propertySubCategory->name }}"
                                       aria-describedby="emailHelp1"
                                       placeholder="Enter Subtype Name" required>
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <!-- /form group -->

                            <div class="form-group">
                                <label for="category">Parent Property Type</label>

                                <select name="category[]" id="category" class="form-control js-example-basic-multiple" multiple required>

                                    @forelse($propertyCategories as $category)
                                        <option value="{{$category->id}}" {{$propertySubCategory->propertyCategories->contains($category->id)? 'selected' : '' }}>{{$category->name}}</option>
                                    @empty
                                        <option value="">Zero Parent Type Available!</option>
                                    @endforelse
                                </select>
                            </div>


                            <div class="form-group">

                                <!-- Checkbox -->
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" id="customcheckboxInline5"
                                           name="status" class="custom-control-input" {{$propertySubCategory->status ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="customcheckboxInline5">Active</label>
                                </div>
                                <!-- /checkbox -->
                            </div>

                            <button class="btn btn-primary" type="submit">Update</button>


                        </form>
                        <!-- /form -->

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

    <!--jquery validation-->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>

        $(document).ready(function () {

            $('#form').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true
                    }
                }
            });
        });
    </script>



@endpush
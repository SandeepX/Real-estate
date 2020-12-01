@extends('admin.layout.master')

@section('title','Edit Testimonial')

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
                    <li class="active breadcrumb-item"><a href="{{route('testimonials.index')}}">Testimonials</a> </li>
                    <li class="active breadcrumb-item"><a href="{{route('testimonials.edit',$testimonial->id)}}">Edit</a> </li>
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

            <!-- Grid Item ,form-->
            <div class="col-md-12 dt-masonry__item ">
                <!-- Card -->
                <div class="dt-card">

                    <!-- Card Header -->
                    <div class="dt-card__header">

                        <!-- Card Heading -->
                        <div class="dt-card__heading">
                            <h3 class="dt-card__title">Edit Testimonial</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('testimonials.update',$testimonial->id)}}" enctype="multipart/form-data">

                        {{ csrf_field()}}

                            <input type="hidden" name="_method" value="PUT">

                        <!-- Form Group -->
                            <div class="form-group">
                                <label for="client_name">Client Name</label>
                                <input type="text" class="form-control" id="client_name" name="client_name" value="{{$testimonial-> client_name}}"
                                       aria-describedby="emailHelp1"
                                       placeholder="Enter client full name">
                                <span class="text-danger">{{ $errors->first('client_name') }}</span>
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="client_name">Client Company</label>
                                <input type="text" class="form-control" id="client_company" name="client_company" value="{{ $testimonial->client_company }}"
                                       aria-describedby="emailHelp1"
                                       placeholder="Enter client company name">
                                <span class="text-danger">{{ $errors->first('client_company') }}</span>
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="client_position">Client Position</label>
                                <input type="text" class="form-control" id="client_position" name="client_position" value="{{ $testimonial-> client_position}}"
                                       aria-describedby="emailHelp1"
                                       placeholder="Enter client designation">
                                <span class="text-danger">{{ $errors->first('client_position') }}</span>
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="summernote">Client's Message</label>
                                <textarea class="form-control" id="summernote" rows="5" name="client_message" placeholder="">{{ $testimonial->client_message }}</textarea>
                            </div>
                            <!-- /form group -->

                            <div class="row">

                                <div class="col-xl-6">
                                    <!-- Input Group -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input upload_img" name="client_image" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose client's image</label>
                                        </div>
                                    </div>

                                    <div id="image_preview">

                                    </div>

                                    @if(isset($testimonial->client_image))
                                        <div class="db_images">

                                            <a class='parent_images'>
                                                <i data-url="{{route('testimonial.images.destroy',$testimonial->id)}}" class='remove-db-img fa fa-times' ></i>
                                                <img class='img'  src="{{asset('common/images/'.$testimonial->client_image)}}">
                                            </a>

                                        </div>

                                    @endif

                                </div>
                            </div>

                            <!-- /form group -->
                            <div class="form-group">

                                <!-- Checkbox -->
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" id="customcheckboxInline5"
                                           name="status"
                                           class="custom-control-input" {{$testimonial->status ==1 ? 'checked' : ''}}>
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
            </div>


        </div>

    </div>
@endsection

@push('scripts')

    @include('partials.image-preview-scripts')

    <!--jquery validation && wsiwyg editor-->
    @include('admin.pages.testimonials.testimonial-scripts')

@endpush
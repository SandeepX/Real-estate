@extends('admin.layout.master')

@section('title','Edit About')

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
                    <li class="active breadcrumb-item"><a href="{{route('admin.editAbout')}}">About-Us</a> </li>
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
                            <h3 class="dt-card__title">Edit About</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('admin.updateAbout')}}" enctype="multipart/form-data">

                            {{ csrf_field()}}

                            <input type="hidden" name="_method" value="PUT">

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$about->title}}"
                                       aria-describedby="emailHelp1"
                                       placeholder="Enter Title">
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="summernote">Message From CEO</label>
                                <textarea class="form-control summernote"  name="ceo_message" placeholder="">{{$about->ceo_message}}</textarea>
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="summernote">Overview</label>
                                <textarea class="form-control summernote"   name="overview" placeholder="">{{$about->overview}}</textarea>
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="summernote">Our Mission</label>
                                <textarea class="form-control summernote" name="our_mission" placeholder="">{{$about->our_mission}}</textarea>
                            </div>
                            <!-- /form group -->
                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="summernote">Our Vision</label>
                                <textarea class="form-control summernote"  name="our_vision" placeholder="">{{$about->our_vision}}</textarea>
                            </div>
                            <!-- /form group -->
                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="summernote">Our Statement</label>
                                <textarea class="form-control summernote" name="our_statements" placeholder="">{{$about->our_statements}}</textarea>
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
                                            <input type="file" class="custom-file-input upload_img" name="ceo_image" id="ceo_image">
                                            <label class="custom-file-label" for="ceo_image">Choose CEO's image</label>
                                        </div>
                                    </div>

                                    <div id="image_preview">

                                    </div>

                                    @if(isset($about->ceo_image))
                                        <div class="db_images">

                                            <a class='parent_images'>
                                                <i data-url="{{route('about.images.destroy','ceo_image')}}" class='remove-db-img fa fa-times' ></i>
                                                <img class='img'  src="{{asset('common/images/'.$about->ceo_image)}}">
                                            </a>

                                        </div>

                                    @endif

                                </div>

                                <div class="col-xl-6">
                                    <!-- Input Group -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input upload_img1" name="bg_image" id="bg_image">
                                            <label class="custom-file-label" for="bg_image">Choose background image</label>
                                        </div>
                                    </div>

                                    <div id="image_preview1">

                                    </div>

                                    @if(isset($about->bg_image))
                                        <div class="db_images">

                                            <a class='parent_images'>
                                                <i data-url="{{route('about.images.destroy','bg_image')}}" class='remove-db-img fa fa-times' ></i>
                                                <img class='img'  src="{{asset('common/images/'.$about->bg_image)}}">
                                            </a>

                                        </div>

                                    @endif

                                </div>
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
    @include('admin.pages.about.about-scripts')

@endpush
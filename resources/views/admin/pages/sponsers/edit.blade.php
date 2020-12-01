@extends('admin.layout.master')

@section('title','Edit Sponser')

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
                    <li class="active breadcrumb-item"><a href="{{route('sponsers.index')}}">Sponsers</a> </li>
                    <li class="active breadcrumb-item"><a href="{{route('sponsers.edit',$sponser->id)}}">Edit</a> </li>
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
                            <h3 class="dt-card__title">Edit Sponser</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="edit_form" method="post" action="{{route('sponsers.update',$sponser->id)}}" enctype="multipart/form-data">

                        {{ csrf_field()}}

                            <input type="hidden" name="_method" value="PUT">

                        <!-- Form Group -->
                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $sponser->company_name }}"
                                       aria-describedby="emailHelp1"
                                       placeholder="Enter company name">
                                <span class="text-danger">{{ $errors->first('company_name') }}</span>
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="company_website">Company Website</label>
                                <input type="url" class="form-control" id="company_website" name="company_website" value="{{ $sponser->company_website }}"
                                       placeholder="https://example.com"
                                       pattern="https://.*" size="30">
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
                                            <input type="file" class="custom-file-input upload_img" name="company_logo" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose company's logo</label>
                                        </div>
                                    </div>

                                    <div id="image_preview">

                                    </div>


                                    @if(isset($sponser->company_logo))
                                        <div class="db_images">

                                            <a class='parent_images'>
                                                <i data-url="{{route('sponsers.images.destroy',$sponser->id)}}" class='remove-db-img fa fa-times' ></i>
                                                <img class='img'  src="{{asset('common/images/'.$sponser->company_logo)}}">
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
                                           class="custom-control-input" {{$sponser->status == 1 ? 'checked' : 1}}>
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
    @include('admin.pages.sponsers.sponser-scripts')

@endpush
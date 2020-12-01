@extends('admin.layout.master')

@section('title','Edit Member')

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
                    <li class="breadcrumb-item"><a href="{{route('members.index')}}">Members</a> </li>
                    <li class="active breadcrumb-item"><a href="{{route('members.edit',$member->id)}}">Edit</a> </li>
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
                            <h3 class="dt-card__title">Edit Member</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('members.update',$member->id)}}" enctype="multipart/form-data">

                        {{ csrf_field()}}

                            <input type="hidden" name="_method" value="PUT">

                        <!-- Form Group -->
                            <div class="form-group">
                                <label for="title">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $member->name}}"
                                       placeholder="Enter Full Name">
                            </div>
                            <!-- /form group -->

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="team_category">Category</label>

                                        <select name="team_category" id="team_category" class="form-control js-example-basic-single" >

                                            <option selected disabled>Select Team Category</option>

                                            @foreach($teamCategories as $category)

                                                <option value="{{$category->id}}"  {{$member->category_id  == $category->id? 'selected' : '' }}> {{$category->name}}</option>

                                                <p class="text-center">Zero Type</p>


                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="designation">Designation</label>

                                        <select name="designation" id="designation" class="form-control js-example-basic-single" >

                                            <option selected disabled>Select Designation</option>

                                            @foreach($designations as $desig)

                                                <option value="{{$desig->id}}"  {{ $member->designation_id == $desig->id? 'selected' : '' }}> {{$desig->title}}</option>

                                                <p class="text-center">Zero Type</p>


                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="facebook" class="label-color">Facebook</label>

                                        <input id="facebook" type="url" value="{{$member->facebook}}" class="form-control" name="facebook"
                                               placeholder="Enter Facebook URL">

                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="linkedin">LinkedIn</label>
                                        <input type="url" class="form-control" id="linkedin" name="linkedin" value="{{$member->linkedin}}"
                                               placeholder="Enter LinkedIn URL">
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
                                            <input type="file" class="custom-file-input upload_img" name="image">
                                            <label class="custom-file-label" for="image">Choose Member Image</label>
                                        </div>
                                    </div>

                                    <div id="image_preview">

                                    </div>

                                    @if(isset($member->image))
                                        <div class="db_images">

                                            <a class='parent_images'>
                                                <i data-url="{{route('member.images.destroy',$member->id)}}" class='remove-db-img fa fa-times' ></i>
                                                <img class='img'  src="{{asset('common/images/'.$member->image)}}">
                                            </a>

                                        </div>

                                    @endif

                                </div>
                            </div>


                            <!-- form group -->
                            <div class="form-group">

                                <!-- Checkbox -->
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" id="customcheckboxInline5"
                                           name="status"
                                           class="custom-control-input" {{$member->status ==1 ? 'checked' : ''}}>
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
    @include('admin.pages.teams.members.members-scripts')

@endpush
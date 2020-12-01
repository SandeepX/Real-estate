@extends('admin.layout.master')

@section('title','Edit Settings')

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
                    <li class="active breadcrumb-item"><a href="{{route('admin.siteSetting')}}">Settings</a> </li>
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
                            <h3 class="dt-card__title">Edit Setting</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('admin.updateSetting')}}" enctype="multipart/form-data">

                            {{ csrf_field()}}

                            <input type="hidden" name="_method" value="PUT">

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="site_title">Site Title</label>
                                <input type="text" class="form-control" id="site_title" name="site_title" value="{{ $setting->site_title }}"
                                       aria-describedby="emailHelp1"
                                       placeholder="Enter Site Title">
                                <span class="text-danger">{{ $errors->first('site_title') }}</span>
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="site_subtitle">Site subtitle</label>
                                <input type="text" class="form-control" id="site_subtitle" name="site_subtitle" value="{{ $setting->site_subtitle }}"
                                       placeholder="Enter Site subtitle">
                            </div>
                            <!-- /form group -->

                            <div class="row">
                                <div class="col-xl-6">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $setting->email }}"
                                               placeholder="Enter Email">
                                    </div>
                                    <!-- /form group -->
                                </div>

                                <div class="col-xl-6">
                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="alt_email">Alternate Email</label>
                                        <input type="alt_email" class="form-control" id="alt_email" name="alt_email" value="{{ $setting->alt_email }}"
                                               placeholder="Enter Alternate Email">
                                    </div>
                                    <!-- /form group -->
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="address" class="label-color">Address</label>

                                <input id="address" type="text" value="{{$setting->address}}" class="form-control" name="address"
                                       placeholder="Enter Address">

                            </div>

                            <div class="row">

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{$setting->phone}}"
                                               placeholder="Enter Phone Number">
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="mobile" class="label-color">Mobile</label>

                                        <input id="mobile" type="text" value="{{$setting->mobile}}" class="form-control" name="mobile"
                                               placeholder="Enter Mobile Number">

                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="facebook" class="label-color">Facebook</label>

                                        <input id="facebook" type="url" value="{{$setting->facebook}}" class="form-control" name="facebook"
                                               placeholder="Enter Facebook URL">

                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="twitter">Twitter</label>
                                        <input type="url" class="form-control" id="twitter" name="twitter" value="{{$setting->twitter}}"
                                               placeholder="Enter Twitter URL">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="linkedin" class="label-color">LinkedIn</label>

                                        <input id="linkedin" type="url" value="{{$setting->linkedin}}" class="form-control" name="linkedin"
                                               placeholder="Enter LinkedIn URL">

                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="instagram">Instagram</label>
                                        <input type="url" class="form-control" id="instagram" name="instagram" value="{{$setting->instagram}}"
                                               placeholder="Enter Instagram URL">
                                    </div>
                                </div>

                            </div>

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="summernote">Short Description</label>
                                <textarea class="form-control" id="summernote"  name="description" placeholder="">{{ $setting->description }}</textarea>
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="map_location">Map Location</label>

                                <textarea class="form-control" rows="2" id="map_location" name="map_location"  placeholder="Enter Map Location">{{ $setting->map_location }}</textarea>
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="copyright_text">Copyright Text</label>
                                <input type="text" class="form-control" id="copyright_text" name="copyright_text" value="{{ $setting->copyright_text }}"
                                       placeholder="Enter Copyright Text">
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
                                            <input type="file" class="custom-file-input" name="site_logo">
                                            <label class="custom-file-label" for="site_logo">Choose company's logo</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <!-- Input Group -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="site_favicon" id="site_favicon">
                                            <label class="custom-file-label" for="site_favicon">Choose company's favicon</label>
                                        </div>
                                    </div>
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
    <!--jquery validation && wsiwyg editor-->
    @include('admin.pages.site-setting.setting-scripts')

@endpush
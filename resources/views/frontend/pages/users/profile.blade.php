@extends('frontend.layouts.search-master')
@section('title','Profile')
@section('content')
    <section class="user-dashboard bg-grey">
        <div class="container-fluid">
            <div class="row">

                @include('frontend.pages.partials.user-navigation')

                <div class="col-lg-10">
                    <div class="dashboard-content-right">
                        <h4>My Profile</h4>

                        @include('partials.messages')

                        <div class="dashboard-content-info">
                            <div class="row">
                                <div class="col-lg-3 p-r-0">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="user-basic-info" data-toggle="pill" href="#user-basic-info-id" role="tab" aria-controls="user-basic-info-id" aria-selected="true">Basic Information</a>
                                        <a class="nav-link" id="user-password-info" data-toggle="pill" href="#user-password-info-id" role="tab" aria-controls="user-password-info-id" aria-selected="false">Password</a>
                                        <a class="nav-link" id="user-social-info" data-toggle="pill" href="#user-social-info-id" role="tab" aria-controls="user-social-info-id" aria-selected="false">Social Links</a>
                                    </div>
                                </div>
                                <div class="col-lg-9 p-l-0">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="user-basic-info-id" role="tabpanel" aria-labelledby="user-basic-info">

                                            <label>Manager Status : </label>
                                            @if($user->manager_status == 'no')
                                                <a href="{{route('user.request.manager')}}" class="btn btn-primary btn-sm">Request</a>
                                            @elseif($user->manager_status == 'pending')
                                                <span class="badge badge-warning">pending</span>
                                            @else
                                                <span class="badge badge-success">On</span>
                                            @endif
                                            <br>
                                            <br>
                                            <form action="{{route('user.updateProfile')}}" id="basic_info" method="post" enctype="multipart/form-data">

                                                {{ csrf_field()}}
                                                <input type="hidden" name="_method" value="PUT">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2">
                                                        <div class="form-group">
                                                            <label>Title</label>
                                                            <div class="dropdown bootstrap-select search-fields title-name-dashboard">
                                                                <select class="form-control" name="title">
                                                                    <option value="Mr" {{$user->title == "Mr" ? 'selected' : ''}}>Mr</option>
                                                                    <option value="Mrs" {{$user->title == "Mrs" ? 'selected' : ''}}>Mrs</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-10 col-md-10">
                                                        <div class="form-group name">
                                                            <label>Your Name</label>
                                                            <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="Gopal Basnet">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group subject">
                                                            <label>Phone</label>
                                                            <input type="text" name="phone" value="{{$user->phone}}" class="form-control" placeholder="Phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group subject">
                                                            <label>Mobile</label>
                                                            <input type="text" name="mobile" value="{{$user->mobile}}" class="form-control" placeholder="Mobile">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group subject">
                                                            <label>Address</label>
                                                            <input type="text" name="address" value="{{$user->address}}" class="form-control" placeholder="Address">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group number">
                                                            <label>Email</label>
                                                            <input type="email" name="email" value="{{$user->email}}" class="form-control" placeholder="Email" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group message">
                                                            <label>Personal info</label>
                                                            <textarea class="form-control" name="personal_info" placeholder="Personal info">{{$user->personal_info}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <div class="form-group message">
                                                            <label>Update Profile Picture</label>
                                                        </div>
                                                        <div class="image-upload-wrap">
                                                            <input class="file-upload-input" type='file' id="upload_file" name="user_image" accept="image/*"/>
                                                            <div class="drag-text">
                                                                <h3>Drag and drop a image or Click here</h3>
                                                            </div>
                                                        </div>
                                                        <div class="image_preview"></div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="send-btn">
                                                            <button type="submit" class="btn btn-basic-info">Update Info</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="user-password-info-id" role="tabpanel" aria-labelledby="user-password-info">
                                            <div class="dashboard-password">

                                                <form id="password_form" action="{{route('user.updatePassword')}}" method="post">

                                                    {{ csrf_field()}}

                                                    <input type="hidden" name="_method" value="PUT">
                                                    <div class="row">
                                                        <!-- <div class="col-lg-12">
                                                            <h5>Password</h5>
                                                        </div> -->
                                                        <div class="col-lg-12">
                                                            <div class="form-group name">
                                                                <label>Current Password</label>
                                                                <input type="password" name="current_password" class="form-control" placeholder="Current Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group email">
                                                                <label>New Password</label>
                                                                <input type="password" name="password" id="password" class="form-control" placeholder="New Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group subject">
                                                                <label>Confirm New Password</label>
                                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="send-btn">
                                                                <button type="submit" class="btn btn-change-pw">Update Password</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="user-social-info-id" role="tabpanel" aria-labelledby="user-social-info">
                                            <div class="dashboard-social">
                                                <!-- <h5>Socials</h5> -->
                                                <form id="social_form" action="{{route('user.updateSocial')}}" method="post">

                                                    {{ csrf_field()}}

                                                    <input type="hidden" name="_method" value="PUT">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group name">
                                                                <label>Facebook</label>
                                                                <input type="text" name="facebook" value="{{$user->facebook}}" class="form-control" placeholder="https://www.facebook.com">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group email">
                                                                <label>Twitter</label>
                                                                <input type="text" name="twitter" value="{{$user->twitter}}" class="form-control" placeholder="https://twitter.com">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group subject">
                                                                <label>LinkedIn</label>
                                                                <input type="text" name="linkedin" value="{{$user->linkedin}}" class="form-control" placeholder="https://linkedin.com">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group subject">
                                                                <label>Instagram</label>
                                                                <input type="text" name="linkedin" value="{{$user->instagram}}" class="form-control" placeholder="https://instagram.com">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="send-btn">
                                                                <button type="submit" id="btn-social" class="btn btn-dashboard-social">Update Links</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-copyright">
                        @include('frontend.pages.partials.search-master-footer')
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    @include('frontend.pages.users.user-scripts')
@endpush
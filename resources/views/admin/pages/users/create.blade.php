@extends('admin.layout.master')

@section('title','Users')

@section('content')
    <!-- Site Content -->
    <div class="dt-content">

        <!-- Page Header -->
        <div class="dt-page__header">
            <h1 class="dt-page__title">Users</h1>
        </div>
        <!-- /page header -->

    @include('partials.messages')

    <!-- Grid -->
        <div class="row">

            <!-- Grid Item ,form-->
            <div class="col-xl-12">

                <!-- Card -->
                <div class="dt-card">

                    <!-- Card Header -->
                    <div class="dt-card__header">

                        <!-- Card Heading -->
                        <div class="dt-card__heading">
                            <h3 class="dt-card__title">Register User</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('users.store')}}" enctype="multipart/form-data">

                        {{ csrf_field()}}

                        <!-- Form Group -->
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                       aria-describedby="emailHelp1"
                                       placeholder="Enter Full Name">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="email-1">Email address</label>
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email-1"
                                       aria-describedby="emailHelp1"
                                       placeholder="Enter email">
                                <small id="emailHelp1" class="form-text">Note: We will never share your
                                    email address with anyone.
                                </small>
                            </div>
                            <!-- /form group -->

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                               placeholder="Enter Password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif

                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="password-confirm" class="label-color">{{ __('Confirm Password') }}</label>

                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                               placeholder="Confirm Password" required>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}"
                                               placeholder="Enter Phone Number">
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="mobile" class="label-color">Mobile</label>

                                        <input id="mobile" type="text" value="{{old('mobile')}}" class="form-control" name="mobile"
                                               placeholder="Enter Mobile Number">

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}"
                                       placeholder="Enter Your Address">
                            </div>


                            <div class="form-group">
                                <label>Role</label>

                                <select name="role" class="form-control js-example-basic-single" required>

                                    @foreach($roles as $role)

                                        <option value="{{$role->id}}"  {{ old('role') == $role->id ? 'selected' : '' }}>{{$role->name}}</option>

                                    @endforeach
                                </select>
                            </div>


                            <!-- Input Group -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input upload_img" name="user_image" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose user image</label>
                                </div>
                            </div>

                            <div id="image_preview">

                            </div>


                            <button class="btn btn-primary" type="submit">Create</button>


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
            $('.js-example-basic-single').select2();
        });
    </script>

    @include('partials.image-preview-scripts')

    <!--jquery validation-->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>

        $(document).ready(function () {

            $('#form').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true
                    }
                }
            });
        });
    </script>

@endpush
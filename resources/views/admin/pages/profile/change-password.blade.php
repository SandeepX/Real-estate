@extends('admin.layout.master')

@section('title',$user->name)

@section('content')
    <!-- Site Content -->
    <div class="dt-content">

        <!-- Page Header -->
        <div class="dt-page__header">
            <h1 class="dt-page__title">{{$user->name}}</h1>
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
                            <h3 class="dt-card__title">Update Password</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('admin.updatePassword')}}">

                            {{ csrf_field()}}

                            <input type="hidden" name="_method" value="PUT">

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input type="password"  name="current_password" class="form-control" id="current_password"
                                               placeholder="Enter Current Password" required>

                                        <span id="error-tag" class="error d-none">Current Password Do Not Match</span>

                                        @if ($errors->has('current_password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                               placeholder="Enter New Password" required>

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
            $('.js-example-basic-single').select2();

            //select password field
            $('#current_password').on('keyup',function () {

                let password=$(this).val();

                if (password){
                    checkPassword(password);
                }

            });

            function checkPassword(password){
                $.ajax(
                    {
                        type: 'GET',
                        url: '/admin/check/password/'+ password,
                    }).done(function (data) {

                    if(data == 0){
                        $('#error-tag').removeClass('d-none');
                    }
                    else {
                        $('#error-tag').addClass('d-none');
                    }
                        //$('#error-tag').removeClass('d-none');

                }).fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log("Error: " + errorThrown);
                    console.log("Status: " + status);
                    console.dir(xhr);
                });
            }

        });
    </script>

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
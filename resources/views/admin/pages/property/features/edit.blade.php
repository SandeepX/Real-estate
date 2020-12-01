@extends('admin.layout.master')

@section('title','Property Features')

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
                    <li class="breadcrumb-item"><a href="{{route('features.index')}}">Features</a></li>
                    <li class="active breadcrumb-item"><a href="{{route('features.edit',$propertyFeature->id)}}">Edit</a></li>
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
        <div class="row">

            <!-- Grid Item ,form-->
            <div class="col-xl-12">

                <!-- Card -->
                <div class="dt-card">

                    <!-- Card Header -->
                    <div class="dt-card__header">

                        <!-- Card Heading -->
                        <div class="dt-card__heading">
                            <h3 class="dt-card__title">Edit Property Feature</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('features.update',$propertyFeature->id)}}">

                        {{ csrf_field()}}

                            <input type="hidden" name="_method" value="PUT">

                        <!-- Form Group -->
                            <div class="form-group">
                                <label for="title">Feature Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $propertyFeature->title }}"
                                       placeholder="Enter Feature Title" required>
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            </div>
                            <!-- /form group -->


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
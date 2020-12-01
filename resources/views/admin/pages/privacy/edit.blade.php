@extends('admin.layout.master')

@section('title','Edit Privacy Policy')

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
                    <li class="breadcrumb-item"><a href="{{route('policy.index')}}">Privacy Policies</a> </li>
                    <li class="active breadcrumb-item"><a href="{{route('policy.edit',$policy->id)}}">Edit</a> </li>
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
                            <h3 class="dt-card__title">Edit Privacy Policy</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('policy.update',$policy->id)}}" >

                            {{ csrf_field()}}

                            <input type="hidden" name="_method" value="PUT">


                            <div class="form-group">
                                <input type="text" class="form-control" id="topic" name="topic" value="{{$policy->topic }}"
                                       placeholder="Enter Topic" required>
                            </div>

                            <div class="form-group">

                                <textarea rows="4" class="form-control" name="description"  placeholder="Type something" required >{{$policy->description}}</textarea>

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
    <!--wysiwg scripts-->
    <script src="{{asset('backend/node_modules/summernote/dist/summernote-bs4.js')}}"></script>
    <script>
        (function ($) {
            "use strict";

            $('#summernote').summernote({
                tabsize: 2,
                height: 200
            });

        })(jQuery);
    </script>
@endpush
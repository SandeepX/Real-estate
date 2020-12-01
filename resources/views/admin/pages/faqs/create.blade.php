@extends('admin.layout.master')

@section('title','Add Faq')

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
                    <li class="active breadcrumb-item"><a href="{{route('faqs.index')}}">Faqs</a> </li>
                    <li class="active breadcrumb-item"><a href="{{route('faqs.create')}}">Create</a> </li>
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
                            <h3 class="dt-card__title">Add Faq</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                        <div class="dt-card__body">

                            <!-- Form -->
                            <form id="form" method="post" action="{{route('faqs.store')}}">

                            {{ csrf_field()}}

                            <!-- Form Group -->
                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <input type="text" class="form-control" id="question" name="question" value="{{ old('question') }}"
                                           aria-describedby="emailHelp1"
                                           placeholder="Enter Question">
                                    <span class="text-danger">{{ $errors->first('question') }}</span>
                                </div>
                                <!-- /form group -->

                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="answer">Answer</label>
                                    <textarea class="form-control" id="summernote" rows="5" name="answer" placeholder="Short Description">{{ old('answer') }}</textarea>
                                </div>
                                <!-- /form group -->


                                <!-- Form Group -->
                                <div class="form-group">
                                    <label for="video_id">Youtube Video Id</label>
                                    <input type="text" class="form-control" id="video_id" name="video_id" value="{{ old('video_id') }}"
                                           placeholder="Eg: PO2UPCckeg4">
                                </div>
                                <!-- /form group -->

                                <!-- /form group -->
                                <div class="form-group">

                                    <!-- Checkbox -->
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" id="customcheckboxInline5"
                                               name="status"
                                               class="custom-control-input">
                                        <label class="custom-control-label" for="customcheckboxInline5">Active</label>
                                    </div>
                                    <!-- /checkbox -->
                                </div>

                                <button class="btn btn-primary" type="submit">Add Question</button>


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
    @include('admin.pages.faqs.faq-scripts')

@endpush
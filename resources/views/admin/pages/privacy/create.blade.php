@extends('admin.layout.master')

@section('title','Privacy Policy')

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
                    <li class="active breadcrumb-item"><a href="{{route('policy.create')}}">Add</a> </li>
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
                            <h3 class="dt-card__title">Add Privacy Policy</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('policy.store')}}" >

                        {{ csrf_field()}}

                            <div class="fields">


                                @php
                                    $topics = session('topics');
                                    $descriptions = session('descriptions');
                                @endphp

                                @if(isset($topics) && count($topics)> 0 )

                                    @foreach($topics as $index=>$topic)
                                        <div class="entry">

                                            @if($loop->last)
                                                <span class="input-group-btn pull-right m-b-10">
                                                        <button class="btn btn-success btn-add" type="button">
                                                            <span class="fa fa-plus"></span>
                                                        </button>
                                                    </span>
                                            @else
                                                <span class="input-group-btn pull-right m-b-10">
                                                                <button class="btn btn-danger btn-remove" type="button">
                                                                    <span class="fa fa-minus"></span>
                                                                </button>
                                                            </span>
                                            @endif

                                            <div class="form-group">
                                                <input type="text" class="form-control" id="topic" name="topics[]" value="{{ $topic }}"
                                                       placeholder="Enter Topic" required>
                                            </div>

                                            <div class="form-group">

                                                <textarea rows="4" class="form-control" name="descriptions[]"  placeholder="Type something" required >{{count($descriptions) > $index ? $descriptions[$index] : '' }}</textarea>

                                            </div>


                                        </div>
                                    @endforeach
                                    @else
                                    <div class="entry">
                                          <span class="input-group-btn pull-right m-b-10">
                                                        <button class="btn btn-success btn-add" type="button">
                                                            <span class="fa fa-plus"></span>
                                                        </button>
                                                    </span>

                                        <div class="form-group">
                                            <input type="text" class="form-control" id="topic" name="topics[]"
                                                   placeholder="Enter Topic" required>
                                        </div>

                                        <div class="form-group">

                                            <textarea rows="4"  class="form-control" name="descriptions[]"  placeholder="Type something" required></textarea>

                                        </div>


                                    </div>
                                @endif


                            </div>


                            <button class="btn btn-primary" type="submit">Add</button>


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

    @include('admin.pages.privacy.privacy-scripts')

@endpush
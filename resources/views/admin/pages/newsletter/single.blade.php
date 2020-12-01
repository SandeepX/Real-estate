@extends('admin.layout.master')

@section('title','Single Newsletter')

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
                    <li class="active breadcrumb-item"><a href="{{route('newsletter.index')}}">Newsletter</a> </li>
                    <li class="breadcrumb-item"><a href="{{route('newsletter.show',$newsLetter->id)}}">View</a> </li>
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


            <!-- Grid Item ,table-->
            <div class="col-md-8 dt-masonry__item">
                <!-- Card -->
                <div class="dt-card">

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <div class="row">
                            <div class="col-2">
                                <h4>Title:</h4>
                            </div>
                            <div class="col-9">
                                <a href="#" target="_blank">
                                    <p>{{$newsLetter->title}}</p>
                                </a>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-2">
                                <h4>Body: </h4>
                            </div>
                            <div class="col-9">
                                <a href="#" target="_blank">
                                    <p>{!! $newsLetter->body !!}</p>
                                </a>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-2">
                                <h4>Image: </h4>
                            </div>
                            <div class="col-9">
                                <a href="#" target="_blank">

                                    @if($newsLetter->image)
                                        <img src="{{asset('common/images/'.$newsLetter->image)}}" height="400" width="500">
                                    @else
                                        <p>No Image</p>
                                    @endif
                                </a>
                            </div>
                        </div>


                    </div>
                    <!-- /card body -->

                </div>
                <!-- /card -->
            </div>
            <!-- /grid item -->


        </div>

    </div>
@endsection

@extends('admin.layout.master')

@section('title','View Request')

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
                    <li class="breadcrumb-item"><a href="{{route('admin.request.index')}}">Requests</a> </li>
                    <li class="active breadcrumb-item"><a href="{{route('admin.request.single',$managerRequest->id)}}">View</a> </li>
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
                            <h3 class="dt-card__title">
                                View Request-
                                @if($managerRequest->request_type == "create_manager")
                                    Create Manager
                                @elseif($managerRequest->request_type == "update_manager")
                                    Update Manager
                                @elseif($managerRequest->request_type == "delete_manager")
                                    Delete Manager
                                @endif
                            </h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('admin.request.update',$managerRequest->id)}}">

                            {{ csrf_field()}}

                            <input type="hidden" name="_method" value="PUT">

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="title">Property Name</label>
                                <input type="text" class="form-control" id="name" name="property_title"
                                       value="{{$managerRequest->property_id ? $managerRequest->property->title : 'NULL'}}" readonly>
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="title">Requested By (User Email)</label>
                                <input type="email" class="form-control" id="name" name="user_email"
                                       value="{{$managerRequest->user_id ? $managerRequest->user->email : 'NULL'}}" readonly>
                            </div>
                            <!-- /form group -->


                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="title">Manager Email</label>
                                <input type="email" class="form-control" id="name" name="manager_email"
                                       value="{{$managerRequest->manager_id ? $managerRequest->manager->email : 'NULL'}}" readonly>
                            </div>
                            <!-- /form group -->


                            <!-- form group -->
                            <div class="form-group">

                                <!-- Checkbox -->
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" id="customcheckboxInline5"
                                           name="isCompleted"
                                           class="custom-control-input" {{ $managerRequest->isCompleted==1 ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="customcheckboxInline5">
                                        @if($managerRequest->request_type == "create_manager")
                                            Create Manager
                                        @elseif($managerRequest->request_type == "update_manager")
                                            Update Manager
                                        @elseif($managerRequest->request_type == "delete_manager")
                                            Delete Manager
                                        @endif
                                    </label>
                                </div>
                                <!-- /checkbox -->
                            </div>

                            <button class="btn btn-primary" type="submit">Finish</button>


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


@endpush
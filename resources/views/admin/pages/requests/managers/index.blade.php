@extends('admin.layout.master')

@section('title','All Requests')

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
                    <li class="active breadcrumb-item"><a href="{{route('admin.request.index')}}">Requests</a> </li>
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
            <div class="col-md-12 dt-masonry__item">
                <!-- Card -->
                <div class="dt-card">

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Tables -->
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Property</th>
                                    <th>Manager</th>
                                    <th>Request</th>
                                    <th>View</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($managerRequests as $request)
                                    <tr class="gradeX">
                                        <td>{{$loop->index +1}}</td>

                                        <td>

                                            @if($request->user_id && $request->user->user_image)
                                                <img class="size-60 dt-avatar mb-6 mb-sm-0 mr-sm-10" src="{{asset('common/images/'.$request->user->user_image)}}">
                                            @else
                                                <img class="size-60 dt-avatar mb-6 mb-sm-0 mr-sm-10" src="{{asset('common/images/default-user.png')}}">
                                            @endif
                                                {{$request->user_id? $request->user->name : 'NULL'}}
                                        </td>
                                        <td>
                                            {{$request->property_id ? $request->property->title : 'NULL'}}
                                        </td>

                                        <td>

                                            @if($request->manager_id && $request->manager->user_image)
                                                <img class="size-60 dt-avatar mb-6 mb-sm-0 mr-sm-10" src="{{asset('common/images/'.$request->manager->user_image)}}">
                                            @else
                                                <img class="size-60 dt-avatar mb-6 mb-sm-0 mr-sm-10" src="{{asset('common/images/default-user.png')}}">
                                            @endif

                                            {{$request->manager_id? $request->manager->name : 'NULL'}}
                                        </td>
                                        <td>
                                            {{$request->request_type}}
                                        </td>

                                        <td style="">

                                            <div>
                                                <a  href="{{route('admin.request.single',$request->id)}}"  type="button" class="edit-button btn btn-xs btn-warning mr-2 mb-2">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>

                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        <!-- /tables -->

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

    <!--for data table-->
    <script src="{{asset('backend/node_modules/datatables.net/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('backend/assets/js/custom/data-table.js')}}"></script>


@endpush
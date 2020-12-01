@extends('admin.layout.master')

@section('title','Manager Requests')

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
                    <li class="breadcrumb-item"><a href="{{route('admin.manager.request')}}">Manager Requests</a></li>
                </ol>
                <!-- /breadcrumbs -->

            </div>
            <!-- /grid item -->

        </div>
        <!-- /grid breadcrumbs -->


        <!-- Page Header -->
        <div class="dt-page__header mt-3">
            <h1 class="dt-page__title">All Manager Requests</h1>
        </div>
        <!-- /page header -->

    @include('partials.messages')

    <!-- Grid -->
        <div class="row">

            <!-- Grid Item ,table-->
            <div class="col-xl-12">
                <!-- Card -->
                <div class="dt-card">

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Tables -->
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>User</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr class="gradeX">

                                        <td>{{$loop->index +1}}</td>

                                        <td>
                                            <a href="{{route('users.edit',$user->id)}}" target="_blank">
                                                {{$user->name}}
                                            </a>

                                        </td>

                                        <td>

                                            <div>

                                                <a type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                                   data-target="#myModal{{$user->id}}">
                                                    View
                                                </a>
                                                <a href="{{route('admin.manager.request.single',$user->id)}}" data-id="{{$user->id}}" type="button" class="parameter-alert edit-button btn btn-xs btn-success mr-2 mb-2">
                                                    Assign Manager
                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal{{$user->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="model-8"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">

                                            <!-- Modal Content -->
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="model-8">{{$user->name}}  Details</h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- /modal header -->

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <p>Name : {{$user->name}}</p>
                                                    <p>Email : {{$user->email}}</p>
                                                    <p>Phone : {{$user->phone}}</p>
                                                    <p>Mobile : {{$user->mobile}}</p>
                                                    <p>Address : {{!is_null($user->address) ? $user->address : ''}}</p>
                                                </div>
                                                <!-- /modal body -->

                                            </div>
                                            <!-- /modal content -->

                                        </div>
                                    </div>
                                    <!-- /modal -->
                                @empty
                                    <p class="text-center">
                                        No Records Found!
                                    </p>
                                @endforelse
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

    <!-- Sweet Alert -->
    <script src="{{asset('backend/node_modules/sweetalert2/dist/sweetalert2.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('.parameter-alert').on("click", function (e) {

                e.preventDefault();
                let dataId = $(this).data('id');
                console.log(dataId);
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success mb-2',
                    cancelButtonClass: 'btn btn-danger mr-2 mb-2',
                    buttonsStyling: false,
                });

                swalWithBootstrapButtons({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Make Manager!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        /* swalWithBootstrapButtons(
                             'Deleted!',
                             'Your file has been deleted.',
                             'success'
                         ),*/
                        // Prevent infinite loop
                        $(this).unbind('click');

                        // Execute default action
                        e.currentTarget.click();
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons(
                            'Cancelled',
                            /* 'Your imaginary file is safe :)',
                             'error'*/
                        )
                    }
                });
            });


        });
    </script>

@endpush
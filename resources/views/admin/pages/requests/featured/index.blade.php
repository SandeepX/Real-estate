@extends('admin.layout.master')

@section('title','Featured Requests')

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
                    <li class="breadcrumb-item"><a href="{{route('admin.request.featured')}}">Featured Requests</a></li>
                </ol>
                <!-- /breadcrumbs -->

            </div>
            <!-- /grid item -->

        </div>
        <!-- /grid breadcrumbs -->


        <!-- Page Header -->
        <div class="dt-page__header mt-3">
            <h1 class="dt-page__title">All Featured Requests</h1>
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
                                    <th>Title</th>
                                    <th>Property Type</th>
                                    <th>Property Subtype</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($properties as $property)
                                    <tr class="gradeX">

                                        <td>{{$loop->index +1}}</td>

                                        <td>
                                            <a href="{{route('property.edit',$property->id)}}" target="_blank">
                                                {{$property->title}}
                                            </a>

                                        </td>
                                        <td>{{$property->property_category_id ? $property->category->name : 'Undefined'}}</td>
                                        <td>{{$property->property_subcategory_id ? $property->subCategory->name : 'Undefined'}}</td>
                                        <td>{{$property->address ? $property->address->address : 'Undefined'}}</td>

                                        <td>

                                            <div>

                                                <a type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                                   data-target="#myModal{{$property->id}}">
                                                    View
                                                </a>
                                                <a href="{{route('admin.request.featured.single',$property->id)}}" data-id="{{$property->id}}" type="button" class="parameter-alert edit-button btn btn-xs btn-success mr-2 mb-2">
                                                    Feature
                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal{{$property->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="model-8"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">

                                            <!-- Modal Content -->
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="model-8">{{$property->title}} {{$property->information->user->name}} Details</h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <!-- /modal header -->

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <p>Name : {{$property->information->user->name}}</p>
                                                    <p>Email : {{$property->information->user->email}}</p>
                                                    <p>Phone : {{$property->information->user->phone}}</p>
                                                    <p>Mobile : {{$property->information->user->mobile}}</p>
                                                    <p>Address : {{!is_null($property->information->user->address) ? $property->information->user->address : ''}}</p>
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
                    confirmButtonText: 'Yes, Feature it!',
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
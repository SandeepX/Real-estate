@extends('admin.layout.master')

@section('title',$title.' Properties')

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
                    <li class="breadcrumb-item">
                        @if($title == 'Unverified')
                        <a href="{{route('admin.properties.unverified')}}">Unverified Properties</a>
                        @else
                            <a href="{{route('admin.properties.verified')}}">Verified Properties</a>
                        @endif
                    </li>
                </ol>
                <!-- /breadcrumbs -->

            </div>
            <!-- /grid item -->

        </div>
        <!-- /grid breadcrumbs -->


        <!-- Page Header -->
        <div class="dt-page__header mt-3">
            <h1 class="dt-page__title">All {{$title}} Properties </h1>
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
                                    @if( $title == 'Featured')
                                        <th>Feature Status</th>
                                    @endif
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($properties as $property)
                                    <tr class="gradeX">

                                        <td>{{$loop->index +1}}</td>

                                        <td>{{$property->title}}</td>
                                        <td>{{$property->property_category_id ? $property->category->name : 'Undefined'}}</td>
                                        <td>{{$property->property_subcategory_id ? $property->subCategory->name : 'Undefined'}}</td>
                                        <td>{{$property->address ? $property->address->address : 'Undefined'}}</td>
                                        @if( $title == 'Featured')
                                            <td>
                                                @if($property->feature_status == 'featured')
                                                    <a href="{{route('property.featured.status',$property->id)}}"  type="button" class="btn btn-sm btn-success pull-left mr-5">
                                                        Activated
                                                    </a>
                                                @else
                                                    <a href="{{route('property.featured.status',$property->id)}}"  type="button" class="btn btn-sm btn-danger pull-left mr-5">
                                                        Deactivated
                                                    </a>
                                                @endif
                                            </td>
                                        @endif

                                        <td>

                                            <div>
                                                <a  href="{{route('property.edit',$property->id)}}"  type="button" class="edit-button btn btn-xs btn-warning mr-2 mb-2">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <form class="confirm_delete{{$property->id}}"  action="{{route('property.destroy',$property->id)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" data-id="{{$property->id}}" class="btn btn-xs btn-danger mr-2 mb-2 parameter-alert">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </div>

                                        </td>

                                    </tr>
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
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        /* swalWithBootstrapButtons(
                             'Deleted!',
                             'Your file has been deleted.',
                             'success'
                         ),*/
                        $(".confirm_delete"+dataId).off("submit").submit();
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons(
                            'Cancelled',
                            'Your imaginary file is safe :)',
                            'error'
                        )
                    }
                });
            });


        });
    </script>

@endpush
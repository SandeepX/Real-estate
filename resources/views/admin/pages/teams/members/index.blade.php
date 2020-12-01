@extends('admin.layout.master')

@section('title','All Members')

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
                    <li class="active breadcrumb-item"><a href="{{route('members.index')}}">Members</a> </li>
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

                        <a class="btn btn-primary pull-right" href="{{route('members.create')}}" style="margin-bottom: 10px !important;" width="100%">
                            <i class="fa fa-plus"> </i>  Add
                        </a>
                        <!-- Tables -->
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Designation</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($members as $member)
                                    <tr class="gradeX">
                                        <td>{{$loop->index +1}}</td>
                                        <td>
                                            @if($member->image)
                                                <img class="size-60 dt-avatar mb-6 mb-sm-0 mr-sm-10" src="{{asset('common/images/'.$member->image)}}">
                                            @else
                                                <img class="size-60 dt-avatar mb-6 mb-sm-0 mr-sm-10" src="{{asset('common/images/default-user.png')}}">
                                            @endif
                                            {{$member->name}}
                                        </td>
                                        <td>
                                            {{$member->category_id ? $member->category->name : 'Undefined'}}
                                        </td>
                                        <td>
                                            {{$member->designation ? $member->designation->title : 'Undefined'}}
                                        </td>

                                        <td>
                                            <i class="fa {{$member->status? 'fa-check' : 'fa-ban'}}" aria-hidden="true"></i>
                                        </td>

                                        <td style="">

                                            <div>
                                                <a href="{{route('members.edit',$member->id)}}"  type="button" class="edit-button btn btn-xs btn-warning mr-2 mb-2">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <form class="confirm_delete{{$member->id}}"  action="{{route('members.destroy',$member->id)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" data-id="{{$member->id}}" class="btn btn-xs btn-danger mr-2 mb-2 parameter-alert">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </form>
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
@extends('admin.layout.master')

@section('title','Property Status')

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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Property</a></li>
                    <li class="breadcrumb-item active"><a href="{{route('status.index')}}">Property Status</a></li>
                </ol>
                <!-- /breadcrumbs -->

            </div>
            <!-- /grid item -->

        </div>
        <!-- /grid breadcrumbs -->

        <!-- Page Header -->
        <div class="dt-page__header">

        </div>
        <!-- /page header -->

    @include('partials.messages')

    <!-- Grid -->
        <div class="row">

            <!-- Grid Item ,form-->
            <div class="col-xl-5">

                <!-- Card -->
                <div class="dt-card" id="dynamic-content">

                    <!-- Card Header -->
                    <div class="dt-card__header">

                        <!-- Card Heading -->
                        <div class="dt-card__heading">
                            <h3 class="dt-card__title">Create Property Status</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('status.store')}}">

                        {{ csrf_field()}}

                        <!-- Form Group -->
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}"
                                       placeholder="Enter Status Title">
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            </div>
                            <!-- /form group -->


                            <button class="btn btn-primary" type="submit">Create</button>


                        </form>
                        <!-- /form -->

                    </div>
                    <!-- /card body -->

                </div>
                <!-- /card -->

            </div>
            <!-- /grid item -->

            <!-- Grid Item ,table-->
            <div class="col-xl-7">
                <!-- Card -->
                <div class="dt-card">

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Tables -->
                        <div class="table-responsive">

                            <table id="data-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($status as $st)
                                    <tr class="gradeX">
                                        <td>{{$st->title}}</td>


                                        <td style="">

                                            <div class="row">
                                                <a  href="{{route('status.edit',$st->id)}}"  type="button" class="edit-button btn btn-xs btn-warning mr-2 mb-2">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <form action="{{route('status.destroy',$st->id)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit"  class="btn btn-xs btn-danger mr-2 mb-2"  onclick="return confirm('Are you sure you want to delete this item?');">
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


    <!--jquery validation-->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>

        $(document).ready(function () {

            $('#form').validate({ // initialize the plugin
                rules: {
                    title: {
                        required: true
                    }
                }
            });
        });
    </script>
@endpush
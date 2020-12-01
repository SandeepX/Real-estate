@extends('admin.layout.master')

@section('title','Property Features')

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
                    <li class="breadcrumb-item"><a href="{{route('features.index')}}">Features</a></li>
                </ol>
                <!-- /breadcrumbs -->

            </div>
            <!-- /grid item -->

        </div>
        <!-- /grid breadcrumbs -->


        <!-- Page Header -->
        <div class="dt-page__header mt-3">
            <h1 class="dt-page__title">All Property Features</h1>
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
                                    <th>Title</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($propertyFeatures as $feature)
                                    <tr class="gradeX">

                                        <td>{{$feature->title}}</td>


                                        <td>

                                            <div>
                                                <a href="{{route('features.edit',$feature->id)}}"  type="button" class="btn btn-xs btn-warning mr-2 mb-2">Edit
                                                </a>
                                                <form action="{{route('features.destroy',$feature->id)}}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit"  class="btn btn-xs btn-danger mr-2 mb-2"  onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
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
                    name: {
                        required: true
                    }
                }
            });
        });
    </script>
@endpush
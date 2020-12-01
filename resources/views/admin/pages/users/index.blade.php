@extends('admin.layout.master')

@section('title','Users')

@section('content')
    <!-- Site Content -->
    <div class="dt-content">

        <!-- Page Header -->
        <div class="dt-page__header">
            <h1 class="dt-page__title">Users</h1>
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

                            <table id="data-table1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Contact</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr class="gradeX">
                                        <td>
                                            @if($user->user_image)
                                                <img width="60" height="60" class="img-responsive" src="{{asset('common/images/'.$user->user_image)}}">
                                            @else
                                                <img width="60" height="60" class="img-responsive" src="{{asset('common/images/default-user.png')}}">
                                            @endif
                                        </td>
                                        <td>{{$user->name}}</td>
                                        <td>

                                            @forelse($user->getRoleNames() as $role)
                                                {{$role}}
                                            @empty
                                                Role Not Assigned
                                            @endforelse

                                        </td>

                                        <td>
                                            phone: {{$user->phone}},
                                            mobile: {{$user->mobile}}
                                        </td>

                                        <td>
                                            @if(auth::id() === $user->id)
                                                <div class="dash-user-action">
                                                    <a href="{{route('admin.editProfile')}}"  type="button" class="btn btn-xs btn-success">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            @else

                                                <div class="dash-user-action">
                                                    <a type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                                            data-target="#myModal{{$user->id}}">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{route('users.edit',$user->id)}}"  type="button" class="btn btn-success btn-xs">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                    </a>
                                                    <form action="{{route('users.destroy',$user->id)}}" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit"  class="btn btn-xs btn-danger "  onclick="return confirm('Are you sure you want to delete this item?');">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </div>

                                            @endif


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
                                                    <h3 class="modal-title" id="model-8">{{$user->title}} {{$user->name}} Details</h3>
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
    <script src="{{asset('backend/assets/js/custom/data-table.js')}}"> </script>

    <!--for data table excel-->
    @include('admin.partials.dataTable-script')

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
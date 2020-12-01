@extends('admin.layout.master')

@section('title','Roles')

@section('content')
    <!-- Site Content -->
    <div class="dt-content">

        <!-- Page Header -->
        <div class="dt-page__header">
            <h1 class="dt-page__title">Roles</h1>
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
                            <h3 class="dt-card__title">Create Roles</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('roles.store')}}">

                        {{ csrf_field()}}

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="name">Role</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                       aria-describedby="emailHelp1"
                                       placeholder="Enter Role Name">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea>
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
                                    <th>Role Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($roles as $role)
                                    <tr class="gradeX">
                                        <td>{{$role->name}}</td>
                                        <td>
                                            {{str_limit(strip_tags($role->description), 80) }}
                                        </td>

                                        <td style="">

                                         <div>
                                             <a  href="{{route('roles.edit',$role->id)}}"  type="button" class="edit-button btn btn-xs btn-warning mr-2 mb-2">Edit
                                             </a>
                                             <form action="{{route('roles.destroy',$role->id)}}" method="POST">
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

            $('.edit-button').on('click', function (e) {

                e.preventDefault();
                let url = $(this).attr('href');

                //ajax call to update page
                updatePage(url);
            });

            function updatePage(url) {
                $.ajax(
                    {
                        type: 'GET',
                        url: url,
                        datatype: "html",
                    }).done(function (data) {
                    $("#dynamic-content").empty().html(data);
                }).fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log("Error: " + errorThrown);
                    console.log("Status: " + status);
                    console.dir(xhr);
                });

            }
        });
    </script>
@endpush
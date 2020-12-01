<!-- Card -->
<div class="dt-card">

    <!-- Card Header -->
    <div class="dt-card__header">

        <!-- Card Heading -->
        <div class="dt-card__heading">
            <h3 class="dt-card__title">Edit Roles</h3>
        </div>
        <!-- /card heading -->

    </div>
    <!-- /card header -->

    <!-- Card Body -->
    <div class="dt-card__body">

        <!-- Form -->
        <form id="form" method="post" action="{{route('roles.update',$role->id)}}">

            {{ csrf_field()}}

            <input type="hidden" name="_method" value="PUT">

            <!-- Form Group -->
            <div class="form-group">
                <label for="name">Role</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$role->name}}"
                       aria-describedby="emailHelp1"
                       placeholder="Enter Role Name">
                <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
            <!-- /form group -->

            <!-- Form Group -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description">{{$role->description}}</textarea>
            </div>
            <!-- /form group -->
            <button class="btn btn-primary" type="submit">Update</button>


        </form>
        <!-- /form -->

    </div>
    <!-- /card body -->

</div>
<!-- /card -->
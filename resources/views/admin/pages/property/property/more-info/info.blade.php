<div class="card-body">

    <!-- Form -->
    <form id="info_form" method="post" action="{{route('property.info.store',$property->id)}}" enctype="multipart/form-data">

    {{ csrf_field()}}

    <div class="form-group">
        <label for="property_user">User</label>


        <select name="user_id" id="property_user" class="form-control js-example-basic-single" >

            <option selected disabled>Select Property User</option>

            @foreach($users as $user)

                <option value="{{$user->id}}"  {{ \App\CustomServices\ViewOldDataHelper::getData('user_id',$propertyInfo ? $propertyInfo : [])  == $user->id? 'selected' : '' }}> {{$user->name}}</option>

                <p class="text-center">Zero Users</p>


            @endforeach
        </select>
    </div>

        <!-- Form Group -->
        <div class="form-group">
            <label for="title">Owner Name</label>
            <input type="text" class="form-control" id="owner_name" name="owner_name" value="{{ \App\CustomServices\ViewOldDataHelper::getData('owner_name',$propertyInfo ? $propertyInfo : []) }}"
                   placeholder="Enter Property Owner Name">
            <span class="text-danger">{{ $errors->first('owner_name') }}</span>
        </div>
        <!-- /form group -->


    <div class="row">

        <div class="col-xl-6">
            <div class="form-group">
                <label for="owner_address" class="label-color">Address</label>

                <input id="owner_address" type="text" value="{{ \App\CustomServices\ViewOldDataHelper::getData('owner_address',$propertyInfo ? $propertyInfo : [])}}" class="form-control" name="owner_address"
                       placeholder="Owner Address">

            </div>
        </div>

        <div class="col-xl-6">
            <div class="form-group">
                <label for="price">Contact Number</label>
                <input type="text"  class="form-control" id="owner_contact" name="owner_contact" value="{{ \App\CustomServices\ViewOldDataHelper::getData('owner_contact',$propertyInfo ? $propertyInfo : [])}}"
                       placeholder="Owner Contact Number">
            </div>
        </div>

    </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label for="title">Alternative Contact Name</label>
                    <input type="text" class="form-control" id="ref_owner_name_1" name="ref_owner_name_1" value="{{ \App\CustomServices\ViewOldDataHelper::getData('ref_owner_name_1',$propertyInfo ? $propertyInfo : [])}}"
                           placeholder="Alternative Contact Name">
                    <span class="text-danger">{{ $errors->first('ref_owner_name_1') }}</span>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="form-group">
                    <label for="price">Alternative Contact Number</label>
                    <input type="text"  class="form-control" id="ref_owner_phone_1" name="ref_owner_phone_1" value="{{ \App\CustomServices\ViewOldDataHelper::getData('ref_owner_phone_1',$propertyInfo ? $propertyInfo : [])}}"
                           placeholder="Alternative Contact Number">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="form-group">
                    <label for="title">Alternative Contact Name(Optional)</label>
                    <input type="text" class="form-control" id="ref_owner_name_2" name="ref_owner_name_2" value="{{ \App\CustomServices\ViewOldDataHelper::getData('ref_owner_name_2',$propertyInfo ? $propertyInfo : [])}}"
                           placeholder="Alternative Contact Name">
                    <span class="text-danger">{{ $errors->first('ref_owner_name_2') }}</span>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="form-group">
                    <label for="price">Alternative Contact Number(Optional)</label>
                    <input type="text"  class="form-control" id="ref_owner_phone_2" name="ref_owner_phone_2" value="{{ \App\CustomServices\ViewOldDataHelper::getData('ref_owner_phone_2',$propertyInfo ? $propertyInfo : [])}}"
                           placeholder="Alternative Contact Number">
                </div>
            </div>
        </div>

        <!-- Form Group -->
        <div class="form-group">
            <label for="yt_url">Youtube Video Id (Optional)</label>
            <input type="text" class="form-control" id="yt_url" name="yt_url" value="{{ \App\CustomServices\ViewOldDataHelper::getData('yt_url',$propertyInfo ? $propertyInfo : [])  }}"
                   placeholder="Example: Sz_1tkcU0Co">
        </div>
        <!-- /form group -->

        <!-- Form Group -->
        <div class="form-group">
            <label for="yt_title">Video Title (Optional)</label>
            <input type="text" class="form-control" id="yt_title" name="yt_title" value="{{  \App\CustomServices\ViewOldDataHelper::getData('yt_title',$propertyInfo ? $propertyInfo : [])}}"
                   placeholder="Enter Title For Youtube Video">
        </div>
        <!-- /form group -->

        <!-- Form Group -->
        <div class="form-group">
            <label for="private_note">Private Note (Optional)</label>
            <input type="text" class="form-control" id="private_note" name="private_note" value="{{  \App\CustomServices\ViewOldDataHelper::getData('private_note',$propertyInfo ? $propertyInfo : []) }}"
                   placeholder="Enter Private Note">
        </div>
        <!-- /form group -->

        <!-- Form Group -->
        <div class="form-group">
            <label for="message">Message To Reviewer (Optional)</label>
            <textarea class="form-control" id="summernote" rows="3" name="message" placeholder="Message To Reviewer">{{ \App\CustomServices\ViewOldDataHelper::getData('message',$propertyInfo ? $propertyInfo : []) }}</textarea>
        </div>
        <!-- /form group -->


        <button class="btn btn-primary" type="submit">Update</button>

    </form>
</div>
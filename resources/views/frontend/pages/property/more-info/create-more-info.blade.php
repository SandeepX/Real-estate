
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="property_user">User</label>
            <select name="user_id" id="property_user" class="form-control" >
                <option value="{{$user->id}}" selected disabled>{{$user->name }}</option>
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="title">Owner Name</label>
            <input type="text" class="form-control" id="owner_name" name="owner_name" value="{{ \App\CustomServices\ViewOldDataHelper::getData('owner_name',isset($propertyInfo) ? $propertyInfo : []) }}"
                   placeholder="Enter Property Owner Name">
            <span class="text-danger"></span>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="owner_address" class="label-color">Address</label>
            <input id="owner_address" type="text"  class="form-control" name="owner_address"
                   value="{{ \App\CustomServices\ViewOldDataHelper::getData('owner_address',isset($propertyInfo) ? $propertyInfo : [])}}"
                   placeholder="Owner Address">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="price">Contact Number</label>
            <input type="text"  class="form-control" id="owner_contact" name="owner_contact"
                   value="{{ \App\CustomServices\ViewOldDataHelper::getData('owner_contact',isset($propertyInfo) ? $propertyInfo : [])}}"
                   placeholder="Owner Contact Number">
        </div>
    </div>


    <div class="col-lg-6">
        <div class="form-group">
            <label for="title">Alternative Contact Name</label>
            <input type="text" class="form-control" id="ref_owner_name_1" name="ref_owner_name_1" value="{{old('ref_owner_name_1')}}"
                   placeholder="Alternative Contact Name">
            <span class="text-danger">{{ $errors->first('ref_owner_name_1') }}</span>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label for="price">Alternative Contact Number</label>
            <input type="text"  class="form-control" id="ref_owner_phone_1" name="ref_owner_phone_1" value="{{old('ref_owner_phone_1')}}"
                   placeholder="Alternative Contact Number">
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label for="title">Alternative Contact Name(Optional)</label>
            <input type="text" class="form-control" id="ref_owner_name_2" name="ref_owner_name_2" value="{{old('ref_owner_name_2')}}"
                   placeholder="Alternative Contact Name">
            <span class="text-danger">{{ $errors->first('ref_owner_name_2') }}</span>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label for="price">Alternative Contact Number(Optional)</label>
            <input type="text"  class="form-control" id="ref_owner_phone_2" name="ref_owner_phone_2" value="{{old('ref_owner_phone_2')}}"
                   placeholder="Alternative Contact Number">
        </div>
    </div>

    <div class="col-lg-6">
        <div class="form-group">
            <label for="yt_url">Youtube Video Id (Optional)</label>
            <input type="text" class="form-control" id="yt_url" name="yt_url"
                   value="{{ \App\CustomServices\ViewOldDataHelper::getData('yt_url',isset($propertyInfo) ? $propertyInfo : [])  }}"
                   placeholder="Example: Sz_1tkcU0Co">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="yt_title">Video Title (Optional)</label>
            <input type="text" class="form-control" id="yt_title" name="yt_title"
                   value="{{  \App\CustomServices\ViewOldDataHelper::getData('yt_title',isset($propertyInfo) ? $propertyInfo : [])}}"
                   placeholder="Enter Title For Youtube Video">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="private_note">Private Note (Optional)</label>
            <input type="text" class="form-control" id="private_note" name="private_note"
                   value="{{  \App\CustomServices\ViewOldDataHelper::getData('private_note',isset($propertyInfo) ? $propertyInfo : []) }}"
                   placeholder="Enter Private Note">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="message">Message To Reviewer (Optional)</label>
            <textarea class="form-control"  rows="3" name="message" placeholder="Message To Reviewer">{{ \App\CustomServices\ViewOldDataHelper::getData('message',isset($propertyInfo) ? $propertyInfo : []) }}</textarea>
        </div>
    </div>
    <div class="col-lg-12">
        <button class="btn post-prop-btn btn-back-next" data-btn-type="prev"  href="#user-basic-info-id">Prev</button>

        <button class="btn post-prop-btn btn-back-next" data-btn-type="next"  href="#user-location-id">Next</button>
    </div>
</div>

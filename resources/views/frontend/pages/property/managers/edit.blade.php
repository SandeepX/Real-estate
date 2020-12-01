<!-- Form -->
<form id="manager_form" method="post" action="{{route('user.property.manager.update',$property->slug)}}">
    {{ csrf_field()}}
    <input type="hidden" name="_method" value="PUT">

    <div class="row">

        <div class="col-lg-12">
            <div class="form-group manager-form-group">
                <label for="property">Property</label>
                <select name="property" id="property"  class="form-control js-example-basic-single"  >

                    <option value="{{$property->id}}" {{ $propertyInfo->property_id == $property->id? 'selected' : '' }}> {{$property->title}}</option>

                </select>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="email-1">Email address</label>
                <input type="email" name="manager" value="{{$manager->email}}" class="form-control" id="email-1"
                       aria-describedby="emailHelp1"
                       placeholder="Enter Manager E-mail">

            </div>

        </div>

        <div class="col-lg-12">
            <button class="btn post-prop-btn" type="submit">Update</button>
        </div>

    </div>
</form>
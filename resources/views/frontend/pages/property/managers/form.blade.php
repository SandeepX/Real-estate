<!-- Form -->
<form id="manager_form" method="post" action="{{route('user.property.manager.request')}}">
    {{ csrf_field()}}
    <div class="row">

         <div class="col-sm-12">
            <div class="form-group manager-form-group">
                <label for="property">Select Property</label>
                <select name="property" id="property"  class="form-control js-example-basic-single">
                    <option selected disabled>Choose Property..</option>

                    @foreach($userPropertiesWithOutManager as $property)
                        <option value="{{$property->id}}" {{ old('property') == $property->id? 'selected' : '' }}> {{$property->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label for="email-1">Email address</label>
                <input type="email" name="manager" value="{{old('email')}}" class="form-control" id="email-1"
                       aria-describedby="emailHelp1"
                       placeholder="Enter Manager E-mail">

            </div>

        </div>

        <div class="col-lg-12">
            <button class="btn post-prop-btn" type="submit">Request</button>
        </div>

    </div>
</form>
<form method="post" action="{{route('fe.contact.store')}}">
    {{csrf_field()}}

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Full Name">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email"  value="{{old('email')}}" placeholder="Email address">
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label>Subject</label>
                <input type="text" name="subject" value="{{old('subject')}}" class="form-control" placeholder="Subject">
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" class="form-control" name="phone" value="{{old('phone')}}"  placeholder="+977-**********">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" name="message" placeholder="Message...">{{old('message')}}</textarea>
            </div>
        </div>

        <button type="submit" class="btn request-info-btn">Contact Us</button>
    </div>
</form>
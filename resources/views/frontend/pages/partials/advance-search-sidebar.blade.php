<form id="advance_search_form" method="get" action="{{route('fe.advance.search')}}" class="w-100">
    <div class="list-prop-filter">
        <div class="col-lg-12">
            <div class="form-group">
                <select id="sale_status" class="form-control" name="sale_status">

                    <option value="" selected >All Status</option>

                    @foreach($propertyStatuses as $status)
                        <option value="{{$status->id}}">{{$status->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <select  id="property_type" class="form-control" name="property_type">
                    <option value="" selected>All Type</option>

                    @foreach($propertyTypes as $propertyType)
                        <option value="{{$propertyType->id}}">{{$propertyType->name}}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">

                <select id="municipal" class="form-control js-example-basic-single" name="municipal" >
                    <option value="" selected>Location</option>

                    @foreach($municipals as $municipal)
                        <option value="{{$municipal->id}}">{{$municipal->municipal_name}}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="row m-l-r-0">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <select  id="bedrooms" class="form-control" name="bedrooms">
                        <option value="" selected>Bedrooms</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <select id="bathrooms" class="form-control" name="bathrooms">
                        <option value="" selected>Bathroom</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-12 m-b-10">
            <div class="price-range-list-prop ">
                <label>Price</label>
                <input type="hidden" id="property_min_price" name="min_price" value="0">
                <input type="hidden" id="property_max_price" name="max_price" value="70000000">
                <div class="range_28"></div>

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-lg-12 m-t-10">
            <div class="price-range-list-prop ">
                <label>Area</label>
                <input type="hidden" id="min_area" name="min_area" value="0">
                <input type="hidden" id="max_area" name="max_area" value="1000000">
                <div class="area_range"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-lg-12">
            <div class="facility-show-div">
                <a class="show-more-options" data-toggle="collapse" data-target="#options-content" aria-expanded="true">
                    <i class="fa fa-plus-circle"></i> Other Features
                </a>
                <div id="options-content" class="collapse hide facility-list-prop" style="">
                    <div class="row">
                        @foreach($propertyFeatures as $feature)
                            <div class="col-lg-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="features[]" value="{{$feature->id}}"> 
                                        {{$feature->title}}
                                    </label>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <button id="search_btn" class="btn list-prop-btn">Search</button>
        </div>
    </div>
</form>
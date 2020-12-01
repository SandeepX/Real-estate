<section class="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 p-l-r-0">
                <div class="owl-bannerSlider owl-carousel">
                    <img class="lazyload img-fluid" src="{{asset('frontend/img/slider/banner2.jpg')}}" alt="">
                    <img class="lazyload img-fluid" src="{{asset('frontend/img/slider/banner-8.png')}}" alt="">
                    <img class="lazyload img-fluid" src="{{asset('frontend/img/slider/banner3.jpg')}}" alt="">
                </div>  
            </div>
            <div class="col-lg-12">
                <div class="map-navigation-positioning">
                <div class="map-navigation-wrapper bot-50">
                    <form method="get" action="{{route('fe.search')}}" class="clear">
                        <div class="form-group">
                            <label>Location</label>
                            <div class="select-wrapper">
                                <select name="municipal" id="select-location" class="form-control js-example-basic-single">
                                    <option value="" selected disabled>Choose...</option>
                                    @foreach($municipals as $municipal)
                                        <option value="{{$municipal->id}}">{{$municipal->municipal_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Property Type</label>
                            <div class="select-wrapper">
                                <select class="form-control js-example-basic-single" name="property_type">
                                    <option value="" selected disabled>Choose...</option>
                                    @foreach($propertyTypes as $propertyType)
                                        <option value="{{$propertyType->id}}">{{$propertyType->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="amount">Price range:</label>
                            <input type="text" class="form-control header-map-amt" id="amount" name="price">
                            <input type="text" class="form-control" id="min_price" name="min_price" hidden>
                            <input type="text" class="form-control" id="max_price" name="max_price" hidden>
                            <div id="slider-range"></div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn map-filter-search-btn btn-block" value="Search">
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</section>
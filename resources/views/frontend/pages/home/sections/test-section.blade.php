<section class="index-property bg-grey">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2">
                <div class="index-left-side-des">
                    <div class="how-we-work-div">
                        How it works
                    </div>
                    <div class="index-left-side-item">
                        <div class="icon-left-sidebar">
                            <img src="{{asset('frontend/img/house-search-01.png')}}" class="img-fluid" alt="">
                        </div>
                        <h6>Search your home</h6>
                    </div>
                    <div class="index-left-side-item">
                        <div class="icon-left-sidebar">
                            <img src="{{asset('frontend/img/contact-us.png')}}" class="img-fluid" alt="">
                        </div>
                        <h6>Contact with us</h6>
                    </div>
                    <div class="index-left-side-item">
                        <div class="icon-left-sidebar">
                            <img src="{{asset('frontend/img/deal.png')}}" class="img-fluid" alt="">
                        </div>
                        <h6>Make a deal and Payment</h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-10">
                <div class="col-lg-12">
                    <h3 class="featured-prop-title">Featured Properties</h3>
                    <div class="bod-bot-div"></div>
                </div>

                <div class="col-lg-12">
                    <div class="owl-featured owl-carousel nav-arrow">

                        @foreach($featuredProperties as $property)
                            <div class="featured-slider-item">
                                <div class="property-photo feature-img-index">
                                    @if($property->featured_image)
                                        <img class="img-fluid" src="{{asset('common/images/medium/'.$property->featured_image)}}" alt="{{$property->title}}">
                                    @else
                                        <img class="img-fluid" src="{{asset('common/images/no-photo.png')}}" alt="{{$property->title}}">
                                    @endif

                                    <div class="property-overlay">
                                        <a href="single-property.php" class="overlay-link">
                                            <i class="fas fa-link"></i>
                                        </a>
                                        <a href="https://www.youtube.com/embed/0xwCqBxa56I" class="overlay-link" data-rel="lightcase"><i class="far fa-play-circle"></i></a>
                                        <div class="property-magnify-gallery">
                                            <a href="{{asset('common/images/'.$property->featured_image)}}" class="overlay-link">
                                                <i class="far fa-images"></i>
                                            </a>

                                            @foreach($property->images as $image)
                                                <a href="{{asset('common/images/'.$image->image)}}" class="hidden"></a>
                                            @endforeach

                                        </div>


                                    </div>
                                </div>
                                <div class="on-sale">
                                    <p>
                                        {{$property->property_status_id ? $property->saleStatus->title : ''}}
                                    </p>
                                </div>
                                <div class="feartured-prop-cat">
                                    <a href="single-property.php" class="color-green"> {{$property->property_category_id ? $property->category->name : ''}}</a>
                                    <a href="single-property.php" class="color-blue"> {{$property->property_subcategory_id ? $property->subCategory->name : ''}}</a>
                                </div>
                                <div class="featured-prop-price">
                                    Rs.{{$property->price}}
                                </div>
                                <div class="featured-prop-desc">
                                    <h4><a href="single-property.php">{{$property->title}}</a></h4>
                                    <p class="featured-prop-sub-title">{{$property->address ? $property->address->address : ''}}</p>
                                </div>
                                <div class="featured-prop-icon index-property-feature">
                                    <p class="featured-bed-p">
                                        <img src="{{asset('frontend/img/bed-icon.png')}}" class="img-fluid" alt="">
                                        <span>: {{$property->bedrooms}}</span>
                                    </p>
                                    <p class="featured-bath-p">
                                        <img src="{{asset('frontend/img/shower-icon.png')}}" class="img-fluid" alt="">
                                        <span>: {{$property->bathrooms}}</span>
                                    </p>
                                    <p class="featured-sqft-p">
                                        <img src="{{asset('frontend/img/square-ft.png')}}" class="img-fluid" alt="">
                                        <span>: {{$property->area_size}} {{$property->area_size_postfix}}</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="featured-property.php" class="btn view-more-btn-top">View More List</a>
                </div>
            </div>
        </div>
    </div>
</section>



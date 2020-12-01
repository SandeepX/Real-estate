<section class="index-property bg-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <h3 class="featured-prop-title">Trending Properties</h3>
                <div class="bod-bot-div"></div>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="{{route('fe.trendingProperty')}}" class="btn view-more-btn-top">View More List</a>
            </div>
            <div class="col-lg-12">
                <div class="owl-trend owl-carousel partner-nav">
                    @foreach($trendingProperties as $property)

                        <div class="property-box-trend">
                            <div class="property-photo ">
                                @if($property->featured_image)
                                    <img class="lazyload img-fluid" data-src="{{asset('common/images/medium/'.$property->featured_image)}}" alt="{{$property->title}}">
                                @else
                                    <img class="lazyload img-fluid" data-src="{{asset('common/images/no-photo.png')}}" alt="{{$property->title}}">
                                @endif

                                <div class="property-overlay">
                                    <a href="{{route('fe.singleProperty',$property->slug)}}" class="overlay-link">
                                        <i class="fas fa-link"></i>
                                    </a>

                                    @if($property->information && $property->information->yt_url)
                                        <a href="https://www.youtube.com/embed/{{$property->information->yt_url}}" class="overlay-link" data-rel="lightcase">
                                            <i class="far fa-play-circle"></i>
                                        </a>
                                    @endif

                                    <div class="property-magnify-gallery">
                                        @if($property->featured_image)
                                            <a href="{{asset('common/images/'.$property->featured_image)}}" class="overlay-link">
                                                <i class="far fa-images"></i>
                                            </a>
                                        @endif

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
                                <a href="{{route('fe.cat.properties',$property->property_category_id?$property->category->slug : 'Undefined')}}" class="color-green"> {{$property->property_category_id ? $property->category->name : ''}}</a>
                                <a href="{{route('fe.subcat.properties',$property->property_subcategory_id?$property->subCategory->slug : 'Undefined')}}" class="color-blue"> {{$property->property_subcategory_id ? $property->subCategory->name : ''}}</a>
                            </div>
                            <div class="property-price trending-price">
                                <span>Rs.</span> {{number_format($property->price)}}
                            </div>
                            <div class="detail">
                                <div class="heading">
                                    <h3>
                                        <a href="{{route('fe.singleProperty',$property->slug)}}">{{$property->title}}</a>
                                    </h3>
                                    <div class="location">
                                        <i class="flaticon-facebook-placeholder-for-locate-places-on-maps"></i>
                                        {{$property->address ? str_limit(strip_tags($property->address->address ),80) : ''}}
                                    </div>
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
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
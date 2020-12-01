
<section class="index-property">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="row">
                    <div class="col-lg-9 col-md-9">
                        <h3 class="featured-prop-title">Testimonial</h3>
                        <div class="bod-bot-div"></div>
                    </div> 
                    <div class="col-lg-3 col-md-3">
                        <a href="featured-property.php" class="btn view-more-btn-top">View More</a>
                    </div>  

                    <div class="col-lg-12">
                        <div class="testimonial-carousel owl-carousel owl-theme nav-arrow blog-test-nav">  
                        @foreach($testimonials as $testimonial)
                            <div class="index-testimonial ">
                                <div class="text">{!! str_limit(strip_tags($testimonial->client_message), 400)  !!}</div> 
                                <div class="author"> 
                                    @if(!is_null($testimonial->client_image))
                                        <img data-src="{{asset('common/images/'.$testimonial->client_image)}}" alt="{{$testimonial->client_name}}" class="lazyload img-fluid">
                                    @else
                                        <img data-src="{{asset('frontend/img/testimonial-user.png')}}" alt="{{$testimonial->client_name}}" class="lazyload img-fluid">
                                    @endif 
                                </div> 
                                <h5 class="name">{{$testimonial->client_name}}</h5>
                                <h5 class="desg">{{$testimonial->client_position}}</h5>
                            </div>
                        @endforeach 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-lg-9 col-md-9">
                        <h3 class="featured-prop-title">Blog</h3>
                        <div class="bod-bot-div"></div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <a href="featured-property.php" class="btn view-more-btn-top">View More</a>
                    </div> 

 
                    <div class="owl-blog owl-carousel partner-nav">

                        @foreach($blogs as $blog)
                            <div class="blog-box clear">
                                <div class="blog-photo">
                                    @if(!is_null($blog->blog_image))
                                        <img data-src="{{asset('common/images/'.$blog->blog_image)}}" alt="{{$blog->title}}" class="lazyload img-fluid">
                                    @else
                                        <img data-src="{{asset('common/images/no-image.png')}}" alt="{{$blog->title}}" class="lazyload img-fluid">
                                    @endif

                                </div>
                                <div class="post-meta">
                                    <ul>
                                        <li class="blog-user"><i class="far fa-user"></i><span>{{$blog->author}}</span></li>
                                        <li class="blog-date">
                                            <i class="far fa-calendar-alt"></i>
                                            <span>{{date('M j,Y',strtotime($blog->created_at))}}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="blog-caption">
                                    <h5><a href="{{route('fe.blogs.single',$blog->slug)}}">{{$blog->title}}</a></h5>
                                    <p> {!! str_limit(strip_tags($blog->description), 150)  !!}</p>
                                    <div class="blog-read-btn">
                                        <a href="{{route('fe.blogs.single',$blog->slug)}}" class="read-more">Read More...</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
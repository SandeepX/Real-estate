@extends('frontend.layouts.master')
@section('title',$blog->title)
@section('content')

  
    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <h2>Blog Single</h2>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <ul class="breadcrumb-ul">
                        <li><a href="{{route('fe.home')}}">Home</a></li>
                        <li><i class="fas fa-chevron-right"></i></li>
                        <li class="active"> <a href="{{route('fe.blogs.single',$blog->slug)}}">{{$blog->title}}</a> </li>
                    </ul>
                </div>
            </div>
        </div> 
    </section>

    <section class="index-property bg-grey">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-8">
                    <div class="single-blog-wrapper">
                        <figure class="blog-single-img">
                            @if($blog->blog_image)
                                <img class="img-fluid" src="{{asset('common/images/'.$blog->blog_image)}}" alt="{{$blog->title}}">
                            @else
                                <img class="img-fluid" src="{{asset('common/images/no-image.png')}}" alt="{{$blog->title}}">
                            @endif
                        </figure>
                        <div class="single-blog-desc">
                            <div class="single-blog-title">
                                <h4>{{$blog->title}}</h4>
                                <ul>
                                    <li><i class="far fa-user"></i>{{$blog->author}}</li>
                                    <li><i class="far fa-calendar-alt"></i>{{date('M j,Y',strtotime($blog->created_at))}}</li>

                                </ul>
                            </div>
                            {!! $blog->description !!}
                            <div class="clearfix"></div>
                            <div class="share-tags">
                                <div class="share-left">
                                    <h6>Share On</h6>
                                    <ul>
                                        <li><a href="#" class="facebook-bg"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#" class="twitter-bg"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#" class="linkedin-bg"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="#" class="google-bg"><i class="fab fa-google-plus-g"></i></a></li>
                                    </ul>
                                </div>
                                <div class="tags-right">
                                    <h6>Tags</h6>
                                    <ul>
                                        @if($blogTags)
                                            @foreach($blogTags as $tag)
                                                <li><a href="#">{{$tag->title}}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                        <div class="single-prop-review" id="review-id">
                            <div class="comment-wrapper">
                                <h4 class="review-title">Give a Review</h4>

                                @if( session('review') == 'review')
                                    @include('partials.messages')
                                @endif

                                <form id="blog_review_form" action="{{route('fe.blog.review.store',$blog->slug)}}" method="post">

                                    {{ csrf_field()}}

                                    <div class="row">

                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-group rating">
                                                {{-- <label for="">Rating</label>--}}
                                                <div class="rating-span">
                            <span><input type="radio" name="rating" id="str5" value="5" {{old('rating') == 5 ? 'checked' :''}} required>
                                <label for="str5"></label>
                            </span>
                                                    <span><input type="radio" name="rating" id="str4" value="4" {{old('rating') == 4 ? 'checked' :''}} required>
                                <label for="str4"></label>
                            </span>
                                                    <span><input type="radio" name="rating" id="str3" value="3" {{old('rating') == 3 ? 'checked' :''}} required>
                                <label for="str3"></label>
                            </span>
                                                    <span><input type="radio" name="rating" id="str2" value="2" {{old('rating') == 2 ? 'checked' :''}} required>
                                <label for="str2"></label>
                            </span>
                                                    <span><input type="radio" name="rating" id="str1" value="1" {{old('rating') == 1 ? 'checked' :''}} required>
                                <label for="str1"></label>
                            </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-sm-12">
                                            <div class="form-group">
                                                <textarea rows="5" class="form-control resize_none" name="client_message" placeholder="Your Comments" required>{{old('client_message')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-sm-12">
                                            <input class="btn btn-review" value="Write a Review" type="submit">

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="review-wrapper">
                                <h4>Reviews And Comments</h4>

                                @foreach($blogReviews as $review)
                                    <div class="review-comment">
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <figure>
                                                    @if($review->user->user_image)
                                                        <img class="img-fluid" src="{{asset('common/images/'.$review->user->user_image)}}" alt="{{$review->user_image}}">
                                                    @else
                                                        <img class="img-fluid" src="{{asset('common/images/default-user.png')}}" alt="{{$review->user->name}}">
                                                    @endif
                                                </figure>
                                            </div>
                                            <div class="col-lg-10">
                                                <div class="author-text">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="author-info">
                                                                <h5 class="author-name">{{$review->user->name}}</h5>
                                                                <span>{{date('M j ,Y',strtotime($review->created_at))}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="user-rating">
                                                                <ul>
                                                                    @for($i=0 ; $i <$review->client_rating ; $i++)
                                                                        <li><i class="fas fa-star"></i></li>
                                                                    @endfor

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <p class="review-p">
                                                                {{strip_tags($review->client_message)}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-lg-4">
                   @include('frontend.pages.blogs.sidebar')
                </div>
            </div>

        </div>
    </section>


@endsection

@push('scripts')
    <script>
        $(".rating input:radio").attr("checked", false);

        $('.rating input').click(function () {
            $(".rating span").removeClass('checked');
            $(this).parent().addClass('checked');
        });
    </script>


    <!--jquery validation-->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

  <script>

        $(document).ready(function () {

            $('#blog_review_form').validate({ // initialize the plugin
                rules: {
                    rating:{
                        required: true,
                    },
                    client_message:"required",
                },
                messages: {
                    rating: {
                        required: "Please Rate.",
                    },
                    client_message: {
                        required: "Please Enter Your Comment.",
                    },

                },
                onfocusout: false,
                invalidHandler: function(form, validator) {
                    var errors = validator.numberOfInvalids();
                    if (errors) {
                        validator.errorList[0].element.focus();
                    }
                }
            });

        });
    </script>
@endpush
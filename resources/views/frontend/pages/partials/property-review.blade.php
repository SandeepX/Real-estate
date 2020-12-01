<div class="single-prop-review">
    <div class="comment-wrapper">
        <h4 class="review-title">Give a Review</h4>

        @if( session('review') == 'review')
            @include('partials.messages')
        @endif

        <form id="prop_review_form" action="{{route('fe.store.property.review',$property->id)}}" method="post" enctype="multipart/form-data">
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

        @foreach($propertyReviews as $review)
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
                                        {{$review->client_message}}
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
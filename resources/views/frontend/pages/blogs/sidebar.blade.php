<div class="blog-left-side">

    <div class="recent-prop">
        <h4>Recent Properties</h4>
        <div class="s-border"></div>

        @foreach($recentProperties as $property)
            <div class="media quick-prop-footer-wrapper">
                <div class="media-left">
                    @if($property->featured_image)
                        <img class="media-object" src="{{asset('common/images/small/'.$property->featured_image)}}" alt="{{$property->title}}">
                    @else
                        <img class="media-object" src="{{asset('common/images/no-image.png')}}" alt="{{$property->title}}">
                    @endif

                </div>
                <div class="media-body quick-prop-footer-body">
                    <h6 class="media-heading">
                        <a href="{{route('fe.singleProperty',$property->slug)}}">{{$property->title}}</a>
                    </h6>
                    <p>{{date('M j,Y',strtotime($property->created_at))}}</p>
                    <div class="price">
                        Rs.{{$property->price}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="category-blog">
        <h4>Category</h4>
        <div class="s-border"></div>
        <ul class="category-blog-ul">

            @foreach($blogCategories as $category)
                <li><a href="{{route('fe.category.blogs',$category->slug)}}">{{$category->title}} <span>({{count($category->blogs)}})</span> </a></li>
            @endforeach

        </ul>
    </div>
    <div class="tags-blog">
        <h4>Tags</h4>
        <div class="s-border"></div>
        <ul class="tags-blog-ul">
            @foreach($tags as $tag)
                <li><a href="{{route('fe.tag.blogs',$tag->slug)}}">{{$tag->title}}</a></li>
            @endforeach

        </ul>

    </div>
</div>
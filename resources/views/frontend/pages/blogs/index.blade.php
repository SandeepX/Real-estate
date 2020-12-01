@extends('frontend.layouts.master')
@section('title','All Blogs')
@section('content')
    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <h2>Blog List</h2>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <ul class="breadcrumb-ul">
                        <li><a href="{{route('fe.home')}}">Home</a></li>
                        <li><i class="fas fa-chevron-right"></i></li>
                        <li class="active">Blog List</li>
                    </ul>
                </div>
            </div>
        </div> 
    </section>

    <section class="index-property bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @forelse($blogs as $blog)

                            <div class="col-lg-6">
                                <div class="blog-box m-b-20">
                                    <div class="blog-photo">

                                        @if($blog->blog_image)
                                            <img class="img-fluid" src="{{asset('common/images/'.$blog->blog_image)}}" alt="{{$blog->title}}">
                                        @else
                                            <img class="img-fluid" src="{{asset('common/images/no-image.png')}}" alt="{{$blog->title}}">
                                        @endif

                                    </div>
                                    <div class="post-meta">
                                        <ul>
                                            <li class="blog-user"><i class="far fa-user"></i><span>{{$blog->author}}</span></li>
                                            <li class="blog-date"><i class="far fa-calendar-alt"></i>
                                                <span>{{ Carbon\Carbon::parse($blog->created_at)->diffForHumans()}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="blog-caption">
                                        <h5><a href="{{route('fe.blogs.single',$blog->slug)}}">{{$blog->title}}</a></h5>
                                        <p>
                                            {{str_limit(strip_tags($blog->description), 200) }}
                                        </p>
                                        <div class="blog-read-btn">
                                            <a href="{{route('fe.blogs.single',$blog->slug)}}" class="read-more">Read More...</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <div class="col-12">
                                "No Blogs Found!"
                            </div>
                        @endforelse

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            {{$blogs->links()}}
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
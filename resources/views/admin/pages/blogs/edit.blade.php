@extends('admin.layout.master')

@section('title','Edit Blog')

@section('content')
    <!-- Site Content -->
    <div class="dt-content">

        <!-- Grid breadcrumbs -->
        <div class="row dt-masonry">

            <!-- Grid Item -->
            <div class="col-md-12 dt-masonry__item">

                <!-- Breadcrumbs -->

                <ol class="mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('blogs.index')}}">Blogs</a> </li>
                    <li class="active breadcrumb-item"><a href="{{route('blogs.edit',$blog->id)}}">Edit</a> </li>
                </ol>
                <!-- /breadcrumbs -->

            </div>
            <!-- /grid item -->

        </div>
        <!-- /grid breadcrumbs -->

        <!-- Page Header -->
        <div class="dt-page__header">
            <h1 class="dt-page__title"></h1>
        </div>
        <!-- /page header -->

    @include('partials.messages')

    <!-- Grid -->
        <div class="row dt-masonry">

            <!-- Grid Item ,form-->
            <div class="col-md-12 dt-masonry__item ">
                <!-- Card -->
                <div class="dt-card">

                    <!-- Card Header -->
                    <div class="dt-card__header">

                        <!-- Card Heading -->
                        <div class="dt-card__heading">
                            <h3 class="dt-card__title">Edit Blog</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('blogs.update',$blog->id)}}" enctype="multipart/form-data">

                            {{ csrf_field()}}

                            <input type="hidden" name="_method" value="PUT">

                            <div class="row">
                                <div class="col-6">

                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{$blog->title }}"
                                               placeholder="Enter Blog Title">
                                    </div>
                                    <!-- /form group -->

                                </div>

                                <div class="col-6">

                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="subtitle">Subtitle</label>
                                        <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ $blog->subtitle}}"
                                               placeholder="Enter Blog Subtitle">
                                    </div>
                                    <!-- /form group -->

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-6">

                                    <div class="form-group">
                                        <label for="blog_category">Category</label>

                                        <select name="blog_category" id="blog_category" class="form-control js-example-basic-single" >

                                            <option selected disabled>Select Blog Category</option>

                                            @foreach($blogCategories as $category)

                                                <option value="{{$category->id}}"  {{ $blog->category_id == $category->id? 'selected' : '' }}> {{$category->title}}</option>

                                                <p class="text-center">Zero Type</p>


                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="col-6">

                                    <!-- Form Group -->
                                    <div class="form-group">
                                        <label for="author">Author</label>
                                        <input type="text" class="form-control" id="author" name="author" value="{{ $blog->author}}"
                                               placeholder="Enter Author Full Name">
                                    </div>
                                    <!-- /form group -->

                                </div>
                            </div>

                            <!-- Form Group -->
                            <div class="form-group">
                                <label for="description">Description</label>

                                <textarea id="summernote" name="description" rows="3" class="form-control">{{ $blog->description}}</textarea>
                            </div>
                            <!-- /form group -->

                            <!-- Form Group -->
                            <div class="form-group">
                                <!-- Input Group -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input upload_img" name="blog_image" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose Blog image</label>
                                    </div>
                                </div>

                                <div id="image_preview">

                                </div>

                                @if(isset($blog->blog_image))
                                    <div class="db_images">

                                        <a class='parent_images'>
                                            <i data-url="{{route('blog.images.destroy',$blog->id)}}" class='remove-db-img fa fa-times' ></i>
                                            <img class='img'  src="{{asset('common/images/'.$blog->blog_image)}}">
                                        </a>

                                    </div>

                                @endif

                            </div>
                            <!-- /form group -->


                            <div class="form-group">
                                <label for="blog_tags">Tags</label>

                                <select name="blog_tags[]" id="blog_tags" class="form-control js-example-basic-multiple" multiple >

                                    <option  disabled>Select Blog Tags</option>

                                    @foreach($tags as $tag)

                                        <option value="{{$tag->id}}"  @if(is_array($blogTags) && in_array($tag->id,$blogTags)) selected @endif>
                                            {{$tag->title}}
                                        </option>

                                        <p class="text-center">Zero Type</p>


                                    @endforeach
                                </select>
                            </div>



                            <!-- form group -->
                            <div class="form-group">

                                <!-- Checkbox -->
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" id="customcheckboxInline5"
                                           name="isPublished"
                                           class="custom-control-input" {{$blog->isPublished == 1 ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="customcheckboxInline5">Publish</label>
                                </div>
                                <!-- /checkbox -->
                            </div>

                            <button class="btn btn-primary" type="submit">Update</button>


                        </form>
                        <!-- /form -->

                    </div>
                    <!-- /card body -->
                </div>
            </div>


        </div>

    </div>
@endsection

@push('scripts')

    @include('partials.image-preview-scripts')
    @include('admin.pages.blogs.blog-scripts')

@endpush
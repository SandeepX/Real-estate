<?php

namespace App\Http\Controllers\Frontend;

use App\Blog;
use App\BlogCategory;
use App\BlogReview;
use App\BlogTag;
use App\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;

class BlogListingController extends Controller
{
    //
    public function getAllBlogs(){

        $blogs = Blog::where('isPublished',1)->latest()->paginate(8);

        $recentProperties = Property::where('status',1)->latest()->take(5)->get();

        $blogCategories = BlogCategory::where('status',1)->latest()->take(5)->get();

        $tags = BlogTag::where('status',1)->latest()->take(10)->get();

        return view('frontend.pages.blogs.index',compact('blogs','recentProperties',
            'blogCategories','tags'));
    }

    public function getSingleBlog($slug){

        $blog = Blog::where('isPublished',1)->where('slug',$slug)->first();

        $blogTags =$blog->tags;

        $recentProperties = Property::where('status',1)->latest()->take(5)->get();

        $blogCategories = BlogCategory::where('status',1)->latest()->take(5)->get();

        $tags = BlogTag::where('status',1)->latest()->take(10)->get();

        $blogReviews = BlogReview::where('blog_id',$blog->id)->get();

       return view('frontend.pages.blogs.single',compact('blog','blogTags',
           'recentProperties','blogCategories','tags','blogReviews'));
    }

    public function getBlogsByCategory($slug){

        $category = BlogCategory::where('status',1)->where('slug',$slug)->firstOrFail();

        $blogs = Blog::where('isPublished',1)->where('category_id',$category->id)->latest()->paginate(8);

        $recentProperties = Property::where('status',1)->latest()->take(5)->get();

        $blogCategories = BlogCategory::where('status',1)->latest()->take(5)->get();

        $tags = BlogTag::where('status',1)->latest()->take(10)->get();

        return view('frontend.pages.blogs.index',compact('blogs','recentProperties',
            'blogCategories','tags'));

    }

    public function getBlogsByTag($slug){

        $tag = BlogTag::where('status',1)->where('slug',$slug)->firstOrFail();

        $blogs = Blog::where('isPublished',1)->whereHas('tags',function ($query) use ($tag){
            $query->where('id',$tag->id);
        })->latest()->paginate(8);

        $recentProperties = Property::where('status',1)->latest()->take(5)->get();

        $blogCategories = BlogCategory::where('status',1)->latest()->take(5)->get();

        $tags = BlogTag::where('status',1)->latest()->take(10)->get();

        return view('frontend.pages.blogs.index',compact('blogs','recentProperties',
            'blogCategories','tags'));

    }

    public function storeBlogReview(Request $request,$slug){

        $blog = Blog::where('slug',$slug)->firstOrfail();

        $validator = Validator::make($request->all(), [
            'client_message'=>'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('review','review');
        }

        $review = new BlogReview();

        $review->blog_id = $blog->id;

        $user = Auth::user();

        $review->user_id = $user->id;

        $review->client_message = strip_tags($request->client_message);
        $review->client_rating = $request->rating;

        $review->status =0;

        $review->save();


        Session::flash('success', 'Thank You For Your Comment');
        return redirect()->back()->with('review','review');
    }
}

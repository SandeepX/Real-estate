<?php

namespace App\Http\Controllers\Admin\Blogs;

use App\Blog;
use App\BlogCategory;
use App\BlogTag;
use App\CustomServices\ImageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Session;

class BlogController extends Controller
{

    public function deleteImage(Request $request,$id){

        if ($request->ajax()) {

            $blog = Blog::findOrFail($id);

            $oldFileName = $blog->blog_image;

            $blog->blog_image=null;

            $blog->save();

            //delete image from Server
            if (!empty($oldFileName)) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $blogs = Blog::with(['category'])->latest()->get();

        return view('admin.pages.blogs.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $blogCategories = BlogCategory::where('status',1)->latest()->get();

        $tags = BlogTag::where('status',1)->latest()->get();

        return view('admin.pages.blogs.create',compact('blogCategories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'title' =>'required|max:191|unique:blogs,title',
            'subtitle'=>'required|max:191',
            'blog_category'=> 'required',
            'author'=>'required|max:191',
            'description'=>'required',
            'blog_image' =>'sometimes|nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //generating the slug
        $title = ucwords(strtolower($request->title));

        $slug = str_slug($title, '-');

        $blog = new Blog();

        $blog->title = $title;
        $blog->slug = $slug;

        $blog->category_id = $request->blog_category;
        $blog->subtitle = $request->subtitle;
        $blog->author = $request->author;
        $blog->description = $request->description;
        $blog->isPublished = $request->has('isPublished');

        //save blog Image
        if ($request->hasFile('blog_image')) {
            $filenameToStore=ImageService::saveImage($request->file('blog_image'));
            $blog->blog_image=$filenameToStore;
        }

        $blog->save();

        $blogTags =array_filter($request->blog_tags);
        $blog->tags()->attach($blogTags);

        Session::flash('success', 'New Blog Has Been Added!');
        //return redirect()->back();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return redirect()->route('blogs.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $blog = Blog::findOrFail($id);

        //retrieving only id and converting to array
        $blogTags = $blog->tags->pluck('id')->all();

        $blogCategories = BlogCategory::where('status',1)->latest()->get();

        $tags = BlogTag::where('status',1)->latest()->get();

        return view('admin.pages.blogs.edit',compact('blogCategories','tags','blog','blogTags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' =>'required|max:191|unique:blogs,title,'.$id,
            'subtitle'=>'required|max:191',
            'blog_category'=> 'required',
            'author'=>'required|max:191',
            'description'=>'required',
            'blog_image' =>'sometimes|nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //generating the slug
        $title = ucwords(strtolower($request->title));

        $slug = str_slug($title, '-');

        $blog = Blog::findOrFail($id);

        $blog->title = $title;
        $blog->slug = $slug;

        $blog->category_id = $request->blog_category;
        $blog->subtitle = $request->subtitle;
        $blog->author = $request->author;
        $blog->description = $request->description;
        $blog->isPublished = $request->has('isPublished');

        //save blog Image
        if ($request->hasFile('blog_image')) {
            $filenameToStore=ImageService::saveImage($request->file('blog_image'));

            $oldFileName=$blog->blog_image;
            $blog->blog_image=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $blog->blog_image == $filenameToStore) {
                //delete the old photo
                ImageService::deleteMultipleSizeImage($oldFileName);
            }
        }

        $blog->save();

        $blogTags =array_filter($request->blog_tags);
        $blog->tags()->sync($blogTags);

        Session::flash('success', 'Blog Has Been Updated!');
        //return redirect()->back();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog= Blog::findOrFail($id);

        $imageToBeDeleted=$blog->blog_image;

        //blog tags detach
        $blog->tags()->detach();

        //delete floor image
        ImageService::deleteImage($imageToBeDeleted);

        $blog->delete();

        Session::flash('success', 'Blog Has Been Deleted!');

        return redirect()->route('blogs.index');
    }
}

<?php

namespace App\Http\Controllers\Admin\Blogs;

use App\Blog;
use App\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $blogCategories = BlogCategory::latest()->get();

        return view('admin.pages.blogs.category.index',compact('blogCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.blogs.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:191|unique:blog_categories,title',
        ]);

        //generating the slug
        $title =  ucwords(strtolower($request->title));
        $slug = str_slug($title, '-');

        $cat= new BlogCategory();

        $cat->title = $title;
        $cat->slug = $slug;

        $cat->description = $request->description;

        $cat->status = $request->has('status');

        $cat->save();


        Session::flash('success', 'New Blog Cateogory Has Been Added!');
        return redirect()->route('blogs-category.create');
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
        return redirect()->route('blogs-category.index');
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
        $category = BlogCategory::findOrFail($id);

        return view('admin.pages.blogs.category.edit',compact('category'));
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
        $this->validate($request, [
            'title' => 'required|max:191|unique:blog_categories,title,'.$id,
        ]);

        //generating the slug
        $title = ucwords(strtolower($request->title));
        $slug = str_slug($title, '-');

        $cat= BlogCategory::findOrFail($id);

        $cat->title = $title;
        $cat->slug = $slug;

        $cat->description = $request->description;

        $cat->status = $request->has('status');

        $cat->save();


        Session::flash('success', 'Blog Cateogory Has Been Updated!');
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
        //
        $cat= BlogCategory::findOrFail($id);

        //mass update
        Blog::where('category_id',$cat->id)->update(['category_id' => null]);

        $cat->delete();

        Session::flash('success', 'Blog Cateogory Has Been Deleted!');
        return redirect()->route('blogs-category.index');
    }
}

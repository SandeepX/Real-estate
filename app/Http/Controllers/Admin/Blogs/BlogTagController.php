<?php

namespace App\Http\Controllers\Admin\Blogs;

use App\BlogTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class BlogTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tags = BlogTag::latest()->get();

        return view('admin.pages.blogs.tags.index',compact('tags'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.blogs.tags.create');
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
            'title' => 'required|max:191|unique:blog_tags,title',
        ]);

        //generating the slug
        $title = ucwords(strtolower($request->title));

        $slug = str_slug($title, '-');

        $cat= new BlogTag();

        $cat->title = $title;
        $cat->slug = $slug;

        $cat->description = $request->description;

        $cat->status = $request->has('status');

        $cat->save();


        Session::flash('success', 'New Blog Tag Has Been Added!');
        return redirect()->route('blogs-tag.create');
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
        return redirect()->route('blogs-tag.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = BlogTag::findOrFail($id);

        return view('admin.pages.blogs.tags.edit',compact('tag'));
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
            'title' => 'required|max:191|unique:blog_tags,title,'.$id,
        ]);

        //generating the slug
        $title =  ucwords(strtolower($request->title));
        $slug = str_slug($title, '-');

        $cat= BlogTag::findOrFail($id);

        $cat->title = $title;
        $cat->slug = $slug;

        $cat->description = $request->description;

        $cat->status = $request->has('status');

        $cat->save();


        Session::flash('success', 'Tag Has Been Updated!');
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
        $tag= BlogTag::findOrFail($id);
        $tag->delete();

        Session::flash('success', 'Tag Has Been Deleted!');
        return redirect()->route('blogs-tag.index');
    }
}

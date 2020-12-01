<?php

namespace App\Http\Controllers\Admin\Property;

use App\Property;
use App\PropertyCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class PropertyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $propertyCategories = PropertyCategory::latest()->get();
        return view('admin.pages.property.category.index',compact('propertyCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return redirect()->route('categories.index');
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
            'name' => 'required|unique:property_categories,name',
        ]);

        try {
            $propertyCategory= new PropertyCategory();

            //generating the slug
            $slug = str_slug($request->name, '-');

            $propertyCategory->name = $request->name;
            $propertyCategory->slug= $slug;
            $propertyCategory->status = $request->has('status');

            $propertyCategory->save();

        } catch (\Exception  $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }


        Session::flash('success', 'New Parent Property Type Was Added!');
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
        return redirect()->route('categories.index');
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
       $propertyCategory = PropertyCategory::findOrFail($id);

       return view('admin.pages.property.category.edit',compact('propertyCategory'));
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
            'name' => 'required|unique:property_categories,name,'.$id,
        ]);

        $propertyCategory = PropertyCategory::findOrFail($id);
        try {

            //generating the slug
            $slug = str_slug($request->name, '-');

            $propertyCategory->name = $request->name;
            $propertyCategory->slug= $slug;
            $propertyCategory->status = $request->has('status');

            $propertyCategory->save();

            $propertyCategory->propertySubCategories()->detach();

        } catch (\Exception  $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        Session::flash('success', 'Property Type Was Updated!');
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
        $propertyCategory = PropertyCategory::findOrFail($id);

        $propertyCategory->propertySubCategories()->detach();

        //mass update
        Property::where('property_category_id',$propertyCategory->id)->update(['property_category_id' => null]);

        $propertyCategory->delete();

        Session::flash('success', 'Property Type Was Deleted!');
        return redirect()->route('categories.index');
    }
}

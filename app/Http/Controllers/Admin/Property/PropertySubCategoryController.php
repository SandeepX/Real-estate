<?php

namespace App\Http\Controllers\Admin\Property;

use App\Property;
use App\PropertyCategory;
use App\PropertySubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class PropertySubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $propertyCategories = PropertyCategory::where('status',1)->latest()->get();

        //get subcategories and only "active" associated categories
        $propertySubCategories = PropertySubCategory::with([
            'propertyCategories'=>function($query){
                $query->where('status',1);
            }
        ])->latest()->get();

        return view('admin.pages.property.subcategory.index',compact('propertyCategories','propertySubCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return redirect()->route('subcategories.index');
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
            'name' => 'required|unique:property_sub_categories,name',
            'category' => 'required',
        ]);

        try {
            $propertySubCategory= new PropertySubCategory();

            //generating the slug
            $slug = str_slug($request->name, '-');

            $propertySubCategory->name = $request->name;
            $propertySubCategory->slug= $slug;
            $propertySubCategory->status = $request->has('status');

            $propertySubCategory->save();

            //also storing in pivot table
            $propertySubCategory->propertyCategories()->attach($request->category);

        } catch (\Exception  $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }


        Session::flash('success', 'New Property Subtype Was Added!');
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
        return redirect()->route('subcategories.index');
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
        $propertySubCategory = PropertySubCategory::findOrFail($id);

        $propertyCategories = PropertyCategory::where('status',1)->latest()->get();

        return view('admin.pages.property.subcategory.edit',compact('propertySubCategory','propertyCategories'));
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
            'name' => 'required|unique:property_sub_categories,name,'.$id,
            'category' => 'required',
        ]);

        $propertySubCategory= PropertySubCategory::findOrFail($id);

        try {
            //generating the slug
            $slug = str_slug($request->name, '-');

            $propertySubCategory->name = $request->name;
            $propertySubCategory->slug= $slug;
            $propertySubCategory->status = $request->has('status');

            $propertySubCategory->save();

            //also updating in pivot table
            $propertySubCategory->propertyCategories()->sync($request->category);

        } catch (\Exception  $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }


        Session::flash('success', 'Property Subtype Was Updated!');
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
        $propertySubCategory= PropertySubCategory::findOrFail($id);

        $propertySubCategory->propertyCategories()->detach();

        //mass update
        Property::where('property_subcategory_id',$propertySubCategory->id)->update(['property_subcategory_id' => null]);

        $propertySubCategory->delete();

        Session::flash('success', 'Property Subtype was deleted!');
        //redirect
        return redirect()->route('subcategories.index');
    }
}

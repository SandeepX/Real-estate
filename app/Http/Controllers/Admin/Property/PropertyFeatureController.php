<?php

namespace App\Http\Controllers\Admin\Property;

use App\PropertyFeature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class PropertyFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $propertyFeatures = PropertyFeature::latest()->get();

        return view('admin.pages.property.features.index',compact('propertyFeatures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.property.features.create');
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
            'title' => 'required|unique:property_features,title',
        ]);

        try {
            $propertyFeature= new PropertyFeature();

            //generating the slug
            $slug = str_slug($request->title, '-');

            $propertyFeature->title = $request->title;
            $propertyFeature->slug= $slug;
            $propertyFeature->description = $request->description;

            $propertyFeature->save();

        } catch (\Exception  $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }


        Session::flash('success', 'New Property Feature Was Added!');
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
        return redirect()->route('features.index');
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
        $propertyFeature = PropertyFeature::findOrFail($id);

        return view('admin.pages.property.features.edit',compact('propertyFeature'));
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
            'title' => 'required|unique:property_features,title,'.$id,
        ]);

        $propertyFeature = PropertyFeature::findOrFail($id);
        try {

            //generating the slug
            $slug = str_slug($request->title, '-');

            $propertyFeature->title = $request->title;
            $propertyFeature->slug= $slug;
            $propertyFeature->description = $request->description;

            $propertyFeature->save();

        } catch (\Exception  $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }


        Session::flash('success', 'Property Feature Was Updated!');
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
        $propertyFeature = PropertyFeature::findOrFail($id);

        //property detach
        $propertyFeature->properties()->detach();

        $propertyFeature->delete();

        Session::flash('success', 'Property Feature Was Deleted!');
        return redirect()->route('features.index');
    }


}

<?php

namespace App\Http\Controllers\Admin\Property;

use App\Property;
use App\PropertyStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class PropertyStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $status=PropertyStatus::latest()->get();

        return view('admin.pages.property.status.index',compact('status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return redirect()->route('status.index');
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
            'title' => 'required|unique:property_statuses,title',
        ]);

        try {
            $propertyStatus= new PropertyStatus();

            //generating the slug
            $slug = str_slug($request->title, '-');

            $propertyStatus->title = $request->title;
            $propertyStatus->slug= $slug;

            $propertyStatus->save();

        } catch (\Exception  $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }


        Session::flash('success', 'New Property Status Was Added!');
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
        return redirect()->route('status.index');
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
        $propertyStatus = PropertyStatus::findOrFail($id);

        return view('admin.pages.property.status.edit',compact('propertyStatus'));
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
            'title' => 'required|unique:property_statuses,title,'.$id,
        ]);

        try {
            $propertyStatus= PropertyStatus::findOrFail($id);

            //generating the slug
            $slug = str_slug($request->title, '-');

            $propertyStatus->title = $request->title;
            $propertyStatus->slug= $slug;

            $propertyStatus->save();

        } catch (\Exception  $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }


        Session::flash('success', 'Property Status Was Updated!');
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
        $propertyStatus = PropertyStatus::findOrFail($id);

        //mass update
        Property::where('property_status_id',$propertyStatus->id)->update(['property_status_id' => null]);

        $propertyStatus->delete();

        Session::flash('success', 'Property Status Was Deleted!');
        return redirect()->back();

    }
}

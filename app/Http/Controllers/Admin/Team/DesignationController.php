<?php

namespace App\Http\Controllers\Admin\Team;

use App\TeamDesignation;
use App\TeamMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $designations = TeamDesignation::orderBy('sorting_order','asc')->get();

        return view('admin.pages.teams.designations.index',compact('designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.teams.designations.create');
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
            'title' => 'required|unique:team_designations,title',
            'sorting_order' => 'required|numeric|unique:team_designations,sorting_order',
        ]);

        //generating the slug
        $title = $request->title;
        $slug = str_slug($title, '-');

        $des= new TeamDesignation();

        $des->title = $title;
        $des->slug = $slug;

        $des->sorting_order = $request->sorting_order;

        $des->status = $request->has('status');

        $des->save();


        Session::flash('success', 'New Designation Has Been Added!');
        return redirect()->route('designations.create');
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
        return redirect()->route('designations.index');
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
        $designation = TeamDesignation::findOrFail($id);

        return view('admin.pages.teams.designations.edit',compact('designation'));
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
            'title' => 'required|unique:team_designations,title,'.$id,
            'sorting_order' => 'required|numeric|unique:team_designations,sorting_order,'.$id,
        ]);

        //generating the slug
        $title = $request->title;
        $slug = str_slug($title, '-');

        $des= TeamDesignation::findOrFail($id);

        $des->title = $title;
        $des->slug = $slug;

        $des->sorting_order = $request->sorting_order;

        $des->status = $request->has('status');

        $des->save();


        Session::flash('success', 'Designation Has Been Updated!');
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
        $des = TeamDesignation::findOrFail($id);

        //mass update
        TeamMember::where('designation_id',$des->id)->update(['designation_id' => null]);

        $des->delete();

        Session::flash('success', 'Designation Has Been Deleted!');
        return redirect()->route('designations.index');

    }
}

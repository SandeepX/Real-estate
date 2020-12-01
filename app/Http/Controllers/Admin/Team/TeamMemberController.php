<?php

namespace App\Http\Controllers\Admin\Team;

use App\CustomServices\ImageService;
use App\TeamCategory;
use App\TeamDesignation;
use App\TeamMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class TeamMemberController extends Controller
{
    public function deleteImage(Request $request,$id){

        if ($request->ajax()) {

            $team = TeamMember::findOrFail($id);

            $oldFileName = $team->image;

            $team->image=null;

            $team->save();

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
        $members = TeamMember::with(['category','designation'])->get();

        return view('admin.pages.teams.members.index',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $teamCategories = TeamCategory::get();

        $designations = TeamDesignation::where('status',1)->orderBy('sorting_order','asc')->get();

        return view('admin.pages.teams.members.create',compact('teamCategories','designations'));
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
            'name' => 'required|max:191',
            'team_category' => 'required',
            'designation' => 'required',
            'image' => 'sometimes|nullable|image',
        ]);
        

        $member= new TeamMember();

        $member->name = $request->name;
        $member->category_id = $request->team_category;

        $member->designation_id = $request->designation;

        $member->facebook = $request->facebook;
        $member->linkedin = $request->linkedin;

        $member->status = $request->has('status');

        //save Image
        if ($request->hasFile('image')) {

            //save image in server
            $filenameToStore=ImageService::saveImage($request->file('image'));

            $member->image=$filenameToStore;

        }

        $member->save();


        Session::flash('success', 'New Team Member Has Been Added!');
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
        return redirect()->route('members.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member= TeamMember::findOrFail($id);

        $teamCategories = TeamCategory::get();

        $designations = TeamDesignation::where('status',1)->orderBy('sorting_order','asc')->get();

        return view('admin.pages.teams.members.edit',compact('teamCategories','designations','member'));
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
            'name' => 'required|max:191',
            'team_category' => 'required',
            'designation' => 'required',
            'image' => 'sometimes|nullable|image',
        ]);


        $member= TeamMember::findOrFail($id);

        $member->name = $request->name;
        $member->category_id = $request->team_category;

        $member->designation_id = $request->designation;

        $member->facebook = $request->facebook;
        $member->linkedin = $request->linkedin;

        $member->status = $request->has('status');

        //save Image
        if ($request->hasFile('image')) {

            //save image in server
            $filenameToStore=ImageService::saveImage($request->file('image'));

            $oldFileName=$member->image;
            $member->image=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $member->image == $filenameToStore) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }

        }

        $member->save();


        Session::flash('success', 'Team Member Has Been Updated!');
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
        $team= TeamMember::findOrFail($id);

        $imageToBeDeleted=$team->image;

        //delete floor image
        ImageService::deleteImage($imageToBeDeleted);

        $team->delete();

        Session::flash('success', 'Team Member Has Been Deleted!');

        return redirect()->route('members.index');
    }
}

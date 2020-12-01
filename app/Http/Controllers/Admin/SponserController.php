<?php

namespace App\Http\Controllers\Admin;

use App\CustomServices\ImageService;
use App\Sponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class SponserController extends Controller
{

    public function deleteImage(Request $request,$id){

        if ($request->ajax()) {

            $sponser = Sponser::findOrFail($id);

            $oldFileName = $sponser->company_logo;

            $sponser->company_logo=null;

            $sponser->save();

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
        $sponsers = Sponser::latest()->get();

        return view('admin.pages.sponsers.index',compact('sponsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.sponsers.create');
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
            'company_name' => 'required|max:191',
            'company_website' => 'sometimes|nullable|url',
            'company_logo' => 'sometimes|nullable|image',
        ]);

        $sponser= new Sponser();

        $sponser->company_name = ucwords(strtolower($request->company_name));
        $sponser->company_website = $request->company_website;

        $sponser->status = $request->has('status');

        //save Image
        if ($request->hasFile('company_logo')) {

            //save image in server
            $filenameToStore=ImageService::saveImage($request->file('company_logo'));

            $sponser->company_logo=$filenameToStore;

        }

        $sponser->save();


        Session::flash('success', 'New Sponser Has Been Added!');
        return redirect()->route('sponsers.create');
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
        return redirect()->route('sponsers.create');
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
        $sponser = Sponser::findOrFail($id);

        return view('admin.pages.sponsers.edit',compact('sponser'));
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
            'company_name' => 'required|max:191',
            'company_website' => 'sometimes|nullable|url',
            'company_logo' => 'sometimes|nullable|image',
        ]);

        $sponser= Sponser::findOrFail($id);

        $sponser->company_name = ucwords(strtolower($request->company_name));
        $sponser->company_website = $request->company_website;

        $sponser->status = $request->has('status');

        //save Image
        if ($request->hasFile('company_logo')) {

            //save image in server
            $filenameToStore=ImageService::saveImage($request->file('company_logo'));

            $oldFileName=$sponser->company_logo;
            $sponser->company_logo=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $sponser->company_logo == $filenameToStore) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }

        }

        $sponser->save();


        Session::flash('success', 'Sponser Has Been Updated!');
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
        $sponser= Sponser::findOrFail($id);

        $imageToBeDeleted=$sponser->company_logo;

        //delete floor image
        ImageService::deleteImage($imageToBeDeleted);

        $sponser->delete();

        Session::flash('success', 'Sponser Has Been Deleted!');

        return redirect()->route('sponsers.index');
    }
}

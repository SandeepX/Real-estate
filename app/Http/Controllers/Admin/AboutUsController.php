<?php

namespace App\Http\Controllers\Admin;

use App\AboutUs;
use App\CustomServices\ImageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class AboutUsController extends Controller
{
    public function deleteImage(Request $request,$column){

        if ($request->ajax()) {

            $about = AboutUs::first();

            switch ($column){
                case 'bg_image':
                    $oldFileName = $about->bg_image;

                    $about->bg_image=null;
                    break;
                case 'ceo_image':
                    $oldFileName = $about->ceo_image;

                    $about->ceo_image=null;
                    break;
                default:
                    return response()->json('No image found.',400);
            }

            $about->save();

            //delete image from Server
            if (!empty($oldFileName)) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }

        }
    }

    //
    public function editAbout(){

        $about = AboutUs::first();

        return view('admin.pages.about.about',compact('about'));
    }

    public function updateAbout(Request $request){

        $this->validate($request, [
            'title' => 'required|max:191',
            'ceo_message' => 'required',
            'ceo_image' => 'sometimes|nullable|image',
            'bg_image' => 'sometimes|nullable|image',
            'overview' => 'required',
            'our_mission' => 'required',
            'our_vision' => 'required',
            'our_statements' => 'required',
        ]);

        $about = AboutUs::first();

        $about->title= ucwords(strtolower($request->title));
        $about->ceo_message= $request->ceo_message;

        $about->overview= $request->overview;
        $about->our_mission= $request->our_mission;
        $about->our_vision= $request->our_vision;

        $about->our_statements= $request->our_statements;


        if ($request->hasFile('ceo_image')) {

            //save image in server
            $filenameToStore=ImageService::saveImage($request->file('ceo_image'));

            //save image in db
            $oldFileName=$about->ceo_image;
            $about->ceo_image=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $about->ceo_image == $filenameToStore) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }

        if ($request->hasFile('bg_image')) {

            //save image in server
            $filenameToStore=ImageService::saveImage($request->file('bg_image'));

            //save image in db
            $oldFileName=$about->bg_image;
            $about->bg_image=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $about->bg_image == $filenameToStore) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }

        $about->save();

        Session::flash('success', 'About Us Has Been Updated');
        return redirect()->back();
    }
}

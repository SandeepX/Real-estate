<?php

namespace App\Http\Controllers\Admin;

use App\CustomServices\ImageService;
use App\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class SiteSettingController extends Controller
{
    //
    public function editSiteSetting(){

        $setting= SiteSetting::first();
        return view('admin.pages.site-setting.site_setting',compact('setting'));
    }

    public function updateSiteSetting(Request $request){

        $this->validate($request, [
            'site_title' => 'required|max:191',
            'site_subtitle' => 'required|max:191',
            'site_logo' => 'sometimes|nullable|image',
            'site_favicon' => 'sometimes|nullable|image',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'description' => 'required',
        ]);

        $setting = SiteSetting::first();

        $setting->site_title= ucwords(strtolower($request->site_title));
        $setting->site_subtitle= ucwords(strtolower($request->site_subtitle));

        $setting->email= $request->email;
        $setting->alt_email= $request->alt_email;
        $setting->phone= $request->phone;
        $setting->mobile= $request->mobile;
        $setting->address= ucwords(strtolower($request->address));
        $setting->description= $request->description;

        $setting->facebook= $request->facebook;
        $setting->twitter= $request->twitter;
        $setting->linkedin= $request->linkedin;
        $setting->instagram= $request->instagram;
        $setting->map_location= $request->map_location;
        $setting->copyright_text= $request->copyright_text;


        if ($request->hasFile('site_logo')) {

            //save image in server
            $filenameToStore=ImageService::saveImage($request->file('site_logo'));

            //save image in db
            $oldFileName=$setting->site_logo;
            $setting->site_logo=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $setting->site_logo == $filenameToStore) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }
        
        if ($request->hasFile('site_favicon')) {

            //save image in server
            $filenameToStore=ImageService::saveImage($request->file('site_favicon'));

            //save image in db
            $oldFileName=$setting->site_favicon;
            $setting->site_favicon=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $setting->site_favicon == $filenameToStore) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }
        }

        $setting->save();

        Session::flash('success', 'Site Setting Has Been Updated');
        return redirect()->back();

    }
}

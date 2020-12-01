<?php

namespace App\Http\Controllers\Admin;

use App\CustomServices\ImageService;
use App\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class TestimonialController extends Controller
{
    public function deleteImage(Request $request,$id){

        if ($request->ajax()) {

            $testi = Testimonial::findOrFail($id);

            $oldFileName = $testi->client_image;

            $testi->client_image=null;

            $testi->save();

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
        $testimonials = Testimonial::latest()->get();

        return view('admin.pages.testimonials.index',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.testimonials.create');
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
            'client_name' => 'required|max:191',
            'client_company' => 'required|max:191',
            'client_image' => 'sometimes|nullable|image',
            'client_message' => 'required'
        ]);

        $testi= new Testimonial();

        $testi->client_name = ucwords(strtolower($request->client_name));
        $testi->client_company = $request->client_company;
        $testi->client_position = $request->client_position;

        $testi->client_message = $request->client_message;

        $testi->status = $request->has('status');

        //save Image
        if ($request->hasFile('client_image')) {

            //save image in server
            $filenameToStore=ImageService::saveImage($request->file('client_image'));

            $testi->client_image=$filenameToStore;

        }

        $testi->save();


        Session::flash('success', 'New Testimonial Has Been Added!');
        return redirect()->route('testimonials.create');
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
        return redirect()->route('testimonials.create');
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
        $testimonial = Testimonial::findOrFail($id);

        return view('admin.pages.testimonials.edit',compact('testimonial'));
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
            'client_name' => 'required|max:191',
            'client_company' => 'required|max:191',
            'client_image' => 'sometimes|nullable|image',
            'client_message' => 'required'
        ]);

        $testi= Testimonial::findOrFail($id);

        $testi->client_name = ucwords(strtolower($request->client_name));
        $testi->client_company = $request->client_company;
        $testi->client_position = $request->client_position;

        $testi->client_message = $request->client_message;

        $testi->status = $request->has('status');

        //save Image
        if ($request->hasFile('client_image')) {

            $filenameToStore=ImageService::saveImage($request->file('client_image'));

            $oldFileName=$testi->client_image;
            $testi->client_image=$filenameToStore;

            //delete image from Server
            if (!empty($oldFileName) && $testi->client_image == $filenameToStore) {
                //delete the old photo
                ImageService::deleteImage($oldFileName);
            }

        }

        $testi->save();


        Session::flash('success', 'Testimonial Has Been Updated!');
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

        $testi= Testimonial::findOrFail($id);

        $imageToBeDeleted=$testi->client_image;

        //delete floor image
        ImageService::deleteImage($imageToBeDeleted);

        $testi->delete();

        Session::flash('success', 'Testimonial Has Been Deleted!');

        return redirect()->route('testimonials.index');
    }
}

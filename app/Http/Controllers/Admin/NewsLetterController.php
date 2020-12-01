<?php

namespace App\Http\Controllers\Admin;

use App\CustomServices\ImageService;
use App\Jobs\SendNewsLetterMail;
use App\Mail\NewsLetterMail;
use App\NewsLetter;
use App\SiteSetting;
use App\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Session;

class NewsLetterController extends Controller
{

    public function publish($id){

        $newsLetter = NewsLetter::findOrFail($id);

        if ($newsLetter->isPublished == 1){

            Session::flash('success', 'Newsletter was already sent!');
            return redirect()->back();

        }

        $this->sendMailToSubscribers($newsLetter);
        $newsLetter->isPublished = 1;
        $newsLetter->save();

        Session::flash('success', 'Newsletter Has Been Sent!');
        return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $newsLetters = NewsLetter::latest()->get();

        return view('admin.pages.newsletter.index',compact('newsLetters'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.newsletter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       /* $data = array(
           'title' => 'prajwal'

        );
        dispatch(new SendNewsLetterMail('shramik41@gmail.com',$data));*/

        //
        $this->validate($request, [
            'title' => 'required|max:191',
            'body' => 'required',
            'image' => 'sometimes|nullable|image',
        ]);

        $letter= new NewsLetter();

        $letter->title = ucwords(strtolower($request->title));
        $letter->body = $request->body;

        $letter->isPublished = $request->has('isPublished');

        //save Image
        if ($request->hasFile('image')) {

            //save image in server
            $filenameToStore=ImageService::saveImage($request->file('image'));

            $letter->image=$filenameToStore;

        }

       $letter->save();

        if ($letter->isPublished == 1){

            $this->sendMailToSubscribers($letter);
        }


        Session::flash('success', 'New Newsletter Has Been Sent!');
        return redirect()->route('newsletter.create');
    }

    public function sendMailToSubscribers($letter){

        $subscribers = Subscriber::select('email')->where('status',1)->get();

        foreach ($subscribers as $subscriber){

            dispatch(new SendNewsLetterMail($subscriber->email,$letter));

        }

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
        $newsLetter = NewsLetter::findOrFail($id);

        return view('admin.pages.newsletter.single',compact('newsLetter'));
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
        //
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
        $newsLetter = NewsLetter::findOrFail($id);

        $newsLetter->delete();

        Session::flash('success', 'New Newsletter Has Been Deleted!');
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $faqs = Faq::latest()->get();

        return view('admin.pages.faqs.index',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.faqs.create');
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
            'question' => 'required|unique:faqs,question',
            'answer' => 'required',
        ]);

        $faq= new Faq();

        $faq->question = $request->question;
        $faq->answer = $request->answer;

        $faq->video_id = $request->video_id;
        $faq->status = $request->has('status');

        $faq->save();


        Session::flash('success', 'New Faq Has Been Added!');
        return redirect()->route('faqs.index');
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
        return redirect()->route('faqs.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq= Faq::findOrFail($id);

        return view('admin.pages.faqs.edit',compact('faq'));
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
            'question' => 'required|unique:faqs,question,'.$id,
            'answer' => 'required',
        ]);

        $faq= Faq::findOrFail($id);

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->video_id = $request->video_id;
        $faq->status = $request->has('status');

        $faq->save();

        Session::flash('success', 'Faq Has Been Updated!');
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
        $faq= Faq::findOrFail($id);

        $faq->delete();

        Session::flash('success', 'Faq Has Been Deleted!');
        return redirect()->route('faqs.index');
    }
}

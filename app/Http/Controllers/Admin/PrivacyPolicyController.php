<?php

namespace App\Http\Controllers\Admin;

use App\PrivacyPolicy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Session;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $policies = PrivacyPolicy::latest()->get();

        return view('admin.pages.privacy.index',compact('policies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.privacy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'topics' =>'required|array',
            'topics.*' => 'required|max:191',
            'descriptions' =>'required|array',
            'descriptions.*' => 'required',

        ],[
            'topics.required' => 'Please fill all the topics.',
            'topics.*.required' => 'Please fill all the topics.',
            'topics.*.max' => 'Topics may not contain more than 191 characters.',
            'descriptions.required' => 'Please fill description.',
            'descriptions.*.required' => 'Please fill all the descriptions.'
        ]);


        $topics=array_filter($request->topics);

        $descriptions=array_filter($request->descriptions);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('topics',$topics)
                ->with('descriptions',$descriptions);
        }

       foreach ($topics as $index=>$topic){

           $policy = new PrivacyPolicy();

           $policy->topic = $topic;
           $policy->description =count($descriptions) > $index ? $descriptions[$index] :'';

           $policy->save();

       }

        Session::flash('success', 'Policy Plans Has Been Added!');
        //return redirect()->back();
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
        return redirect()->route('policy.index');
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
        $policy = PrivacyPolicy::findOrFail($id);

        return view('admin.pages.privacy.edit',compact('policy'));
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
        $validator = Validator::make($request->all(), [
            'topic' => 'required|max:191',
            'description' =>'required',

        ],[
            'topic.required' => 'Please fill topic.',
            'topic.max' => 'Topic may not contain more than 191 characters.',
            'description.required' => 'Please fill description.',
        ]);


        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $policy = PrivacyPolicy::findOrFail($id);

        $policy->topic = $request->topic;
        $policy->description =$request->description;

        $policy->save();

        Session::flash('success', 'Privacy Policy Has Been Updated!');
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
        $policy = PrivacyPolicy::findOrFail($id);

        $policy->delete();

        Session::flash('success', 'Privacy Policy Has Been Deleted!');
        return redirect()->back();
    }
}

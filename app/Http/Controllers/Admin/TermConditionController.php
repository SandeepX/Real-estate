<?php

namespace App\Http\Controllers\Admin;

use App\TermCondition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Session;

class TermConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = TermCondition::latest()->get();

        return view('admin.pages.terms.index',compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.terms.create');
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
            'topics.required' => 'Please fill all the topics..',
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

            $term = new TermCondition();

            $term->topic = $topic;
            $term->description =count($descriptions) > $index ? $descriptions[$index] :'';

            $term->save();

        }

        Session::flash('success', 'Terms And Conditions Has Been Added!');
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
        return redirect()->route('conditions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $term = TermCondition::findOrFail($id);

        return view('admin.pages.terms.edit',compact('term'));
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

        $term = TermCondition::findOrFail($id);

        $term->topic = $request->topic;
        $term->description =$request->description;

        $term->save();

        Session::flash('success', 'Terms And Conditions Has Been Updated!');
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
        $term = TermCondition::findOrFail($id);

        $term->delete();

        Session::flash('success', 'Terms And Conditions Has Been Deleted!');
        return redirect()->back();
    }
}

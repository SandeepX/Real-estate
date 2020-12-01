<?php

namespace App\Http\Controllers\Admin;

use App\PricingPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Session;

class PricingPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pricingPlans = PricingPlan::latest()->get();

        return view('admin.pages.pricing.index',compact('pricingPlans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.pricing.create');
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
            'plan_name' =>'required|max:191|unique:pricing_plans,plan_name',
            'price' => 'required',
            'price_postfix' => 'required|max:191',
            'features'=> 'required|array|min:2',
            'features.*' => 'max:191',

        ],[
            'features.min' => 'Please Fill At Least One Feature.',
            'features.*.max' => 'Features may not contain more than 191 characters.'
        ]);

        $features=array_filter($request->features);

        if ($validator->fails()) {

            $oldFields = $features;
            //dd($request);
            //dd($oldFields);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('oldFields',$oldFields);
        }


        $planName = ucwords(strtolower($request->plan_name));
        //generating the slug
        $slug = str_slug($planName, '-');

        $plan = new PricingPlan();

        $plan->plan_name = $planName;
        $plan->slug = $slug;
        $plan->price = $request->price;
        $plan->price_postfix = $request->price_postfix;

        $plan->status = $request->has('status');
        $plan->isFeatured = $request->has('isFeatured');


        //saving array..Returns a string containing the JSON representation of the supplied value.
        if (!empty($features)){
            $plan->features =  json_encode($features);
        }


        $plan->save();

        Session::flash('success', 'New Pricing Plan Has Been Added!');
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
        $pricingPlan = PricingPlan::findOrFail($id);

        //features of pricing plan
        $features =json_decode($pricingPlan->features);

        return view('admin.pages.pricing.edit',compact('features','pricingPlan'));
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
            'plan_name' =>'required|max:191|unique:pricing_plans,plan_name,'.$id,
            'price' => 'required',
            'price_postfix' => 'required|max:191',
            'features'=> 'required|array|min:2',
            'features.*' => 'sometimes|max:191',

        ],[
            'features.min' => 'Please Fill At Least One Feature.',
            'features.*.max' => 'Features may not contain more than 191 characters.'
        ]);

        $features=array_filter($request->features);

        if ($validator->fails()) {

            $oldFields = $features;
            //dd($request);
            //dd($oldFields);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('oldFields',$oldFields);
        }


        $planName = ucwords(strtolower($request->plan_name));
        //generating the slug
        $slug = str_slug($planName, '-');

        $plan = PricingPlan::findOrFail($id);

        $plan->plan_name = $planName;
        $plan->slug = $slug;
        $plan->price = $request->price;
        $plan->price_postfix = $request->price_postfix;

        $plan->status = $request->has('status');
        $plan->isFeatured = $request->has('isFeatured');


        //saving array..Returns a string containing the JSON representation of the supplied value.
        if (!empty($features)){
            $plan->features =  json_encode($features);
        }

        $plan->save();

        Session::flash('success', 'Pricing Plan Has Been Updated!');
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
        $plan = PricingPlan::findOrFail($id);

        $plan->delete();

        Session::flash('success', 'Pricing Plan Has Been Deleted!');
        return redirect()->route('pricing.index');

    }
}

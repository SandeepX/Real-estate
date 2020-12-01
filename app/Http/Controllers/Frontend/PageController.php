<?php

namespace App\Http\Controllers\Frontend;

use App\AboutUs;
use App\Blog;
use App\BlogTag;
use App\ContactMessage;
use App\Faq;
use App\Notifications\ContactMessageNotificaiton;
use App\PricingPlan;
use App\PrivacyPolicy;
use App\Property;
use App\PropertyAddress;
use App\PropertyFeature;
use App\PropertyFloorPlan;
use App\PropertyGallery;
use App\PropertyMoreInformation;
use App\PropertyReview;
use App\PropertyStatus;
use App\PropertySubCategory;
use App\Sponser;
use App\Subscriber;
use App\TeamMember;
use App\TermCondition;
use App\Testimonial;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    //
    public function getHome(){

        $featuredProperties = Property::with(['saleStatus','category','subCategory','information'])->verified()->featured()
            ->latest()->take(6)->get();

        $newProperties = Property::with(['saleStatus','category','subCategory','information'])->verified()
            ->where('feature_status','unfeatured')->latest()->take(6)->get();

        $trendingProperties = Property::with(['saleStatus','category','subCategory','information'])->verified()
            ->orderBy('view_count','desc')->take(6)->get();

        $blogs= Blog::where('isPublished',1)->latest()->take(5)->get();

        $testimonials = Testimonial::where('status',1)->latest()->take(5)->get();

        //for map
        $allProperties = Property::with(['category','subCategory','address','information'])->verified()->get();

       $propertyTypes = PropertySubCategory::where('status',1)->get();

        return view('frontend.pages.home.home',compact('featuredProperties','newProperties',
            'trendingProperties','allProperties','propertyTypes','blogs','testimonials'));
    }

    public function getAbout(){

        $aboutUs = AboutUs::first();

        $boardMembers = TeamMember::where('category_id', 1)->get();

       /* $techMembers = TeamMember::with(['designation'])->where('category_id', '=', 2)
            ->join('team_designations', 'team_designations.id', '=', 'team_members.designation_id')
            ->where('team_members.status',1)
            ->where('team_designations.status',1)
            ->orderBy('team_designations.sorting_order', 'asc')
            ->get();*/
       $techMembers = TeamMember::with(['designation'])->where('category_id', '=', 2)
             ->whereHas('designation',function ($query){
                 $query->where('status','1');
             })->where('status',1)->get()->sortBy('designation.sorting_order');

        return view ('frontend.pages.about.about', compact('aboutUs', 'boardMembers', 'techMembers'));
    }

    public function getFaqs(){

        $faqs = Faq::where('status',1)->get();

        $recentProperties = Property::where('status',1)->latest()->take(3)->get();

        return view('frontend.pages.faq.faq',compact('faqs','recentProperties'));

    }

    public function getContactPage(){

        return view('frontend.pages.contact.contact');
    }

    public function postContactMessage(Request $request){

        //validate
        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|email',
            'subject' => 'required|max:191',
            'phone' => 'required|max:191',
            'message' => 'required',
        ]);

        $message = new ContactMessage();

        $message->name = $request->name;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->phone = $request->phone;
        $message->message = $request->message;

        $message->save();

        $this->sendContactMessageNotificationsToaAdmin($message);

        Session::flash('success', 'Your Message Has Been Delivered.');
        return redirect()->back();
    }

    public function sendContactMessageNotificationsToaAdmin($message){

        $superAdmins = User::role('Super Admin')->get();

        Notification::send($superAdmins, new ContactMessageNotificaiton($message));
    }

    public function getPricingPage(){

        $basicPlan = PricingPlan::where('status',1)->where('slug','basic')->first();

        $totalBasicPlanFeatures = count(json_decode($basicPlan->features));

        $advancePlan = PricingPlan::where('status',1)->where('slug','advance')->first();
        $totalAdvancePlanFeatures = count(json_decode($advancePlan->features));

        $premiumPlan = PricingPlan::where('status',1)->where('slug','premium')->first();
        $totalPremiumPlanFeatures = count(json_decode($premiumPlan->features));

        return view('frontend.pages.plans.price.price',compact('basicPlan','advancePlan','premiumPlan',
            'totalBasicPlanFeatures','totalAdvancePlanFeatures','totalPremiumPlanFeatures'));
    }

    public function getPrivacyPolicyPage(){

        $policies = PrivacyPolicy::all();

        $propertyStatuses = PropertyStatus::all();

        $propertyTypes = PropertySubCategory::where('status',1)->get();

        //property features
        $propertyFeatures = PropertyFeature::latest()->get();

        return view('frontend.pages.privacy.privacy',compact('policies','propertyStatuses',
            'propertyFeatures','propertyTypes'));
    }

    public function getTermsAndConditiosPage(){

        $terms = TermCondition::all();

        $propertyStatuses = PropertyStatus::all();

        $propertyTypes = PropertySubCategory::where('status',1)->get();

        //property features
        $propertyFeatures = PropertyFeature::latest()->get();

        return view('frontend.pages.terms.terms',compact('terms','propertyStatuses',
            'propertyFeatures','propertyTypes'));
    }


    public function storeSubscriber(Request $request){

        //validate
        $this->validate($request, [
            'email' =>'required|email',
        ]);

        $isOldSubscriber = Subscriber::where('email',$request->email)->first();

        if(!is_null($isOldSubscriber)){

            if ($isOldSubscriber->status == 1){

                Session::flash('success', 'You Have Already Subscribed, Thank You');
                return redirect()->back()->with('subscribe','subscribe');
            }
            else{
                $isOldSubscriber->delete();
            }
        }

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->token = str_random(40);
        $subscriber->status = 0;

        $subscriber->sendConfirmationMail($subscriber);

        $subscriber->save();

        Session::flash('success', 'Please check your email to confirm subscription, Thank You!');
        return redirect()->back()->with('subscribe','subscribe');

    }

    public function confirmSubscription($token){

        $subscriber = Subscriber::where('token',$token)->firstOrFail();

        $subscriber->verify();

        $subscriber->save();

        //$subscriber->update(['token' => null, 'status' =>1]);

        Session::flash('success', 'Thank you! For Subscribing.');
        return redirect()->back();
    }


    public function calculateEmi(Request $request){


        $validator = Validator::make($request->all(), [
            'total_amount' =>'required|numeric',
            'interest_rate' =>'required|min:1|max:100|numeric',
            'period' =>'required|numeric',
            'down_payment' =>'required|numeric',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),400);

            /*return redirect()->back()
                ->withErrors($validator)
                ->withInput();*/
        }
      /*  //validate
        $this->validate($request, [
            'total_amount' =>'required|numeric',
            'interest_rate' =>'required|min:1|max:100|numeric',
            'period' =>'required|numeric',
            'down_payment' =>'required|numeric',
        ]);*/

        $totalAmount = $request->total_amount;
        $interestRate= $request->interest_rate;
        $periodInMonths = $request->period;
        $downPayment = $request->down_payment;

        $principle = $totalAmount-$downPayment;
        $R = $interestRate/12/100; //(12/100 =0.12 monthly)

        //return pow(2,3);
        $numerator = $principle * $R *pow(1+$R,$periodInMonths);

        $denominator =pow(1+$R,$periodInMonths)-1;

        $emi = $numerator/$denominator;

       $result=[
           'total_amount' =>$totalAmount,
           'interest_rate' =>$interestRate,
           'period' =>$periodInMonths,
           'down_payment' =>$downPayment,
           'emi' =>$emi
       ];

        //return $emi
        if($request->ajax()){
            return view('frontend.pages.partials.emi-result',compact('result'))->render();
        }

        //return view('frontend.pages.partials.emi-result',compact('emi'))->with('emi','emi')->render();


    }


    public function showPropertyMap(){
        $allProperties = Property::with(['category','subCategory','address','information'])->verified()->get();

        $propertyTypes = PropertySubCategory::where('status',1)->get();
        return view('frontend.pages.property-map.property-map',compact('allProperties','propertyTypes'));
    }

}

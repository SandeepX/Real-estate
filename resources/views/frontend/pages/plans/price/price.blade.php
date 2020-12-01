@extends('frontend.layouts.master')
@section('title','Price Details')
@section('content')

    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <h2>Pricing</h2>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <ul class="breadcrumb-ul">
                        <li><a href="{{route('fe.home')}}">Home</a></li>
                        <li><i class="fas fa-chevron-right"></i></li>
                        <li class="active"><a href="{{route('fe.pricingDetail')}}">Pricing</a></li>
                    </ul>
                </div>
            </div>
        </div> 
    </section>

    <section class="pricing-table-section bg-grey">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-4" >
                    <div class="pricing-3 mb-50 clearfix {{$basicPlan->isFeatured ? 'featured' : ''}}">

                        @if($basicPlan->isFeatured)
                            <div class="listing-badges">
                                <span class="featured">featured</span>
                            </div>
                        @endif

                        <div class="price-header plan-1">
                            <div class="title">{{$basicPlan->plan_name}}</div>
                            <div class="price">RS.{{$basicPlan->price}} <span>{{$basicPlan->price_postfix}}</span></div>
                        </div>
                        <div class="content">
                            <ul>

                                @for($i=0; $i<$totalPremiumPlanFeatures; $i++)

                                    @if($i>=$totalBasicPlanFeatures)
                                        <li><i class="fas fa-times color-red"></i></li>
                                    @else
                                        <li>{{json_decode($basicPlan->features)[$i]}}</li>
                                    @endif
                                @endfor

                            </ul>
                            <div class="button"><a href="#" class="btn btn-outline pricing-btn">Get started</a></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4" >
                    <div class="pricing-3 mb-0 {{$advancePlan->isFeatured ? 'featured' : ''}} clearfix">
                        @if($advancePlan->isFeatured)
                            <div class="listing-badges">
                                <span class="featured">featured</span>
                            </div>
                        @endif
                        <div class="price-header price-header-2 plan-2">
                            <div class="title">{{$advancePlan->plan_name}}</div>
                            <div class="price">RS.{{$advancePlan->price}} <span>{{$advancePlan->price_postfix}}</span>	</div>
                        </div>
                        <div class="content">
                            <ul>
                                @for($i=0; $i<$totalPremiumPlanFeatures; $i++)

                                    @if($i>=$totalAdvancePlanFeatures)
                                        <li><i class="fas fa-times color-red"></i></li>
                                    @else
                                        <li>{{json_decode($advancePlan->features)[$i]}}</li>
                                    @endif
                                @endfor
                            </ul>
                            <div class="button"><a href="#" class="btn button-theme pricing-btn">Get started</a></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4" >
                    <div class="pricing-3 mb-50 clearfix {{$premiumPlan->isFeatured ? 'featured' : ''}}">

                        @if($premiumPlan->isFeatured)
                            <div class="listing-badges">
                                <span class="featured">featured</span>
                            </div>
                        @endif

                        <div class="price-header plan-3">
                            <div class="title">{{$premiumPlan->plan_name}}</div>
                            <div class="price">RS.{{$premiumPlan->price}} <span>{{$premiumPlan->price_postfix}}</span></div>
                        </div>
                        <div class="content">
                            <ul>
                                @foreach(json_decode($premiumPlan->features) as $feature)
                                    <li>{{$feature}}</li>
                                @endforeach
                            </ul>
                            <div class="button"><a href="#" class="btn btn-outline pricing-btn">Get started</a></div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

@endsection
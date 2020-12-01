@extends('admin.layout.master')

@section('title','Edit Pricing Plan')

@section('content')
    <!-- Site Content -->
    <div class="dt-content">

        <!-- Grid breadcrumbs -->
        <div class="row dt-masonry">

            <!-- Grid Item -->
            <div class="col-md-12 dt-masonry__item">

                <!-- Breadcrumbs -->

                <ol class="mb-0 breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="active breadcrumb-item"><a href="{{route('pricing.index')}}">Pricing Plans</a> </li>
                    <li class="active breadcrumb-item"><a href="{{route('pricing.edit',$pricingPlan->id)}}">Edit</a> </li>
                </ol>
                <!-- /breadcrumbs -->

            </div>
            <!-- /grid item -->

        </div>
        <!-- /grid breadcrumbs -->

        <!-- Page Header -->
        <div class="dt-page__header">
            <h1 class="dt-page__title"></h1>
        </div>
        <!-- /page header -->

    @include('partials.messages')

    <!-- Grid -->
        <div class="row dt-masonry">

            <!-- Grid Item ,form-->
            <div class="col-md-12 dt-masonry__item ">
                <!-- Card -->
                <div class="dt-card">

                    <!-- Card Header -->
                    <div class="dt-card__header">

                        <!-- Card Heading -->
                        <div class="dt-card__heading">
                            <h3 class="dt-card__title">Edit Pricing Plan</h3>
                        </div>
                        <!-- /card heading -->

                    </div>
                    <!-- /card header -->

                    <!-- Card Body -->
                    <div class="dt-card__body">

                        <!-- Form -->
                        <form id="form" method="post" action="{{route('pricing.update',$pricingPlan->id)}}" >

                        {{ csrf_field()}}

                            <input type="hidden" name="_method" value="PUT">

                        <!-- Form Group -->
                            <div class="form-group">
                                <label for="plan_name">Plan Name</label>
                                <input type="text" class="form-control" id="plan_name" name="plan_name" value="{{ $pricingPlan->plan_name }}"
                                       aria-describedby="emailHelp1"
                                       placeholder="Enter Plan Name">
                                <span class="text-danger">{{ $errors->first('plan_name') }}</span>
                            </div>
                            <!-- /form group -->

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="price">Price (Only digits)</label>
                                        <input type="number" min="0" class="form-control" id="price" name="price" value="{{$pricingPlan->price}}"
                                               placeholder="Enter Price">
                                        <small  class="form-text">
                                            Example Vlaue: 435000
                                        </small>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label for="price_postfix" class="label-color">Price Postfix</label>

                                        <input id="price_postfix" type="text" value="{{$pricingPlan->price_postfix}}" class="form-control" name="price_postfix"
                                               placeholder="Example: Per Year">

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Features</label>



                                <div class="fields">
                                    @if(isset($features) && count($features)> 0 )

                                        @foreach($features as $field)
                                            <div class="entry input-group col-xs-3">
                                                <input class="form-control" name="features[]" value="{{$field}} " type="text" placeholder="Type something" />
                                                <span class="input-group-btn">
                                                            <button class="btn btn-danger btn-remove" type="button">
                                                                <span class="fa fa-minus"></span>
                                                            </button>
                                                        </span>
                                            </div>
                                        @endforeach
                                    @endif

                                    <div class="entry input-group col-xs-3">
                                        <input class="form-control" name="features[]" type="text" placeholder="Type something" />
                                        <span class="input-group-btn">
                                                            <button class="btn btn-success btn-add" type="button">
                                                                <span class="fa fa-plus"></span>
                                                            </button>
                                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- /form group -->
                            <div class="form-group">

                                <!-- Checkbox -->
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" name="isFeatured"  id="isFeatured"
                                           class="custom-control-input" {{$pricingPlan->isFeatured ==1 ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="isFeatured">Featured</label>
                                </div>
                                <!-- /checkbox -->

                                <!-- Checkbox -->
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" id="customcheckboxInline5"
                                           name="status"
                                           class="custom-control-input" {{$pricingPlan->status ==1 ? 'checked': ''}}>
                                    <label class="custom-control-label" for="customcheckboxInline5">Active</label>
                                </div>
                                <!-- /checkbox -->
                            </div>

                            <button class="btn btn-primary" type="submit">Update</button>


                        </form>
                        <!-- /form -->

                    </div>
                    <!-- /card body -->
                </div>
            </div>


        </div>

    </div>
@endsection

@push('scripts')

    @include('admin.pages.pricing.pricing-scripts')

@endpush
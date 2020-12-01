@extends('frontend.layouts.master')
@section('title',$title)
@section('content')

    <section class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <h2>{{$title}}</h2>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <ul class="breadcrumb-ul">
                        <li><a href="{{route('fe.home')}}">Home</a></li>
                        <li><i class="fas fa-chevron-right"></i></li>
                        <li class="active">{{$title}}</li>
                    </ul>
                </div>
            </div>
        </div> 
    </section> 

    <section class="index-property bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="list-property-left-header">
                        <h4>
                            Property Advance Search
                        </h4>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="list-property-right-header">
                        <div class="col-lg-8">
                            <div class="form-group sort-div">
                                <label for="">Sort By: </label>
                                <select id="sort_by" class="form-control" name="sort_by">
                                    <option value="newest">Newest Property</option>
                                    <option value="oldest">Oldest Property</option>
                                    <option value="high_to_low">high price to low</option>
                                    <option value="low_to_high">low price to high</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                   @include('frontend.pages.partials.advance-search-sidebar')
                </div>

                <div class="col-lg-8">
                    <div class="dynamic_content">


                           @include('frontend.pages.view-property.includes-properties')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    @include('frontend.pages.view-property.index-scripts')
@endpush
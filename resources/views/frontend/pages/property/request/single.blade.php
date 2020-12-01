@extends('frontend.layouts.search-master')
@section('title','Property Requests')
@section('content')
    <section class="user-dashboard bg-grey">
        <div class="container-fluid">
            <div class="row">

                @include('frontend.pages.partials.user-navigation')

                <div class="col-lg-10">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bread-ol">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Library</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data</li>
                        </ol>
                    </nav>
                    <div class="my-prop-wrapper">

                        <h3>{{$property->title}} Requests</h3>

                        @include('partials.messages')

                        <div class="row m-l-r-0">
                            <div class="col-2">
                                <h5>Full Name:</h5>
                            </div>
                            <div class="col-9">
                                    <p>{{$propertyRequest->name}}</p>
                            </div>
                            <div class="col-2">
                                <h5>Email:</h5>
                            </div>
                            <div class="col-9">
                                    <p>{{$propertyRequest->email}}</p>
                            </div>
                            <div class="col-2">
                                <h5>Phone</h5>
                            </div>
                            <div class="col-9">
                                    <p>{{$propertyRequest->phone}}</p>
                            </div>
                            <div class="col-2">
                                <h5>Address</h5>
                            </div>
                            <div class="col-9">
                                    <p>{{$propertyRequest->address}}</p>
                            </div>
                            <div class="col-2">
                                <h5>Message:</h5>
                            </div>
                            <div class="col-9">
                                    <p>{{$propertyRequest->message}}</p>
                            </div>
                        </div>



                    </div>

                    <div class="dashboard-copyright">
                        @include('frontend.pages.partials.search-master-footer')
                    </div>
                </div>


            </div>
        </div>
    </section>

@endsection

@push('scripts')



@endpush
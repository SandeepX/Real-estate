@extends('frontend.layouts.search-master')
@section('title','Property Requests')
@section('content')
    <section class="user-dashboard bg-grey">
        <div class="container-fluid">
            <div class="row">

                @include('frontend.pages.partials.user-navigation')

                <div class="col-lg-10">
                    <div class="my-prop-wrapper">
                        <h3>{{$property->title}} Requests</h3>

                        @include('partials.messages')

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Request From</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($propertyRequests as $request)
                                    <tr class="responsive-table">
                                        <td>
                                            {{$request->name}}
                                        </td>
                                        <td>
                                            {{$request->email}}
                                        </td>

                                        <td>
                                            {{$request->phone}}

                                        </td>


                                        <td>
                                            {{str_limit(strip_tags($request->message), 80) }}

                                        </td>

                                        <td class="action">
                                            <a href="{{route('fe.user.property.requests.single',[$property->slug,$request->id])}}" class="btn btn-primary">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="responsive-table">

                                        <td>

                                            <h5 class=""><i class="flaticon-pin"></i> Currently You Don't Have Any Requests. </h5>
                                        </td>


                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="col-12">
                        {{$propertyRequests->links()}}
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
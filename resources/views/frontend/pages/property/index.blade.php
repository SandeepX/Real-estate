@extends('frontend.layouts.search-master')
@section('title','Property')
@section('content')
    <section class="user-dashboard bg-grey">
        <div class="container-fluid">
            <div class="row">

                @include('frontend.pages.partials.user-navigation')

                <div class="col-lg-10">
                    <div class="my-prop-wrapper">
                        <h3>My Properties</h3>

                        @include('partials.messages')

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Property</th>
                                    <th>Verification</th>
                                    <th>Featured</th>
                                    <th>Posted At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($properties as $property)
                                    <tr class="responsive-table">
                                        <td class="property-tbl-td-img">
                                            @if($property->featured_image)
                                            <img src="{{asset('common/images/'.$property->featured_image)}}" alt="listing-photo" class="img-fluid">
                                            @else
                                            <img src="{{asset('common/images/no-photo.png')}}" alt="listing-photo" class="img-fluid">
                                            @endif

                                            <div class="property-tbl-td-info">

                                                <h2><a href="{{route('user.property.edit',$property->slug)}}">{{$property->title}}</a></h2>
                                                <h5 class=""><i class="flaticon-pin"></i> {{$property->address ? $property->address->address : ''}} </h5>
                                                <h6 class="">Rs.{{$property->price}}/{{$property->price_postfix}}</h6>
                                            </div>
                                        </td>
                                        <td>

                                            @if($property->verify_status == "unverified")
                                                <a href="{{route('request.property.verification',$property->slug)}}" class="btn btn-request-prop" type="button">
                                                    Request
                                                </a>
                                            @elseif($property->verify_status == "verified")
                                                <span class="badge badge-success">Verified</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>

                                        <td>

                                            @if($property->feature_status == 'unfeatured')
                                                <a href="{{route('request.property.featuring',$property->slug)}}" class="btn btn-request-prop" type="button">
                                                    Request
                                                </a>
                                            @elseif($property->feature_status == "featured")
                                                <span class="badge badge-success">Featured</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif

                                        </td>
                                        <td class="expire-date" title="Added Date">{{date('M j ,Y',strtotime($property->created_at))}}</td>
                                        <td class="action">
                                            <a class="btn btn-request-prop-edit" href="{{route('user.property.edit',$property->slug)}}"><i class="far fa-edit"></i></a>
                                           {{-- <form class="inline-block" action="{{route('user.property.delete',$property->slug)}}"
                                            method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button class="btn btn-request-prop-danger" type="submit"
                                            onclick="return confirm('Are you sure you want to delete the Manager?');">
                                            <i class="far fa-trash-alt"></i>
                                            </button>
                                            </form>--}}

                                            <a href="{{route('fe.user.property.requests',$property->slug)}}" class="btn btn-primary">
                                                Enquiries
                                            </a>
                                        </td>
                                </tr>
                                @empty
                                <tr class="responsive-table">

                                <td>

                                 <h5 class=""><i class="flaticon-pin"></i> Currently You Don't Have Any Property. </h5>
                                </td>


                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    </div>
                    <div class="col-12">
                        {{$properties->links()}}
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
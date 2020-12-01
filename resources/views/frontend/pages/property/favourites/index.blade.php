@extends('frontend.layouts.search-master')
@section('title','Fav Properties')
@section('content')
    <section class="user-dashboard bg-grey">
        <div class="container-fluid">
            <div class="row">

                @include('frontend.pages.partials.user-navigation')

                <div class="col-lg-10">
                    <div class="my-prop-wrapper">
                        <h3>My Favourite Properties</h3>

                        @include('partials.messages')

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Property</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($favProperties as $property)
                                    <tr class="responsive-table">
                                        <td class="property-tbl-td-img">
                                            @if($property->featured_image)
                                                <img src="{{asset('common/images/'.$property->featured_image)}}" alt="listing-photo" class="img-fluid">
                                            @else
                                                <img src="{{asset('common/images/no-photo.png')}}" alt="listing-photo" class="img-fluid">
                                            @endif

                                            <div class="property-tbl-td-info">

                                                <h2><a href="{{route('fe.singleProperty',$property->slug)}}" target="_blank">{{$property->title}}</a></h2>
                                                <h5 class=""><i class="flaticon-pin"></i> {{$property->address ? $property->address->address : ''}} </h5>
                                                <h6 class="">Rs.{{$property->price}}/{{$property->price_postfix}}</h6>
                                            </div>
                                        </td>

                                        <td class="action">

                                            <form class="inline-block" action="{{route('fe.user.property.favourites.remove',$property->slug)}}"
                                                  method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button class="btn btn-request-prop-danger" type="submit"
                                                        onclick="return confirm('Are you sure you want to remove?');">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="responsive-table">

                                        <td>

                                            <h5 class=""><i class="flaticon-pin"></i> Currently You Don't Have Any Favourite Property. </h5>
                                        </td>

                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        {{$favProperties->links()}}
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
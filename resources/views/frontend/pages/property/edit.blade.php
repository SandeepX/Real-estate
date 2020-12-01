@extends('frontend.layouts.search-master')
@section('title','Property')
@section('content')
    <section class="user-dashboard bg-grey">
        <div class="container-fluid">
            <div class="row">

                @include('frontend.pages.partials.user-navigation')

                <div class="col-lg-10">
                    <div class="dashboard-content-right">
                        <ul class="nav nav-pills top-nav-pill" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="genral-tab" data-toggle="pill" href="#general-id" role="tab" aria-controls="general-id" aria-selected="true">General Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="floor-plan-tab" data-toggle="pill" href="#floor-plan-id" role="tab" aria-controls="floor-plan-id" aria-selected="false">Floor Plan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="more-info-tab" data-toggle="pill" href="#more-info-id" role="tab" aria-controls="more-info-id" aria-selected="false">More Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="document-tab" data-toggle="pill" href="#document-id" role="tab" aria-controls="document-id" aria-selected="false">Documents</a>
                            </li>
                        </ul>


                        <div class="tab-content top-nav-content" id="pills-tabContent">


                            <div class="tab-pane fade show active" id="general-id" role="tabpanel" aria-labelledby="genral-tab">
                                @if( session('tabName') =='general-id' )
                                    @include('partials.messages')
                                @endif

                               @include('frontend.pages.property.general.general-tab')
                            </div>

                            <div class="tab-pane fade" id="floor-plan-id" role="tabpanel" aria-labelledby="floor-plan-tab">
                                @if( session('tabName') =='floor-plan-id' )
                                    @include('partials.messages')
                                @endif
                                @include('frontend.pages.property.floor.floor')
                            </div>

                            <div class="tab-pane fade" id="more-info-id" role="tabpanel" aria-labelledby="more-info-tab">
                                @if( session('tabName') =='more-info-id' )
                                    @include('partials.messages')
                                @endif
                               @include('frontend.pages.property.more-info.info')
                            </div>

                            <div class="tab-pane fade" id="document-id" role="tabpanel" aria-labelledby="document-tab">
                                @if( session('tabName') =='document-id' )
                                    @include('partials.messages')
                                @endif
                                @include('frontend.pages.property.documents.new-document')
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
    @include('frontend.pages.property.feproperty-scripts')
    @include('frontend.pages.property.general.edit-general-scripts')

    @include('frontend.pages.property.floor.floor-scripts')

    @include('frontend.pages.property.more-info.more-info-scripts')

    @include('frontend.pages.property.documents.new-document-scripts')

    @include('scipts.property-scritps')

    <!--for redirecting to specific tab-->
    <script>
        let tabName = "<?php echo session('tabName'); ?>";
        //console.log(tabName);
        if (tabName){
            $('.nav-pills a[href="#' +tabName+ '"]').tab('show');
            $('.nav-pills a[href="#' +tabName+ '"]').trigger('click');
        }
    </script>

@endpush

@extends('frontend.layouts.search-master')
@section('title','Managers')
@section('content')
    <section class="user-dashboard bg-grey">
        <div class="container-fluid">
            <div class="row">

                @include('frontend.pages.partials.user-navigation')

                <div class="col-lg-10">
                    <div class="dashboard-content-right">
                        <h4>Managers</h4>
                        <div class="dashboard-content-info">
                            <div class="row">
                                <div class="col-lg-3 p-r-0">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="manager_nav" data-toggle="pill" href="#manager_tab"
                                           role="tab" aria-controls="manager_tab" aria-selected="true">My Managers</a>
                                        
                                        <a class="nav-link" id="manager_form_nav" data-toggle="pill" href="#manager_form_tab" 
                                           role="tab" aria-controls="manager_form_tab" aria-selected="false">Request A manager</a>
                                    </div>
                                </div>
                                <div class="col-lg-9 p-l-0">
                               

                                    <div class="tab-content" id="v-pills-tabContent">
                                        @include('partials.messages')
                                        <div class="tab-pane fade show active post-prop-wrapper" id="manager_tab" role="tabpanel" aria-labelledby=manager_nav">
                                            <div id="hide_mager_tab">

                                                @include('frontend.pages.property.managers.index')
                                            </div>

                                            <div id="dynamic_content">

                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="manager_form_tab" role="tabpanel" aria-labelledby="manager_form_nav">

                                            @include('frontend.pages.property.managers.form')

                                        </div>
                                       

                                    </div>
                                   
                                </div>
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

    <script src="{{asset('backend/assets/js/my-scripts/select2.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <!--jquery validation-->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>

        $(document).ready(function () {

            $('#manager_form').validate({ // initialize the plugin
                rules: {
                    property: {
                        required: true
                    },
                    manager: {
                        required: true,
                        email:true,
                    },
                },
                messages: {
                    property: {
                        required: "Please Select Property",
                    },
                    manager: {
                        required: "Please Select Manager",
                        email: "Please Enter A Valid Email."
                    },

                },
            });

        });
    </script>


    <!-- ajax edit page-->
    <script>
        $('.edit_btn').on('click', function (e) {

            e.preventDefault();
            let url = $(this).attr('href');

            //ajax call to update page
            updatePage(url);
        });

        function updatePage(url) {
            $.ajax(
                {
                    type:'GET',
                    url: url,
                    datatype: "html",
                }).done(function (data) {
               $('#hide_mager_tab').hide();
                $("#dynamic_content").empty().html(data);
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log("Error: " + errorThrown);
                console.log("Status: " + status);
                console.dir(xhr);
            });

        }

        $('#manager_nav').on('click',function () {

            $('#hide_mager_tab').show();
            $("#dynamic_content").empty();
        });
    </script>


    <!--for redirecting to specific tab-->
    <script>
        let tabName = "<?php echo session('tabName'); ?>";
        console.log(tabName);


        if (tabName){
            $('.nav a[href="#' +tabName+ '"]').tab('show');
            $('.nav a[href="#' +tabName+ '"]').trigger('click');
        }
    </script>

@endpush
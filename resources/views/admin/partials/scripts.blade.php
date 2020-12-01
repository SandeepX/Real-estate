<!-- Optional JavaScript -->
<script src="{{asset('backend/node_modules/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('backend/node_modules/moment/moment.js')}}"></script>
<script src="{{asset('backend/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<!-- Perfect Scrollbar jQuery -->
<script src="{{asset('backend/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
<!-- /perfect scrollbar jQuery -->

<!-- masonry script -->
<script src="{{asset('backend/node_modules/masonry-layout/dist/masonry.pkgd.min.js')}}"></script>
<script src="{{asset('backend/node_modules/sweetalert2/dist/sweetalert2.js')}}"></script>
<script src="{{asset('backend/assets/js/functions.js')}}"></script>
<script src="{{asset('backend/assets/js/customizer.js')}}"></script>
<script src="{{asset('backend/node_modules/chart.js/dist/Chart.min.js')}}"></script>
{{--<script src="http://maps.google.com/maps/api/js?key=AIzaSyBbyv4oQ2Y4cDpMC8MGhERZ_kicy4YKcuc"></script>--}}
<script src="{{asset('backend/node_modules/gmaps/gmaps.min.js')}}"></script>
<script src='{{asset('backend/node_modules/echarts/dist/echarts.min.js')}}'></script>
<script src='{{asset('backend/node_modules/echarts-liquidfill/dist/echarts-liquidfill.min.js')}}'></script>

<script src="{{asset('backend/assets/js/custom/charts/dashboard-real-estate.js')}}"></script>
<!-- Custom JavaScript -->
<script src="{{asset('backend/assets/js/script.js')}}"></script>
<script src="{{asset('backend/assets/js/custom/maps/gmaps.js')}}"></script>

<!--mark as read notification -->
<script>
    $(document).ready(function () {


        $('.unread_notification').on("click", function (e) {

            e.preventDefault();

            let dataId = $(this).data('id');

            markAsRead(dataId);

            // Prevent infinite loop
            $(this).unbind('click');

            // Execute default action
            e.currentTarget.click();
        });

        function markAsRead(dataId) {

            console.log(dataId);
            $.ajax(
                {
                    type: 'GET',
                    url: dataId,
                    datatype: "html",
                }).done(function (data) {
                console.log(data);
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log("Error: " + errorThrown);
                console.log("Status: " + status);
                console.dir(xhr);
            });

        }

    });
</script>


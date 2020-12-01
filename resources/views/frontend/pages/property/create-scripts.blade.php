{{--get districts,municipals on change of province--}}
<script>
    $(document).ready(function () {

        function updateOptionsOfDistricts(id,options) {
            //make select option empty
            $(id).empty();
            $('#municipal').empty();

            let disabledOption= "<option value='' selected disabled>Choose...</option>";

            $('#municipal').append(disabledOption);

            let districtroute= "{{url('/district/municipals/')}}";

            //append new options from json data
            $(id).append(disabledOption);

            options.forEach(function (option) {
                $(id).append("<option data-url='"+districtroute+'/'+option['id']+"' value='" + option['id'] + "'>" + option['district_name'] + "</option>");
            });

        }

        function updateOptionsDistricts(selectorId,url) {
            $.ajax(
                {
                    type: 'GET',
                    url: url,
                    datatype: "json",
                }).done(function (data) {
                updateOptionsOfDistricts(selectorId,data);
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log("Error: " + errorThrown);
                console.log("Status: " + status);
                console.dir(xhr);
            });

        }

        $('#province').on('change', function () {

            var provinceUrl = $(this).children(":selected").data('provinceurl');

            //ajax call to update districts
            updateOptionsDistricts('#district',provinceUrl);

        });

        function updateOptionsOfMunicipals(id,options) {
            //make select option empty
            $(id).empty();

            let disabledOption= "<option value='' selected disabled>Choose...</option>";

            //append new options from json data
            $(id).append(disabledOption);
            options.forEach(function (option) {
                $(id).append("<option value='" + option['id'] + "'>" + option['municipal_name'] + "</option>");
            });
        }

        function updateOptionsMunicipals(selectorId,url) {
            $.ajax(
                {
                    type: 'GET',
                    url: url,
                    datatype: "json",
                }).done(function (data) {
                updateOptionsOfMunicipals(selectorId,data);
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log("Error: " + errorThrown);
                console.log("Status: " + status);
                console.dir(xhr);
            });

        }

        $('#district').on('change', function () {

            var districtUrl = $(this).children(":selected").data('url');

            //ajax call to update options
            updateOptionsMunicipals('#municipal',districtUrl);

        });

    });
</script>

<!--multi step form scripts-->
<script>
    $(document).ready(function () {

        //tab change..multi step form
        $('.btn-back-next').on('click',function (e) {

            e.preventDefault();

            let form = $('#property_form');

            let isNextBtn= $(this).attr("data-btn-type");

            let hrefValue =  $(this).attr('href');

            let navSelector ='.nav-pills a';

            // $('.nav-pills a[href="#user-location-id"]').tab('show');

            if (isNextBtn==="next" && typeof isNextBtn !== typeof undefined && isNextBtn !== false ) {
                if(form.valid() === true){

                    $(navSelector+'[href="' +hrefValue+ '"]').removeClass('disabled');

                    //tab change
                    changeTab(navSelector,hrefValue);


                    //scrolltop
                    $("html, body").animate({ scrollTop: 0 }, 100);
                    // $( "html, body" ).scrollTop(300);
                }

            }
            else{

                changeTab(navSelector,hrefValue);
            }


        });

        function changeTab(navSelector,hrefValue) {
            $(navSelector+'[href="' +hrefValue+ '"]').tab('show');
            $(navSelector+'[href="' +hrefValue+ '"]').trigger('click');
        }

    });
</script>



{{--check if terms and conditions is accepted--}}
<script>
    $(document).ready(function () {

        $('#terms_conditions_checkbox').on('change',function () {

            if ( $(this).is(":checked")) {
                $('#btn-register').prop('disabled',false);
            }

            else {
                $('#btn-register').prop('disabled',true);
            }


        }).trigger('change');

       /* if ( $('#terms_conditions_checkbox').is(":checked")) {
            $('#btn-register').prop('disabled',false);
        }*/
    });
</script>

<!--jquery validation-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>

    $(document).ready(function () {

        $('#registerForm').validate({ // initialize the plugin
            rules: {
                name: {
                    required: true
                },
                email:{
                    required:true,
                    email: true
                },
                password: {
                  required:true,
                    minlength: 6,
                },
                password_confirmation: {
                    required:true,
                    minlength: 6,
                    equalTo: "#password"
                },
                phone: "required",
                province: "required",
                district: "required",
                municipal: "required",
                address:"required",
            },
            messages: {
                name: {
                    required: "Please Enter Your Full Name.",
                },
                email: {
                    required: "Please Enter Your Email.",
                    email:"Please Enter Valid Email."
                },
                password: {
                    required: "Please Enter Password.",
                    minlength:'Your password must be at least 6 characters long.'
                },
                password_confirmation: {
                    required: "Please Confirm Password.",
                    minlength:'Your password must be at least 6 characters long.',
                    equalTo: "Password Confirmation Do Not Match."
                },
                phone: {
                    required: "Please Enter Your Phone Number",
                },
                province: {
                    required: "Please Select Your Province",
                },
                district: {
                    required: "Please Select Your District",
                },
                municipal: {
                    required: "Please Select Your Municipality",
                },
                address: {
                    required: "Please Enter Your Address",
                },

            },
        });

    });
</script>

{{--get districts,municipals on change of province--}}
<script>
    $(document).ready(function () {

        function updateOptionsOfDistricts(id,options) {
           //make select option empty
            $(id).empty();
            $('#municipal').empty();

            let disabledOption= "<option value='' selected disabled>Choose...</option>";

            let districtroute= "{{url('/district/municipals/')}}";

            //append new options from json data
            $('#municipal').append(disabledOption);
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

        }).trigger('change');

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



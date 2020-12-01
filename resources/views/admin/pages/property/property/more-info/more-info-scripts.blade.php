{{--validation scripts--}}
<script>

    $(document).ready(function () {

        $('#info_form').validate({ // initialize the plugin
            rules: {
                user_id:{
                    required: true,
                },
                owner_name:"required",
                owner_address:"required",
                owner_contact:"required",
                ref_owner_name_1:'required',
                ref_owner_phone_1:'required',


            },
            messages: {
                property_user: {
                    required: "User is required.",
                },

            },
            onfocusout: false,
            invalidHandler: function(form, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    validator.errorList[0].element.focus();
                }
            }
        });

    });
</script>
{{--validation scripts--}}
<script>

    $(document).ready(function () {

        $('#info_form').validate({ // initialize the plugin
            rules: {
                owner_name:"required",
                owner_address:"required",
                owner_contact:"required",

            },
            messages: {
                owner_name: {
                    required: "Owner Name Is Required.",
                },
                owner_address: {
                    required: "Owner Address Is Required.",
                },
                owner_contact: {
                    required: "Owner Contact Is Required.",
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
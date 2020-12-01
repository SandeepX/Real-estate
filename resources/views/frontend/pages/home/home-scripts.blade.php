
@auth
    @if(Auth::user()->phone == null && Auth::user()->mobile == null)
        <script>
            $(window).on('load', function() {
                $('#phnhover').modal('show');
            });
        </script>
    @endif
@endauth

<!--jquery validation-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>

    $(document).ready(function () {

        $('#phone_form').validate({ // initialize the plugin

            rules: {
                phone:{
                    required: true,
                },

            },
            messages: {
                phone: {
                    required: "Please enter your contact number.",
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
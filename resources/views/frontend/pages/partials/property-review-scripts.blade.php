<!--jquery validation-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

{{--<script>

    $(document).ready(function () {

        $('#prop_review_form').validate({ // initialize the plugin
            rules: {
                rating:{
                    required: true,
                },
                client_message:"required",
            },
            messages: {
                rating: {
                    required: "Please Rate.",
                },
                client_message: {
                    required: "Please Enter Your Comment.",
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
</script>--}}


<script>
    $(".rating input:radio").attr("checked", false);

    $('.rating input').click(function () {
        $(".rating span").removeClass('checked');
        $(this).parent().addClass('checked');
    });
</script>
<!--jquery validation-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>

    $('form').each(function () {
        if ($(this).data('validator'))
            $(this).data('validator').settings.ignore = "#summernote *";
    });

    $(document).ready(function () {

        $('#form').validate({ // initialize the plugin
            // exclude it from validation
            rules: {

                client_name:"required",
                client_company:"required",
                client_position:"required",
                client_message:"required",
            },
            messages: {
                client_name: {
                    required: "Please Enter Client Name.",
                },
                client_company: {
                    required: "Please Enter Client Company.",
                },
                client_position: {
                    required: "Please Enter Client Position.",
                },
                client_message: {
                    required: "Please Enter Client's Message.",
                },

            },
        });

    });
</script>

<!--wysiwg scripts-->
@include('admin.partials.summernote-scripts')

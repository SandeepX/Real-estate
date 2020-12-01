<!--jquery validation-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>

    $(document).ready(function () {

        $('#form').validate({ // initialize the plugin
            rules: {
                question: {
                    required: true
                },
                answer:"required",
            },
            messages: {
                question: {
                    required: "Question is required.",
                },
                answer: {
                    required: "Answer is required.",
                },

            },
        });

    });
</script>

<!--wysiwg scripts-->
@include('admin.partials.summernote-scripts')
<!--jquery validation-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>


<script>
    //for create
    $(document).ready(function () {

        $('#form').validate({ // initialize the plugin
            rules: {
                title:"required",
                ceo_message:"required",
                overview:"required",
                our_mission:"required",
                our_vision: "required",
                our_statements: "required",

            },
            messages: {
                title: {
                    required: "Please Enter Title.",
                },
                ceo_message: {
                    required: "Please  Enter CEO message.",
                },
                overview: {
                    required: "Please Enter Overview",
                },
                our_vision: {
                    required: "Please  Enter Our Vision",
                },
                our_statements: {
                    required: "Please  Enter Our Statements",
                },

                our_mission: {
                    required: "Please Enter Our Mission",
                },

            },
        });

    });

</script>

<!--wysiwg scripts-->
@include('admin.partials.summernote-scripts')
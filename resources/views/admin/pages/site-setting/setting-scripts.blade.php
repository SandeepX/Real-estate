<!--jquery validation-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>


<script>
    //for create
    $(document).ready(function () {

        $('#form').validate({ // initialize the plugin
            rules: {

                site_title:"required",
                site_subtitle:"required",
                email:"required",
                address:"required",
                phone:"required",

            },
            messages: {
                site_title: {
                    required: "Please Enter Site Title.",
                },
                site_subtitle: {
                    required: "Please  Enter Site Subtitle.",
                },
                email: {
                    required: "Please Enter Email",
                },
                address: {
                    required: "Please Enter Address",
                },
                phone: {
                    required: "Please Enter Phone",
                },

            },
        });

    });

</script>

<!--wysiwg scripts-->
<script src="{{asset('backend/node_modules/summernote/dist/summernote-bs4.js')}}"></script>
<script>
    (function ($) {
        "use strict";

        $('#summernote').summernote({
            tabsize: 2,
            height: 200
        });

    })(jQuery);
</script>

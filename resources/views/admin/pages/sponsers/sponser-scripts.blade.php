<!--jquery validation-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>


<script>
    //for create
    $(document).ready(function () {

        $('#form').validate({ // initialize the plugin
            rules: {

                company_name:"required",
                company_logo:"required",
                company_website: {
                    url: true
                }

            },
            messages: {
                company_name: {
                    required: "Please Enter Company Name.",
                },
                company_logo: {
                    required: "Please Upload Logo",
                },
                company_website: {
                    url: "Please Enter Valid URL",
                },

            },
        });

    });

    //for edit
    $(document).ready(function () {

        $('#edit_form').validate({ // initialize the plugin
            rules: {

                company_name:"required",
                company_website: {
                    url: true
                }

            },
            messages: {
                company_name: {
                    required: "Please Enter Company Name.",
                },
                company_website: {
                    url: "Please Enter Valid URL",
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

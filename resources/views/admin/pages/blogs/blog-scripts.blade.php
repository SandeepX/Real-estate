<!--jquery validation-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>

    $(document).ready(function () {

        $('#form').validate({ // initialize the plugin
            rules: {

                title:"required",
                subtitle:"required",
                author:"required",
                description:"required",
            },
            messages: {
                title: {
                    required: "Please Enter Blog Title.",
                },
                subtitle: {
                    required: "Please Enter Subtitle.",
                },
                author: {
                    required: "Please Enter Author Full Name.",
                },
                description: {
                    required: "Please Enter Blog Description.",
                },

            },
        });

    });
</script>

<!--wysiwg scripts-->
@include('admin.partials.summernote-scripts')


<!--select 2-->
<script src="{{asset('backend/assets/js/my-scripts/select2.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        $('.js-example-basic-multiple').select2();

    });
</script>

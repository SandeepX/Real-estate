<!--jquery validation-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>

    $(document).ready(function () {

        $('#form').validate({ // initialize the plugin
            rules: {
                name: {
                    required: true
                },
                team_category:"required",
                designation: "required"
            },
            messages: {
                name: {
                    required: "Full Name is required.",
                },
                team_category: {
                    required: "Please Select Team Category",
                },
                designation: {
                    required: "Please Select Designation",
                },

            },
        });

    });
</script>


<script src="{{asset('backend/assets/js/my-scripts/select2.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
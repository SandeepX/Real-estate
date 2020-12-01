<!--jquery validation-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>


<script>
    //for create
    $(document).ready(function () {

        $('#request_form').validate({ // initialize the plugin
            rules: {

                name:"required",
                phone:"required",
                address:"required",
                message:"required",
                email: {
                    required:true,
                    email: true
                }

            },
            messages: {
                name: {
                    required: "Please Enter Your Full Name.",
                },
                phone: {
                    required: "Please Enter Your Full Name",
                },
                address: {
                    required: "Please Enter Your Address",
                },
                message: {
                    required: "Please Enter Your Message",
                },
                email: {
                    required: "Please Enter Your Email",
                    email: "Please Enter Valid Email"
                },

            },
        });

    });
</script>
<!--jquery validation-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>


<script>

    $(document).ready(function () {

        $('#basic_info').validate({ // initialize the plugin
            rules: {

                name:"required",
                phone:"required",
                address:"required",
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
                    required: "Please Enter Your Phone Number",
                },
                address: {
                    required: "Please Enter Your Address",
                },
                email: {
                    required: "Please Enter Your Email",
                    email: "Please Enter Valid Email"
                },

            },
        });

        $('#password_form').validate({ // initialize the plugin
            rules: {
                current_password: "required",
                password: {
                    required:true,
                    minlength: 6,
                },
                password_confirmation: {
                    required:true,
                    minlength: 6,
                    equalTo: "#password"
                },

            },
            messages: {
                current_password: {
                    required: "Please Enter Your Current Password.",

                },
                password: {
                    required: "Please Enter Password.",
                    minlength:'Your password must be at least 6 characters long.'
                },
                password_confirmation: {
                    required: "Please Confirm Password.",
                    minlength:'Your password must be at least 6 characters long.',
                    equalTo: "Password Confirmation Do Not Match."
                },
            },
        });

    });


</script>

{{--check at least one of the field is not empty--}}
<script>

    /*let els = $('#social_form :input').filter(function() {
        return this.value !== "" && this.value !== "0";
    });

    if (els.length > 0) {
        alert('here');
        $("#btn-social").attr("disabled", false);
    }
    else {
        alert('there');
        $("#btn-social").attr("disabled", true);
    }*/

/*   let allFields= $('#social_form').find('input[type=text], select').each(function(){
        if($(this).val() != "");
    });

   if (allFields.length >0){

       console.log(allFields);
       alert('here');
   }
   else {
       alert('there');
       $("#btn-social").attr("disabled", true);
   }*/

    let inputs =$('#social_form :input');
    if ( $( "#social_form :input:empty" )){
        $("#btn-social").attr("disabled", true);
    }
    else {
        $("#btn-social").attr("disabled", false);
    }

</script>


{{--image preview scripts--}}
<script>
    //for image preview after upload
    function preview_image() {

        let imagePreview = $('.image_preview');

        //for single image upload..remove older uploads
        imagePreview.html('');

        var total_file=document.getElementById("upload_file").files.length;
        for(var i=0;i<total_file;i++)
        {
            imagePreview.append("<a class='parent_images'><i class='remove-img fa fa-times' ></i><img class='img' src='"+URL.createObjectURL(event.target.files[i])+"'></a>");
        }
    }

    $('#upload_file').change(function () {
        preview_image();
    });

    //script for removing not db image
    $(document).on('click','.remove-img',function (e) {
        e.preventDefault();
        $(this).parent().remove();
    });
</script>
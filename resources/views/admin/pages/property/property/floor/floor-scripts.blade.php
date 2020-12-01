{{--validation scripts--}}
<script>

    $(document).ready(function () {

        $('#floor_form').validate({ // initialize the plugin
            rules: {
                floor_title:{
                    required: true,
                },
                floor_description:"required",
                floor_price:"required",
                floor_area_size:"required",
                floor_area_size_postfix:"required",
                floor_bedrooms : "required",
                floor_bathrooms : "required",

            },
            messages: {
                floor_title: {
                    required: "Floor title is required.",
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


        $('#floor_edit_form').validate({ // initialize the plugin
            rules: {
                floor_title:{
                    required: true,
                },
                floor_description:"required",
                floor_price:"required",
                floor_area_size:"required",
                floor_area_size_postfix:"required",
                floor_bedrooms : "required",
                floor_bathrooms : "required",

            },
            messages: {
                floor_title: {
                    required: "Floor title is required.",
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
</script>


{{--ajax edit scripts--}}
<script>

    $('.edit-button').on('click', function (e) {

        e.preventDefault();
        let url = $(this).attr('href');

        //ajax call to update page
        updatePage(url);
    });

    function updatePage(url) {
        $.ajax(
            {
                type: 'GET',
                url: url,
                datatype: "html",
            }).done(function (data) {
                $('#floor-tab').hide();
            $("#dynamic-content").empty().html(data);
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log("Error: " + errorThrown);
            console.log("Status: " + status);
            console.dir(xhr);
        });

    }

    $('#nav-all-floor').on('click',function () {
        $('#floor-tab').show();
        $("#dynamic-content").empty();
    });
</script>
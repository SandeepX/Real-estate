{{--validation scripts--}}
<script>

    $(document).ready(function () {

        $('#document_form').validate({ // initialize the plugin
            rules: {
                document:{
                    required: true,
                   /* accept:'doc/docx/odt/pdf/rtf/txt/7z/rar/z/zip',

                    extension: "doc,docx,odt,pdf,rtf,txt,7z,rar,z,zip",*/
                },

            },
            messages: {
                document: {
                    required: "Minimum one file is required.",
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


<!--property documents for name preview after upload -->
<script>

    //for image preview after upload
    function preview_doc()
    {
        var total_file=document.getElementById("upload_doc").files.length;
        //console.log(total_file);
        for(var i=0;i<total_file;i++)
        {
            $('#document_preview').append("<a><i class='remove-doc fa fa-times' ></i><span class='badge badge-secondary'>"+event.target.files[i].name+"</span> </a>");
        }
        //$("#upload_doc")[0].value = '';
    }

    $('#upload_doc').change(function () {
        preview_doc();
    });

    //script for removing not db docs
    $(document).on('click','.remove-doc',function (e) {
        e.preventDefault();
        $(this).parent().remove();
    });

    //script for removing db docs
    $(document).on('click','i.remove-db-doc',function (e) {
        e.preventDefault();

        if (confirm('Are you sure you want to delete this item?')){

            var url= $(this).data('url');

            if(url){

                let thisImage = $(this);


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "DELETE",

                })
                    .done(function( ) {
                        thisImage.parent().remove();
                        alert('Document Deleted');
                    })
                    .fail(function( xhr, status, errorThrown ) {
                        alert( "Sorry, there was a problem!" );

                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                        console.dir( xhr );
                    });
            }

        }

    });

</script>
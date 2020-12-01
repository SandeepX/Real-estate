<!--property documents for name preview after upload -->
<script>


    $('.upload_img').change(function (event) {

        //preview_doc();
       /* $('#img_preview').html("<a><i class='remove-img fa fa-times' ></i><span class='badge badge-secondary'>"+event.target.files[0].name+"</span> <hr></a> ");*/
        $('#image_preview').html("<a class='parent_images'><i class='remove-img fa fa-times' ></i><img class='img' src='"+URL.createObjectURL(event.target.files[0])+"'><hr></a>");
    });

    $('.upload_img1').change(function (event) {

        //preview_doc();
        /* $('#img_preview').html("<a><i class='remove-img fa fa-times' ></i><span class='badge badge-secondary'>"+event.target.files[0].name+"</span> <hr></a> ");*/
        $('#image_preview1').html("<a class='parent_images'><i class='remove-img fa fa-times' ></i><img class='img' src='"+URL.createObjectURL(event.target.files[0])+"'><hr></a>");
    });

    //script for removing not db docs
    $(document).on('click','.remove-img',function (e) {
        e.preventDefault();
        $(this).parent().remove();
    });

    //script for removing db docs
    $(document).on('click','i.remove-db-img',function (e) {
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
                        alert('Image Deleted');
                    })
                    .fail(function( xhr,jqXHR, status, errorThrown ) {

                        //console.log(xhr.responseText);

                      let alertMsg= xhr.responseText;

                       if(alertMsg){
                           alert(alertMsg);
                       }
                       else {
                           alert( "Sorry, there was a problem!" );
                       }


                       /* console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                        console.dir( xhr );*/
                    });
            }

        }

    });


</script>
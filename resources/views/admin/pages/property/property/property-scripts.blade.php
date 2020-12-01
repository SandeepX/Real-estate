<!--jquery validation-->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>

    $(document).ready(function () {

        $('#form').validate({ // initialize the plugin
            rules: {
                title:{
                    required: true,
                },
                property_type:"required",
                property_status:"required",
                description:"required",
                price:"required",
                area_size:"required",
                area_size_postfix:"required",
                featured_image:"required",
                address:"required",
                latitude:"required",
                longitude:"required",
                province:"required",
                district:"required",
                municipal:"required",
                user_id:{
                    required: true,
                },
                owner_name:"required",
                owner_address:"required",
                owner_contact:"required",
                ref_owner_name_1:'required',
                ref_owner_phone_1:'required',

            },
            messages: {
                title: {
                    required: "Title is required.",
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

        $('#form-edit').validate({ // initialize the plugin
            rules: {
                title:{
                    required: true,
                },
                property_type:"required",
                property_status:"required",
                description:"required",
                price:"required",
                area_size:"required",
                area_size_postfix:"required",
                address:"required",
                latitude:"required",
                longitude:"required",
                province:"required",
                district:"required",
                municipal:"required",


            },
            messages: {
                title: {
                    required: "Title is required.",
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

<!--map scripts-->
<script>

    let map;
    let cmarker;
    let latitude=  document.getElementById('latitude');
    let longitude=  document.getElementById('longitude');

    let latitudeValue=  document.getElementById('latitude').value;
    let longitudeValue=  document.getElementById('longitude').value;

    let geocoder;
    let infowindow;

    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">


    function initAutocomplete() {

        // The location of nepal
        var defaultLocation = {lat: 28.3949, lng: 84.1240};
        var location = {lat: parseFloat(latitudeValue), lng: parseFloat(longitudeValue)};

        var mapOptions = {
            zoom: 7,
            scrollwheel: true,
            center: location,
        };


        map = new google.maps.Map(document.getElementById('map'),mapOptions);

         geocoder = new google.maps.Geocoder;
         infowindow = new google.maps.InfoWindow;

        // The marker, positioned at nepal
        cmarker = new google.maps.Marker({
            position: location,
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
        });

        cmarker.addListener('drag', function (event) {
            let newPosition = event.latLng;

            latitude.value = event.latLng.lat();
            longitude.value = event.latLng.lng();
            getPlaceName(newPosition);

        });

        //place marker on click on map
        map.addListener('click', function(e) {

            let newPosition = e.latLng;

            cmarker.setPosition(newPosition);

            map.panTo(newPosition);

            latitude.value = e.latLng.lat();
            longitude.value = e.latLng.lng();

            getPlaceName(newPosition);

        });

        //if edit page increasing zoom level
        if ( JSON.stringify(defaultLocation) !== JSON.stringify(location) ){
            map.setCenter(cmarker.getPosition());
            map.setZoom(16);
        }

        //for autocomplete search--google code
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();


            if (places.length === 0) {
                return;
            }

            //custom function
            bindSearchValueToAddressField(input.value);

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }

                cmarker.setPosition(place.geometry.location);

                latitude.value=place.geometry.location.lat();
                longitude.value= place.geometry.location.lng();

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });



    }

    function getPlaceName(newPosition){
        geocoder.geocode({'location': newPosition}, function(results, status) {
            if (status === 'OK') {
                if (results[0]) {
                    //map.setZoom(11);
                    //console.log(results[0]);
                    infowindow.setContent(results[0].formatted_address);
                    infowindow.open(map, cmarker);

                    //custom function
                    bindSearchValueToAddressField(results[0].formatted_address);
                } else {
                    window.alert('No results found');
                }
            } else {
                //window.alert('Geocoder failed due to: ' + status);
            }
        });
    }

    $(".lat-long ").on('keyup',function () {

        //getting input from lat & lang field
        var latlng = new google.maps.LatLng(latitude.value, longitude.value);

        //setting marker position
        cmarker.setPosition(latlng);

        //adjusting and making map camera center
        map.setCenter(cmarker.getPosition());

    });

    function bindSearchValueToAddressField(value) {
        $('#address').val(value);
    }

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrPMYf0pq2cXXte1SxJOdMJR8F9dMxKdg&libraries=places&callback=initAutocomplete"
        async defer></script>

<!--wysiwg scripts-->
@include('admin.partials.summernote-scripts')

<!-- adding dynamic fields scripts-->
<script>
    //for dynamic field add
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $('.fields:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="fa fa-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
        $(this).parents('.entry:first').remove();

        e.preventDefault();
        return false;
    });




</script>

<!--for image preview after upload property gallery-->
<script>

    $('.upload_img1').change(function (event) {

        //preview_doc();
        /* $('#img_preview').html("<a><i class='remove-img fa fa-times' ></i><span class='badge badge-secondary'>"+event.target.files[0].name+"</span> <hr></a> ");*/
        $('#image_preview1').html("<a class='parent_images'><i class='remove-img fa fa-times' ></i><img class='img' src='"+URL.createObjectURL(event.target.files[0])+"'><hr></a>");
    });


    //for image preview after upload
    function preview_image()
    {
        var total_file=document.getElementById("upload_file").files.length;
        for(var i=0;i<total_file;i++)
        {
            $('#image_preview').append("<a class='parent_images'><i class='remove-img fa fa-times' ></i><img class='img' src='"+URL.createObjectURL(event.target.files[i])+"'></a>");
        }
       // $("#upload_file")[0].value = '';
    }

    $('#upload_file').change(function () {
        preview_image();
    });

    //script for removing db images
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
                    .fail(function( xhr, status, errorThrown ) {
                        alert( "Sorry, there was a problem!" );

                        console.log( "Error: " + errorThrown );
                        console.log( "Status: " + status );
                        console.dir( xhr );
                    });
            }

        }

    });

    //script for removing not db images
    $(document).on('click','.remove-img',function (e) {
        e.preventDefault();
        $(this).parent().remove();
    });

</script>


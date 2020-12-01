<script>
    var map;
    var clusterMarkers=[];

    var customInfoWindow;

    var propertyMarkers = {!!json_encode($feProperties) !!};

    //console.log(propertyMarkers);

    function initMap() {

        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            mapTypeId: 'roadmap',
            zoom: 14,
            scrollwheel: true,
            center: {lat: 27.7172, lng: 85.3240}
        };

        customInfoWindow = new google.maps.InfoWindow;

        // Display a map on the web page
        map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
        map.setTilt(50);

        // Multiple markers location, latitude, and longitude
        var markers = propertyMarkers;


        // Info window content
        var infoWindowContent = [];



        // Add multiple markers to map
        var infoWindow = new google.maps.InfoWindow(), marker, i;
        let imageUrl = "{{asset('frontend/img/pin-1.png')}}";
        var image = {
            /* url: 'img/pin-1.png',*/
            url: imageUrl,
            size: new google.maps.Size(60, 60),
            origin: new google.maps.Point(0, 0),
          /*  anchor: new google.maps.Point(0, 0)*/
        };

        // Place each marker on the map
        for( i = 0; i < markers.length; i++ ) {
            var position = new google.maps.LatLng(markers[i]['address']['latitude'], markers[i]['address']['longitude']);

            let imageSource= "{{asset('common/images/small')}}"+'/'+markers[i]['featured_image'];
            let singleRoute = "{{url('show-property')}}"+'/'+markers[i]['slug'];

            let categoryRoute = "{{route('fe.cat.properties',':slug')}}";
            categoryRoute = categoryRoute.replace(':slug', markers[i]['category']['slug']);

            let subCategoryRoute = "{{route('fe.subcat.properties',':slug')}}";
            subCategoryRoute = subCategoryRoute.replace(':slug', markers[i]['sub_category']['slug']);

            let displayContent = '<div class="info_content">' +
                '<img class="map-img-small" src="'+ imageSource+'" class="img-fluid map-img" alt="">' +
                '<h6 class="map-img-title"><a href='+singleRoute+'>'+ markers[i]['title']+'</a></h6>' +
                '<p class="map-desc-p">'+markers[i]['address']['address'] +'</p>' +
                '<p class="map-desc-p">Beds: '+markers[i]['bedrooms']+' Baths: '+markers[i]['bathrooms']+' '+markers[i]['area_size_postfix']+': '+markers[i]['area_size']+'</p>' +
                '<p class="map-category-p"><a href='+categoryRoute+' class="map-category">'+markers[i]['category']['name']+'</a>' +
                '<a href='+subCategoryRoute+' class="map-category">'+markers[i]['sub_category']['name']+'</a>' +
                '</p></div>';

            infoWindowContent.push(displayContent);

            //console.log(markers[i]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                icon: image,
                title: markers[i][0]
            });

            clusterMarkers.push(marker);

            // Add info window to marker
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infoWindow.setContent(infoWindowContent[i]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));

            //for autocomplete search--google code
            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);

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


                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }


                    // cmarker.setPosition(place.geometry.location);

                    // latitude.value=place.geometry.location.lat();
                    //longitude.value= place.geometry.location.lng();

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

        // Set zoom level
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(7);
            google.maps.event.removeListener(boundsListener);
        });

        var markerCluster = new MarkerClusterer(map, clusterMarkers,
            {imagePath: '{{asset('frontend/img/map/m')}}'});

    }
    function knowYourLocation() {
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                customInfoWindow.setPosition(pos);
                customInfoWindow.setContent('Location found.');
                customInfoWindow.open(map);
                map.setCenter(pos);
                map.setZoom(16);
            }, function() {
                handleLocationError(true, customInfoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, customInfoWindow, map.getCenter());
        }
    }
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        /*infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');*/
        infoWindow.open(map);
    }

</script>

<script>
    $('#know').on('click',function () {
        knowYourLocation();
    });
</script>

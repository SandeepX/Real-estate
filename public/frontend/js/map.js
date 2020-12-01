function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap',
        zoom: 14,
        scrollwheel: true,
        center: {lat: 27.7172, lng: 85.3240}
    };

    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(50);

    // Multiple markers location, latitude, and longitude
    var markers = [
        ['Chabahil', 27.717592, 85.346904],
        ['Lazimpat', 27.719729, 85.318644],
        ['Baluwatar', 27.724326, 85.331197],
        ['Tangal', 27.717160, 85.330403],
        ['Paknajol', 27.715493, 85.308602],
        ['chhauni',27.706205,85.292048],
        ['Sitapaila',27.707513,85.282562],
        ['Jorpati',27.721729,85.372701],
        ['Halchowk',27.719753,85.280611]
    ];

    // Info window content
    var infoWindowContent = [
        ['<div class="info_content">' +
        '<img src="img/map-img1.jpg" class="img-fluid map-img" alt="">' +
        '<h6 class="map-img-title"><a href="single-properties.php">Chabahil Apartment</a></h6>' +
        '<p class="map-desc-p">Chabahil, Kathmandu, NEPAL</p><p class="map-desc-p">Beds: 4 Baths: 2 Sq Ft: 1200</p>' +
        '<p class="map-category-p"><a href="list-property.php" class="map-category">Apartment</a><a href="list-property.php" class="map-category">Banglow</a><a href="list-property.php" class="map-category">House</a></p>' + '</div>'],
        ['<div class="info_content">' +
        '<img src="img/map-img2.jpg" class="img-fluid map-img" alt="">' +
        '<h6 class="map-img-title"><a href="single-properties.php">Lazimpat Apartment</a></h6>' +
        '<p class="map-desc-p">Lazimpat, Kathmandu, NEPAL</p><p class="map-desc-p">Beds: 4 Baths: 2 Sq Ft: 1200</p>' +
        '<p class="map-category-p"><a href="list-property.php" class="map-category">Apartment</a><a href="list-property.php" class="map-category">Banglow</a><a href="list-property.php" class="map-category">House</a></p>' + '</div>'],
        ['<div class="info_content">' +
        '<img src="img/map-img3.jpg" class="img-fluid map-img" alt="">' +
        '<h6 class="map-img-title"><a href="single-properties.php">Baluwatar Apartment</a></h6>' +
        '<p class="map-desc-p">Baluwatar, Kathmandu, NEPAL</p><p class="map-desc-p">Beds: 4 Baths: 2 Sq Ft: 1200</p>' +
        '<p class="map-category-p"><a href="list-property.php" class="map-category">Apartment</a><a href="list-property.php" class="map-category">Banglow</a><a href="list-property.php" class="map-category">House</a></p>' + '</div>'],
        ['<div class="info_content">' +
        '<img src="img/map-img4.jpg" class="img-fluid map-img" alt="">' +
        '<h6 class="map-img-title"><a href="single-properties.php">Tangal Apartment</a></h6>' +
        '<p class="map-desc-p">Tangal, Kathmandu, NEPAL</p><p class="map-desc-p">Beds: 4 Baths: 2 Sq Ft: 1200</p>' +
        '<p class="map-category-p"><a href="list-property.php" class="map-category">Apartment</a><a href="list-property.php" class="map-category">Banglow</a><a href="list-property.php" class="map-category">House</a></p>' + '</div>'],
        ['<div class="info_content">' +
        '<img src="img/map-img1.jpg" class="img-fluid map-img" alt="">' +
        '<h6 class="map-img-title"><a href="single-properties.php">Paknajol Apartment</a></h6>' +
        '<p class="map-desc-p">Paknajol, Kathmandu, NEPAL</p><p class="map-desc-p">Beds: 4 Baths: 2 Sq Ft: 1200</p>' +
        '<p class="map-category-p"><a href="list-property.php" class="map-category">Apartment</a><a href="list-property.php" class="map-category">Banglow</a><a href="list-property.php" class="map-category">House</a></p>' + '</div>']
    ];



    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    let imageUrl = "{{$propertyAddress->latitude}}";
    var image = {
       /* url: 'img/pin-1.png',*/
        url: "{{}}",
        size: new google.maps.Size(60, 60),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 0)
    };

    // Place each marker on the map
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            icon: image,
            title: markers[i][0]
        });

        // Add info window to marker
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });



}
// // Load initialize function
// google.maps.event.addDomListener(window, 'load', initMap);
// 
// 
//
  
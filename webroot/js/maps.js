
/*Google Maps*/
var marker = null;
function placeMarker(location, map) {
    if(marker) {
        marker.setPosition(location);
    } else {
        marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }
    if ($('#btnRemoveLocation').length > 0) {
        $('#btnRemoveLocation').show();
    }
}
function removeLocation(){
    $('#latitude').val('');
    $('#longitude').val('');
    $('#btnRemoveLocation').fadeOut();
    marker.setMap(null);
    marker = null;
}

function initAdminMap(lat, lon) {
    var showMarker = true;
    if (!lat) {
        showMarker = false;
        lat = "35.92016134622394";
    }
    if (!lon) {
        showMarker = false;
        lon = "14.438588619232178";
    }
    var myLatlng = new google.maps.LatLng(lat, lon);
    var mapOptions = {
        zoom: 11,
        center: myLatlng
    };
    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng, map);
        $('#latitude').val(event.latLng.lat());
        $('#longitude').val(event.latLng.lng());
        $('#btnRemoveLocation').fadeIn();
    });

    if (showMarker) {
        placeMarker(myLatlng, map);
        $('#btnRemoveLocation').fadeIn();
    }

    // Create the search box and link it to the UI element.
    var input = (document.getElementById('googleSearchBox'));
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var searchBox = new google.maps.places.SearchBox((input));

    google.maps.event.addListener(map, 'tilesloaded', function() {
        google.maps.event.addListener(searchBox, 'places_changed', function() {
            var places = searchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            bounds.extend(places[0].geometry.location);
            map.fitBounds(bounds);
            map.setZoom(16);
        });
    });

    google.maps.event.addListener(map, 'bounds_changed', function() {
        var bounds = map.getBounds();
        searchBox.setBounds(bounds);
    });
}

function initFrontEndMap(lat, lon) {
    var myLatlng = new google.maps.LatLng(lat, lon);
    var mapOptions = {
        center: myLatlng,
        zoom: 15,
        disableDefaultUI: true,
        draggableCursor: "pointer"
    };
    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map
    });

    google.maps.event.addListener(map, 'click', function() {
        map.setCenter(marker.getPosition());
        var latlng = map.getCenter().toUrlValue();
        var parametersLatLng = latlng.replace(',', '+')
        window.open("https://www.google.com.mt/maps/place/" + parametersLatLng);
    });
}
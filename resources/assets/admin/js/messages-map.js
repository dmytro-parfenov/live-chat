//functions
function initMap(locations) {

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 2,
        minZoom: 2,
        center: {lat: 0, lng: 0},
        mapTypeControl: false
    });

    // Add some markers to the map.
    // Note: The code uses the JavaScript Array.prototype.map() method to
    // create an array of markers based on a given "locations" array.
    // The map() method here has nothing to do with the Google Maps API.
    var markers = locations.map(function(location, i) {
        return new google.maps.Marker({
            position: location
        });
    });

    // Add a marker clusterer to manage the markers.
    var markerCluster = new MarkerClusterer(map, markers,
        {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
}

$(document).ready(function(){

    //get coords of users by messages and init map
    $.ajax({
        type: "GET",
        url: "/master/messages-map/coords",
        success: function (response) {
            if (response.length > 0) {
                var coords = [];
                var places = [];
                for (var i = 0; i < response.length; i++) {
                    coords.push({lat: parseFloat(response[i].user_location_lat), lng: parseFloat(response[i].user_location_lng)});
                }
                initMap(coords);
            }
        }
    });

});

$(window).on('load', function(){


});
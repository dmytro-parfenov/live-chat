//functions
function initMap(locations, places) {

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
            position: location,
            title: places[i]
        });
    });

    // Add a marker clusterer to manage the markers.
    var markerCluster = new MarkerClusterer(map, markers,
        {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
}

function uniqueCountries(arr) {
    var result = [];

    nextInput:
        for (var i = 0; i < arr.length; i++) {
            var str = arr[i]; // для каждого элемента
            for (var j = 0; j < result.length; j++) { // ищем, был ли он уже?
                if (result[j] == str) continue nextInput; // если да, то следующий
            }
            result.push(str);
        }

    return result;
}

function drawMapStatistic(name, values, idElement) {
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(values);

        var options = {
            title: name
        };

        var chart = new google.visualization.BarChart(document.getElementById(idElement));
        chart.draw(data, options);
    }
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
                var countries = [];
                for (var i = 0; i < response.length; i++) {
                    coords.push({lat: parseFloat(response[i].user_location_lat), lng: parseFloat(response[i].user_location_lng)});
                    $.ajax({
                        async: false,
                        type: "GET",
                        url: "https://maps.googleapis.com/maps/api/geocode/json",
                        data: {latlng: response[i].user_location_lat+','+response[i].user_location_lng,
                            language: 'en',
                            result_type: 'street_address|country',
                            key: 'AIzaSyAIpi0wvFb7yyxMzJZWXYxX3cEQn_byngU'},
                        success: function (data) {
                            if (data.results.length > 0) {
                                if (data.results.length > 1) {
                                    places.push(data.results[0].formatted_address);
                                    countries.push(data.results[1].formatted_address);
                                } else {
                                    places.push(data.results[0].formatted_address);
                                    countries.push(data.results[0].formatted_address);
                                }
                            } else {
                                places.push('Not found');
                                countries.push('Not found');
                            }
                        }
                    });
                }
                initMap(coords, places);
                originalArrayCountries = countries;
                uniqueArrayCountries = uniqueCountries(countries);
                var valuesCountries = [['Name', 'Value']];
                for (i = 0; i < uniqueArrayCountries.length; i++){
                    var count = 0;
                    for (k = 0; k < originalArrayCountries.length; k++){
                        if (uniqueArrayCountries[i] === originalArrayCountries[k]) {
                            count++;
                        }
                    }
                    valuesCountries.push([uniqueArrayCountries[i], count]);
                }
                drawMapStatistic('Countries statistics', valuesCountries, 'barchart-map');
            }
        }
    });

});

$(window).on('load', function(){


});
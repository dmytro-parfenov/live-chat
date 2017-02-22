$(document).ready(function(){
    
    //delete one message
    $('.delete-message').click(function () {
        $(this).prev().attr("checked", true);
    });

    //delete all messages
    $('.delete-all-messages').click(function () {
        if(confirm('Confirm the deletion')) {
            $('.checkbox-message').attr("checked", true);
            $('.messages-control-form').submit();
        }
    });

    //filter date
    $('input[type=date]').change(function () {
        $('.messages-sort-form').submit();
    });

    //filter order by
    $('.order-by-select').change(function () {
        $('.messages-sort-form').submit();
    });

    //filter users
    $('.user-select').change(function () {
        $('.messages-sort-form').submit();
    });

    //show or hide user location
    $('body').on('click', '.map-marker', function(){
        $('.background-map-object, #map-object').fadeIn(500);
        //get coords
        var locationLat = parseFloat($(this).attr("data-user-location-lat"));
        var locationLng = parseFloat($(this).attr("data-user-location-lng"));
        var myLatLng = {lat: locationLat, lng: locationLng};

        //get map containel object
        mapObjectLocation = $('#map-object-location')[0];

        //generate map
        var map = new google.maps.Map(mapObjectLocation, {
            zoom: 14,
            center: myLatLng,
            mapTypeControl: false
        });

        $.ajax({
            type: "GET",
            url: "https://maps.googleapis.com/maps/api/geocode/json",
            data: {latlng: locationLat+','+locationLng,
                language: 'en',
                key: 'AIzaSyAIpi0wvFb7yyxMzJZWXYxX3cEQn_byngU'},
            success: function (response) {
                var locationName = response.results[0].formatted_address;
                // generate marker content
                var contentString = '<div id="content-map-marker">'+locationName+'</div>';
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                //generate marker
                var marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map
                });

                //show marker content
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

            }
        });

        $('.background-map-object, #map-object').stop();
        $('.background-map-object, #map-object').fadeIn(500);
        //refresh map
        google.maps.event.trigger(map, 'resize');
        var newLatlng = new google.maps.LatLng(locationLat, locationLng);
        map.setCenter(newLatlng);
    });
    $('.background-map-object').click(function () {
        $('.background-map-object, #map-object').stop();
        $('.background-map-object, #map-object').fadeOut(500);
    });


});

$(window).on('load', function(){


});
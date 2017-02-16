// functions
function soundNotification(url) {
    var audio = new Audio();
    audio.src = url;
    audio.autoplay = true;
}
function sendNotification(title, options) {
    function clickFunc() {
        window.focus();
        $("html, body").animate({ scrollTop: $(document).height() }, 500);
        this.close();
    }
    // check rights for notifications
    if (Notification.permission === "granted") {
        // send notification
        var notification = new Notification(title, options);
        notification.onclick = clickFunc;
    } else if (Notification.permission !== 'denied') {
        Notification.requestPermission(function (permission) {
            if (permission === "granted") {
                var notification = new Notification(title, options);
                notification.onclick = clickFunc;
            }
        });
    }
}

$(document).ready(function(){

    //show or hide user location
    $('body').on('click', '.map-marker', function(){
        //get coords
        locationLat = parseFloat($(this).attr("data-user-location-lat"));
        locationLng = parseFloat($(this).attr("data-user-location-lng"));
        var myLatLng = {lat: locationLat, lng: locationLng};

        //get map containel object
        mapObjectLocation = $('#map-object-location')[0];

        //generate map
        var map = new google.maps.Map(mapObjectLocation, {
            zoom: 14,
            center: myLatLng
        });

        $.ajax({
            type: "GET",
            url: "https://maps.googleapis.com/maps/api/geocode/json",
            data: {latlng: locationLat+','+locationLng,
                language: 'en',
                key: 'AIzaSyAIpi0wvFb7yyxMzJZWXYxX3cEQn_byngU'},
            success: function (response) {
                // generate marker content
                var contentString = '<div id="content-map-marker">'+response.results[0].formatted_address+'</div>';
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

    //show more messages
    $('.show-earlier span').click(function () {
       first_message = $(this).attr('data-first-message');
       _token = $(this).prev().val();
        $.ajax({
            type: "POST",
            url: "/show-more-messages",
            dataType: 'json',
            data: {_token: _token,
                first_message: first_message},
            success: function (response) {
                $('.message-block').first().before(response.html);
                $('.message-block').hide();
                $('.message-block').fadeIn(500);
                $('.show-earlier span').attr('data-first-message', response.first_message);
            },
            error: function () {
                $('.show-earlier').slideUp(500);
            }
        });
    });

});

$(window).on('load', function(){

    //check browser support for notifications
    if (("Notification" in window)) {
        Notification.requestPermission();
    } else {
        console.log('Your browser does not support HTML5 Notifications');
    }

    // load pusher
    var pusher = new Pusher('5ccc3f2a7680d594a7dc', {
        encrypted: true
    });

    // subscribe to new messages
    var channelMessage = pusher.subscribe('new-message-channel');
    channelMessage.bind('new-message-event', function(data) {
        $("html, body").animate({ scrollTop: $(document).height() }, 500);
        $('.message-block').last().after(data.html);
        $('.message-block').last().hide();
        $('.message-block').last().fadeIn(500);

        if (document.hidden) {
            soundNotification('frontend/sounds/get-message.wav');
            sendNotification(data.user_name, {
                body: data.message,
                icon: 'favicon.ico',
                dir: 'auto'
            });
        }

    });

    // subscribe to new users
    var channelUser = pusher.subscribe('new-user-channel');
    channelUser.bind('new-user-event', function(data) {
        soundNotification('frontend/sounds/get-message.wav');
        sendNotification('New user connected', {
            body: data,
            icon: 'favicon.ico',
            dir: 'auto'
        });
    });

});
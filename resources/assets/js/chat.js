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
    $('.map-marker').click(function () {

        locationLat = parseFloat($(this).attr("data-user-location-lat"));
        locationLng = parseFloat($(this).attr("data-user-location-lng"));
        mapObject = $('#map-object-location')[0];
        var myLatLng = {lat: locationLat, lng: locationLng};
        var map = new google.maps.Map(mapObject, {
            zoom: 14,
            center: myLatLng
        });
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map
        });
        $('.background-map-object, #map-object').stop();
        $('.background-map-object, #map-object').fadeIn(500);
    });
    $('.background-map-object').click(function () {
        $('.background-map-object, #map-object').stop();
        $('.background-map-object, #map-object').fadeOut(500);
        $('#map-object-location').find('div').remove();
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
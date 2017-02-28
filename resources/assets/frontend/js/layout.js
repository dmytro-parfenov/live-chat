//functions
function showPosition(position) {
    var _token = $('meta[name=csrf-token]').attr('content');
    $.ajax({
        type: "POST",
        url: "/send-location",
        data: { _token: _token,
            user_location_lat: position.coords.latitude,
            user_location_lng: position.coords.longitude}
    });
}

function sendDeviceInfo(deviceType, deviceOs) {
    var _token = $('meta[name=csrf-token]').attr('content');
    $.ajax({
        type: "POST",
        url: "/send-device-info",
        data: { _token: _token,
            device_type: deviceType,
            device_os: deviceOs}
    });
}

$(document).ready(function(){

    //load bootstrap
    $('[data-toggle="tooltip"]').tooltip();

    //edit user name
    $('.user-name span').click(function () {
        $(this).closest('.user-name').hide(500, function () {
            $('.get-user-name').show(500);
        });
    });

    // go to page bottom or top
    $('.arrow-up').click(function () {
        $("html, body").animate({ scrollTop: 0 });
    });
    $('.arrow-down').click(function () {
        $("html, body").animate({ scrollTop: $(document).height() });
    });

    //detect device type and os
    var deviceType = 'Other';
    if (device.mobile()) {
        deviceType = 'Mobile';
    } else if (device.tablet()){
        deviceType = 'Tablet';
    } else if (device.desktop()){
        deviceType = 'Desktop';
    }
    var deviceOs = 'Other';
    if (device.ios()) {
        deviceOs = 'IOS';
    } else if (device.android()){
        deviceOs = 'Android';
    } else if (device.windows()) {
        deviceOs = 'Windows';
    }

    sendDeviceInfo(deviceType, deviceOs);

});

$(window).on('load', function(){

    // check browser support geolocation
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        console.log('Geolocation is not supported by this browser');
    }

});
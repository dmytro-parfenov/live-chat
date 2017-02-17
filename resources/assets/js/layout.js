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

});

$(window).on('load', function(){

    // check browser support geolocation
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        console.log('Geolocation is not supported by this browser');
    }

});
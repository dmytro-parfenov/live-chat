//functions
function sendMessage() {
    var message = $('.send-message-container input').val();
    var token = $('.send-message-container input').data('token');
    if (message.length > 0 ) {
        $.ajax({
            type: "POST",
            url: "/send-message",
            data: { _token: token,
                    message: message},
            success: function(){
                $('.send-message-container input').val('');
            }
        });
    }
}

function showPosition(position) {
    var _token = $('.geolocation-token').find('input').val();
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

    //send message
    $('.send-message-container input').keyup(function (event) {
        if (event.keyCode === 13){
            sendMessage();
        }
    });
    $('.send-message-container button').click(function () {
        sendMessage();
    });

    //show or hide search form
    $('.search').click(function () {
        $('.tool-pannel').stop();
        $('.tool-pannel').animate({'right':'-50px'}, 500);
        showToolPannel = false;
        $('.search-form').slideDown(500);
    });

    $(document).click(function(event) {
        if ($(event.target).closest('.search-form').length) return;
        if ($(event.target).closest('.search').length) return;
        if ($(event.target).closest('.search-result-again span').length) return;
        $('.search-form').slideUp(500);
        event.stopPropagation();
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
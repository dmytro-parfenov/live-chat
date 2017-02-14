//functions
function soundNotification(url) {
    var audio = new Audio();
    audio.src = url;
    audio.autoplay = true;
}
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
                soundNotification('frontend/sounds/send-message.wav');
            }
        });
    }
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

    $('.search').click(function () {
        $('.search').stop();
        $('.search').animate({'right':'-50px'}, 500);
        showSearch = false;
        $('.search-form').slideDown(500);
    });

    $(document).click(function(event) {
        if ($(event.target).closest('.search-form').length) return;
        if ($(event.target).closest('.search').length) return;
        $('.search-form').slideUp(500);
        event.stopPropagation();
    });

});

$(window).on('load', function(){

    $("html, body").animate({ scrollTop: $(document).height() }, 500, function () {
        coordWindowTopMax = $(window).scrollTop();
        showSearch = false;
        showMessageContainer = true;
        $(window).scroll(function () {
            coordWindowTop = $(window).scrollTop();
            if (coordWindowTopMax - 70 > coordWindowTop && !showSearch && $('.search-form').css('display') !== 'block') {
                $('.search').stop();
                $('.search').animate({'right':'0'}, 500);
                showSearch = true;
            } else if (coordWindowTopMax - 70 < coordWindowTop && showSearch) {
                $('.search').stop();
                $('.search').animate({'right':'-50px'}, 500);
                showSearch = false;
            }
            if (coordWindowTop >= coordWindowTopMax && !showMessageContainer) {
                $('.send-message-container').stop();
                $('.send-message-container').animate({'bottom':'0'}, 500);
                showMessageContainer = true;
            } else if (coordWindowTop < coordWindowTopMax && showMessageContainer) {
                $('.send-message-container').stop();
                $('.send-message-container').animate({'bottom':'-70px'}, 500);
                showMessageContainer = false;
            }
        });
    });

    function countUsersOnline() {
        usersOnline = $('.realtimeuserscounter__num').text();
        $('.users-online-counter').css({'display':'inline-block'});
        $('.users-online-counter').animate({marginTop:'0'}, 500);
        $('.users-online-counter').text(usersOnline);
        $('.realtimeuserscounter').remove();
    }

    setTimeout(countUsersOnline, 5000);

});
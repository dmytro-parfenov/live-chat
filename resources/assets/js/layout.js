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

});

$(window).on('load', function(){

    $("html, body").animate({ scrollTop: $(document).height() }, 500);

});
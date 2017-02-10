//function
function sendMessage() {
    var message = $('.send-message-container input').val();
    var token = $('.send-message-container input').data('token');
    if (message.length > 0 ) {
        $.post('/send-message', {_token: token, message: message },
            function(data){
                if (data) {
                    $('.send-message-container input').val('');
                } else {
                    alert('Error');
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
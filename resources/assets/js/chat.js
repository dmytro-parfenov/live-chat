// functions
function sendNotification(title, options) {
    function clickFunc() {
        window.focus();
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

});

$(window).on('load', function(){

    //check browser support for notifications
    if (("Notification" in window)) {
        Notification.requestPermission();
    } else {
        console.log('Your browser does not support HTML5 Notifications');
    }

    //subscribe to new messages
    var pusher = new Pusher('5ccc3f2a7680d594a7dc', {
        encrypted: true
    });

    var channel = pusher.subscribe('new-message-channel');
    channel.bind('new-message-event', function(data) {
        $("html, body").animate({ scrollTop: $(document).height() }, 500);
        $('.message-block').last().after(data.html);
        $('.message-block').last().hide();
        $('.message-block').last().fadeIn(500);

        $.ajax({
            type: "GET",
            url: "/get-cookie-user-id",
            success: function(response){
                response = parseInt(response);
                if (response !== data.user_id) {
                    soundNotification('frontend/sounds/get-message.wav');
                    sendNotification(data.user_name, {
                        body: data.message,
                        icon: 'favicon.ico',
                        dir: 'auto'
                    });
                }
            }
        });

    });

});
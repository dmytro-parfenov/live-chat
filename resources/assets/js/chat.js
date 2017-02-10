// functions
function sendNotification(title, options) {
    function clickFunc() {
        window.focus();
        this.close();
    }
    function soundNotification() {
        var audio = new Audio();
        audio.src = 'frontend/sounds/notification.mp3';
        audio.autoplay = true;
    }

    // check rights for notifications
    if (Notification.permission === "granted") {
        // send notification
        var notification = new Notification(title, options);
        notification.onclick = clickFunc;
        soundNotification();
    } else if (Notification.permission !== 'denied') {
        Notification.requestPermission(function (permission) {
            // send notification
            if (permission === "granted") {
                var notification = new Notification(title, options);
                notification.onclick = clickFunc;
                soundNotification();
            }
        });
    }
}
function subscribe() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState != 4) return;

        if (this.status == 200) {
            if (this.responseText.length > 0) {
                $("html, body").animate({ scrollTop: $(document).height() }, 500);
                response = jQuery.parseJSON(this.responseText);
                $('.message-block').last().after(response.html);
                $('.message-block').last().hide();
                $('.message-block').last().fadeIn(500);
                for (i = 0; i < response.messages.length; i++) {
                    if (response.user_id !== null) {
                        if (response.user_id !== response.messages[i].user_id) {
                            sendNotification(response.messages[i].user_name, {
                                body: response.messages[i].message,
                                icon: 'favicon.ico',
                                dir: 'auto'
                            });
                        }
                    } else {
                        sendNotification(response.messages[i].user_name, {
                            body: response.messages[i].message,
                            icon: 'favicon.ico',
                            dir: 'auto'
                        });
                    }
                }
            }
        }

        subscribe();
    };
    xhr.open("GET", '/subscribe-message', true);
    xhr.send();
}

$(document).ready(function(){

});

$(window).on('load', function(){

    if (("Notification" in window)) {
        Notification.requestPermission();
    } else {
        console.log('Your browser does not support HTML5 Notifications');
    }

    subscribe();

});
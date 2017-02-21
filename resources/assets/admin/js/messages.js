$(document).ready(function(){
    
    //delete one message
    $('.delete-message').click(function () {
        $(this).prev().attr("checked", true);
    });

    //delete all messages
    $('.delete-all-messages').click(function () {
        if(confirm('Confirm the deletion')) {
            $('.checkbox-message').attr("checked", true);
            $('.messages-control-form').submit();
        }
    });

    //filter date
    $('input[type=date]').change(function () {
        $('.messages-sort-form').submit();
    });

    //filter order by
    $('.order-by-select').change(function () {
        $('.messages-sort-form').submit();
    });

    //filter users
    $('.user-select').change(function () {
        $('.messages-sort-form').submit();
    });

});

$(window).on('load', function(){


});
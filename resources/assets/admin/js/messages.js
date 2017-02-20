$(document).ready(function(){
    
    $('.delete-message').click(function () {
        console.log($(this).prev().val());
        $(this).prev().attr("checked", true);
    })

});

$(window).on('load', function(){


});
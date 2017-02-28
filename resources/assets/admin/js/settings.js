$(document).ready(function(){

    tinymce.init({
        selector: '.tinymce',
        height: 300,
        menubar: true,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code responsivefilemanager'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
        filemanager_crossdomain: true,
        external_filemanager_path:"/bower_components/tinymce/js/tinymce/filemanager/",
        external_plugins: { "filemanager" : "/bower_components/tinymce/js/tinymce/filemanager/plugin.min.js"}
    });

});

$(window).on('load', function(){


});
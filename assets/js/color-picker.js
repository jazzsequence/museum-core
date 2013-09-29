jQuery(document).ready(function($) {
    $('#colorpicker-link').hide();
    $('#colorpicker-hover').hide();
    $('#colorpicker-link').farbtastic('#link-color');
    $('#colorpicker-hover').farbtastic('#hover-color');

    $('#link-color').click(function() {
        $('#colorpicker-link').slideToggle();
    });
    $('#hover-color').click(function() {
        $('#colorpicker-hover').slideToggle();
    });
});
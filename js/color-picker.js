jQuery(document).ready(function($) {
    $('#colorpicker').hide();
    $('#colorpicker').farbtastic('#color');

    $('#color').click(function() {
        $('#colorpicker').slideToggle();
    });
});
$(document).ready(function() {
    $(window).keydown(function(e) {
        if(e.keyCode == 13) {
            $('[data-overlay-dialog-button-value]').click();
        }
    });

    $('[data-overlay-dialog-button-value]').click(function() {
        var optionDialogButton = $(this).data('overlay-dialog-button-value');
        if(optionDialogButton == 'Okay') {
            if($(this).data('redirect') != undefined && $(this).data('redirect') != '') {
                window.location = $(this).data('redirect');
            } else {
                if($('.overlay').length) {
                    $('.overlay').fadeOut(250, function() {
                        $('.focused-input').focus();
                    });
                }
            }
        }
    });
});
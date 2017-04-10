function toggleSubHeader(position) {
    if(position <= 0) {
        position = 0;
        $('#prev-button').hide();
        $('#scroll-up').fadeOut(500);
    } else if(position >= 7) {
        position = 7;
        $('#next-button').hide();
        $('#submit-button').show();
        $('#scroll-down').fadeOut(500);
    } else {
        $('#prev-button').show();
        $('#next-button').show();
        $('#submit-button').hide();
        $('#scroll-up').fadeIn(500);
        $('#scroll-down').fadeIn(500);
    }

    $('#side-bar-container').animate({
        'margin-top': -(position*250)
    }, 200);

    switch(position) {
        case 0:
            $('#sub-header').text('President');
            break;
        case 1:
            $('#sub-header').text('Vice President');
            break;
        case 2:
            $('#sub-header').text('Secretary');
            break;
        case 3:
            $('#sub-header').text('Treasurer');
            break;
        case 4:
            $('#sub-header').text('Auditor');
            break;
        case 5:
            $('#sub-header').text('Business Manager');
            break;
        case 6:
            $('#sub-header').text('P.R.O.');
            break;
        case 7:
            switch(sessionID) {
                case 4:
                    $('#sub-header').text('4th Year Representative');
                    break;
                case 3:
                    $('#sub-header').text('3rd Year Representative');
                    break;
                case 2:
                    $('#sub-header').text('2nd Year Representative');
                    break;
                case 1:
                    $('#sub-header').text('1st Year Representative');
                    break;
            }

            break;
    }
}

function loadCandidates(position) {
    var post = 0;

    switch(position) {
        case 7:
            switch(sessionID) {
                case 4:
                    post = 7;
                    break;
                case 3:
                    post = 8;
                    break;
                case 2:
                    post = 9;
                    break;
                case 1:
                    post = 10;
                    break;
            }

            break;
        default:
            post = position;
            break;
    }

    $.ajax({
        url: 'requests/candidates.php',
        method: 'POST',
        data: {
            action: 'cfb0812ce377639da10d21e6416d3a2d',
            position: post
        },
        success: function(response) {
            var pos;

            switch(position) {
                case 0:
                    pos = 'president';
                    break;
                case 1:
                    pos = 'vice-president';
                    break;
                case 2:
                    pos = 'secretary';
                    break;
                case 3:
                    pos = 'treasurer';
                    break;
                case 4:
                    pos = 'auditor';
                    break;
                case 5:
                    pos = 'business-manager';
                    break;
                case 6:
                    pos = 'pro';
                    break;
                case 7:
                    switch(sessionID) {
                        case 4:
                            pos = '4th-year-rep';
                            break;
                        case 3:
                            pos = '3rd-year-rep';
                            break;
                        case 2:
                            pos = '2nd-year-rep';
                            break;
                        case 1:
                            pos = '1st-year-rep';
                            break;
                    }

                    break;
            }

            $('.candidates').html(response);

            $('.' + pos).each(function() {
                if($('.candidate-info', this).data('candidate-id') == $('#voted-' + pos).val()) {
                    $('.container', this).addClass('selected');
                }
            });

            $('.candidates').css({
                'margin-top': -($('.candidates').height() / 2) + 'px'
            });

            $('.candidate').click(function() {
                if($('div', this).hasClass('selected')) {
                    $('.container', this).removeClass('selected');
                    $('#image-' + pos).attr('src', 'images/warrior.png');
                    $('#voted-' + pos).val('');
                } else {
                    $('.' + pos).each(function() {
                        $('.container', this).removeClass('selected');
                    });

                    if($('#image-' + pos).attr('src') != $('.candidate-image', this).attr('src')) {
                        $('#image-' + pos).attr('src', $('.candidate-image', this).attr('src'));
                    }

                    $('#voted-' + pos).val($('.candidate-info', this).data('candidate-id'));

                    $('.container', this).addClass('selected');
                }
            });
        }
    });

    return false;
}

function showConfirmDialog(title, content, yesFunction, noFunction) {
    $('.special').html('<div class="overlay"><div class="overlay"><div class="overlay-dialog"><div class="overlay-dialog-header">' + title + '</div><div class="overlay-dialog-content">' + content + '</div><div class="overlay-dialog-footer"><button id="overlay-yes-button" class="input-button minify" data-overlay-dialog-button-focus="true">Yes</button>&nbsp;<button id="overlay-no-button" class="input-button minify">No</button></div></div></div>');

    $(window).keydown(function(e) {
        if(e.keyCode == 13) {
            $('[data-overlay-dialog-button-value]').click();
        }
    });

    $('#overlay-yes-button').click(yesFunction);

    $('#overlay-no-button').click(noFunction);
}

$(document).ready(function() {
    var position = 0;

    $(function() {
        $('#sub-header').text('President');

        $('#prev-button').hide();
        $('#submit-button').hide();

        loadCandidates(position);
    });

    $('#scroll-up').click(function() {
        position -= 1;

        if(position >= 0 && position <= 7) {
            toggleSubHeader(position);
            loadCandidates(position);
        } else if(position <= 0) {
            position = 0;
            toggleSubHeader(position);
            loadCandidates(position);
        }
    });

    $('#prev-button').click(function() {
        position -= 1;

        if(position >= 0 && position <= 10) {
            toggleSubHeader(position);
            loadCandidates(position);
        } else if(position <= 0) {
            position = 0;
            toggleSubHeader(position);
            loadCandidates(position);
        }
    });

    $('#scroll-down').click(function() {
        position += 1;

        if(position >= 0 && position <= 7) {
            toggleSubHeader(position);
            loadCandidates(position);
        } else if(position >= 7) {
            position = 7;
            toggleSubHeader(position);
            loadCandidates(position);
        }
    });

    $('#next-button').click(function() {
        position += 1;

        if(position >= 0 && position <= 10) {
            toggleSubHeader(position);
            loadCandidates(position);
        } else if(position >= 10) {
            position = 10;
            toggleSubHeader(position);
            loadCandidates(position);
        }
    });

    $('#submit-button').click(function() {
        showConfirmDialog('Submit Vote', 'Are you sure you want to submit your votes? Submitted votes cannot be altered hereafter.', function() {
            $('#overlay-yes-button').hide();
            $('[data-form=votes-form]').delay(1000).submit();
        }, function() {
            if($('.overlay').length) {
                $('.overlay').fadeOut(250, function() {
                    $('.focused-input').focus();
                });
            }
        });
    });
});
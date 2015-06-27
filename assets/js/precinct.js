function toggleSubHeader(position) {
    if(position <= 0) {
        position = 0;
        $('#prev-button').hide();
        $('#scroll-up').fadeOut(500);
    } else if(position >= 9) {
        position = 9;
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
            $('#sub-header').text('4th Year Representative');
            break;
        case 7:
            $('#sub-header').text('3rd Year Representative');
            break;
        case 8:
            $('#sub-header').text('2nd Year Representative');
            break;
        case 9:
            $('#sub-header').text('1st Year Representative');
            break;
    }
}

function loadCandidates(position) {
    $.ajax({
        url: 'requests/candidates.php',
        method: 'POST',
        data: {
            action: 'cfb0812ce377639da10d21e6416d3a2d',
            position: position
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
                    pos = '4th-year-rep';
                    break;
                case 7:
                    pos = '3rd-year-rep';
                    break;
                case 8:
                    pos = '2nd-year-rep';
                    break;
                case 9:
                    pos = '1st-year-rep';
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

        if(position >= 0 && position <= 9) {
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

        if(position >= 0 && position <= 9) {
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

        if(position >= 0 && position <= 9) {
            toggleSubHeader(position);
            loadCandidates(position);
        } else if(position >= 9) {
            position = 9;
            toggleSubHeader(position);
            loadCandidates(position);
        }
    });

    $('#next-button').click(function() {
        position += 1;

        if(position >= 0 && position <= 9) {
            toggleSubHeader(position);
            loadCandidates(position);
        } else if(position >= 9) {
            position = 9;
            toggleSubHeader(position);
            loadCandidates(position);
        }
    });

    $('#submit-button').click(function() {
        $('[data-form=votes-form]').submit();
    });
});
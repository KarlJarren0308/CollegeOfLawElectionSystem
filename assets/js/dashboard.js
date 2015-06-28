var info = [];

function loadMessages() {
    $.ajax({
        url: 'requests/logs.php',
        method: 'POST',
        data: {
            action: '670b6594b0d31fe3cb808084a4c9c0cb'
        },
        success: function(response) {
            $('.chat-messages').html(response);
        }
    });

    return false;
}

function revealResults(pos) {
    for(var i = 0; i < info.length; i++) {
        if(pos == info[i]['position']) {
            var arr = $('#count-' + info[i]['id']).text().split('/');
            var newWidth = (arr[0] / arr[1]) * 100;

            $('#count-' + info[i]['id']).fadeIn(500);
            $('#bar-' + info[i]['id']).animate({
                'width': newWidth + '%'
            }, 1500);
        }
    }
}

$(document).ready(function() {
    $(function() {
        setInterval(function() {
            loadMessages();
        }, 500);
    });

    $('[data-form=chat-form]').submit(function() {
        $.ajax({
            url: 'requests/logs.php',
            method: 'POST',
            data: $(this).serialize() + '&action=5dd205015951f9f81e5b95c86457130a',
            success: function(response) {
                if(response == true) {
                    loadMessages();
                    $('#message-box').val('').focus();
                }
            }
        });

        return false;
    });

    $('#position').click(function() {
        $select = $(this)[0].selectedIndex;

        if($select != 0) {
            $(this).css({
                'color': 'rgb(25, 40, 35)',
                'text-shadow': '-2px 2px 3px rgba(25, 40, 35, 0.5)'
            });
        }
    });

    $('#position').change(function() {
        $.ajax({
            url: 'requests/count_votes.php',
            method: 'POST',
            data: {
                action: '4423e313719cbd8b2b3cc097bf3bb439',
                position: $(this).val()
            },
            success: function(response) {
                $('.candidates').html(response);

                $('.candidates').css({
                    'margin-top': -($('.candidates').height() / 2) + 'px'
                });

                $.ajax({
                    url: 'requests/get_candidate_id.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        info = response;
                    }
                });
                
                return false;
            }
        });
    });

    $('#reveal-button').click(function() {
        var pos = '';

        switch($('#position').val()) {
            case '0':
                pos = 'President';
                break;
            case '1':
                pos = 'Vice President';
                break;
            case '2':
                pos = 'Secretary';
                break;
            case '3':
                pos = 'Treasurer';
                break;
            case '4':
                pos = 'Auditor';
                break;
            case '5':
                pos = 'Business Manager';
                break;
            case '6':
                pos = '4th Year Representative';
                break;
            case '7':
                pos = '3rd Year Representative';
                break;
            case '8':
                pos = '2nd Year Representative';
                break;
            case '9':
                pos = '1st Year Representative';
                break;
            default:
                pos = '';
                break;
        }

        revealResults(pos);
    });
});
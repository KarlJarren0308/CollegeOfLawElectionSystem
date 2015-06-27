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

function revealResults() {
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
            }
        });
    });

    $('#reveal-button').click(function() {
        revealResults('.bar');
    });
});
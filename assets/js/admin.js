function postLog(username, message) {
    $.ajax({
        url: '',
        method: 'POST',
        data: {
            action: '0bd0904b022afac1c25776450cab3fe4',
            username: username,
            message: message
        }
    });

    return false;
}

$(document).ready(function() {
    $(function() {
        if(!$('.overlay').length) {
            $('.focused-input').focus();
        }
    });
});
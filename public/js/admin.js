$('#send_test_form').submit(function (event) {
    event.preventDefault();
    $('#alert_warning').hide();
    $('#alert_success').hide();
    if ($('#step').val() === '0') {
        $.ajax({
            type: 'POST',
            url: '/ajax/newTest.php',
            data: $('#send_test_form').serialize(),
            success: function (data) {
                let response = JSON.parse(data);
                if (response.error == 0) {
                    $('#send_test_form').html(response.template);
                } else {
                    $('#alert_warning').text(response.msg).show();
                }
            }
        });
    } else {
        $.ajax({
            type: 'POST',
            url: '/ajax/newQuestion.php',
            data: $('#send_test_form').serialize(),
            success: function (data) {
                let response = JSON.parse(data);
                if (response.error == 0) {
                    $('#send_test_form').html(response.template);
                } else {
                    $('#alert_warning').text(response.msg).show();
                }
            }
        })
    }
});
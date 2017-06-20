
$(document).ready(function() {
    $(document).on("click", "button#sendEmail", function (e) {
        if($('#emailto').val()==''){
            displayMessageAlert("Please provide Email to!", 'danger', 'warning-sign');
            return false;
        }
        if($('#subject').val()==''){
            displayMessageAlert("Please provide Email Subject!", 'danger', 'warning-sign');
            return false;
        }
        if($('#message').val()==''){
            displayMessageAlert("Please provide Email Message!", 'danger', 'warning-sign');
            return false;
        }

        processing();
        var formData = $('form#quickemail').serializeArray();
        formData.push({
            name: "_method",
            value: "POST"
        });
        $.post('/admin/dashboard/email', formData)
            .done(function (response) {
                $.unblockUI();
                $('form#quickemail')[0].reset();
                displayMessageAlert(response.message);
            })
            .fail(function (response) {
                $('#discount_code').val('');
                $.unblockUI();
                $.each(response.responseJSON, function (key, value) {
                    $.each(value, function (index, message) {
                        displayMessageAlert(message, 'danger', 'warning-sign');
                    });
                });
            });
    });

});
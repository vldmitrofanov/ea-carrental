$(document).ready(function(){
    $(document).on('click', 'button.btn-login', function() {
        processing();
        var formData = $('form#loginForm').serializeArray();
        formData.push({
            name: "_method",
            value: "POST"
        });
        $.post('/cart/add', formData)
            .done(function(response){

                $.unblockUI();
            })
            .fail(function(response){
                $.unblockUI();
                $.each(response.responseJSON, function (key, value) {
                    $.each(value, function (index, message) {
                        displayMessageAlert(message, 'danger', 'warning-sign');
                    });
                });
            });
    });
});
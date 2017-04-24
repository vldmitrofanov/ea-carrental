$(document).ready(function(){
    $(document).on('click', 'a.btn-checkout', function() {
        processing();
        var formData = $('form#checkoutForm').serializeArray();
        formData.push({
            name: "_method",
            value: "POST"
        });
        $.post('/cart/checkout', formData)
            .done(function(response){
                $.unblockUI();

                // displayMessageAlert(response.message);
                // redirectPage('/cart/checkout')
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
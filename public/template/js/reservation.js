
$(document).ready(function(){
    $(document).on("click", "a.validate-code", function(e) {
        processing();
        var formData = $('form#car_reservation').serializeArray();
        formData.push({
            name: "_method",
            value: "POST"
        });
        $.post('/cart/validate_voucher', formData)
        .done(function(response){
            $.unblockUI();
            displayMessageAlert(response.message);
            calculatePrices();
        })
        .fail(function(response){
            $('#discount_code').val('');
            $.unblockUI();
            $.each(response.responseJSON, function (key, value) {
                $.each(value, function (index, message) {
                    displayMessageAlert(message, 'danger', 'warning-sign');
                });
            });
        });
    });
            
    $(document).on('change', 'input[name="extra_id[]"]', function() {
        calculatePrices()
    });

    $(document).on('click', 'a.btn-continue', function() {
        if(!moment($('#date_from').val()).isValid()){
            displayMessageAlert("Please select booking date!", 'danger', 'warning-sign');
            return false;
        }
        if(!moment($('#date_to').val()).isValid()){
            displayMessageAlert("Please select valid booking end date!", 'danger', 'warning-sign');
            return false;
        }

        if(!moment($('#date_to').val()).isAfter($('#date_from').val())){
            displayMessageAlert("Please select valid booking end date!", 'danger', 'warning-sign');
            return false;
        }

        processing();
        var formData = $('form#car_reservation').serializeArray();
        formData.push({
            name: "_method",
            value: "POST"
        });
        $.post('/cart/add', formData)
        .done(function(response){
            displayMessageAlert(response.message);
            redirectPage('/cart/confirm')
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


    $('#resetDateStart').datetimepicker({
        defaultTime:'10:00',
        useCurrent: false,
        onChangeDateTime:function(dp,$input){
            $('#rdate_start').val($input.val());
            calculatePrices();
        }
    });
    $('#resetDateEnd').datetimepicker({
        useCurrent: false,
        defaultTime:'18:00',
        onChangeDateTime:function(dp,$input){
            $('#rdate_end').val($input.val());
            calculatePrices();
        }
    });

    // $('#resetDateStart').on('dp.change',function(event){
    //     alert("in")
    //     $('#rdate_start').val(event.date);
    //     calculatePrices();
    // });
    // $('#resetDateEnd').on('dp.change',function(event){
    //     $('#rdate_end').val(event.date);
    //     calculatePrices();
    // });
});
function calculatePrices(){
    processing();
    var formData = $('form#car_reservation').serializeArray();
    formData.push({
        name: "_method",
        value: "POST"
    });
    $.post('/fleet/calculate_difference', formData)
    .done(function(response){
        $('div.days-duration').html(response.days+' Days Rental');
        $('div.hours-duration').html(response.hours+' Hours Rental');

        $('#date_from').val(response.start);
        $('#date_to').val(response.end);

        $('span.start_date').html(response.start_date);
        $('span.start_time').html(response.start_time);
        $('span.end_date').html(response.end_date);
        $('span.end_time').html(response.end_time);

        $("table.payment_detail> tbody tr:first").find('td').html(
            response.days+" Days and "+ response.hours+" Hours"
        );
        calculateRental();
        // $.unblockUI();
    })
    .fail(function(response){
        $.unblockUI();
        $.each(response.responseJSON, function (key, value) {
            $.each(value, function (index, message) {
                displayMessageAlert(message, 'danger', 'warning-sign');
            });
        });
    });
}

function calculateRental () {
    if(!moment($('#date_from').val()).isValid()){
        $.unblockUI();
        return false;
    }
    if(!moment($('#date_to').val()).isValid()){
        $.unblockUI();
        return false;
    }

    if(!moment($('#date_to').val()).isAfter($('#date_from').val())){
        $.unblockUI();
        return false;
    }

    processing();
    var formData = $('form#car_reservation').serializeArray();
    formData.push({
        name: "_method",
        value: "POST"
    });
    $.post('/fleet/load_car_prices', formData)
    .done(function(response){
        var prices = response.data.prices;
        var currency = response.data.currency;
        var currencySign = response.data.currencySign;

        $('#price_per_day').val(prices.price_per_day);
        $('#price_per_day_detail').val(prices.price_per_day_detail);
        $('#price_per_hour').val(prices.price_per_hour);
        $('#price_per_hour_detail').val(prices.price_per_hour_detail);
        $('#car_rental_fee').val(prices.car_rental_fee);
        $('#extra_price').val(prices.extra_price);
        $('#insurance').val(prices.insurance);
        $('#sub_total').val(prices.sub_total);
        $('#tax').val(prices.tax);
        $('#total_price').val(prices.total_price);
        $('#required_deposit').val(prices.required_deposit);
        $('#discount').val(prices.discount);
        $('#discount_detail').val(prices.discount_detail);

        $('.total-cost').html(prices.total_price);
        $('.days-duration-price').html(prices.price_per_day_label);
        $('.hours-duration-price').html(prices.price_per_hour_label);

        if(prices.hasVDiscount==true){
            $('#discount_code').prop('disabled', true);
            $('#discount_code').val('');
            $('.validate-code').prop('disabled', true);
        }else{
            $('#discount_code').prop('disabled', false);
            $('.validate-code').prop('disabled', false);
        }
                    
        if(prices.discount>0) {
            $('li.discounts').removeClass('hidden');
            $('.discount-label').html(prices.discount_detail);
            $('.discount-amount').html(currencySign+' '+prices.discount);
        }else{ 
            $('li.discounts').addClass('hidden');
        }

        if(prices.hasFreeBies>0) {
            $('li.freeBiesInfo').removeClass('hidden');
            $('.freebies-label').html(prices.oFreeBies.name);
        }else{
            $('li.freeBiesInfo').addClass('hidden');
            $('.freebies-label').html('');
        }

        $('.rentalfee-label').html(prices.car_rental_fee_detail);
        $('.rentalfee-amount').html(currencySign+' '+prices.car_rental_fee);

        $('.extra-label').html('Extras Price');
        $('.extra-amount').html(prices.extra_price_label);
        
        $('.insurance-label').html(prices.insurance_detail);
        $('.insurance-amount').html(currencySign+' '+prices.insurance);
        
        $('.subtotal-fee').html(currencySign+' '+prices.sub_total);
        
        $('.tax-label').html(prices.tax_detail);
        $('.tax-amount').html(currencySign+' '+prices.tax);

        $('.total-cost').html(currencySign+' '+prices.total_price);
        
        $('.deposit-label').html(prices.required_deposit_detail);
        $('.deposit-fee').html(currencySign+' '+prices.required_deposit);
        
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
}


$(document).ready(function(){
    $(document).on('change', 'input[name="extra_id[]"]', function() {
        calculatePrices()
    });

    $('#resetDateStart').datetimepicker().on('dp.change',function(event){
        $('#rdate_start').val(event.date);
        calculatePrices();
    });
    $('#resetDateEnd').datetimepicker().on('dp.change',function(event){
        $('#rdate_end').val(event.date);
        calculatePrices();
    });
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

            if(prices.discount>0) {
                $('li.discounts').removeClass('hidden');
                $('.discount-label').html(prices.discount_detail);
                $('.discount-amount').html(prices.discount);
            }else{
                $('li.discounts').addClass('hidden');
            }

            $('.tax-label').html(prices.tax_detail);
            $('.tax-amount').html(prices.tax);

            $('.extra-label').html('Extras Price');
            $('.extra-amount').html(prices.extra_price_label);

            /*

            $("table.payment_detail> tbody tr:nth-child(2)").find('th').html('Price per day:<br/><small>'+prices.price_per_day_detail+'<small>');
            $("table.payment_detail> tbody tr:nth-child(2)").find('td').html(currencySign+' '+prices.price_per_day);

            $("table.payment_detail> tbody tr:nth-child(3)").find('th').html('Discount:<br/><small>'+prices.discount_detail+'<small>');
            $("table.payment_detail> tbody tr:nth-child(3)").find('td').html(currencySign+' '+prices.discount);


            $("table.payment_detail> tbody tr:nth-child(4)").find('th').html('Price per hour:<br/><small>'+prices.price_per_hour_detail+'<small>');
            $("table.payment_detail> tbody tr:nth-child(4)").find('td').html(currencySign+' '+prices.price_per_hour);


            $("table.payment_detail> tbody tr:nth-child(5)").find('th').html('Car rental fee:<br/><small>'+prices.car_rental_fee_detail+'<small>');
            $("table.payment_detail> tbody tr:nth-child(5)").find('td').html(currencySign+' '+prices.car_rental_fee);


            $("table.payment_detail> tbody tr:nth-child(6)").find('td').html(currencySign+' '+prices.extra_price);

            $("table.payment_detail> tbody tr:nth-child(7)").find('th').html('Insurance:<br/><small>'+prices.insurance_detail+'<small>');
            $("table.payment_detail> tbody tr:nth-child(7)").find('td').html(currencySign+' '+prices.insurance);

            $("table.payment_detail> tbody tr:nth-child(8)").find('td').html(currencySign+' '+prices.sub_total);

            $("table.payment_detail> tbody tr:nth-child(9)").find('th').html('Tax:<br/><small>'+prices.tax_detail+'<small>');
            $("table.payment_detail> tbody tr:nth-child(9)").find('td').html(currencySign+' '+prices.tax);

            $("table.payment_detail> tbody tr:nth-child(10)").find('td').html(currencySign+' '+prices.total_price);
            $("table.payment_detail> tbody tr:nth-child(11)").find('td').html(currencySign+' '+prices.required_deposit);
            */
            $.unblockUI();
        })
        .fail(function(response){
            $.unblockUI();
            $.each(response.responseJSON, function (key, value) {
                $.each(value, function (index, message) {
                    displayMessageAlert(message, 'danger', 'warning-sign');
                });
            });

//                    $('input#date_from').val('');
//                    $('input#date_to').val('');
        });
}

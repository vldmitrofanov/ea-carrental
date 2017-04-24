<?php

return [
    'company' => [
        'name' => 'Embassy Alliance Travel Sdn. Bhd.',
        'address' => 'Suite C-12-1, Wisma Goshen, Plaza Pantai, Jalan 4/83A, Off Jalan Pantai Bharu',
        'city' => 'Kuala Lumpur',
        'state' => '',
        'zip' => '59200',
        'country' => 'Malaysia',
        'phone' => '+(60) 322 874 722',
        'fax' => '+(60) 322 874 722',
        'email' => ''
    ],

    'transmission' => [
        'Manual' => 'M',
        'Automatic' => 'Automatic',
        'S' => 'Semi-automatic',
    ],

    'user_title' => [
        'Mr' => 'Mr',
        'Mrs' => 'Mrs',
        'Ms' => 'Ms',
        'Dr' => 'Dr',
        'Prof' => 'Prof',
        'Rev' => 'Rev',
        'Other' => 'Other',
    ],

    'cc_types' => [
        'Visa' => 'Visa',
        'MasterCard' => 'MasterCard',
        'Maestro' => 'Maestro',
        'AmericanExpress' => 'AmericanExpress',
    ],

    'week_days' => [
        '0' => 'Sunday',
        '1' => 'Monday',
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thursday',
        '5' => 'Friday',
        '6' => 'Saturday',
    ],

    'calculate_rental_fee' => [
        'perday' => 'Per day only',
        'perhour' => 'Per hour only',
        'both' => 'Per day and per hour',
    ],

    'deposit_type' => [
        'amount' => 'Amount',
        'percent' => 'Percent',
    ],

    'tax_type' => [
        'amount' => 'Amount',
        'percent' => 'Percent',
    ],
    'service_tax_type' => [
        'amount' => 'Amount',
        'percent' => 'Percent',
    ],

    'insurance_type' => [
        'amount' => 'Amount',
        'percent' => 'Percent',
    ],

    'booking_status' => [
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'cancelled' => 'Cancel',
    ],

    'payment_status' => [
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'cancelled' => 'Cancel',
    ],

    'payment_disable' => [
        '0' => 'No',
        '1' => 'Yes',
    ],
    
    'allow_cash' => [
        '0' => 'No',
        '1' => 'Yes',
    ],

    'email_confirmation' => [
        '1' => 'Yes',
        '0' => 'No',
    ],
    
    'discount_type' => [
        'amount' => 'Amount',
        'percent' => 'Percent',
    ],

    'recurrence_types' => [
        'none' => 'None',
        'daily' => 'Daily',
        'weekly' => 'Weekly',
        'monthly' => 'Monthly',
    ],

    'booking_duration_type' => [
        'days' => 'Days of Rental',
        'weeks' => 'Weeks of Rental',
        'month' => 'Month of Rental',
    ],
    
    'email_notification_types' => [
        'NewReservationCustomer' => 'New Reservation Email - Customer',
        'NewReservationAdmin' => 'New Reservation Email - Admin',
        'PaymentConfirmationCustomer' => 'Payment Confirmation Email - Customer',
        'PaymentConfirmationAdmin' => 'Payment Confirmation Email - Admin',
        'CancellationEmailCustomer' => 'Reservation Cancellation Email - Customer',
        'CancellationEmailAdmin' => 'Reservation Cancellation Email - Admin',
    ],
    
    'email_tags' => [
        '{notification:title}' => '{notification:title}',
        '{notification:name}' => '{notification:name}',
        '{notification:email}' => '{notification:email}',
        '{notification:phone}' => '{notification:phone}',
        '{notification:country}' => '{notification:country}',
        '{notification:city}' => '{notification:city}',
        '{notification:state}' => '{notification:state}',
        '{notification:zip}' => '{notification:zip}',
        '{notification:address}' => '{notification:address}',
        '{notification:company}' => '{notification:company}',
        '{notification:notes}' => '{notification:notes}',
        '{notification:v}' => '{notification:datefrom}',
        '{notification:dateto}' => '{notification:dateto}',
        '{notification:pickuplocation}' => '{notification:pickuplocation}',
        '{notification:returnlocation}' => '{notification:returnlocation}',
        '{notification:type}' => '{notification:type}',
        '{notification:extras}' => '{notification:extras}',
        '{notification:bookingid}' => '{notification:bookingid}',
        '{notification:deposit}' => '{notification:deposit}',
        '{notification:total}' => '{notification:total}',
        '{notification:tax}' => '{notification:tax}',
        '{notification:security}' => '{notification:security}',
        '{notification:insurance}' => '{notification:insurance}',
        '{notification:paymentmethod}' => '{notification:paymentmethod}',
        '{notification:cancelURL}' => '{notification:cancelURL}',
    ],
];

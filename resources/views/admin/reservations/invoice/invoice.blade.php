<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Reservation # {{ $oReservation->reservation_number  }} | Reservation Invoice</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body style="margin:0;background-color:#fefefe;">
    <div style="background-color:#fefefe;">
        <table bgcolor="#fff" width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #ddd;margin:0 auto;font-family: 'Source Sans Pro', 'Helvetica Neue',Helvetica,Arial,sans-serif;">
            <tr>
                <td>
                    <table width="100%" border="0" bgcolor="#fff" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="text-align:center; padding:5px 10px; background-color:#fff; border:2px solid #D3006C;"><img src="http://fingertipmail.com/car/images/logo.png" alt=""></td>
                            <td width="75%" valign="top" style="font-size:12px;text-align:right; padding:10px; background-color:#D3006C; color:#eee;border:2px solid #D3006C;border-left:0;">Date:{{ date('m-d-Y') }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="20">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="0" bgcolor="#fff" cellspacing="0" cellpadding="0" style=" font-size:14px;">
                        <tr>
                            <td width="33%" style="padding:5px 10px;">
                                From<br>
                                <strong>{{ config('settings.company.name')  }}</strong><br>
                                {{ config('settings.company.address')  }}<br>
                                {{ config('settings.company.zip')  }} {{ config('settings.company.city')  }}, {{ config('settings.company.country')  }}<br>
                                Phone: {{ config('settings.company.phone')  }}<br>
                                Fax: {{ config('settings.company.fax')  }}
                            </td>
                            <td width="33%" style="">
                                To<br>
                                <strong>{{ $oReservation->user->name }}</strong><br>
                                {{ $oReservation->user->address }}<br>
                                {{ $oReservation->user->city }}, {{ $oReservation->user->state }} {{ $oReservation->user->zip }}<br>
                                Phone: {{ $oReservation->user->phone }}<br>
                                Email: {{ $oReservation->user->email }}
                            </td>
                            <td width="33%" style="">
                                <strong>Order ID:</strong> {{ $oReservation->reservation_number }} <br> <br>
                                <strong>Payment Due:</strong> {{ $oReservation->details()->first()->date_to }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="20">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="0" bgcolor="#fff" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th style="text-align:left; padding:5px 10px;">S.No</th>
                                <th style="text-align:left; padding:5px 10px;">Car</th>
                                <th style="text-align:left; padding:5px 10px;">Registration No</th>
                                <th style="text-align:left; padding:5px 10px;">Date From - To</th>
                                <th style="text-align:left; padding:5px 10px;">Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($oReservation->details as $key=>$oDetail)
                            <tr>
                                <td style="text-align:left; padding:5px 10px; background-color:#e3c9d6;border-top:2px solid #d0b1c1;">{{ ++$key }}</td>
                                <td style="text-align:left; padding:5px 10px; background-color:#e3c9d6;border-top:2px solid #d0b1c1;">{{  $oDetail->car->make }} - {{  $oDetail->car->model }}</td></td>
                                <td style="text-align:left; padding:5px 10px; background-color:#e3c9d6;border-top:2px solid #d0b1c1;">{{  $oDetail->car->registration_number }}</td>
                                <td style="text-align:left; padding:5px 10px; background-color:#e3c9d6;border-top:2px solid #d0b1c1;">{{  $oDetail->date_from }} - {{  $oDetail->date_to }}</td>
                                <td style="text-align:left; padding:5px 10px; background-color:#e3c9d6;border-top:2px solid #d0b1c1;">{{  $oDetail->rental_days }} Days and {{  $oDetail->rental_hours }} Hours</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="20">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="0" bgcolor="#fff" cellspacing="0" cellpadding="0">
                        <tr>
                            <td valign="top" width="50%" style="text-align:left; padding:5px 10px; font-size:21px;">Amount Due: {{ $currency }} {{ $oReservation->details()->get()->sum('total_price') }}</td>
                            <td width="50%">
                                <table width="100%" border="0" bgcolor="#fff" cellspacing="0" cellpadding="0">
                                    @if($oReservation->details()->get()->sum('price_per_day')>0)
                                    <tr>
                                        <th style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">Price per day:</th>
                                        <td style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">{{ $currency }} {{ $oReservation->details()->get()->sum('price_per_day') }}</td>
                                    </tr>
                                    @endif
                                    @if($oReservation->details()->get()->sum('price_per_hour')>0)
                                    <tr>
                                        <th style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">Price per Hour:</th>
                                        <td style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">{{ $currency }} {{ $oReservation->details()->get()->sum('price_per_hour') }}</td>
                                    </tr>
                                    @endif
                                    @if($oReservation->details()->get()->sum('car_rental_fee')>0)
                                    <tr>
                                        <th style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">Car rental fee:</th>
                                        <td style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">{{ $currency }} {{ $oReservation->details()->get()->sum('car_rental_fee') }}</td>
                                    </tr>
                                    @endif
                                    @if($oReservation->details()->get()->sum('extra_price')>0)
                                    <tr>
                                        <th style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">Extras Price:</th>
                                        <td style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">{{ $currency }} {{ $oReservation->details()->get()->sum('extra_price') }}</td>
                                    </tr>
                                    @endif
                                    @if($oReservation->details()->get()->sum('insurance')>0)
                                    <tr>
                                        <th style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">Insurance:</th>
                                        <td style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">{{ $currency }} {{ $oReservation->details()->get()->sum('insurance') }}</td>
                                    </tr>
                                    @endif
                                    @if($oReservation->details()->get()->sum('sub_total')>0)
                                    <tr>
                                        <th style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">Sub-total:</th>
                                        <td style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">{{ $currency }} {{ $oReservation->details()->get()->sum('sub_total') }}</td>
                                    </tr>
                                    @endif
                                    @if($oReservation->details()->get()->sum('tax')>0)
                                    <tr>
                                        <th style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">Tax:</th>
                                        <td style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">{{ $currency }} {{ $oReservation->details()->get()->sum('tax') }}</td>
                                    </tr>
                                    @endif
                                    @if($oReservation->details()->get()->sum('total_price')>0)
                                    <tr>
                                        <th style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">Total Price:</th>
                                        <td style="text-align:left;border-top:1px solid #eee;padding:7px 10px; font-size:13px;">{{ $currency }} {{ $oReservation->details()->get()->sum('total_price') }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr>
                <td height="15">&nbsp;</td>
            </tr>
            
            <tr>
                <td height="20">&nbsp;</td>
            </tr>
        </table>
    </div>
</body>
    
</html>

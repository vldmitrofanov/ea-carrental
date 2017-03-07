<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reservation # {{ $oReservation->reservation_number  }} | Reservation Invoice</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('administration/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('administration/dist/css/AdminLTE.min.css') }}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="">
<div class="wrapper">

    <div class="content-wrapper" style="margin-left:0;background:none;">
        <section class="invoice">
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <img src="{{ asset('images/logo.png') }}">
                        <small class="pull-right">Date: {{ date('m-d-Y') }}</small>
                    </h2>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>{{ config('settings.company.name')  }}</strong><br>
                        {{ config('settings.company.address')  }}<br>
                        {{ config('settings.company.zip')  }} {{ config('settings.company.city')  }}, {{ config('settings.company.country')  }}<br>
                        Phone: {{ config('settings.company.phone')  }}<br>
                        Fax: {{ config('settings.company.fax')  }}
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong>{{ $oReservation->user->name }}</strong><br>
                        {{ $oReservation->user->address }}<br>
                        {{ $oReservation->user->city }}, {{ $oReservation->user->state }} {{ $oReservation->user->zip }}<br>
                        Phone: {{ $oReservation->user->phone }}<br>
                        Email: {{ $oReservation->user->email }}
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <b>Order ID:</b> {{ $oReservation->reservation_number }}<br><br/>
                    <b>Payment Due:</b> {{ $oReservation->details()->first()->date_to }}<br>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Car</th>
                            <th>Registration No</th>
                            <th>Date From - To</th>
                            <th>Duration</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($oReservation->details as $key=>$oDetail)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{  $oDetail->car->make }} - {{  $oDetail->car->model }}</td>
                            <td>{{  $oDetail->car->registration_number }}</td>
                            <td>{{  $oDetail->date_from }} - {{  $oDetail->date_to }}</td>
                            <td>{{  $oDetail->rental_days }} Days and {{  $oDetail->rental_hours }} Hours</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <p class="lead">Amount Due: &nbsp;{{ $currency }} {{ $oReservation->details()->get()->sum('total_price') }}</p>
                    <?php /*
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p> */ ?>
                </div>

                <div class="col-xs-6">
                    <div class="table-responsive">
                        <table class="table">
                            @if($oReservation->details()->get()->sum('price_per_day')>0)
                            <tr>
                                <th style="width:50%">Price per day:</th>
                                <td>{{ $currency }} {{ $oReservation->details()->get()->sum('price_per_day') }}</td>
                            </tr>
                            @endif
                            @if($oReservation->details()->get()->sum('price_per_hour')>0)
                            <tr>
                                <th>Price per hour:</th>
                                <td>{{ $currency }} {{ $oReservation->details()->get()->sum('price_per_hour') }}</td>
                            </tr>
                            @endif
                            @if($oReservation->details()->get()->sum('car_rental_fee')>0)
                            <tr>
                                <th>Car rental fee:</th>
                                <td>{{ $currency }} {{ $oReservation->details()->get()->sum('car_rental_fee') }}</td>
                            </tr>
                            @endif
                            @if($oReservation->details()->get()->sum('extra_price')>0)
                            <tr>
                                <th>Extras Price:</th>
                                <td>{{ $currency }} {{ $oReservation->details()->get()->sum('extra_price') }}</td>
                            </tr>
                            @endif
                            @if($oReservation->details()->get()->sum('insurance')>0)
                            <tr>
                                <th>Insurance:</th>
                                <td>{{ $currency }} {{ $oReservation->details()->get()->sum('insurance') }}</td>
                            </tr>
                            @endif
                            @if($oReservation->details()->get()->sum('sub_total')>0)
                            <tr>
                                <th>Sub-total:</th>
                                <td>{{ $currency }} {{ $oReservation->details()->get()->sum('sub_total') }}</td>
                            </tr>
                            @endif
                            @if($oReservation->details()->get()->sum('tax')>0)
                            <tr>
                                <th>Tax</th>
                                <td>{{ $currency }} {{ $oReservation->details()->get()->sum('tax') }}</td>
                            </tr>
                            @endif
                            @if($oReservation->details()->get()->sum('total_price')>0)
                            <tr>
                                <th>Total Price:</th>
                                <td>{{ $currency }} {{ $oReservation->details()->get()->sum('total_price') }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>

        </section>
        <div class="clearfix"></div>
    </div>

</div>

<script src="{{ asset('administration/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('administration/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>

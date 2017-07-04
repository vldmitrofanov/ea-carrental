@extends('frontend.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Embassy Alliance
@endsection

@section('content')
    @include('frontend.searchbar.search_by_location')
    @include('frontend.partials.errors.errors')

    @if($oCars->count()>0)
    @foreach($oCars as $oCar)
        <div class="searchCarList">
        <div class="container">
            <div class="row">
                <div class="col-sm-2 col-md-3">
                    <div class="thumbnail">
                        <a href="{{ url('fleet/'.$oCar->url_token) }}">
                            @if($oCar && Storage::has($oCar->thumb_image))
                                <img class="container img-responsive" src="{{Storage::url($oCar->thumb_image)}}" alt="{{$oCar->makeAndModel->make}} {{$oCar->makeAndModel->model}}">
                            @endif
                        </a>
                        @if($oCar->getCarPrice()['total_price_original'] > $oCar->getCarPrice()['total_price'])
                        <div class="offDeal">{{ $oCar->getCarPrice()['discount_information'] }}</div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4 col-md-5">
                    <h3>{{$oCar->makeAndModel->make}} {{$oCar->makeAndModel->model}}</h3>
                    <p>{{$oCar->makeAndModel->description}}</p>
                    <div class="theInfo"> <span class="theBlue"><img src="{{asset('template/images/1.png')}}" alt="">{{ $oCar->makeAndModel->total_passengers }}</span> <span class="theBlue"><img src="{{asset('template/images/2.png')}}" alt="">{{ $oCar->makeAndModel->total_bags }}</span> <span class="theBlue"><img src="{{asset('template/images/3.png')}}" alt="">{{ ($oCar->makeAndModel->SIPPCode->first())?$oCar->makeAndModel->SIPPCode->first()->vehicleDoors->description:null }}</span> <span class="theBlue"><img src="{{asset('template/images/4.png')}}" alt="">{{ ($oCar->makeAndModel->SIPPCode->first())?$oCar->makeAndModel->SIPPCode->first()->vehicleTransmissionAndDrive->description:null }}</span>
<!--                        <span class="theGreen"><img src="{{asset('template/images/6.png')}}" alt="">2 cars available for your dates</span> -->
                    </div>

                </div>
                <div class="col-sm-3 col-md-2 detailInfo">
                    <div class="grayBg">Daily Rate: {{$currency}} {{$oCar->makeAndModel->price_per_day}}</div>
                    <div class="">Weekly Rate: {{$currency}} {{$oCar->makeAndModel->price_per_day*7}} <span></span></div>
                    <div class="grayBg">Monthly Rate: {{$currency}} {{$oCar->makeAndModel->price_per_day*30}} <span></span></div>
                </div>
                <div class="col-sm-3 col-md-2 total text-center">
                    <h5>TOTAL PRICE:</h5>
                    @if($oCar->getCarPrice()['total_price_original'] > $oCar->getCarPrice()['total_price'])
                        <h6 class="cross">{{$currency}} {{ $oCar->getCarPrice()['total_price_original'] }}</h6>
                        <h6>{{$currency}} {{ $oCar->getCarPrice()['total_price'] }}</h6>
                    @else
                        <h6>{{$currency}} {{ $oCar->getCarPrice()['total_price'] }}</h6>
                    @endif
                    <div class="mt10"> <a class="btn text-uppercase have-radius btn-primary" href="{{ url('fleet/'.$oCar->url_token) }}">book this car</a> </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else
        <p class="lead text-center mb0">Sorry! All cars are reserved.</p>
        <p></p>
    @endif

    <div class="container">
        <div class="text-center">
            @if($oCars->render())
                <div class="box-footer clearfix">
                    {!! $oCars->render() !!}
                </div>
            @endif
        </div>
    </div>

    
@endsection

@section('javascript')

@endsection
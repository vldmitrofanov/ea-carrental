@extends('frontend.partials.layouts.master')
@section('meta-info')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    Embassy Alliance
@endsection

@section('content')
    @include('frontend.searchbar.search_bar')
    @include('frontend.partials.errors.errors')

    @foreach($oCars as $oCar)
        <div class="searchCarList">
        <div class="container">
            <div class="row">
                <div class="col-sm-2 col-md-3">
                    <div class="thumbnail">
                        <a href="form.html"><img src="{{asset($oCar->thumb_image)}}" alt="{{$oCar->makeAndModel->make}} {{$oCar->makeAndModel->model}}"></a>
                        <div class="offDeal">10% off</div>
                    </div>
                </div>
                <div class="col-sm-4 col-md-5">
                    <h3>{{$oCar->makeAndModel->make}} {{$oCar->makeAndModel->model}}</h3>
                    <p>{{$oCar->makeAndModel->description}}</p>
                    <div class="theInfo"> <span class="theBlue"><img src="{{asset('template/images/1.png')}}" alt="">2</span> <span class="theBlue"><img src="{{asset('template/images/2.png')}}" alt="">2</span> <span class="theBlue"><img src="{{asset('template/images/3.png')}}" alt="">2</span> <span class="theBlue"><img src="{{asset('template/images/4.png')}}" alt="">2</span> <span class="theGreen"><img src="{{asset('template/images/6.png')}}" alt="">2 cars available for your dates
</span> </div>

                </div>
                <div class="col-sm-3 col-md-2 detailInfo">
                    <div class="grayBg">Daily Rate: {{$currency}} {{$oCar->makeAndModel->price_per_day}}</div>
                    <div class="">Weekly Rate: {{$currency}} {{$oCar->makeAndModel->price_per_day*7}} <span>(Discount: 10%)</span></div>
                    <div class="grayBg">Monthly Rate: {{$currency}} {{$oCar->makeAndModel->price_per_day*30}} <span>(Discount 40%)</span></div>
                </div>
                <div class="col-sm-3 col-md-2 total text-center">
                    <h5>TOTAL PRICE:</h5>
                    <h6 class="cross">{{$currency}} 160</h6>
                    <h6>{{$currency}} 160</h6>
                    <div class="mt10"> <a class="btn text-uppercase have-radius btn-primary" href="#">book this car</a> </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    <div class="container">
        <div class="text-center">
            @if($oCars->render())
                <div class="box-footer clearfix">
                    {!! $oCars->render() !!}
                </div>
            @endif
            {{--<ul class="pagination pagination-lg">--}}
                {{--<li><a href="#">«</a></li>--}}
                {{--<li><a href="#">1</a></li>--}}
                {{--<li><a href="#">2</a></li>--}}
                {{--<li><a href="#">3</a></li>--}}
                {{--<li><a href="#">»</a></li>--}}
            {{--</ul>--}}
        </div>
    </div>

    
@endsection

@section('javascript')

@endsection
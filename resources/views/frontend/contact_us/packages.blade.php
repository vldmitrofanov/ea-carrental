@if($oDiscountVolumes->count()>0)
<h4>Our best car rental discounts and offers in Malaysia and singapore</h4>
<div class="row rentalPackages text-center text-uppercase">
    @foreach($oDiscountVolumes as $oDiscountVolume)
        <?php //print_r($oDiscountVolume);exit;?>
        <div class="col-md-4">
            <div class="theBox">
                <div class="theDiscount">{{Booking::formatDiscountVolumne($oDiscountVolume->discount_amount, $oDiscountVolume->discount_type)}}</div>
                <div class="theText">WHEN BOOKING <span class="text-danger">{{$oDiscountVolume->booking_duration}} {{$oDiscountVolume->booking_duration_type}}</span></div>
                <div class="thePluse"><i class="fa fa-plus"></i></div>
                <div class="theText">{!! $oDiscountVolume->description !!} </div> <a href="{{  url('/offers/'.str_slug($oDiscountVolume->name, '-').'-'.$oDiscountVolume->id) }}" role="button" class="btn btn-danger">Book Now</a> </div>
        </div>
        @endforeach
</div>
@endif
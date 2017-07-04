<div class="page-header text-center">
    <h2>Our Car Rental Fleet</h2> </div>
<div class="container">
    <div class="rentalFleet text-center">
        <div class="row">
            @foreach($oFeaturedCars as $oFeaturedCar)
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <div>
                        @if($oFeaturedCar && Storage::has($oFeaturedCar->thumb_image))
                            <img class="container img-responsive" src="{{Storage::url($oFeaturedCar->thumb_image)}}" alt="">
                        @endif
                    </div>
                    <div class="caption">
                        <h3>{{$oFeaturedCar->makeAndModel->make}}</h3> <a href="{{ url('fleet/'.$oFeaturedCar->url_token)  }}" class="btn btn-danger" role="button">View and Rent</a>
                        <div>
                            <span><i class="fa fa-car"></i>{{$oFeaturedCar->makeAndModel->model}}</span>
                            <span><i class="fa fa-car"></i>{{$oFeaturedCar->makeAndModel->SIPPCode->vehicleFuelAndAC->description}}</span>
                            <?php /*<span><i class="fa fa-car"></i>{{$oFeaturedCar->makeAndModel->SIPPCode->vehicleTransmissionAndDrive->description }}</span>*/ ?>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!--rentalFleet-->
    <div class="satisfiedCustomer">
        <div class="row">
            <div class="col-md-6">
                <div class="media">
                    <div class="media-left">
                        <a href="javascript:;"> <img class="media-object" src="{{asset('template/images/img_1.jpg')}}" alt=" "> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"></h4>
                        <p>Experienced Licenced Tour Operator in Malaysia &amp; Singapore</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="media">
                    <div class="media-left">
                        <a href="javascript:;"> <img class="media-object" src="{{asset('template/images/img_18.jpg')}}" alt=" "> </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">1024</h4>
                        <p>Satisfied Customers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--satisfiedCustomer-->
</div>
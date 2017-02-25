<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
        <li><a href="#rates" data-toggle="tab">Custom Rates</a></li>
    </ul>

    <div class="tab-content">

        <div id="details" class="tab-pane active">
            <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i> Update car type!</h4>
                Fill in the form below to add a new car type. Please, note that your clients view and book car types not a specific vehicle/car, so it's very important to fill in the specification details carefully. Under the 'Custom rates' tab you can specify custom seasonal prices based on period and length of reservation.
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-10">
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Type']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Type Description']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="price_per_day" class="col-sm-2 control-label">Price per day <img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="This is the default daily price for renting this car type. Later when you add the car type you can specify custom seasonal prices."></label>

                <div class="col-sm-10">
                {!! Form::text('price_per_day', null, ['class' => 'form-control', 'id' => 'price_per_day', 'placeholder' => 'Price per Day']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="price_per_hour" class="col-sm-2 control-label">Price per hour <img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="This is the default hourly price for renting this car type. Later when you add the car type you can specify custom seasonal prices."></label>
                <div class="col-sm-10">
                {!! Form::text('price_per_hour', null, ['class' => 'form-control', 'id' => 'price_per_hour', 'placeholder' => 'Price per hour']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="limit_mileage" class="col-sm-2 control-label">Limit mileage (per km) <img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="Set allowed daily mileage. Customers that extend this will be charged additional fee as per the amount you enter in the next box."></label>
                <div class="col-sm-10">
                {!! Form::text('limit_mileage', null, ['class' => 'form-control', 'id' => 'limit_mileage', 'placeholder' => 'Limit mileage']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="extra_mileage" class="col-sm-2 control-label">Price for extra mileage (per km) <img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="Set price for each km/mile over the allowed daily mileage limit."></label>
                <div class="col-sm-10">
                {!! Form::text('extra_mileage', null, ['class' => 'form-control', 'id' => 'extra_mileage', 'placeholder' => 'Price for extra mileage']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="total_passengers" class="col-sm-2 control-label">Num. of passengers</label>
                <div class="col-sm-10">
                {!! Form::text('total_passengers', null, ['class' => 'form-control', 'id' => 'total_passengers', 'placeholder' => 'Num. of passengers']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="total_bags" class="col-sm-2 control-label">Pieces of bags</label>
                <div class="col-sm-10">
                {!! Form::text('total_bags', null, ['class' => 'form-control', 'id' => 'total_bags', 'placeholder' => 'Pieces of bags']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="total_doors" class="col-sm-2 control-label">Number of doors</label>
                <div class="col-sm-10">
                {!! Form::text('total_doors', null, ['class' => 'form-control', 'id' => 'total_doors', 'placeholder' => 'Number of doors']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="transmission" class="col-sm-2 control-label">Transmission</label>
                <div class="col-sm-10">
                {!! Form::select('transmission', array('Manual'=>'Manual', 'Automatic'=>'Automatic', 'Semi-automatic'=>'Semi-automatic'),null,array('class'=>'form-control','id'=>'transmission')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="available_extras" class="col-sm-2 control-label">Available Extras</label>
                <div class="col-sm-10">
                {!! Form::select('available_extras[]', array(''=>'Please Select')+$oExtras,$oCarType->extras()->pluck('car_extras_id')->toArray(),array('class'=>'form-control', 'multiple'=>'true','id'=>'transmission')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputFile" class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                <input name="type_image" type="file">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </div>


        <div class="tab-pane" id="rates">
            <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i> Custom rates!</h4>
                You can define different prices based on reservation length and/or the time period of the reservation. Please make sure that periods for the same car type do not overlap. Depending on your Rental Settings you will be able to set prices per hour, per day or per hour and per day.
            </div>
            <table class="table table-bordered extra_rates">
                <thead>
                <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>Length</th>
                    <th>Price</th>
                    <th style="width: 40px"></th>
                </tr>
                </thead>

                <tbody>
                @foreach($oCarType->prices as $oPrice)
                    <tr id="{{  $oPrice->id }}">
                        <td><input class="form-control" name="date_from[{{ $oPrice->id  }}]" value="{{ $oPrice->date_from  }}" id="date_from{{  $oPrice->id }}" style="width:auto"
                                   type="text"></td>
                        <td><input class="form-control" name="date_to[{{ $oPrice->id  }}]" value="{{ $oPrice->date_to  }}" id="date_to{{  $oPrice->id }}" style="width:auto" type="text">
                        </td>
                        <td>From <input class="form-control" name="from[{{ $oPrice->id  }}]" value="{{  $oPrice->from }}" style="width:80px; display:inline" min="0"
                                        max="23" type="number">&nbsp;&nbsp;&nbsp;To&nbsp;<input class="form-control" value="{{  $oPrice->to }}"
                                                                                                name="to[{{ $oPrice->id  }}]"
                                                                                                style="width:80px; display:inline"
                                                                                                min="0" max="24"
                                                                                                type="number">&nbsp;&nbsp;&nbsp;<select
                                    class="form-control" name="price_per[{{ $oPrice->id  }}]" style="width:80px; display:inline">
                                <option value="hour" {{  ($oPrice->price_per=='hour')?'selected':'' }}>Hours</option>
                                <option value="day" {{  ($oPrice->price_per=='day')?'selected':'' }}>Days</option>
                            </select></td>
                        <td><input value="{{  $oPrice->price }}" class="form-control" name="price[{{ $oPrice->id  }}]" style="width:80px;display:inline" type="text">&nbsp;&nbsp;per&nbsp;<span
                                    id="price-type">{{  $oPrice->price_per }}</span></td>
                        <td><a href="javascript:;" class="remove-extra" data-id="{{  $oPrice->id }}"><i class="fa fa-trash"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-info btn-add-rate">Add +</button>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
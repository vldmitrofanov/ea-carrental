<div class="bannerCarSearch darkBg">
    <div>
        <div class="panel-body">
            {!! Form::open(array('url' => 'fleet/search', 'method' => 'post', 'class'=>'form-inline', 'name'=>'search', 'id'=>'search')) !!}
                <div class="form-group">
                    <label>Your Search:</label>
                </div>
                <div class="form-group">
                    <input required type='text' class="form-control date" id='start' name="start" placeholder="Start Date" /> </div>
                <div class="form-group">
                    <input required type='text' class="form-control date" id='end' name="end" placeholder="End Date" /> </div>
                <div class="form-group">
                    <select required class="form-control" name="location" id="location">
                        <option value="">Pick up address</option>
                        @foreach ($officeLocations as $officeLocation)
                            <option>{{$officeLocation->name}} {{$officeLocation->country->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary text-uppercase">Find Available Cars</button>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="greyBg">YOUR REQUESTED DURATION IS: {{$searchData->days}} DAYS &amp; {{$searchData->hours}} HOURS </div>
    </div>
</div>
<div class="bannerCarSearch darkBg">
    <div>
        <div class="panel-body">
            {!! Form::open(array('url' => 'fleet/search', 'method' => 'post', 'class'=>'form-inline', 'name'=>'search', 'id'=>'search')) !!}
            <h4>Search for available cars in Malaysia or Singapore</h4>
            <div class="form-group">
                <input required type='text' value="" class="form-control date" id='start' name="start" placeholder="Start Date" />
            </div>
            <div class="form-group">
                <input required type='text' value="" class="form-control date" id='end' name="end" placeholder="End Date" />
            </div>
            <div class="form-group">
                <select required class="form-control" name="location" id="location">
                    <option value="">Pick up address</option>
                    @foreach ($officeLocations as $officeLocation)
                        <option value="{{$officeLocation->id}}">{{$officeLocation->name}} {{$officeLocation->country->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary text-uppercase">Find Available Cars</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
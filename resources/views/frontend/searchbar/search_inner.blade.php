<div class="bannerCarSearch darkBg">
    <div>
        <div class="panel-body">
            <form class="form-inline" name="search" id="search" method="post">
                <div class="form-group">
                    <label>Your Search:</label>
                </div>
                <div class="form-group">
                    <input type='text' class="form-control date" id='from' name="from" placeholder="Start Date" /> </div>
                <div class="form-group">
                    <input type='text' class="form-control date" id='till' id="till" placeholder="End Date" /> </div>
                <div class="form-group">
                    <select class="form-control" name="pickup_location" id="pickup_location">
                        <option>Pick up address</option>
                        @foreach ($officeLocations as $officeLocation)
                        <option>{{$officeLocation->name}} {{$officeLocation->country->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary text-uppercase">Find Available Cars</button>
                </div>
            </form>
        </div>
    </div>
</div>
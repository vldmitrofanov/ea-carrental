
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
        <li><a href="#default_working_time" data-toggle="tab">Default Working Time</a></li>
        <li><a href="#custom_working_time" data-toggle="tab">Custom working time</a></li>
    </ul>

    <div class="tab-content">

        <div id="details" class="tab-pane active">
            <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i> Update Location!</h4>
                Update the office location data. If you change its address do not forget to replace it on the map. If you have multi language front-end, do not forget to translate the titles in all languages.
            </div>

            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Type']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-10">
                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) !!}
                </div>
                </div>
            </div>
            <div class="form-group">
                <label for="notify_email" class="col-sm-2 control-label">Email notifications <img  width="14" src="{{asset('images/help.png') }}" class="protip" data-pt-title="Send New reservation, Payment confirmation, and Reservation Cancellation email notifications to this email address."></label>
                <div class="col-sm-10">
                    <div class="">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" {{ ($oOfficeLocation->notify_email)?'checked':''  }} name="notify_email" id="notify_email"> Email notifications
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        {!! Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Phone']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="country_id" class="col-sm-2 control-label">Country</label>
                <div class="col-sm-10">
                    {!! Form::select('country_id', array(''=>'Please Select')+$oCountries,null,array('class'=>'form-control', 'id'=>'transmission')) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="state" class="col-sm-2 control-label">State</label>
                <div class="col-sm-10">
                    {!! Form::text('state', null, ['class' => 'form-control', 'id' => 'state', 'placeholder' => 'State']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-10">
                    {!! Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'City']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                    {!! Form::text('address', null, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Address']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="zip" class="col-sm-2 control-label">Zip</label>
                <div class="col-sm-10">
                    {!! Form::text('zip', null, ['class' => 'form-control', 'id' => 'zip', 'placeholder' => 'Zip']) !!}
                </div>
            </div>
            <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <button type="button" class="btn btn-info btn-map"><i class="fa fa-map-o"></i> Find on Map</button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lat" class="col-sm-2 control-label">Latitude</label>
                    <div class="col-sm-10">
                        {!! Form::text('lat', null, ['class' => 'form-control', 'id' => 'lat', 'placeholder' => 'Latitude']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label for="lng" class="col-sm-2 control-label">Longitude</label>
                    <div class="col-sm-10">
                        {!! Form::text('lng', null, ['class' => 'form-control', 'id' => 'lng', 'placeholder' => 'Longitude']) !!}
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
            <div class="col-md-6">   
                <div class="box box-solid bg-light-blue-gradient">
                <div class="box-body">
                  <div style="height: 300px; width: 100%;" id="world-map"></div>
                </div>
              </div>
            </div>

        </div>
        </div>

        <div class="tab-pane" id="default_working_time">
            <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i> Default Working Time!</h4>
                Here you can set working time for this location only. Different working time can be set for each day of the week. You can also set days off.
            </div>
            <table class="table table-bordered" >
                <thead>
                <tr>
                    <th>Day of week</th>
                    <th>Is Day off</th>
                    <th>Start time</th>
                    <th>End time</th>
                </tr>
                </thead>
                <tbody>
                <tr class="odd" data-day="monday">
                    <td>Monday</td>
                    <td class="align_center"><input class="working_day" {{ ($oOfficeLocation->workingTime && $oOfficeLocation->workingTime->monday_dayoff)?'checked':''  }} name="monday_dayoff" value="1" type="checkbox"></td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input name="monday_from" value="{{ ($oOfficeLocation->workingTime)?$oOfficeLocation->workingTime->monday_from:''  }}" id="monday_from" type="text" class="form-control timepicker" style="width: 165px;">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input name="monday_to" id="monday_to" value="{{ ($oOfficeLocation->workingTime)?$oOfficeLocation->workingTime->monday_to:''  }}" type="text" class="form-control timepicker" style="width: 165px;">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="even" data-day="tuesday">
                    <td>Tuesday</td>
                    <td class="align_center"><input class="working_day" {{ ($oOfficeLocation->workingTime && $oOfficeLocation->workingTime->tuesday_dayoff)?'checked':''  }} name="tuesday_dayoff" value="1" type="checkbox"></td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input name="tuesday_from" id="tuesday_from" value="{{ ($oOfficeLocation->workingTime)?$oOfficeLocation->workingTime->tuesday_from:''  }}" type="text" class="form-control timepicker" style="width: 165px;">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input name="tuesday_to" id="tuesday_to" value="{{ ($oOfficeLocation->workingTime)?$oOfficeLocation->workingTime->tuesday_to:''  }}" type="text" class="form-control timepicker" style="width: 165px;">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="odd" data-day="wednesday">
                    <td>Wednesday</td>
                    <td class="align_center"><input class="working_day" {{ ($oOfficeLocation->workingTime && $oOfficeLocation->workingTime->wednesday_dayoff)?'checked':''  }} name="wednesday_dayoff" value="1" type="checkbox"></td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input name="wednesday_from" id="wednesday_from" value="{{ ($oOfficeLocation->workingTime)?$oOfficeLocation->workingTime->wednesday_from:''  }}"  type="text" class="form-control timepicker" style="width: 165px;">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input name="wednesday_to" id="wednesday_to" value="{{ ($oOfficeLocation->workingTime)?$oOfficeLocation->workingTime->wednesday_to:''  }}"  type="text" class="form-control timepicker" style="width: 165px;">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="even" data-day="thursday">
                    <td>Thursday</td>
                    <td class="align_center"><input class="working_day" {{ ($oOfficeLocation->workingTime && $oOfficeLocation->workingTime->thursday_dayoff)?'checked':''  }}  name="thursday_dayoff" value="1" type="checkbox"></td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input name="thursday_from" id="thursday_from" value="{{ ($oOfficeLocation->workingTime)?$oOfficeLocation->workingTime->thursday_from:''  }}" type="text" class="form-control timepicker" style="width: 165px;">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input name="thursday_to" id="thursday_to" value="{{ ($oOfficeLocation->workingTime)?$oOfficeLocation->workingTime->thursday_to:'' }}" type="text" class="form-control timepicker" style="width: 165px;">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="odd" data-day="friday">
                    <td>Friday</td>
                    <td class="align_center"><input class="working_day" {{ ($oOfficeLocation->workingTime && $oOfficeLocation->workingTime->friday_dayoff)?'checked':''  }}  name="friday_dayoff" value="1" type="checkbox"></td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input name="friday_from" id="friday_from" type="text" value="{{ ($oOfficeLocation->workingTime)?$oOfficeLocation->workingTime->friday_from:''  }}" class="form-control timepicker" style="width: 165px;">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input name="friday_to" id="friday_to" type="text" value="{{ ($oOfficeLocation->workingTime)?$oOfficeLocation->workingTime->friday_to:''  }}" class="form-control timepicker" style="width: 165px;">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="even" data-day="saturday">
                    <td>Saturday</td>
                    <td class="align_center"><input class="working_day" {{ ($oOfficeLocation->workingTime && $oOfficeLocation->workingTime->saturday_dayoff)?'checked':''  }}  name="saturday_dayoff" value="1" type="checkbox"></td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input name="saturday_from" id="saturday_from" value="{{ ($oOfficeLocation->workingTime)?$oOfficeLocation->workingTime->saturday_from:''  }}" type="text" class="form-control timepicker" style="width: 165px;">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input name="saturday_to" id="saturday_to" value="{{ ($oOfficeLocation->workingTime)?$oOfficeLocation->workingTime->saturday_to:''  }}" type="text" class="form-control timepicker" style="width: 165px;">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="odd" data-day="sunday">
                    <td>Sunday</td>
                    <td class="align_center"><input class="working_day" {{ ($oOfficeLocation->workingTime && $oOfficeLocation->workingTime->sunday_dayoff)?'checked':''  }} name="sunday_dayoff" value="1" type="checkbox"></td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input name="sunday_from" id="sunday_from" value="{{ ($oOfficeLocation->workingTime)?$oOfficeLocation->workingTime->sunday_from:''  }}" type="text" class="form-control timepicker" style="width: 165px;">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                <input name="sunday_to" id="sunday_to" value="{{ ($oOfficeLocation->workingTime)?$oOfficeLocation->workingTime->sunday_to:'' }}" type="text" class="form-control timepicker" style="width: 165px;">
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="custom_working_time">
            <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-info"></i> Custom Working Time!</h4>
                Using the form below you can set a custom working time for any date for this location only. Just select a date and set working time for it. Or you can just mark the date as a day off.
            </div>

            <div class="form-group">
                <label for="work_date" class="col-sm-2 control-label">Date</label>
                <div class="col-sm-10">
                    {!! Form::text('work_date', null, ['class' => 'form-control', 'id' => 'work_date']) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="notify_email" class="col-sm-2 control-label">Is Day off</label>
                <div class="col-sm-10">
                    <div class="">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="is_dayoff" id="is_dayoff"> Is Day off
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="start_time" class="col-sm-2 control-label">Start time</label>
                <div class="col-sm-10">
                    <div class="bootstrap-timepicker">
                        <div class="input-group">
                            <input name="start_time" id="start_time"  type="text" class="form-control timepicker">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="end_time" class="col-sm-2 control-label">End time</label>
                <div class="col-sm-10">
                    <div class="bootstrap-timepicker">
                        <div class="input-group">
                            <input name="end_time" id="end_time"  type="text" class="form-control timepicker">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-primary btn-custom-time">Save Custom Time</button>
                </div>
            </div>
            <input type="hidden" name="custom_time" id="custom_time">
            <table class="table table-bordered custom_time" >
                <thead>
                <tr>
                    <th>
                        <div class="pj-table-sort-label">Date</div>
                    </th>
                    <th>
                        <div class="pj-table-sort-label">Start time</div>
                        </div>
                    </th>
                    <th>
                        <div class="pj-table-sort-label">End time</div>
                        </div>
                    </th>
                    <th>
                        <div class="pj-table-sort-label">Is Day off</div>
                        </div>
                    </th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($oOfficeLocation->customWorkingTimes as $oCustomTime)
                        <tr id="{{ $oCustomTime->id  }}">
                            <td>
                                {{ $oCustomTime->work_date  }}
                            </td>
                            <td>
                                {{ $oCustomTime->start_time  }}
                            </td>
                            <td>
                                {{ $oCustomTime->end_time  }}
                            </td>
                            <td>
                                {{ ($oCustomTime->is_dayoff)?"Yes":"No"  }}
                            </td>
                            <td>
                                <a href="javascript:;" class="edit-ctime" data-id="{{ $oCustomTime->id  }}" ><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                <a href="javascript:;" class="remove-ctime" data-id="{{ $oCustomTime->id  }}" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{!! Form::close() !!}


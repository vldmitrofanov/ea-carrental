@extends('admin.partials.layouts.master')

@section('title')
Fleet Availability Report
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Fleet Availability<small>Status Report</small></h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"></h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <select name="status" id="status" class="form-control pull-right">
                                        <option value="available" {{ ($q=='available')?'selected':'' }}>View Available Cars</option>
                                        <option value="reserved" {{ ($q=='reserved')?'selected':'' }}>View Reserved Cars</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Make/Model</th>
                                        <th>Registration No</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($oCars as $index =>$oCar)
                                    <tr>
                                        <td>{{$oCar->makeAndModel->make}}/{{$oCar->makeAndModel->model}}</td>
                                        <td>{{ $oCar->registration_number }}</td>
                                        <td>
                                            @if($q=='available')
                                                <span class="label label-success">Available</span>
                                            @else
                                                <span class="label label-danger">Reserved</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody> 
                            </table>
                        </div>
                        
                        @if($oCars->render())
                            <div class="box-footer clearfix">
                                {!! $oCars->render() !!}
                            </div>
                        @endif
                    </div>                    
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript')
<script>
$(function () {
    $( "#status" ).change(function(){
        window.location = ($(this).val()!='')?"?q="+$(this).val():'/admin/fleetavailability/report';
    });
});
</script>
@endsection
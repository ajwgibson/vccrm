
{{ Form::model($record, array('method' => 'PUT', 'route' => array('attendance_record.update', $record->id))) }}

<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="form-horizontal">

	<div class="form-group {{ $errors->has('project_id') ? 'has-error' : '' }}">
        {{ Form::label('project_id', 'Project', array ('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-4">
            {{ Form::select('project_id', $projects, $record->project_id, array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('contact_id') ? 'has-error' : '' }}">
        {{ Form::label('contact_id', 'Contact', array ('class' => 'col-sm-2 control-label')) }}
        <div class="col-sm-4">
            {{ Form::select('contact_id', $contacts, $record->contact_id, array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('attendance_date') ? 'has-error' : '' }}">
	    {{ Form::label(
	            'attendance_date', 
	            'Attendance date', 
	            array (
	                'class' => 'col-sm-2 control-label required',
	                'data-datepicker' => 'datepicker' )) }}
	    <div class="col-sm-2">
	        <div class="input-group date dp3" 
	                data-date="{{ empty($record->attendance_date) ? date('Y-m-d') : $record->attendance_date->format('Y-m-d') }}" 
	                data-date-format="yyyy-mm-dd">
	            {{ Form::text('attendance_date', empty($record->attendance_date) ? '' : $record->attendance_date->format('Y-m-d') , array ('class' => 'form-control')) }}
	            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	        </div>
	    </div>
	</div>

    <div class="form-group {{ $errors->has('hours') ? 'has-error' : '' }}">
        {{ Form::label('hours', 'Hours', array ('class' => 'col-sm-2 control-label required')) }}
        <div class="col-sm-1">
            {{ Form::text('hours', $record->hours, array ('class' => 'form-control')) }}
        </div>
        <p class="col-sm-offset-2 col-sm-10 help-block">You can enter this value as a whole number of hours or as a decimal fraction e.g. 1.5</p>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2">
            {{ Form::submit('Update this attendance record', array ('class' => 'btn btn-primary')) }} 
        </div>
    </div>

</div>

{{ Form::close() }}


@section('extra_js')

<script type="text/javascript">
    
    $('#project_id').select2();
    $('#contact_id').select2();
    
</script>

@endsection
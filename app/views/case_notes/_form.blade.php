<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="form-horizontal">

	<div class="form-group {{ $errors->has('project_id') ? 'has-error' : '' }}">
        {{ Form::label('project_id', 'Project', array ('class' => 'col-sm-2 control-label required')) }}
        <div class="col-sm-4">
            {{ Form::select(
            	'project_id', 
            	array ( '' => 'Select a project...') + $projects, 
            	$case_note->project_id, 
            	array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('volunteer') ? 'has-error' : '' }}">
        {{ Form::label('volunteer', 'Volunteer', array ('class' => 'col-sm-2 control-label required')) }}
        <div class="col-sm-4">
            {{ Form::text('volunteer', $case_note->volunteer, array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('conversation_date') ? 'has-error' : '' }}">
	    {{ Form::label(
	            'conversation_date', 
	            'Date', 
	            array (
	                'class' => 'col-sm-2 control-label required',
	                'data-datepicker' => 'datepicker' )) }}
	    <div class="col-sm-2">
	        <div class="input-group date dp3" 
	                data-date="{{ empty($case_note->conversation_date) ? date('Y-m-d') : $case_note->conversation_date->format('Y-m-d') }}" 
	                data-date-format="yyyy-mm-dd">
	            {{ Form::text('conversation_date', empty($case_note->conversation_date) ? '' : $case_note->conversation_date->format('Y-m-d') , array ('class' => 'form-control')) }}
	            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	        </div>
	    </div>
	</div>

    <div class="form-group {{ $errors->has('channel') ? 'has-error' : '' }}">
        {{ Form::label('channel', 'Method', array ('class' => 'col-sm-2 control-label required')) }}
        <div class="col-sm-4">
            {{ Form::select(
                'channel', 
                array ( 
                    'Phone call' => 'Phone call',
                    'Face to face' => 'Face to face',
                    'SMS' => 'SMS',
                    'Email' => 'Email',
                    'Other' => 'Other'),
                $case_note->channel, 
                array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('notes') ? 'has-error' : '' }}">
        {{ Form::label('notes', 'Notes', array ('class' => 'col-sm-2 control-label required')) }}
        <div class="col-sm-6">
            {{ Form::textarea('notes', $case_note->notes, array ('class' => 'form-control', 'rows' => '3')) }}
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            {{ Form::submit('Save case note', array ('class' => 'btn btn-primary')) }} 
        </div>
    </div>

</div>

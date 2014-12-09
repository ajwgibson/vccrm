<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="form-horizontal">

    <fieldset>
        
        <legend>Project details</legend>

    	<div class="form-group {{ $errors->has('project_id') ? 'has-error' : '' }}">
            {{ Form::label('project_id', 'Project', array ('class' => 'col-sm-2 control-label required')) }}
            <div class="col-sm-4">
                {{ Form::select(
                	'project_id', 
                	array ( '' => 'Select a project...') + $projects, 
                	$connection_card->project_id, 
                	array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('connection_date') ? 'has-error' : '' }}">
    	    {{ Form::label(
    	            'connection_date', 
    	            'Connection date', 
    	            array (
    	                'class' => 'col-sm-2 control-label required',
    	                'data-datepicker' => 'datepicker' )) }}
    	    <div class="col-sm-2">
    	        <div class="input-group date dp3" 
    	                data-date="{{ empty($connection_card->connection_date) ? date('Y-m-d') : $connection_card->connection_date->format('Y-m-d') }}" 
    	                data-date-format="yyyy-mm-dd">
    	            {{ Form::text('connection_date', empty($connection_card->connection_date) ? '' : $connection_card->connection_date->format('Y-m-d') , array ('class' => 'form-control')) }}
    	            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
    	        </div>
    	    </div>
    	</div>

    	<div class="form-group {{ $errors->has('volunteer') ? 'has-error' : '' }}">
            {{ Form::label('volunteer', 'Volunteer', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-4">
                {{ Form::text('volunteer', $connection_card->volunteer, array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('heard_about', 'How did the guest hear about the project?', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-6">
                {{ Form::textarea('heard_about', $connection_card->heard_about, array ('class' => 'form-control', 'rows' => '3')) }}
            </div>
        </div>

    </fieldset>

    <fieldset>
        
        <legend>Personal circumstances</legend>

        <div class="form-group">
            {{ Form::label('', 'Do any of these circumstances apply to the guest?', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                <label class="checkbox-inline">{{ Form::checkbox('low_income') }} Low income</label><br/>
    			<label class="checkbox-inline">{{ Form::checkbox('budgeting_problems') }} Budgeting problems</label><br/>
    			<label class="checkbox-inline">{{ Form::checkbox('mental_health') }} Mental health issues</label> <br/>
    			<label class="checkbox-inline">{{ Form::checkbox('addiction') }} Addiction</label><br/>
    			<label class="checkbox-inline">{{ Form::checkbox('isolation') }} Isolation</label><br/>
    			<label class="checkbox-inline">{{ Form::checkbox('unemployed') }} Unemployed</label><br/>
    			<label class="checkbox-inline">{{ Form::checkbox('long_term_illness') }} Long term illness</label><br/>
    			<label class="checkbox-inline">{{ Form::checkbox('benefit_issues') }} Benefit issues</label><br/>
    			<label class="checkbox-inline">{{ Form::checkbox('relationship_breakdown') }} Relationship breakdown</label>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('notes', 'Notes', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-6">
                {{ Form::textarea('notes', $connection_card->notes, array ('class' => 'form-control', 'rows' => '3')) }}
            </div>
        </div>

    </fieldset>

    <fieldset>
        
        <legend>Family circumstances</legend>

        <div class="form-group {{ $errors->has('marital_status') ? 'has-error' : '' }}">
            {{ Form::label('marital_status', 'Marital status', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-4">
                {{ Form::select(
                	'marital_status', 
                	array ( 
                		'' => 'Select a marital status...',
                		'Cohabiting' => 'Cohabiting',
                		'Divorced'   => 'Divorced',
                		'Engaged'    => 'Engaged',
                		'Married'    => 'Married',
                		'Separated'  => 'Separated',
                		'Single'     => 'Single',
            		), 
                	$connection_card->marital_status, 
                	array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('adults_in_household') ? 'has-error' : '' }}">
            {{ Form::label('adults_in_household', 'Adults in household', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-1">
                {{ Form::text('adults_in_household', $connection_card->adults_in_household, array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('children_in_household') ? 'has-error' : '' }}">
            {{ Form::label('children_in_household', 'Children in household', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-1">
                {{ Form::text('children_in_household', $connection_card->children_in_household, array ('class' => 'form-control')) }}
            </div>
        </div>
    
    </fieldset>

    <fieldset>
        
        <legend>Suggested next steps</legend>

        <div class="form-group {{ $errors->has('next_steps_1') ? 'has-error' : '' }}">
            {{ Form::label('next_steps_1', '#1', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-6">
                {{ Form::textarea('next_steps_1', $connection_card->next_steps_1, array ('class' => 'form-control', 'rows' => '2')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('next_steps_2') ? 'has-error' : '' }}">
            {{ Form::label('next_steps_2', '#2', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-6">
                {{ Form::textarea('next_steps_2', $connection_card->next_steps_2, array ('class' => 'form-control', 'rows' => '2')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('next_steps_3') ? 'has-error' : '' }}">
            {{ Form::label('next_steps_3', '#3', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-6">
                {{ Form::textarea('next_steps_3', $connection_card->next_steps_3, array ('class' => 'form-control', 'rows' => '2')) }}
            </div>
        </div>

    </fieldset>

    <fieldset>
        
        <legend>Additional contact information</legend>

        <div class="form-group">
            {{ Form::label('can_contact', 'Is it ok for Vineyard Compassion to contact this guest?', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-offset-2">
                <label class="checkbox-inline">{{ Form::radio('can_contact', true) }} Yes</label>
                <label class="checkbox-inline">{{ Form::radio('can_contact', false) }} No</label>
            </div>
        </div>

        <div class="form-group {{ $errors->has('best_telephone') ? 'has-error' : '' }}">
            {{ Form::label('best_telephone', 'Best contact number', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-2">
                {{ Form::text('best_telephone', $connection_card->best_telephone, array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('', 'Best contact time', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-10">
                <label class="checkbox-inline">{{ Form::checkbox('best_time_morning') }} Morning</label><br/>
                <label class="checkbox-inline">{{ Form::checkbox('best_time_afternoon') }} Afternoon</label><br/>
                <label class="checkbox-inline">{{ Form::checkbox('best_time_evening') }} Evening</label> <br/>
                <label class="checkbox-inline">{{ Form::checkbox('best_time_weekday') }} Monday - Friday</label><br/>
                <label class="checkbox-inline">{{ Form::checkbox('best_time_saturday') }} Saturday</label><br/>
                <label class="checkbox-inline">{{ Form::checkbox('best_time_any') }} Anytime</label><br/>
            </div>
        </div>

    </fieldset>

    <fieldset>
        
        <legend>Signature details</legend>

        <div class="form-group">
            {{ Form::label('card_signed', 'Did the guest sign the connection card?', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-offset-2">
                <label class="checkbox-inline">{{ Form::radio('card_signed', true) }} Yes</label>
                <label class="checkbox-inline">{{ Form::radio('card_signed', false) }} No</label>
            </div>
        </div>

        <div class="form-group {{ $errors->has('signed_date') ? 'has-error' : '' }}">
            {{ Form::label(
                    'signed_date', 
                    'Date of signature', 
                    array (
                        'class' => 'col-sm-2 control-label',
                        'data-datepicker' => 'datepicker' )) }}
            <div class="col-sm-2">
                <div class="input-group date dp3" 
                        data-date="{{ empty($connection_card->signed_date) ? date('Y-m-d') : $connection_card->signed_date->format('Y-m-d') }}" 
                        data-date-format="yyyy-mm-dd">
                    {{ Form::text('signed_date', empty($connection_card->signed_date) ? '' : $connection_card->signed_date->format('Y-m-d') , array ('class' => 'form-control')) }}
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>
        </div>

    </fieldset>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            {{ Form::submit('Save connection card', array ('class' => 'btn btn-primary')) }} 
        </div>
    </div>

</div>


<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="form-horizontal">

    <fieldset>
        
        <legend>Next of kin</legend>

        <div class="form-group {{ $errors->has('next_of_kin_name') ? 'has-error' : '' }}">
            {{ Form::label('next_of_kin_name', 'Name', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-4">
                {{ Form::text('next_of_kin_name', $volunteer_details->next_of_kin_name, array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('next_of_kin_telephone') ? 'has-error' : '' }}">
            {{ Form::label('next_of_kin_telephone', 'Telephone', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-4">
                {{ Form::text('next_of_kin_telephone', $volunteer_details->next_of_kin_telephone, array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('next_of_kin_relationship') ? 'has-error' : '' }}">
            {{ Form::label('next_of_kin_relationship', 'Relationship', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-4">
                {{ Form::text('next_of_kin_relationship', $volunteer_details->next_of_kin_relationship, array ('class' => 'form-control')) }}
            </div>
        </div>

    </fieldset>

    <fieldset>
        
        <legend>Contact in case of emergency</legend>

        <div class="form-group {{ $errors->has('emergency_name') ? 'has-error' : '' }}">
            {{ Form::label('emergency_name', 'Name', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-4">
                {{ Form::text('emergency_name', $volunteer_details->emergency_name, array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('emergency_telephone') ? 'has-error' : '' }}">
            {{ Form::label('emergency_telephone', 'Telephone', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-4">
                {{ Form::text('emergency_telephone', $volunteer_details->emergency_telephone, array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('emergency_relationship') ? 'has-error' : '' }}">
            {{ Form::label('emergency_relationship', 'Relationship', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-4">
                {{ Form::text('emergency_relationship', $volunteer_details->emergency_relationship, array ('class' => 'form-control')) }}
            </div>
        </div>

    </fieldset>
    
    <fieldset>
        
        <legend>Additional information</legend>

        <div class="form-group">
            {{ Form::label('health_issues', 'Any health issues or special needs that we should be aware of?', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-offset-2">
                <label class="checkbox-inline">{{ Form::radio('health_issues', true) }} Yes</label>
                <label class="checkbox-inline">{{ Form::radio('health_issues', false) }} No</label>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('health_issues_details', 'Details inc. medication:', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-6">
                {{ Form::textarea('health_issues_details', $volunteer_details->health_issues_details, array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('personal_development_notes', 'Any personal development requested, or other development info, reasons for volunteering:', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-6">
                {{ Form::textarea('personal_development_notes', $volunteer_details->personal_development_notes, array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('access_ni_required', 'Access NI (Police) check required?', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-offset-2">
                <label class="checkbox-inline">{{ Form::radio('access_ni_required', true) }} Yes</label>
                <label class="checkbox-inline">{{ Form::radio('access_ni_required', false) }} No</label>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('access_ni_received', 'Access NI (Police) check received?', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-offset-2">
                <label class="checkbox-inline">{{ Form::radio('access_ni_received', true) }} Yes</label>
                <label class="checkbox-inline">{{ Form::radio('access_ni_received', false) }} No</label>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('confidentiality', 'Confidentiality agreement signed?', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-offset-2">
                <label class="checkbox-inline">{{ Form::radio('confidentiality', true) }} Yes</label>
                <label class="checkbox-inline">{{ Form::radio('confidentiality', false) }} No</label>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('photographs', 'Photograph permission given?', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-offset-2">
                <label class="checkbox-inline">{{ Form::radio('photographs', true) }} Yes</label>
                <label class="checkbox-inline">{{ Form::radio('photographs', false) }} No</label>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('health_and_safety', 'Health and safety checklist completed for current location?', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-offset-2">
                <label class="checkbox-inline">{{ Form::radio('health_and_safety', true) }} Yes</label>
                <label class="checkbox-inline">{{ Form::radio('health_and_safety', false) }} No</label>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('safeguarding', 'Safeguarding training received?', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-offset-2">
                <label class="checkbox-inline">{{ Form::radio('safeguarding', true) }} Yes</label>
                <label class="checkbox-inline">{{ Form::radio('safeguarding', false) }} No</label>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('notes', 'Notes:', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-6">
                {{ Form::textarea('notes', $volunteer_details->notes, array ('class' => 'form-control')) }}
            </div>
        </div>

    </fieldset>

    <div class="form-group">
        <div class="col-sm-offset-2">
            {{ Form::submit($button, array ('class' => 'btn btn-primary')) }} 
        </div>
    </div>

</div>
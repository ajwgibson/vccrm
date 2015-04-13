
<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="form-horizontal">

    <fieldset>

        <legend>Contact name</legend>

        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
            {{ Form::label('first_name', 'First name', array ('class' => 'col-sm-2 control-label required')) }}
            <div class="col-sm-4">
                {{ Form::text('first_name', $contact->first_name, array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
            {{ Form::label('last_name', 'Last name', array ('class' => 'col-sm-2 control-label required')) }}
            <div class="col-sm-4">
                {{ Form::text('last_name', $contact->last_name, array ('class' => 'form-control')) }}
            </div>
        </div>

    </fieldset>

    <fieldset>
        
        <legend>Address</legend>

        <div class="form-group {{ $errors->has('address_line_1') ? 'has-error' : '' }}">
            {{ Form::label('address_line_1', 'Line 1', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-6">
                {{ Form::text('address_line_1', $contact->address_line_1, array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('address_line_2') ? 'has-error' : '' }}">
            {{ Form::label('address_line_2', 'Line 2', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-6">
                {{ Form::text('address_line_2', $contact->address_line_2, array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('address_town') ? 'has-error' : '' }}">
            {{ Form::label('address_town', 'Town', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-4">
                {{ Form::text('address_town', $contact->address_town, array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('address_postcode') ? 'has-error' : '' }}">
            {{ Form::label('address_postcode', 'Postcode', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-2">
                {{ Form::text('address_postcode', $contact->address_postcode, array ('class' => 'form-control')) }}
            </div>
        </div>

    </fieldset>

    <fieldset>
        
        <legend>Contact details</legend>

        <div class="form-group {{ $errors->has('telephone') ? 'has-error' : '' }}">
            {{ Form::label('telephone', 'Telephone number', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-2">
                {{ Form::text('telephone', $contact->telephone, array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('mobile') ? 'has-error' : '' }}">
            {{ Form::label('mobile', 'Mobile number', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-2">
                {{ Form::text('mobile', $contact->mobile, array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            {{ Form::label('email', 'Email', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-4">
                {{ Form::text('email', $contact->email, array ('class' => 'form-control')) }}
            </div>
        </div>

    </fieldset>

    <fieldset>
        
        <legend>Personal details</legend>

        <div class="form-group {{ $errors->has('date_of_birth') ? 'has-error' : '' }}">
            {{ Form::label(
                    'date_of_birth', 
                    'Date of birth', 
                    array (
                        'class' => 'col-sm-2 control-label',
                        'data-datepicker' => 'datepicker' )) }}
            <div class="col-sm-2">
                <div class="input-group date dp3" 
                        data-date="{{ empty($contact->date_of_birth) ? date('Y-m-d') : $contact->date_of_birth->format('Y-m-d') }}" 
                        data-date-format="yyyy-mm-dd" 
                        data-date-viewmode="years">
                    {{ Form::text('date_of_birth', empty($contact->date_of_birth) ? '' : $contact->date_of_birth->format('Y-m-d') , array ('class' => 'form-control')) }}
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>
        </div>

        <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
            {{ Form::label('gender', 'Gender', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-2">
                {{ Form::select('gender', array('Male' => 'Male', 'Female' => 'Female'), $contact->gender, array ('class' => 'form-control')) }}
            </div>
        </div>

    </fieldset>

    <fieldset>
        
        <legend>Additional information</legend>

        <div class="form-group">
            {{ Form::label('notes', 'Notes:', array ('class' => 'col-sm-2 control-label')) }}
            <div class="col-sm-6">
                {{ Form::textarea('notes', $contact->notes, array ('class' => 'form-control')) }}
            </div>
        </div>

    </fieldset>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-4">
            {{ Form::submit($button, array ('class' => 'btn btn-primary')) }} 
        </div>
    </div>

</div>
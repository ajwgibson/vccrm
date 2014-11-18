
<fieldset>
    <legend>Basic details</legend>
    
    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        {{ Form::label('email', 'Email', array ('class' => 'col-sm-3 control-label required')) }}
        <div class="col-sm-3">
            {{ Form::text('email', $user->email, array ('class' => 'form-control')) }}
        </div>
        <p class="col-sm-offset-3 col-sm-7 help-block">The email will be used as a username and needs to be unique.</p>
    </div>

    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
        {{ Form::label('first_name', 'First name', array ('class' => 'col-sm-3 control-label required')) }}
        <div class="col-sm-3">
            {{ Form::text('first_name', $user->first_name, array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
        {{ Form::label('last_name', 'Last name', array ('class' => 'col-sm-3 control-label required')) }}
        <div class="col-sm-3">
            {{ Form::text('last_name', $user->last_name, array ('class' => 'form-control')) }}
        </div>
    </div>

</fieldset>

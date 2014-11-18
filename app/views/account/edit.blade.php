
{{ Form::model($account, array('method' => 'POST', 'route' => 'account.update')) }}

<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="form-horizontal">

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        {{ Form::label('email', 'Email', array ('class' => 'col-sm-2 control-label required')) }}
        <div class="col-sm-6">
            {{ Form::text('email', $account->email, array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
        {{ Form::label('first_name', 'First name', array ('class' => 'col-sm-2 control-label required')) }}
        <div class="col-sm-6">
            {{ Form::text('first_name', $account->first_name, array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
        {{ Form::label('last_name', 'Last name', array ('class' => 'col-sm-2 control-label required')) }}
        <div class="col-sm-6">
            {{ Form::text('last_name', $account->last_name, array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="col-sm-offset-2 col-sm-4">
        {{ Form::submit('Save changes', array ('class' => 'btn btn-primary')) }} 
    </div>

</div>

{{ Form::close() }}

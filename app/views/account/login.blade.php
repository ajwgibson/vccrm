

{{ Form::open(array('action' => 'AccountController@postLogin')) }}

<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="form-horizontal">

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        {{ Form::label('email', 'Email', array ('class' => 'col-sm-2 control-label required')) }}
        <div class="col-sm-4">
            {{ Form::text('email', '', array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        {{ Form::label('password', 'Password', array ('class' => 'col-sm-2 control-label required')) }}
        <div class="col-sm-4">
            {{ Form::password('password', array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="col-sm-offset-2 col-sm-4">
        {{ Form::submit('Login', array ('class' => 'btn btn-primary')) }} 
    </div>

</div>

{{ Form::close() }}

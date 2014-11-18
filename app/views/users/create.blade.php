
{{ Form::open(array('route' => 'user.store')) }}

<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="form-horizontal">

    @include('users._form')

    <fieldset>
        <legend>Password</legend>

        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            {{ Form::label('password', 'Password', array ('class' => 'col-sm-3 control-label required')) }}
            <div class="col-sm-3">
                {{ Form::password('password', array ('class' => 'form-control')) }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
            {{ Form::label('password_confirmation', 'Confirm password', array ('class' => 'col-sm-3 control-label required')) }}
            <div class="col-sm-3">
                {{ Form::password('password_confirmation', array ('class' => 'form-control')) }}
            </div>
        </div>

    </fieldset>

    @include('users._permissions')

    <div class="col-sm-offset-3">
        
        {{ Form::submit('Create user', array ('class' => 'btn btn-primary')) }} 

        {{ link_to_route(
            'user.index', 
            'Go back', 
            $parameters = array( ), 
            $attributes = array( 'class' => 'btn btn-default')) }}
           
    </div>

</div>

{{ Form::close() }}

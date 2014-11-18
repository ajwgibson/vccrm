
{{ Form::model($user, array('route' => array('user.updatePassword', $user->id))) }}

<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="form-horizontal">

    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        {{ Form::label('password', 'Password', array ('class' => 'col-sm-2 control-label required')) }}
        <div class="col-sm-4">
            {{ Form::password('password', array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
        {{ Form::label('password_confirmation', 'Confirm password', array ('class' => 'col-sm-2 control-label required')) }}
        <div class="col-sm-4">
            {{ Form::password('password_confirmation', array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="col-sm-offset-2">
        
        {{ Form::submit('Change password', array ('class' => 'btn btn-primary')) }} 

        {{ link_to_route(
            'user.show', 
            'Go back', 
            $parameters = array( 'id' => $user->id ), 
            $attributes = array( 'class' => 'btn btn-default')) }}
           
    </div>

</div>

{{ Form::close() }}


{{ Form::open(array('route' => 'account.updatePassword')) }}

<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="form-horizontal">

    <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
        {{ Form::label('current_password', 'Current password', array ('class' => 'col-sm-3 control-label required')) }}
        <div class="col-sm-4">
            {{ Form::password('current_password', array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
        {{ Form::label('new_password', 'New password', array ('class' => 'col-sm-3 control-label required')) }}
        <div class="col-sm-4">
            {{ Form::password('new_password', array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="form-group {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
        {{ Form::label('new_password_confirmation', 'Confirm new password', array ('class' => 'col-sm-3 control-label required')) }}
        <div class="col-sm-4">
            {{ Form::password('new_password_confirmation', array ('class' => 'form-control')) }}
        </div>
    </div>

    <div class="col-sm-offset-3">
        
        {{ Form::submit('Change password', array ('class' => 'btn btn-primary')) }} 

        {{ link_to_route(
            'home', 
            'Cancel', 
            $parameters = array(  ), 
            $attributes = array( 'class' => 'btn btn-default')) }}
           
    </div>

</div>

{{ Form::close() }}

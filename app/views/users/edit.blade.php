
{{ Form::model($user, array('method' => 'PUT', 'route' => array('user.update', $user->id))) }}

<p class="required-warning">Required fields are marked with an asterisk.</p>

<div class="form-horizontal">
        
    @include('users._form')

    @include('users._permissions')

    <div class="col-sm-offset-3">
        
        {{ Form::submit('Update user', array ('class' => 'btn btn-primary')) }} 

        {{ link_to_route(
            'user.show', 
            'Go back', 
            $parameters = array( 'id' => $user->id ), 
            $attributes = array( 'class' => 'btn btn-default')) }}
           
    </div>

</div>

{{ Form::close() }}

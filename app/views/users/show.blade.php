
<div class="col-sm-8">
    <dl class="dl-horizontal">
        
        <dt>Email</dt>
        <dd>{{{ $user->email }}}</dd>

        <dt>First name</dt>
        <dd>{{{ $user->first_name }}}</dd>

        <dt>Last name</dt>
        <dd>{{{ $user->last_name }}}</dd>

        <dt>Superuser</dt>
        <dd>{{{ $user->isSuperUser() ? "Yes" : "No" }}}</dd>
        
        <dt>User Administrator</dt>
        <dd>{{{ $user->inGroup($user_administration) ? "Yes" : "No" }}}</dd>

        <dt>Project Administrator</dt>
        <dd>{{{ $user->inGroup($project_administration) ? "Yes" : "No" }}}</dd>

        <dt>Contact Administrator</dt>
        <dd>{{{ $user->inGroup($contact_administration) ? "Yes" : "No" }}}</dd>

        <dt>Attendance Administrator</dt>
        <dd>{{{ $user->inGroup($attendance_administration) ? "Yes" : "No" }}}</dd>

    </dl>
</div>

<div class="col-sm-4">

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('user.destroy', $user->id),
            'class' => 'delete' ) ) }}

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'user.index', 
            'Go back',
            $parameters = array(),
            $attributes = array( 'class' => 'btn btn-default' )) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'user.edit', 
            'Edit this user', 
            $parameters = array( 'id' => $user->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'user.editPassword', 
            'Change this user\'s password', 
            $parameters = array( 'id' => $user->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ Form::button(
            'Delete this user', 
            array(
                'class' => 'btn btn-danger',
                'data-toggle' => 'modal',
                'data-target' => '#modal' )) }}
    </div>

    {{ Form::close() }}

</div>

<div id="modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p class="text-danger" style="font-size: 2em;">
            <span class="glyphicon glyphicon-warning-sign"></span> Warning</p>
        <p>
            You are about to delete the user with email <strong>"{{{ $user->email }}}"</strong>
            from the system.
            <br/>
            <br/>
            Are you sure you want to continue?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No, cancel</button>
        <button type="button" id="continue" class="btn btn-danger">Yes, continue</button>
      </div>
    </div>
  </div>
</div>


@section('extra_js')

<script type="text/javascript">
    
    $('#continue').click(function() {
        $('form.delete').submit();
    });
    
</script>

@stop

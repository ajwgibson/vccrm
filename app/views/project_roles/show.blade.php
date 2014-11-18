<div class="col-sm-6">
    <dl class="dl-horizontal">
        
        <dt>Role name</dt>
        <dd>{{{ $role->name }}}</dd>

        <dt>Typical attendance</dt>
        <dd>{{{ number_format($role->hours, 2) . ' hrs' }}}</dd>

        <dt>Volunteer role?</dt>
        <dd>{{{ $role->volunteer ? 'Yes' : 'No' }}}</dd>

    </dl>
</div>

<div class="col-sm-6">

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('project_role.destroy', $role->id),
            'class' => 'delete' ) ) }}

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'project.show', 
            'Go back',
            $parameters = array($role->project->id),
            $attributes = array( 'class' => 'btn btn-default' )) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'project_role.edit', 
            'Edit this role', 
            $parameters = array( 'id' => $role->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ Form::button(
            'Delete this role', 
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
            <span class="glyphicon glyphicon-warning-sign"></span> Warning
        </p>
        <p>
            You are about to delete the <strong>"{{{ $role->name }}}"</strong> role
            from the "{{{ $role->project->name }}}" project. This will not delete any
            attendance records that were created using this role.
            <br/> 
            <br/> 
            <strong>This action cannot be undone.</strong>
            <br/>
            <br/>
            Are you sure you want to continue?
        </p>
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

@endsection
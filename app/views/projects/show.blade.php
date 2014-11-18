
<div class="col-sm-6">
    <dl class="dl-horizontal">
        
        <dt>Project name</dt>
        <dd>{{{ $project->name }}}</dd>

        <dt>Project leader</dt>
        <dd>{{{ $project->leader }}}</dd>

    </dl>
</div>

<div class="col-sm-6">

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('project.destroy', $project->id),
            'class' => 'delete' ) ) }}

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'project.index', 
            'Go back',
            $parameters = array(),
            $attributes = array( 'class' => 'btn btn-default' )) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'project.edit', 
            'Edit this project', 
            $parameters = array( 'id' => $project->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ Form::button(
            'Delete this project', 
            array(
                'class' => 'btn btn-danger',
                'data-toggle' => 'modal',
                'data-target' => '#modal' )) }}
    </div>

    {{ Form::close() }}

</div>

<div class="col-sm-12">
    <h2>Roles</h2>
    
    <div>
        {{ link_to_route(
                'project_role.create', 
                'Add a new role', 
                array($project->id), 
                array('class' => 'btn btn-primary')) }}
    </div>

    <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Typical attendance</th>
                <th>Volunteer?</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($project->roles->sortBy('name') as $role)
                <tr>
                    <td>{{{ $role->name }}}</td>
                    <td>{{{ number_format($role->hours, 2) . ' hrs' }}}</td>
                    <td>{{{ $role->volunteer ? 'Yes' : 'No' }}}</td>
                    <td>
                        {{ link_to_route(
                            'project_role.show', 
                            'View details', 
                            array($role->id), 
                            array('class' => '')) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div id="modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p class="text-danger" style="font-size: 2em;">
            <span class="glyphicon glyphicon-warning-sign"></span> Warning
        </p>
        <p>
            You are about to delete the <strong>"{{{ $project->name }}}"</strong> project.
            This action will also remove any attendance records associated with the
            project. <strong>This action cannot be undone.</strong>
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
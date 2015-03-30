
<div class="col-sm-6">
    <dl class="dl-horizontal">
        
        <dt>Project name</dt>
        <dd>{{{ $project->name }}}</dd>

        <dt>Project leader</dt>
        <dd>{{{ $project->leader }}}</dd>

    </dl>
</div>

<div class="col-sm-6 hidden-print">

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
    
    <div class="hidden-print">
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
                <th class="hidden-print"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($project->roles->sortBy('name') as $role)
                <tr>
                    <td>{{{ $role->name }}}</td>
                    <td>{{{ number_format($role->hours, 2) . ' hrs' }}}</td>
                    <td>{{{ $role->volunteer ? 'Yes' : 'No' }}}</td>
                    <td class="hidden-print">
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


<div class="col-sm-12">

    <h2>Volunteers</h2>
    
    @if ($volunteer_records)
        <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Volunteer</th>
                <th>Telephone</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Hours</th>
                <th>Start Date</th>
                <th>Finish Date</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($volunteer_records as $volunteer)
            <tr>
                <td>
                    @if (!($volunteer->volunteer_details_id))
                    <span 
                        class="glyphicon glyphicon-info-sign text-danger" 
                        data-toggle="tooltip" data-placement="auto left" title="This contact does not appear to have completed a volunteer details form."></span>
                    @endif
                    {{ link_to_route(
                        'contact.show', 
                        "$volunteer->first_name $volunteer->last_name", 
                        $parameters = array( 'id' => $volunteer->id), 
                        $attributes = array( 'class' => '')) }}
                </td>
                <td>{{{ $volunteer->telephone }}}</td>
                <td>{{{ $volunteer->mobile }}}</td>
                <td>{{{ $volunteer->email }}}</td>
                <td>{{{ number_format($volunteer->hours, 2) . ' hrs' }}}</td>
                <td>{{{ $volunteer->start_date }}}</td>
                <td>{{{ $volunteer->finish_date }}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p><i>There are no volunteering records for this project.</i></p>
    @endif

</div>


<div class="col-sm-12">

    <h2>Guests</h2>
    
    @if ($guest_records)
        <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Guest</th>
                <th>Hours</th>
                <th>Start Date</th>
                <th>Finish Date</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($guest_records as $guest)
            <tr>
                <td>
                    {{ link_to_route(
                        'contact.show', 
                        "$guest->first_name $guest->last_name", 
                        $parameters = array( 'id' => $guest->id), 
                        $attributes = array( 'class' => '')) }}
                </td>
                <td>{{{ number_format($guest->hours, 2) . ' hrs' }}}</td>
                <td>{{{ $guest->start_date }}}</td>
                <td>{{{ $guest->finish_date }}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p><i>There are no guest records for this project.</i></p>
    @endif

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

    $('[data-toggle="tooltip"]').tooltip()
    
</script>

@endsection
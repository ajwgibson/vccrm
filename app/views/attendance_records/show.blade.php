
<div class="col-sm-6">
    <dl class="dl-horizontal">
        
        <dt>Project</dt>
        <dd>{{{ $record->project->name }}}</dd>

        <dt>Contact</dt>
        <dd>{{{ $record->contact->Name }}}</dd>

        <dt>Attendance date</dt>
        <dd>{{{ $record->attendance_date->format('Y-m-d') }}}</dd>

        <dt>Hours</dt>
        <dd>{{{ number_format($record->hours, 2) . ' hrs' }}}</dd>

        <dt>Role</dt>
        <dd>{{{ $record->role }}}&nbsp;</dd>

        <dt>Volunteer?</dt>
        <dd>{{{ $record->volunteer ? 'Yes' : 'No' }}}</dd>

    </dl>
</div>

<div class="col-sm-6">

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('attendance_record.destroy', $record->id),
            'class' => 'delete' ) ) }}

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'attendance_record.index', 
            'Go back',
            $parameters = array(),
            $attributes = array( 'class' => 'btn btn-default' )) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'attendance_record.edit', 
            'Edit this attendance record', 
            $parameters = array( 'id' => $record->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ Form::button(
            'Delete this attendance record', 
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
            You are about to delete this attendance record. <strong>This action cannot be undone.</strong>
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
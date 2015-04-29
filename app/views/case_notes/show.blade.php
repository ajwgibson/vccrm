
<div class="col-sm-6">
    <dl class="dl-horizontal">

        <dt>Project</dt>
        <dd>{{{ $case_note->project->name }}}&nbsp;</dd>

        <dt>Volunteer</dt>
        <dd>{{{ $case_note->volunteer }}}&nbsp;</dd>

        <dt>Date</dt>
        <dd>{{{ $case_note->conversation_date->format('Y-m-d') }}}&nbsp;</dd>
        
        <dt>Method</dt>
        <dd>{{{ $case_note->channel }}}&nbsp;</dd>

        <dt>Notes</dt>
        <dd>{{{ $case_note->notes }}}&nbsp;</dd>

    </dl>

</div>

<div class="col-sm-6">

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('case_note.destroy', $case_note->id),
            'class' => 'delete' ) ) }}

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'contact.show', 
            'Back to contact', 
            $parameters = array( 'id' => $case_note->contact_id), 
            $attributes = array( 'class' => 'btn btn-default')) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'case_note.edit', 
            'Edit this case note', 
            $parameters = array( 'id' => $case_note->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ Form::button(
            'Delete this case note', 
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
            You are about to delete this case note. <strong>This action cannot be undone.</strong>
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
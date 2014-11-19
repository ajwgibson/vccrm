
<div class="col-sm-6">
    <dl class="dl-horizontal">

        <dt>First name</dt>
        <dd>{{{ $contact->first_name }}} &nbsp;</dd>

        <dt>Last name</dt>
        <dd>{{{ $contact->last_name }}} &nbsp;</dd>

        <dt>Address</dt>
        <dd>
            {{{ $contact->address_line_1 }}}<br>
            {{{ $contact->address_line_2 }}}<br>
            {{{ $contact->address_town }}}  <br>
            {{{ $contact->address_postcode }}} 
            &nbsp;
        </dd>

        <dt>Telephone number</dt>
        <dd>{{{ $contact->telephone }}} &nbsp;</dd>

        <dt>Mobile number</dt>
        <dd>{{{ $contact->mobile }}} &nbsp;</dd>

        <dt>Email</dt>
        <dd>{{{ $contact->email }}} &nbsp;</dd>

        <dt>Date of birth</dt>
        <dd>{{{ $contact->date_of_birth ? $contact->date_of_birth->format('Y-m-d') : '' }}} &nbsp;</dd>

        <dt>Gender</dt>
        <dd>{{{ $contact->gender }}} &nbsp;</dd> 

        <dt>Notes</dt>
        <dd>{{{ $contact->notes }}} &nbsp;</dd>

    </dl>
</div>

<div class="col-sm-6">

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('contact.destroy', $contact->id),
            'class' => 'delete' ) ) }}

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'contact.index', 
            'Go back',
            $parameters = array(),
            $attributes = array( 'class' => 'btn btn-default' )) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'contact.edit', 
            'Edit this contact', 
            $parameters = array( 'id' => $contact->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ Form::button(
            'Delete this contact', 
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
            You are about to delete a contact called <strong>"{{{ $contact->first_name }}} {{{ $contact->last_name }}}"</strong>
            from the system. This will also delete the contact's attendance records.
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

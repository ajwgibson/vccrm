
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
        <dd>{{{ $contact->date_of_birth ? 
                    "{$contact->date_of_birth->format('Y-m-d')} ({$contact->age})" : '' }}} &nbsp;</dd>

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

<div class="col-sm-12">
    
    <h3>Volunteer details</h3>

@if ($contact->volunteer_details)

    <div class="row">
        <div class="col-sm-6 show-label">Next of kin</div>
        <div class="col-sm-6 show-value">
            {{{ $contact->volunteer_details->next_of_kin_name }}} <br>
            {{{ $contact->volunteer_details->next_of_kin_telephone }}} <br>
            {{{ $contact->volunteer_details->next_of_kin_relationship }}} 
            &nbsp;
        </div>  
    </div>

    <div class="row">
        <div class="col-sm-6 show-label">Contact in case of emergency</div>
        <div class="col-sm-6 show-value">
            {{{ $contact->volunteer_details->emergency_name }}} <br>
            {{{ $contact->volunteer_details->emergency_telephone  }}} <br>
            {{{ $contact->volunteer_details->emergency_relationship }}} 
            &nbsp;
        </div>  
    </div>

    <div class="row">
        <div class="col-sm-6 show-label">Health issues?</div>
        <div class="col-sm-6 show-value">
            {{{ $contact->volunteer_details->health_issues ? 'Yes' : 'No' }}} <br>
            {{{ $contact->volunteer_details->health_issues_details }}} 
            &nbsp;
        </div>
    </div>        

    <div class="row">
        <div class="col-sm-6 show-label">Personal development, reasons for volunteering</div>
        <div class="col-sm-6 show-value">
            {{{ $contact->volunteer_details->personal_development_notes }}} &nbsp;
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-6 show-label">Access NI required?</div>
        <div class="col-sm-6 show-value">
            {{{ $contact->volunteer_details->access_ni_required ? 'Yes' : 'No' }}} &nbsp; 
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-6 show-label">Access NI received?</div>
        <div class="col-sm-6 show-value">
            {{{ $contact->volunteer_details->access_ni_received ? 'Yes' : 'No' }}} &nbsp; 
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-6 show-label">Confidentiality agreement signed?</div>
        <div class="col-sm-6 show-value">
            {{{ $contact->volunteer_details->confidentiality ? 'Yes' : 'No' }}} &nbsp;
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-6 show-label">Photograph permission given?</div>
        <div class="col-sm-6 show-value">
            {{{ $contact->volunteer_details->photographs ? 'Yes' : 'No' }}} &nbsp; 
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-6 show-label">Health and safety checklist completed for current location?</div>
        <div class="col-sm-6 show-value">
            {{{ $contact->volunteer_details->health_and_safety ? 'Yes' : 'No' }}} &nbsp;
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-6 show-label">Safeguarding training received?</div>
        <div class="col-sm-6 show-value">
            {{{ $contact->volunteer_details->safeguarding ? 'Yes' : 'No' }}} &nbsp;
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-6 show-label">Notes</div>
        <div class="col-sm-6 show-value">
            {{{ $contact->volunteer_details->notes }}} &nbsp;
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-6">
            {{ Form::open(
                array(
                    'method' => 'DELETE', 
                    'route'  => array('volunteer_details.destroy', $contact->volunteer_details->id),
                    'id'     => 'delete_details' ) ) }}

            {{ link_to_route(
                'volunteer_details.edit', 
                'Edit volunteer details', 
                $parameters = array( 'id' => $contact->volunteer_details->id), 
                $attributes = array( 'class' => 'btn btn-primary btn-sm')) }}

            {{ Form::button(
                'Delete volunteer details', 
                array(
                    'class' => 'btn btn-danger btn-sm',
                    'data-toggle' => 'modal',
                    'data-target' => '#modal-details' )) }}
            
            {{ Form::close() }}

        </div>
    </div>
    
@else
    <div class="row">
        <div class="col-sm-6">
            {{ link_to_route(
                'volunteer_details.create', 
                'Add volunteer details', 
                $parameters = array( 'id' => $contact->id), 
                $attributes = array( 'class' => 'btn btn-primary btn-sm')) }}
        </div>
    </div>
@endif
</div>


<div class="col-sm-12">
    
    <h3>Guest connection cards</h3>

@if ($contact->connection_cards->count() > 0)

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Project</th>
                <th>Connection date</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($contact->connection_cards as $connection_card)
            <tr>
                <td>{{{ $connection_card->project->name }}}</td>
                <td>{{{ $connection_card->connection_date ? $connection_card->connection_date->format('Y-m-d') : '' }}}</td>
                <td>{{ link_to_route(
                        'connection_card.show', 
                        'Show details', 
                        $parameters = array( 'id' => $connection_card->id), 
                        $attributes = array( 'class' => '')) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endif

    <div class="row">
        <div class="col-sm-6">
            {{ link_to_route(
                'connection_card.create', 
                'Add a guest connection card', 
                $parameters = array( 'id' => $contact->id), 
                $attributes = array( 'class' => 'btn btn-primary btn-sm')) }}
        </div>
    </div>


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

<div id="modal-details" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p class="text-danger" style="font-size: 2em;">
            <span class="glyphicon glyphicon-warning-sign"></span> Warning</p>
        <p>
            You are about to delete <strong>"{{{ $contact->name }}}'s"</strong> volunteer details.
            <br/>
            <br/>
            Are you sure you want to continue?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No, cancel</button>
        <button type="button" id="continue-details" class="btn btn-danger">Yes, continue</button>
      </div>
    </div>
  </div>
</div>


@section('extra_js')

<script type="text/javascript">
    
    $('#continue').click(function() {
        $('form.delete').submit();
    });

    $('#continue-details').click(function() {
        $('form#delete_details').submit();
    });
    
</script>

@stop

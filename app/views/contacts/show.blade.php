
<div class="col-sm-9">
    <dl class="dl-horizontal">

        <dt>First name</dt>
        <dd>{{{ $contact->first_name }}} &nbsp;</dd>

        <dt>Last name</dt>
        <dd>{{{ $contact->last_name }}} &nbsp;</dd>

        <dt>Address</dt>
        <dd>{{{ $contact->address }}} &nbsp;</dd>

        <dt>Telephone number</dt>
        <dd>{{{ $contact->telephone }}} &nbsp;</dd>

        <dt>Mobile number</dt>
        <dd>{{{ $contact->mobile }}} &nbsp;</dd>

        <dt>Email</dt>
        <dd>{{{ $contact->email }}} &nbsp;</dd>

        <dt>Date of birth</dt>
        <dd>{{{ $contact->date_of_birth ? "{$contact->date_of_birth->format('Y-m-d')} ({$contact->age})" : '' }}} &nbsp;</dd>

        <dt>Gender</dt>
        <dd>{{{ $contact->gender }}} &nbsp;</dd> 

        <dt>Notes</dt>
        <dd class="pre">{{{ $contact->notes }}}</dd>

    </dl>
</div>

<div class="col-sm-3">

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

<div class="col-sm-12" role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active" ><a href="#volunteer-details" aria-controls="volunteer-details" role="tab" data-toggle="tab">Volunteer details</a></li>
        <li role="presentation"><a href="#guest-details" aria-controls="guest-details" role="tab" data-toggle="tab" id="guest-details-tab-link">Guest details</a></li>
    </ul>

    <!-- Nav tab content -->
    <div class="tab-content">

        <div role="tabpanel" class="tab-pane fade in active" id="volunteer-details">

            @if ($contact->volunteer_details)

                <div class="row">
                    <div class="col-sm-9">
                        <dl class="dl-vertical">
                            <dt>Next of kin</dt>
                            <dd>{{{ $contact->volunteer_details->next_of_kin_name }}}</dd>
                            <dd>{{{ $contact->volunteer_details->next_of_kin_telephone }}}</dd>
                            <dd>{{{ $contact->volunteer_details->next_of_kin_relationship }}} </dd>

                            <dt>Contact in case of emergency</dt>
                            <dd>{{{ $contact->volunteer_details->emergency_name }}}</dd>
                            <dd>{{{ $contact->volunteer_details->emergency_telephone  }}}</dd>
                            <dd>{{{ $contact->volunteer_details->emergency_relationship }}}</dd>

                            <dt>Health issues?</dt>
                            <dd>{{{ $contact->volunteer_details->health_issues ? 'Yes' : 'No' }}}</dd>
                            <dd class="pre">{{{ $contact->volunteer_details->health_issues_details }}}</dd>

                            <dt>Personal development, reasons for volunteering</dt>
                            <dd class="pre">{{{ $contact->volunteer_details->personal_development_notes }}}</dd>

                            <dt>Access NI required?</dt>
                            <dd>{{{ $contact->volunteer_details->access_ni_required ? 'Yes' : 'No' }}}</dd>

                            <dt>Access NI received?</dt>
                            <dd>{{{ $contact->volunteer_details->access_ni_received ? 'Yes' : 'No' }}}</dd>

                            <dt>Confidentiality agreement signed?</dt>
                            <dd>{{{ $contact->volunteer_details->confidentiality ? 'Yes' : 'No' }}}</dd>

                            <dt>Photograph permission given?</dt>
                            <dd>{{{ $contact->volunteer_details->photographs ? 'Yes' : 'No' }}}</dd>

                            <dt>Health and safety checklist completed for current location?</dt>
                            <dd>{{{ $contact->volunteer_details->health_and_safety ? 'Yes' : 'No' }}}</dd>

                            <dt>Safeguarding training received?</dt>
                            <dd>{{{ $contact->volunteer_details->safeguarding ? 'Yes' : 'No' }}}</dd>

                            <dt>Notes</dt>
                            <dd class="pre">{{{ $contact->volunteer_details->notes }}}</dd>

                            <dt>Vineyard Compassion volunteer?</dt>
                            <dd>{{{ $contact->volunteer_details->vineyard_compassion ? 'Yes' : 'No' }}}</dd>

                            <dt>Supported volunteer?</dt>
                            <dd>{{{ $contact->volunteer_details->supported ? 'Yes' : 'No' }}}</dd> &nbsp;

                        </dl>
                    </div>
                    <div class="col-sm-3">

                        {{ Form::open(
                            array(
                                'method' => 'DELETE', 
                                'route'  => array('volunteer_details.destroy', $contact->volunteer_details->id),
                                'id'     => 'delete_details' ) ) }}

                        <div style="margin-bottom:10px;">
                        {{ link_to_route(
                            'volunteer_details.edit', 
                            'Edit volunteer details', 
                            $parameters = array( 'id' => $contact->volunteer_details->id), 
                            $attributes = array( 'class' => 'btn btn-primary btn-sm')) }}
                        </div>

                        <div style="margin-bottom:10px;">
                        {{ Form::button(
                            'Delete volunteer details', 
                            array(
                                'class' => 'btn btn-danger btn-sm',
                                'data-toggle' => 'modal',
                                'data-target' => '#modal-details' )) }}
                        </div>
                        
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

            <h3>Record of volunteering</h3>
            
            @if ($volunteering_records)
                <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Leader</th>
                        <th>Hours</th>
                        <th>Start Date</th>
                        <th>Finish Date</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($volunteering_records as $record)
                    <tr>
                        <td>{{{ $record->project }}}</td>
                        <td>{{{ $record->leader }}}</td>
                        <td>{{{ number_format($record->hours, 2) . ' hrs' }}}</td>
                        <td>{{{ $record->start_date }}}</td>
                        <td>{{{ $record->finish_date }}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <p><i>There are no volunteering records for this contact.</i></p>
            @endif

        </div>

        <div role="tabpanel" class="tab-pane fade" id="guest-details">
            
            <h3>Connection cards</h3>

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
                        'Add a connection card', 
                        $parameters = array( 'id' => $contact->id), 
                        $attributes = array( 'class' => 'btn btn-primary btn-sm')) }}
                </div>
            </div>

            <h3>Case notes</h3>

            @if ($contact->case_notes->count() > 0)

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Volunteer</th>
                            <th>Date</th>
                            <th>Method</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($contact->case_notes as $case_note)
                        <tr>
                            <td>{{{ $case_note->project->name }}}</td>
                            <td>{{{ $case_note->volunteer }}}</td>
                            <td>{{{ $case_note->conversation_date ? $case_note->conversation_date->format('Y-m-d') : '' }}}</td>
                            <td>{{{ $case_note->channel }}}</td>
                            <td>{{ link_to_route(
                                    'case_note.show', 
                                    'Show details', 
                                    $parameters = array( 'id' => $case_note->id), 
                                    $attributes = array( 'class' => '')) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @endif

            <div class="row">
                <div class="col-sm-6">
                    {{ link_to_route(
                        'case_note.create', 
                        'Add a case note', 
                        $parameters = array( 'id' => $contact->id), 
                        $attributes = array( 'class' => 'btn btn-primary btn-sm')) }}
                </div>
            </div>

            <h3>Record of attendance as a guest</h3>
    
            @if ($guest_records)
                <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Leader</th>
                        <th>Hours</th>
                        <th>Start Date</th>
                        <th>Finish Date</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($guest_records as $record)
                    <tr>
                        <td>{{{ $record->project }}}</td>
                        <td>{{{ $record->leader }}}</td>
                        <td>{{{ number_format($record->hours, 2) . ' hrs' }}}</td>
                        <td>{{{ $record->start_date }}}</td>
                        <td>{{{ $record->finish_date }}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <p><i>There are no records for this contact attending as a guest.</i></p>
            @endif

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
            from the system. This will also delete all other information associated with this contact
            like connection cards, case notes and attendance records.
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

@if (Input::has('guest-details'))

    $(function () {
        $('#guest-details-tab-link').tab('show')
    })

@endif
    
</script>

@stop

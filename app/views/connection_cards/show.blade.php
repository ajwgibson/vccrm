
<div class="col-sm-6">
    <h3>Project details</h3>
    <dl class="dl-horizontal">

        <dt>Project</dt>
        <dd>{{{ $connection_card->project->name }}}&nbsp;</dd>

        <dt>Connection date</dt>
        <dd>{{{ $connection_card->connection_date->format('Y-m-d') }}}&nbsp;</dd>

        <dt>Volunteer</dt>
        <dd>{{{ $connection_card->volunteer }}}&nbsp;</dd>

        <dt>How did the guest hear about the project?</dt>
        <dd>{{{ $connection_card->heard_about }}}&nbsp;</dd>

    </dl>

    <h3>Personal circumstances</h3>
    <dl class="dl-horizontal">

        <dt>Low income</dt>
        <dd>{{{ $connection_card->low_income ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Budgeting problems</dt>
        <dd>{{{ $connection_card->budgeting_problems ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Mental health</dt>
        <dd>{{{ $connection_card->mental_health ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Addiction</dt>
        <dd>{{{ $connection_card->addiction ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Isolation</dt>
        <dd>{{{ $connection_card->isolation ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Unemployment</dt>
        <dd>{{{ $connection_card->unemployed ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Long term illness</dt>
        <dd>{{{ $connection_card->long_term_illness ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Benefit issues</dt>
        <dd>{{{ $connection_card->benefit_issues ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Relationship breakdown</dt>
        <dd>{{{ $connection_card->relationship_breakdown ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Notes</dt>
        <dd>{{{ $connection_card->notes }}}&nbsp;</dd>

    </dl>

    <h3>Family circumstances</h3>
    <dl class="dl-horizontal">

        <dt>Marital status</dt>
        <dd>{{{ $connection_card->marital_status }}}&nbsp;</dd>

        <dt>Adults in household</dt>
        <dd>{{{ $connection_card->adults_in_household }}}&nbsp;</dd>

        <dt>Children in household</dt>
        <dd>{{{ $connection_card->children_in_household }}}&nbsp;</dd>

    </dl>

    <h3>Suggested next steps</h3>
    <dl class="dl-horizontal">

        <dt>#1</dt>
        <dd>{{{ $connection_card->next_steps_1 }}}&nbsp;</dd>

        <dt>#2</dt>
        <dd>{{{ $connection_card->next_steps_2 }}}&nbsp;</dd>

        <dt>#3</dt>
        <dd>{{{ $connection_card->next_steps_3 }}}&nbsp;</dd>

    </dl>

    <h3>Additional contact information</h3>
    <dl class="dl-horizontal">

        <dt>OK to contact?</dt>
        <dd>{{{ $connection_card->can_contact ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Best contact number</dt>
        <dd>{{{ $connection_card->best_telephone }}}&nbsp;</dd>

        <dt>Contact in morning?</dt>
        <dd>{{{ $connection_card->best_time_morning ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Contact in afternoone?</dt>
        <dd>{{{ $connection_card->best_time_afternoon ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Contact in evening?</dt>
        <dd>{{{ $connection_card->best_time_evening ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Contact Monday - Friday?</dt>
        <dd>{{{ $connection_card->best_time_weekday ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Contact Saturday?</dt>
        <dd>{{{ $connection_card->best_time_saturday ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Contact any time?</dt>
        <dd>{{{ $connection_card->best_time_any ? 'Yes' : 'No' }}}&nbsp;</dd>
    
    </dl>

    <h3>Signature details</h3>
    <dl class="dl-horizontal">
        
        <dt>Card signed?</dt>
        <dd>{{{ $connection_card->card_signed ? 'Yes' : 'No' }}}&nbsp;</dd>

        <dt>Date of signature</dt>
        <dd>{{{ $connection_card->signed_date ? $connection_card->signed_date->format('Y-m-d') : '' }}}&nbsp;</dd>

    </dl>

</div>

<div class="col-sm-6">

    {{ Form::open(
        array(
            'method' => 'DELETE', 
            'route' => array('connection_card.destroy', $connection_card->id),
            'class' => 'delete' ) ) }}

    <div style="margin-bottom:10px;">
        {{ link_to_route(
            'connection_card.edit', 
            'Edit this connection card', 
            $parameters = array( 'id' => $connection_card->id), 
            $attributes = array( 'class' => 'btn btn-primary')) }}
    </div>

    <div style="margin-bottom:10px;">
        {{ Form::button(
            'Delete this connection card', 
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
            You are about to delete this connection card. <strong>This action cannot be undone.</strong>
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
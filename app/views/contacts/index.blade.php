
<div class="pull-right">
    <a class="btn" data-toggle="collapse" data-target="#filter">
        @if ($filtered)
        <span class="glyphicon glyphicon-warning-sign"></span>
        @endif
        Filter contacts
        <span class="caret"></span>
    </a>
</div>

<div>
	{{ link_to_route('contact.create', 'Add a new contact', array(), array('class' => 'btn btn-primary')) }}

    {{ link_to_route(
        'contact.export', 
        'Export all contacts', 
        $parameters = array( ), 
        $attributes = array( 'class' => 'btn btn-default' ) ) }}
</div>	

<div class="clearfix"></div>

<div id="filter" class="filter collapse">

    <div class="col-sm-6"></div>

    {{ Form::open(array('route' => array('contact.filter'))) }}

    <div class="col-sm-6 panel panel-default">

    	<div class="col-sm-6">

            <div class="form-group">
                {{ Form::label('filter_guest', 'Guests & Volunteers', array('class' => 'control-label')) }}
                <div>
                	<label class="checkbox-inline">{{ Form::checkbox('filter_guest', true, $filter_guest) }} Guest</label><br/>
                	<label class="checkbox-inline">{{ Form::checkbox('filter_volunteer', true, $filter_volunteer) }} Volunteer</label><br/>
                </div>
            </div>

        </div>

        <div class="col-sm-6">

            <div class="form-group">
                {{ Form::label('filter_name', 'Name', array ('class' => 'control-label')) }}
                <div>
                	{{ Form::text('filter_name', $filter_name, array ('class' => 'form-control')) }}
                </div>
        		<p class="help-block">You can enter a full or partial first or last name, but not both</p>
            </div>

        </div>

        <div class="col-sm-6 col-sm-offset-6">
            {{ Form::submit('Apply filters', array('class' => 'btn btn-info')) }}

            {{ link_to_route(
                'contact.resetfilter', 
                'Reset filters', 
                $parameters = array( ), 
                $attributes = array( 'class' => 'btn btn-default' ) ) }}

        </div>

    </div>

    {{ Form::close() }}

</div>


<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Telephone</th>
			<th>Volunteer?</th>
			<th>Guest?</th>
			<th>Options</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($contacts as $contact)
		<tr>
			<td>{{{ "{$contact->first_name} {$contact->last_name}" }}}</td>
			<td>{{{ $contact->email }}}</td>
			<td>{{{ $contact->mobile }}}</td>
			<td>{{{ $contact->telephone }}}</td>
			<td>{{{ $contact->volunteer ? 'Yes' : 'No' }}}</td>
			<td>{{{ $contact->guest ? 'Yes' : 'No' }}}</td>
			<td>{{ link_to_route(
					'contact.show', 
					'Show details', 
					$parameters = array( 'id' => $contact->id), 
					$attributes = array( 'class' => '')) }}</td>
		</tr>
	@endforeach
	</tbody>
</table>

<div class="pull-right">
    {{ $contacts->links() }}
</div>
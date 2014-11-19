
<div>
	{{ link_to_route('contact.create', 'Add a new contact', array(), array('class' => 'btn btn-primary')) }}
</div>	

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Telephone</th>
			<th>Volunteer?</th>
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
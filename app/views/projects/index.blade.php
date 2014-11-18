
<div>
	{{ link_to_route('project.create', 'Add a new project', array(), array('class' => 'btn btn-primary')) }}
</div>	

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
			<th>Leader</th>
			<th>Options</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($projects as $project)
		<tr>
			<td>{{{ $project->name }}}</td>
			<td>{{{ $project->leader }}}</td>
			<td>{{ link_to_route(
					'project.show', 
					'Show details', 
					$parameters = array( 'id' => $project->id), 
					$attributes = array( 'class' => '')) }}</td>
		</tr>
	@endforeach
	</tbody>
</table>
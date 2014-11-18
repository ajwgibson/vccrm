
<div>
	{{ link_to_route('user.create', 'Add a new user', array(), array('class' => 'btn btn-primary')) }}
</div>	

<div class="table-responsive">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Email</th>
				<th>First name</th>
				<th>Last name</th>
				<th>Superuser</th>
				<th>Groups</th>
				<th>Last login</th>
				<th>Options</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($users as $user)
			<tr>
				<td>{{{ $user->email }}}</td>
				<td>{{{ $user->first_name }}}</td>
				<td>{{{ $user->last_name }}}</td>
				<td>{{{ $user->isSuperUser() ? "Yes" : "No" }}}</td>
				<td>
				@foreach ($user->getGroups() as $group)
		            {{{ $group->name }}}<br/>
		        @endforeach
		        </td>
				<td>{{{ $user->last_login ? date_format($user->last_login, 'd/m/Y @ H:i') : '' }}}</td>
				<td>{{ link_to_route(
						'user.show', 
						'Show details', 
						$parameters = array( 'id' => $user->id), 
						$attributes = array( 'class' => '')) }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
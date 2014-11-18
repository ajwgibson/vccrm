
{{ Form::model($role, array('route' => 'project_role.store')) }}

{{ Form::hidden('project_id', $project) }}

@include('project_roles._form', array ( 'button' => 'Save new role' ))

{{ Form::close() }}
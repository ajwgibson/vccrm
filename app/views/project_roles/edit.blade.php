
{{ Form::model($role, array('route' => array('project_role.update', $role->id))) }}

@include('project_roles._form', array ( 'button' => 'Update this role' ))

{{ Form::close() }}
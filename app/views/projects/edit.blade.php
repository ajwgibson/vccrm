
{{ Form::model($project, array('method' => 'PUT', 'route' => array('project.update', $project->id))) }}

@include('projects._form', array ( 'button' => 'Update this project' ))

{{ Form::close() }}

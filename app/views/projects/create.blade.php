
{{ Form::open(array('route' => 'project.store')) }}

@include('projects._form', array ( 'button' => 'Save new project' ))

{{ Form::close() }}

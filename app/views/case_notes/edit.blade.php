{{ Form::model($case_note, array('route' => array('case_note.update', $case_note->id))) }}

@include('case_notes._form')

{{ Form::close() }}

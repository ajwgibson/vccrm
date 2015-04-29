{{ Form::model($case_note, array('route' => array('case_note.store', $contact->id))) }}

@include('case_notes._form')

{{ Form::close() }}

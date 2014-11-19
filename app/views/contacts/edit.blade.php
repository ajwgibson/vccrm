
{{ Form::model($contact, array('method' => 'PUT', 'route' => array('contact.update', $contact->id))) }}

@include('contacts._form', array ( 'button' => 'Update this contact' ))

{{ Form::close() }}

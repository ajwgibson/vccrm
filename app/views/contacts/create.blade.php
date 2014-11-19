
{{ Form::model($contact, array('route' => 'contact.store')) }}

@include('contacts._form', array ( 'button' => 'Save new contact' ))

{{ Form::close() }}

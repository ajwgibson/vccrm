{{ Form::model($connection_card, array('route' => array('connection_card.store', $contact->id))) }}

@include('connection_cards._form')

{{ Form::close() }}

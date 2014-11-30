{{ Form::model($connection_card, array('route' => array('connection_card.update', $connection_card->id))) }}

@include('connection_cards._form')

{{ Form::close() }}

{{ Form::model($volunteer_details, array('route' => array('volunteer_details.update', $volunteer_details->id))) }}

@include('volunteer_details._form', array ( 'button' => 'Save details' ))

{{ Form::close() }}

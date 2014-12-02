
<div class="pull-right">
    <a class="btn" data-toggle="collapse" data-target="#filter">
        @if ($filtered)
        <span class="glyphicon glyphicon-warning-sign"></span>
        @endif
        Filter attendance records
        <span class="caret"></span>
    </a>
</div>

<div>
	{{ link_to_route('attendance_record.create', 'Add a new attendance record', array(), array('class' => 'btn btn-primary')) }}

    @if ($canExport)
		{{ link_to_route(
	        'attendance_record.export', 
	        'Export all attendance records', 
	        $parameters = array( ), 
	        $attributes = array( 'class' => 'btn btn-default' ) ) }}
    @endif
</div>	


<div class="clearfix"></div>

<div id="filter" class="filter collapse">

    <div class="col-sm-6"></div>

    {{ Form::open(array('route' => array('attendance_record.filter'))) }}

    <div class="col-sm-6 panel panel-default">

        <div class="col-sm-6">

            <div class="form-group">
                {{ Form::label('filter_name', 'Name', array ('class' => 'control-label')) }}
                <div>
                    {{ Form::text('filter_name', $filter_name, array ('class' => 'form-control')) }}
                </div>
                <p class="help-block">You can enter a full or partial first or last name, but not both</p>
            </div>

            <div class="form-group">
                {{ Form::label('filter_guest', 'Guests & Volunteers', array('class' => 'control-label')) }}
                <div>
                    <label class="checkbox-inline">{{ Form::checkbox('filter_guest', true, $filter_guest) }} Guest records</label><br/>
                    <label class="checkbox-inline">{{ Form::checkbox('filter_volunteer', true, $filter_volunteer) }} Volunteer records</label><br/>
                </div>
                <p class="help-block">You can select either one of these, but not both</p>
            </div>

        </div>

        <div class="col-sm-6">

            <div class="form-group">
                {{ Form::label('filter_project', 'Project', array ('class' => 'control-label')) }}
                <div>
                    {{ Form::select(
                        'filter_project', 
                        array('' => 'All projects') + $projects,
                        $filter_project,
                        array ('class' => 'form-control')) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('filter_contact', 'Contact', array('class' => 'control-label')) }}
                <div>
                    {{ Form::select(
                        'filter_contact', 
                        array('' => 'All contacts') + $contacts,
                        $filter_contact,
                        array ('class' => 'form-control')) }}
                </div>
            </div>

        </div>

        <div class="col-sm-6 col-sm-offset-6">
            {{ Form::submit('Apply filters', array('class' => 'btn btn-info')) }}

            {{ link_to_route(
                'attendance_record.resetfilter', 
                'Reset filters', 
                $parameters = array( ), 
                $attributes = array( 'class' => 'btn btn-default' ) ) }}

        </div>

    </div>

    {{ Form::close() }}

</div>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Date</th>
			<th>Project</th>
            <th>Contact</th>
            <th>Hours</th>
            <th>Role</th>
			<th>Volunteer or Guest</th>
			<th>Options</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($records as $record)
		<tr>
			<td>{{{ $record->attendance_date->format('Y-m-d') }}}</td>
			<td>{{{ $record->project->name }}}</td>
			<td>{{{ $record->contact->Name }}}</td>
			<td>{{{ number_format($record->hours, 2) . ' hrs' }}}</td>
            <td>{{{ $record->role }}}</td>
            <td>{{{ $record->volunteer ? 'Volunteer' : 'Guest' }}}</td>
			<td>{{ link_to_route(
					'attendance_record.show', 
					'Show details', 
					$parameters = array( 'id' => $record->id), 
					$attributes = array( 'class' => '')) }}</td>
		</tr>
	@endforeach
	</tbody>
</table>

<div class="pull-right">
    {{ $records->links() }}
</div>



@section('extra_js')

<script type="text/javascript">
    $('#filter_project, #filter_contact').select2();
</script>

@endsection
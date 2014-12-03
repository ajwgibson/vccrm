
@section('extra_css')

@stop



<h2>Top 10 volunteers for this month</h2>
<ol>
	@foreach ($top_10_volunteers as $volunteer)
        <li>{{{ "$volunteer->first_name $volunteer->last_name" }}} 
        	<span class="badge">{{{ number_format($volunteer->hours, 2) }}} hrs</span></li>
    @endforeach
</ol>

<h2>Busiest projects this month</h2>
<h3>By guest hours</h3>
<ol>
	@foreach ($top_5_guest_projects as $project)
        <li>{{{ $project->name }}} 
        	<span class="badge">{{{ number_format($project->hours, 2) }}} hrs</span></li>
    @endforeach
</ol>
<h3>By volunteer hours</h3>
<ol>
	@foreach ($top_5_volunteer_projects as $project)
        <li>{{{ $project->name }}} 
        	<span class="badge">{{{ number_format($project->hours, 2) }}} hrs</li>
    @endforeach
</ol>


<h2>Possible enhancements</h2>
<ul>
	<li>Add some reports.</li>
	<li>Add notifications e.g. contact birthdays</li>
</ul>

@section('extra_js')

@stop
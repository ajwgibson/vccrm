
@section('extra_css')

@stop


<h3>Busiest volunteers</h3>
<canvas id="top10VolunteersChart" width="250" height="250" class="pull-left"></canvas>
<ol class="pull-left dashboard-list">
	@foreach ($top_10_volunteers as $volunteer)
        <li><span class="badge">{{{ number_format($volunteer->hours, 2) }}} hrs</span>
        	{{{ "$volunteer->first_name $volunteer->last_name" }}} </li>
    @endforeach
</ol>

<div class="clearfix"></div>

<h3>Busiest projects</h3>
<div class="row">
	<div class="col-sm-6">
		<h4>Volunteer hours...</h4>
		<canvas id="top5VolunteerProjectsChart" width="250" height="250" class="pull-left"></canvas>
		<ol class="pull-left dashboard-list">
			@foreach ($top_5_volunteer_projects as $project)
		        <li><span class="badge">{{{ number_format($project->hours, 2) }}} hrs</span> {{{ $project->name }}} </li>
		    @endforeach
		</ol>
	</div>
	<div class="col-sm-6">
		<h4>Guest hours...</h4>
		<canvas id="top5GuestProjectsChart" width="250" height="250" class="pull-left"></canvas>
		<ol class="pull-left dashboard-list">
			@foreach ($top_5_guest_projects as $project)
		        <li><span class="badge">{{{ number_format($project->hours, 2) }}} hrs</span> {{{ $project->name }}}</li>
		    @endforeach
		</ol>
	</div>
</div>



@section('extra_js')

<script src="{{ asset('js/Chart.min.js') }}"></script>

<script type="text/javascript">

<?php
	$colours = array( 
	    "#a6cee3", "#1f78b4", "#b2df8a", "#33a02c", "#fb9a99",
		"#e31a1c", "#fdbf6f", "#ff7f00", "#cab2d6", "#6a3d9a",
	);
?>

var top_10_volunteers_data = [
@for ($i = 0; $i < count($top_10_volunteers); $i++)
	{
    	value: {{{ number_format($top_10_volunteers[$i]->hours, 2) }}},
    	label: '{{{ "{$top_10_volunteers[$i]->first_name} {$top_10_volunteers[$i]->last_name}" }}}',
    	color: '{{{ $colours[$i % count($colours)] }}}',
    	highlight: ColorLuminance('{{{ $colours[$i % count($colours)] }}}', 0.2)
	},
@endfor
];

var top_5_guest_projects_data = [
@for ($i = 0; $i < count($top_5_guest_projects); $i++)
	{
    	value: {{{ number_format($top_5_guest_projects[$i]->hours, 2) }}},
    	label: '{{{ $top_5_guest_projects[$i]->name }}}',
    	color: '{{{ $colours[$i % count($colours)] }}}',
    	highlight: ColorLuminance('{{{ $colours[$i % count($colours)] }}}', 0.2)
	},
@endfor
];

var top_5_volunteer_projects_data = [
@for ($i = 0; $i < count($top_5_volunteer_projects); $i++)
	{
    	value: {{{ number_format($top_5_volunteer_projects[$i]->hours, 2) }}},
    	label: '{{{ $top_5_volunteer_projects[$i]->name }}}',
    	color: '{{{ $colours[$i % count($colours)] }}}',
    	highlight: ColorLuminance('{{{ $colours[$i % count($colours)] }}}', 0.2)
	},
@endfor
];


var ctx1 = document.getElementById("top10VolunteersChart").getContext("2d");
var pieChart1 = new Chart(ctx1).Doughnut(top_10_volunteers_data);

var ctx2 = document.getElementById("top5GuestProjectsChart").getContext("2d");
var pieChart2 = new Chart(ctx2).Doughnut(top_5_guest_projects_data);

var ctx3 = document.getElementById("top5VolunteerProjectsChart").getContext("2d");
var pieChart3 = new Chart(ctx3).Doughnut(top_5_volunteer_projects_data);


function ColorLuminance(hex, lum) {

	// validate hex string
	hex = String(hex).replace(/[^0-9a-f]/gi, '');
	if (hex.length < 6) {
		hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
	}
	lum = lum || 0;

	// convert to decimal and change luminosity
	var rgb = "#", c, i;
	for (i = 0; i < 3; i++) {
		c = parseInt(hex.substr(i*2,2), 16);
		c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
		rgb += ("00"+c).substr(c.length);
	}

	return rgb;
}

</script>


@stop
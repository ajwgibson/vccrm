<div class="pull-right" style="margin-bottom: 20px;">
    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" 
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Select a reporting year... <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            @foreach ($years as $year_option)
            <li>{{ link_to_route(
                        'report.dsd', 
                        $year_option, 
                        $parameters = array( 'year' => $year_option), 
                        $attributes = array( 'class' => '')) }}</li>
            @endforeach
        </ul>
    </div>
</div>

<table class="report-dsd table table-condensed table-responsive">
    <thead>
        <tr>
            <th>Month</th>
            <th>Project</th>
            <th style="text-align: right">Volunteers</th>
            <th style="text-align: right">Hours</th>
            <th style="text-align: right">Opportunities</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($months as $month)
        <tr class="month-name">
            <td>{{{ $month->name }}}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @foreach ($month->projects as $project)
        <tr class="no-border">
            <td></td>
            <td>{{{ $project->name }}}</td>
            <td align="right">{{{ $project->volunteers }}}</td>
            <td align="right">{{{ $project->hours }}}</td>
            <td align="right">{{{ $project->opportunities }}}</td>
        </tr>
        @endforeach
        <tr class="no-border totals">
            <td></td>
            <td align="right" style="border-top: 1px solid #ddd;">Monthly totals</td>
            <td align="right" style="border-top: 1px solid #ddd;">{{{ $month->volunteers }}}</td>
            <td align="right" style="border-top: 1px solid #ddd;">{{{ $month->hours }}}</td>
            <td align="right" style="border-top: 1px solid #ddd;">{{{ $month->opportunities }}}</td>
        </tr>
        <tr class="no-border totals">
            <td></td>
            <td align="right" style="border-top: 1px dashed #ddd;">Rolling (year to date) totals</td>
            <td align="right" style="border-top: 1px dashed #ddd;">{{{ $month->cumulative_volunteers }}}</td>
            <td align="right" style="border-top: 1px dashed #ddd;">{{{ $month->cumulative_hours }}}</td>
            <td align="right" style="border-top: 1px dashed #ddd;">{{{ $month->cumulative_opportunities }}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
                

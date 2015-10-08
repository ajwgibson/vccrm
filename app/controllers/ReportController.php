<?php

class ReportController extends BaseController {

    protected $title = 'Reporting';

    /**
     * Serves up the DSD report.
     */
    public function dsd($year = null)
    {
        // List of years that have attendance records
        $years = 
            DB::table('attendance_records')
                ->select(DB::raw('distinct year(attendance_date) as years')) 
                    ->where('attendance_records.volunteer', '=', true)
                    ->orderBy('years', 'desc')
                    ->lists('years', 'years');

        if (!($year)) {
            $year = reset($years);
        }

        // Initialise the report data
        $months = array(
            (object)array('name' => 'January',   'volunteers' => 0, 'hours' => 0.0, 'opportunities' => 0, 'cumulative_volunteers' => 0, 'cumulative_hours' => 0.0, 'cumulative_opportunities' => 0, 'projects' => array()),
            (object)array('name' => 'February',  'volunteers' => 0, 'hours' => 0.0, 'opportunities' => 0, 'cumulative_volunteers' => 0, 'cumulative_hours' => 0.0, 'cumulative_opportunities' => 0, 'projects' => array()),
            (object)array('name' => 'March',     'volunteers' => 0, 'hours' => 0.0, 'opportunities' => 0, 'cumulative_volunteers' => 0, 'cumulative_hours' => 0.0, 'cumulative_opportunities' => 0, 'projects' => array()),
            (object)array('name' => 'April',     'volunteers' => 0, 'hours' => 0.0, 'opportunities' => 0, 'cumulative_volunteers' => 0, 'cumulative_hours' => 0.0, 'cumulative_opportunities' => 0, 'projects' => array()),
            (object)array('name' => 'May',       'volunteers' => 0, 'hours' => 0.0, 'opportunities' => 0, 'cumulative_volunteers' => 0, 'cumulative_hours' => 0.0, 'cumulative_opportunities' => 0, 'projects' => array()),
            (object)array('name' => 'June',      'volunteers' => 0, 'hours' => 0.0, 'opportunities' => 0, 'cumulative_volunteers' => 0, 'cumulative_hours' => 0.0, 'cumulative_opportunities' => 0, 'projects' => array()),
            (object)array('name' => 'July',      'volunteers' => 0, 'hours' => 0.0, 'opportunities' => 0, 'cumulative_volunteers' => 0, 'cumulative_hours' => 0.0, 'cumulative_opportunities' => 0, 'projects' => array()),
            (object)array('name' => 'August',    'volunteers' => 0, 'hours' => 0.0, 'opportunities' => 0, 'cumulative_volunteers' => 0, 'cumulative_hours' => 0.0, 'cumulative_opportunities' => 0, 'projects' => array()),
            (object)array('name' => 'September', 'volunteers' => 0, 'hours' => 0.0, 'opportunities' => 0, 'cumulative_volunteers' => 0, 'cumulative_hours' => 0.0, 'cumulative_opportunities' => 0, 'projects' => array()),
            (object)array('name' => 'October',   'volunteers' => 0, 'hours' => 0.0, 'opportunities' => 0, 'cumulative_volunteers' => 0, 'cumulative_hours' => 0.0, 'cumulative_opportunities' => 0, 'projects' => array()),
            (object)array('name' => 'November',  'volunteers' => 0, 'hours' => 0.0, 'opportunities' => 0, 'cumulative_volunteers' => 0, 'cumulative_hours' => 0.0, 'cumulative_opportunities' => 0, 'projects' => array()),
            (object)array('name' => 'December',  'volunteers' => 0, 'hours' => 0.0, 'opportunities' => 0, 'cumulative_volunteers' => 0, 'cumulative_hours' => 0.0, 'cumulative_opportunities' => 0, 'projects' => array()),
        );

        // Fill in the monthly totals
        $statistics_by_month =
            DB::table('attendance_records')
                    ->select(
                        DB::raw(
                            "monthname(attendance_date) as month, " .
                            "month(attendance_date) as month_number, " .
                            "count(distinct contact_id) as volunteers, " .
                            "sum(hours) as hours, " .
                            "count(*) as opportunities, " .
                            "( " .
                            "    select count(distinct ar1.contact_id) " .
                            "    from attendance_records as ar1 " .
                            "    where  " .
                            "        ar1.volunteer=1 " .
                            "        and year(ar1.attendance_date) = '" . $year . "'" .
                            "        and month(ar1.attendance_date) <= month_number " .
                            ") as cumulative_volunteers, " .
                            "( " .
                            "    select sum(ar2.hours) " .
                            "    from attendance_records as ar2 " .
                            "    where  " .
                            "        ar2.volunteer=1 " .
                            "        and year(ar2.attendance_date) = '" . $year . "'" .
                            "        and month(ar2.attendance_date) <= month_number " .
                            ") as cumulative_hours, " .
                            "( " .
                            "    select count(ar3.id) " .
                            "    from attendance_records as ar3 " .
                            "    where  " .
                            "        ar3.volunteer=1 " .
                            "        and year(ar3.attendance_date) = '" . $year . "'" .
                            "        and month(ar3.attendance_date) <= month_number " .
                            ") as cumulative_opportunities "
                        ))
                    ->where('attendance_records.volunteer', '=', true)
                    ->where(DB::raw('year(attendance_date)'), '=', $year)
                    ->groupBy('month')
                    ->orderBy(DB::raw('month(attendance_records.attendance_date)'))
                    ->get();

        foreach($statistics_by_month as $month) {
            $needle = array_filter($months, function($m) use ($month) { return $m->name == $month->month; });
            $needle = reset($needle);
            $needle->volunteers                = $month->volunteers;
            $needle->hours                     = $month->hours;
            $needle->opportunities             = $month->opportunities;
            $needle->cumulative_volunteers     = $month->cumulative_volunteers;
            $needle->cumulative_hours          = $month->cumulative_hours;
            $needle->cumulative_opportunities  = $month->cumulative_opportunities;
        }

        // Deal with missing cumulative values?
        for($i = 1; $i < count($months); $i++) {
            if ($months[$i]->cumulative_volunteers == 0)    $months[$i]->cumulative_volunteers =    $months[$i-1]->cumulative_volunteers;
            if ($months[$i]->cumulative_hours == 0)         $months[$i]->cumulative_hours =         $months[$i-1]->cumulative_hours;
            if ($months[$i]->cumulative_opportunities == 0) $months[$i]->cumulative_opportunities = $months[$i-1]->cumulative_opportunities;
        }

        // Fill in the project details
        $statistics_by_project =
            DB::table('attendance_records')
                    ->join('projects', 'attendance_records.project_id', '=', 'projects.id')
                    ->select(
                        DB::raw(
                            'monthname(attendance_date) as month, ' .
                            'projects.name as project, ' .
                            'count(distinct contact_id) as volunteers, ' .
                            'sum(hours) as hours, ' .
                            'count(*) as opportunities'
                        ))
                    ->where('attendance_records.volunteer', '=', true)
                    ->where(DB::raw('year(attendance_date)'), '=', $year)
                    ->groupBy('month')
                    ->groupBy('project')
                    ->orderBy('project')
                    ->get();

        foreach($statistics_by_project as $project) {
            $needle = array_filter($months, function($m) use ($project) { return $m->name == $project->month; });
            $needle = reset($needle);
            $needle->projects[] = (object)array(
                'name'          => $project->project,
                'volunteers'    => $project->volunteers,
                'hours'         => $project->hours,
                'opportunities' => $project->opportunities,
            );
        }

        $this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'DSD report for ' . $year);

        $this->layout->content =
            View::make('reports.dsd')
                ->with('years', $years)
                ->with('year', $year)
                ->with('months', $months);
    }

}
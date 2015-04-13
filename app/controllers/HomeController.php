<?php

class HomeController extends BaseController {

	protected $title = 'Vineyard Compassion CRM';

	/**
	 * Serves up the administration home page.
	 */
	public function index()
	{
		$this->layout->with('title', $this->title);
        $this->layout->with('subtitle', 'home');

        // Top 10 volunteers this month
        $top_10_volunteers = 
        	DB::table('attendance_records')
        			->join('contacts', 'attendance_records.contact_id', '=', 'contacts.id')
        			->select(
        				DB::raw(
        					'contacts.first_name as first_name, contacts.last_name as last_name' .
        					', sum(attendance_records.hours) as hours'))
    				->groupBy('contacts.first_name')
    				->groupBy('contacts.last_name')
    				->where('attendance_records.volunteer', '=', true)
    				->where(DB::raw('year(attendance_records.attendance_date)'), '=', DB::raw('year(date_sub(current_date, interval 1 month))'))
    				->where(DB::raw('month(attendance_records.attendance_date)'), '=', DB::raw('month(date_sub(current_date, interval 1 month))'))
    				->orderBy('hours', 'desc')
    				->take(10)->get();

		// Top 5 projects by guest numbers
        $top_5_guest_projects = 
        	DB::table('attendance_records')
        			->join('projects', 'attendance_records.project_id', '=', 'projects.id')
        			->select(
        				DB::raw(
        					'projects.name as name, sum(attendance_records.hours) as hours'))
    				->groupBy('projects.name')
    				->where('attendance_records.volunteer', '=', false)
    				->where(DB::raw('year(attendance_records.attendance_date)'), '=', DB::raw('year(date_sub(current_date, interval 1 month))'))
    				->where(DB::raw('month(attendance_records.attendance_date)'), '=', DB::raw('month(date_sub(current_date, interval 1 month))'))
    				->orderBy('hours', 'desc')
    				->take(5)->get();

		// Top 5 projects by volunteer numbers
        $top_5_volunteer_projects = 
        	DB::table('attendance_records')
        			->join('projects', 'attendance_records.project_id', '=', 'projects.id')
        			->select(
        				DB::raw(
        					'projects.name as name, sum(attendance_records.hours) as hours'))
    				->groupBy('projects.name')
    				->where('attendance_records.volunteer', '=', true)
    				->where(DB::raw('year(attendance_records.attendance_date)'), '=', DB::raw('year(date_sub(current_date, interval 1 month))'))
    				->where(DB::raw('month(attendance_records.attendance_date)'), '=', DB::raw('month(date_sub(current_date, interval 1 month))'))
    				->orderBy('hours', 'desc')
    				->take(5)->get();

		// Contacts with a birthday this month
        $contacts =
            Contact::where(DB::raw('month(date_of_birth)'), '=', DB::raw('month(current_date)'))
                    ->orderBy(DB::raw('day(date_of_birth)'))
                    ->get();

        $this->layout->content = View::make('index')
									->with('top_10_volunteers', $top_10_volunteers)
									->with('top_5_guest_projects', $top_5_guest_projects)
                                    ->with('top_5_volunteer_projects', $top_5_volunteer_projects)
									->with('contacts', $contacts);
	}

}
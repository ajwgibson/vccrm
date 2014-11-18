<?php

class ProjectRole extends Eloquent {
	
	protected $table = 'project_roles';

	protected $guarded = array('id');

	public static $rules = array(
		'name'   => 'required|max:100',
		'hours'  => 'numeric|min:0|max:24',
	);


	// Relationship: project
    public function project()
    {
        return $this->belongsTo('Project');
    }
}
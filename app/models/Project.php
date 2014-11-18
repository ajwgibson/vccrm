<?php

class Project extends Eloquent {
	
	protected $table = 'projects';

	protected $guarded = array('id');

	public static $rules = array(
		'name'   => 'required|max:100|unique:projects,name,:id',
		'leader' => 'required|max:100',
	);

}
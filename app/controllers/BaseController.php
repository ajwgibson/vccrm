<?php

class BaseController extends Controller {

	protected $layout = 'layouts.default';

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if (!is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


	/**
	 * Injects an id into a set of validation rules to prevent errors
	 * firing on updates.
	 */
	protected function inject_id($rules, $id)
    {
    	if (!$id) $id = '-1';
    	
        foreach ($rules as $key => $rule)
        {
            $rules[$key] = str_replace(':id', $id, $rule);
        }
        return $rules;
    }
}

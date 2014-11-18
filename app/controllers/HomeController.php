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

		$this->layout->content = View::make('index');
	}

}
<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Errors extends Controller_Page {

	public function action_404() {
		$this->response->status(404);
		$this->template->title = 'Page not found';
		$this->template->subtitle = 'Error 404';
		$this->template->content = View::factory('errors/404');
	}

}

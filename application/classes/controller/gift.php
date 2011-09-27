<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Gift extends Controller {

	public function action_add() {
		$view = View::factory('gift/add');

		if ($_POST) {
			if (arr::get($_POST, 'title')) {
				Request::current()->redirect('list/mine/2');
			}
			$view->errors = 'Please enter a product title';
		}
		$this->response->body($view);
	}


	public function action_browse() {
		$view = View::factory('gift/browse');

		$this->response->body($view);
	}

} 

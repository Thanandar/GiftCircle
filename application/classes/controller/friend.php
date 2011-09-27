<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Friend extends Controller {

	public function action_index()
	{
		$id = $this->request->param('id');
		$this->response->body('hello, world!' . $id);
		//$this->response->body(View::factory('helloworld'));
	}

	public function action_list() {
		$this->response->body(View::factory('friend/list'));
	}

	public function action_edit() {

		$view = View::factory('friend/edit');
		$view->friend_id = $this->request->param('id');

		if ($_POST) {
			if (arr::get($_POST, 'email')) {
				Request::current()->redirect('friend/list');
			}
			$view->errors = 'Please supply an email address';
		}
		$this->response->body($view);
	}

} // End Welcome

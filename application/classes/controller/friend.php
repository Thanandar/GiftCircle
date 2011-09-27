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

} // End Welcome

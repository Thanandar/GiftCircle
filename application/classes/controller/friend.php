<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller {

	public function action_index()
	{
		$id = $this->request->param('id');
		$this->response->body('hello, world!' . $id);
		//$this->response->body(View::factory('helloworld'));
	}

} // End Welcome

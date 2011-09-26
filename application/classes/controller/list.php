<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List extends Controller {

	public function action_view() {
		$id = $this->request->param('id');
		$this->response->body('viewing list id:' . $id);
		//$this->response->body(View::factory('helloworld'));
	}

	public function action_add() {
		//$id = $this->request->param('id');
		$this->response->body('creating a list');
		//$this->response->body(View::factory('helloworld'));
	}

}

<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller {

	public function action_index() {
		//$id = $this->request->param('id');
		//$this->response->body('hello, world!' . $id);
		$this->response->body(View::factory('home/index'));
	}

	public function action_features() {
		$this->response->body(View::factory('home/features'));
	}

	public function action_support() {
		$this->response->body(View::factory('home/support'));
	}

	public function action_faqs() {
		$this->response->body(View::factory('home/faqs'));
	}


}

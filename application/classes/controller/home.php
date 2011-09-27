<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Page {

	public function action_index() {
		//$id = $this->request->param('id');
		//$this->response->body('hello, world!' . $id);
		//$this->response->body(View::factory('home/index'));
		$this->template->title = 'Home';
		$this->template->content = View::factory('home/index');
	}

	public function action_features() {
		$this->template->title = 'Features';
		$this->template->content = View::factory('home/features');
	}

	public function action_support() {
		$this->template->title = 'Support';
		$this->template->content = View::factory('home/support');
	}

	public function action_faqs() {
		$this->template->title = 'FAQs';
		$this->template->content = View::factory('home/faqs');
	}


}

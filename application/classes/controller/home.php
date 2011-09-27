<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Page {

	public function action_index() {
		//$id = $this->request->param('id');
		if (Auth::instance()->logged_in()) {
			Request::current()->redirect('user/view_lists');
		}

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

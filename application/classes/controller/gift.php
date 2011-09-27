<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Gift extends Controller_Page {

	public function action_index() {
		Request::current()->redirect('');
	}
	
	public function action_add() {
		$this->template->title = 'Add gift';
		$view = View::factory('gift/add');

		if ($_POST) {
			if (arr::get($_POST, 'title')) {
				Request::current()->redirect('list/mine/2');
			}
			$view->errors = 'Please enter a product title';
		}
		$this->template->content = $view;
	}

	public function action_edit() {
		$this->template->title = 'Edit gift';
		$view = View::factory('gift/edit');

		$view->gift_id = $this->request->param('id');


		if ($_POST) {
			if (arr::get($_POST, 'title')) {
				Request::current()->redirect('list/mine/2');
			}
			$view->errors = 'Please enter a product title';
		}
		$this->template->content = $view;
	}


	public function action_browse() {
		$this->template->title = 'Browse for a gift';
		$view = View::factory('gift/browse');

		$this->template->content = $view;
	}

	public function action_buy() {
		$this->template->title = 'Buy a gift';
		$view = View::factory('gift/buy');
		$view->gift_id = $this->request->param('id');

		$this->template->content = $view;
	}

} 

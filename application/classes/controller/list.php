<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List extends Controller_Page {

	public function action_index() {
		Request::current()->redirect('');
	}

	public function action_add() {
		$this->template->title = 'Add a list';

		$view = View::factory('list/add');

		if ($_POST) {
			if (arr::get($_POST, 'name')) {
				Request::current()->redirect('list/mine/1');
			}
			$view->errors = 'Please enter a list name';
		}
		$this->template->content = $view;
	}

	public function action_mine() {
		$this->template->title = 'View my list';

		$view = View::factory('list/mine');
		$view->list_id = $this->request->param('id');
		$this->template->content = $view;
	}

	public function action_friend() {
		$this->template->title = 'View my friend\'s list';

		$view = View::factory('list/friend');

		if ($_POST) {
			if (arr::get($_POST, 'reserve')) {
				Request::current()->redirect('gift/buy/1');
			}
			$view->errors = 'Please select some gifts to reserve';
		}

		$view->list_id = $this->request->param('id');
		$this->template->content = $view;
	}

	public function action_add_friend() {
		$this->template->title = 'Add a friend to my list';

		$view = View::factory('list/add_friend');

		if ($_POST) {
			if (arr::get($_POST, 'id')) {
				Request::current()->redirect('list/mine/1');
			}
			$view->errors = 'Please select some friends to add';
		}

		$view->list_id = $this->request->param('id');
		$this->template->content = $view;
	}

}

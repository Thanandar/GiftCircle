<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Friend extends Controller_Page {

	public function action_index() {
		Request::current()->redirect('friend/list');
		$id = $this->request->param('id');
		$this->response->body('hello, world!' . $id);
		//$this->response->body(View::factory('helloworld'));
	}

	public function action_list() {
		$this->template->title = 'My Friends';

		$this->template->content = View::factory('friend/list');
	}

	public function action_edit() {
		$this->template->title = 'Edit friend';

		$view = View::factory('friend/edit');
		$view->friend_id = $this->request->param('id');

		if ($_POST) {
			if (arr::get($_POST, 'email')) {
				Request::current()->redirect('friend/list');
			}
			$view->errors = 'Please supply an email address';
		}
		$this->template->content = $view;
	}

	public function action_add() {
		$this->template->title = 'Add friend';

		$view = View::factory('friend/add');

		if ($_POST) {
			if (arr::get($_POST, 'email')) {
				Request::current()->redirect('friend/list');
			}
			$view->errors = 'Please supply an email address';
		}
		$this->template->content = $view;
	}

} // End Welcome

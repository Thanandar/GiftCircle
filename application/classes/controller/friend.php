<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Friend extends Controller_Page {

	public function action_index() {
		Request::current()->redirect('friend/list');
	}

	public function action_list() {
		$this->template->title = 'My Friends';

		$this->template->content = View::factory('friend/list');
	}

	public function action_view() {
		$this->template->title = 'View friend';

		$friend = new Model_Friend($this->request->param('id'));

		if ($friend->creator_id != $this->me()->id) {
			Message::add('error', 'You are not friends with this person');
			Request::current()->redirect('friend/list');
		}

		$view = View::factory('friend/view');
		$view->friend = $friend;
		
		$user = ORM::factory('owner')
			->where('email', '=', $friend->email)
			->find_all();

		
		// $view->my_lists = ORM::factory('list')
		// 	->where('owner_id', '=', $this->me())
		// 	->where_related('owner_id', '=', $this->me())
		// 	->find_all();


		$view->friend_user = count($user) ? $user : null;
		

		$this->template->content = $view;
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

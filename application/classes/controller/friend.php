<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Friend extends Controller_Page {

	public function action_index() {
		Request::current()->redirect('friend/list');
	}

	public function action_list() {
		$this->template->title = 'My Friends';

		$view = View::factory('friend/list');
		$view->friends = ORM::factory('friend')
			->where('creator_id', '=', $this->me()->id)
			->find_all();

		$this->template->content = $view;
	}

	public function action_delete() {
		
		$friend = new Model_Friend($this->request->param('id'));

		if ($friend->creator_id != $this->me()->id) {
			Message::add('error', Kohana::message('friend', 'not-friends'));
			Request::current()->redirect('friend/list');
		}

		$friend->delete();
		Message::add('success', 'Friend deleted');
		Request::current()->redirect('friend/list');

	}

	public function action_view() {
		$this->template->title = 'View friend';

		$friend = new Model_Friend($this->request->param('id'));

		if ($friend->creator_id != $this->me()->id) {
			Message::add('error', Kohana::message('friend', 'not-friends'));
			Request::current()->redirect('friend/list');
		}

		$view = View::factory('friend/view');
		$view->friend = $friend;
		
		$user = ORM::factory('owner')
			->where('email', '=', $friend->email)
			->find_all();

		
		// $view->friends_lists = ORM::factory('list')
		// 	->where('owner_id', '=', $user->id)
		// 	->find_all();

		// $view->friends_lists = $friends_lists;
		

		$view->friend_user = count($user) ? $user : null;
		

		$this->template->content = $view;
	}

	public function action_edit() {
		$this->template->title = 'Edit friend';

		$friend = new Model_Friend($this->request->param('id'));

		if ($friend->creator_id != $this->me()->id) {
			Message::add('error', Kohana::message('friend', 'not-friends'));
			Request::current()->redirect('friend/list');
		}

		$view = View::factory('friend/edit');
		$view->friend = $friend;

		if ($_POST) {
			if (arr::get($_POST, 'email')) {
				Request::current()->redirect('friend/list');
			}
			$view->errors = Kohana::message('friend', 'email-required');
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
			$view->errors = Kohana::message('friend', 'email-required');
		}
		$this->template->content = $view;
	}

} // End Welcome

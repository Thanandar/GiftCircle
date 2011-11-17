<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Friend extends Controller_Page {

	// make sure user is logged in
	public function before() {
		if (!$this->me()->id) {
			Request::current()->redirect('');
		}		
		parent::before();
	}

	public function action_index() {
		Request::current()->redirect('friend/list');
	}

	public function action_list() {
		$this->template->title = 'Friends';
		$this->template->subtitle = 'Share lists with all these people';

		$view = View::factory('friend/list');
		
		$me = new Model_Owner($this->me()->id);
		//$view->friends = $me->confirmed_friends();
		$view->friends = $me->friends->order_by('surname')->find_all();

		$this->template->content = $view;
	}

	public function action_delete() {
		
		$friend = new Model_Friend($this->request->param('id'));

		if ($friend->creator_id != $this->me()->id) {
			Message::add('error', Kohana::message('friend', 'not-friends'));
			Request::current()->redirect('friend/list');
		}

		if (arr::get($_POST, 'delete')) {
			$friend->delete();
			Message::add('success', 'Friend deleted');
			Request::current()->redirect('friend/list');
		}

		$view = View::factory('friend/delete');
		$view->friend = $friend;
		$this->template->content = $view;
		$this->template->title = 'Confirm';
	}

	public function action_view() {
		$this->template->title = 'View friend\'s lists';

		$friend = new Model_Friend($this->request->param('id'));

		if ($friend->creator_id != $this->me()->id) {
			Message::add('error', Kohana::message('friend', 'not-friends'));
			Request::current()->redirect('friend/list');
		}

		$view = View::factory('friend/view');
		$view->friend = $friend;
		
		$user = $friend->get_user();

		$view->friend_user = $user->loaded() ? $user : null;
		
		$view->friends_lists = $user->lists_containing_email($this->me()->email);

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
			$view->errors = array();
			
			if (filter_var(arr::get($_POST, 'email'), FILTER_VALIDATE_EMAIL) && arr::get($_POST, 'firstname')) {
				$friend->firstname = arr::get($_POST, 'firstname');
				$friend->surname   = arr::get($_POST, 'surname');
				$friend->email     = arr::get($_POST, 'email');
				$friend->birthday  = arr::get($_POST, 'birthday');
				$friend->address   = arr::get($_POST, 'address');
				$friend->save();
				Message::add('success', 'Successfully updated friend.');
				Request::current()->redirect('friend/list');
			} else {
				if (!filter_var(arr::get($_POST, 'email'), FILTER_VALIDATE_EMAIL)) {
					$view->errors['email'] = Kohana::message('friend', 'email-required');
				}

				if (!arr::get($_POST, 'firstname')) {
					$view->errors['firstname'] = Kohana::message('friend', 'firstname-required');
				}
				
			}
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

	public function action_request_accept() {
		
		$friend = new Model_Owner($this->request->param('id'));

		if (!$friend->is_on_my_friends_list($this->me())) {
			Message::add('error', 'This person does not want to be your friend.');
			Request::current()->redirect('');
		}

		if ($friend->is_on_friends_friends_list($this->me())) {
			Message::add('error', 'You are already friends with this person.');
			Request::current()->redirect('');
		}

		$new_friend = new Model_Friend;
		$new_friend->creator_id = $this->me()->id;
		$new_friend->firstname  = $friend->firstname;
		$new_friend->surname    = $friend->surname;
		$new_friend->email      = $friend->email;
		$new_friend->save();

		Message::add('success', 'Successfully confirmed friendship');
		Request::current()->redirect('');

	}

	public function action_request_cancel() {

		$friend_user = new Model_Owner($this->request->param('id'));

		if (!$friend_user->is_on_my_friends_list($this->me())) {
			Message::add('error', 'This person does not want to be your friend.');
			Request::current()->redirect('');
		}

		if ($friend_user->is_on_friends_friends_list($this->me())) {
			Message::add('error', 'You are already friends with this person.');
			Request::current()->redirect('');
		}

		$mes = $friend_user->friends
			->where('email', '=', $this->me()->email)
			->find_all();

		foreach ($mes as $me) {
			$me->delete();
		}

		Message::add('success', 'Successfully cancelled friendship');
		Request::current()->redirect('');
	}

} // End Welcome

<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List extends Controller_Page {

	// make sure user is logged in
	public function before() {
		if (!$this->me()->id) {
			Request::current()->redirect('');
		}		
		parent::before();
	}

	public function action_index() {
		Request::current()->redirect('');
	}


	public function action_my() {
		if (!$this->me()->id) {
			Request::current()->redirect('');
		}

		$this->template->title = 'Circles';
		$this->template->subtitle = 'Gift circles you have created';

		$view = View::factory('list/my');
		$me = ORM::factory('owner', $this->me()->id);

		$view->my_lists = $me->lists
			->order_by('updated', 'DESC')
			->find_all();
		
		$this->template->content = $view;
	}

	private function redirect_if_not_owner() {
		$list_id = $this->request->param('id');
		$list = new Model_List($list_id);

		if ($list->owner->id != $this->me()->id) {
			Request::current()->redirect('list/my');
		}
	}

	public function action_all() {
		Request::current()->redirect('home/dashboard');
	}


	public function action_add() {
		$this->template->title = 'Create a Circle';
		
		$me = new Model_Owner($this->me()->id);

		$view = View::factory('list/add');
		$view->friends = $me->friends->find_all();

		if ($_POST) {
			if (arr::get($_POST, 'name')) {
				$list = new Model_List;
				$list->owner_id = $this->me()->id;
				$list->name = arr::get($_POST, 'name');
				$list->expiry = arr::get($_POST, 'expiry');
				$list->save();

				//$added = $this->add_existing_friends_from_post($view, $list);
				//$added += $this->add_new_friends_from_post($view, $list);

				Message::add('success', __('Successfully created a new circle.'));
				Request::current()->redirect('list/add_friend_wizard/' . $list->id);
			}
			$view->errors = 'Please enter a circle name';
		}
		$this->template->content = $view;
	}

	public function action_edit() {
		$this->redirect_if_not_owner();

		$list_id = $this->request->param('id');
		$list = new Model_List($list_id);


		$this->template->title = 'Edit circle';
		$view = View::factory('list/edit');
		$view->list = $list;

		if ($_POST) {
			if (arr::get($_POST, 'name')) {
				$list->name = arr::get($_POST, 'name');

				if (arr::get($_POST, 'expiry') && !preg_match('~^\d{1,2}/\d{1,2}/\d{4}$~', arr::get($_POST, 'expiry'))) {
					$view->errors = 'Please enter a valid date';
				} else {
					$list->expiry = arr::get($_POST, 'expiry');
					$list->save();
					Message::add('success', __('Circle updated.'));
					Request::current()->redirect('list/mine/' . $list->id);
				}
			} else {
				$view->errors = 'Please enter a circle name';
			}
		}
		$this->template->content = $view;
	}

	public function action_mine() {
		$this->redirect_if_not_owner();

		$list = new Model_List($this->request->param('id'));

		$view = View::factory('list/mine');
		$view->list = $list;
		$view->gifts = $list->gifts->find_all();
		$view->friends = $list->friends->find_all();

		$this->template->title = 'View your circle &raquo; ' . $list->name;
		$this->template->subtitle = 'Your gift circle in detail';

		$this->template->content = $view;
	}

	private function redirect_if_not_on_list() {
		$list = new Model_List($this->request->param('id'));
		$friends = $list->friends
			->where('email', '=', $this->me()->email)
			->where('list_id', '=', $list)
			->find_all();

		if (!count($friends)) {
			Request::current()->redirect('user/noaccess');
		}
	}

	private function reserve_items(View &$view) {
		if (!arr::get($_POST, 'reserve')) {
			$view->errors = 'Please select some gifts to reserve';
			return;	
		}

		$reserved = 0;
		foreach (arr::get($_POST, 'reserve') as $gift_id) {
			// TODO: check gift is on a list you're allowed to access
			// TOOD: check gift has not been reserved by someone else

			// add this gift to me
			$me = new Model_Owner($this->me()->id);
			$gift = new Model_Gift((int) $gift_id);
			$gift->reserver_id = $me;
			$gift->save();
			
			// this should work
			//$gift->add('reserver', $me);
			//$me->add('reservations', $gift);
			$reserved++;
		}

		Message::add('success', __('Reserved ' . $reserved . ' gift(s).'));
		Request::current()->redirect('gift/shopping');
	}

	// view a freind's list
	public function action_friend() {
		$this->redirect_if_not_on_list();

		$this->template->title = 'View friend\'s circle';
		$list = new Model_List($this->request->param('id'));

		$view = View::factory('list/friend');
		$view->list = $list;
		$view->gifts = $list->gifts->find_all();
		$view->friends = $list->confirmed_friends()->find_all();
		$view->subscribed = $list->is_user_subscribed($this->me());
		$view->me = $this->me();

		if ($_POST) {
			$this->reserve_items($view);
		}

		$view->list_id = $this->request->param('id');
		$this->template->content = $view;
		$this->template->styles['static/css/engage.itoggle.css'] = 'screen';
		$this->template->scripts[] = 'static/js/engage.itoggle.js';
	}

	private function add_existing_friends_from_post(&$view, $list) {
		$added = 0;

		if (arr::get($_POST, 'id')) {
			foreach (arr::get($_POST, 'id') as $friend_id) {
				
				$friend = new Model_Friend((int) $friend_id);

				if (!$friend->loaded()) {
					$view->errors['existing'] = 'Could not find your friend.';
					break;
				}

				// TODO: make sure you created your friends

				$friend->add('lists', $list);
				$added++;
			}
		}

		return $added;
	}

	private function add_new_friends_from_post(&$view, $list) {
		$added = 0;
		$view->new_friends = array();
		$i = 0;
		$firstnames = arr::get($_POST, 'firstname', array());
		$surnames   = arr::get($_POST, 'surname',   array());
		$emails     = arr::get($_POST, 'email',     array());
		
		foreach ($firstnames as $firstname) {
			// would be nice if PHP could traverse multiple arrays in one foreach
			$surname = $surnames[$i];
			$email = $emails[$i];
			$i++;

			if (!strlen($firstname.$surname.$email)) {
				continue;
			}

			if (empty($firstname) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$view->new_friends[] = array($firstname, $surname, $email);
				$view->errors['new'] = 'Please enter a first name and a valid email address.';
				continue;
			}

			// already got a friend with this email
			if ($this->me('owner')->has_friend_with_email($email)) {
				$friend = new Model_Friend(array(
					'email'      => $email,
					'creator_id' => $this->me()->id,
				));

				if ($friend->is_on_list($list)) {
					Message::add('warning', $friend->firstname . ' ' . $friend->surname . ' is already on this list.');
					continue;
				}
			} else {
				$friend = new Model_Friend;
				$friend->creator   = $this->me();
				$friend->firstname = $firstname;
				$friend->surname   = $surname;
				$friend->email     = $email;
				$friend->save();
			}

			$friend->add('lists', $list);
			$added++;
		}

		return $added;
	}

	public function action_add_friend_wizard() {
		$this->redirect_if_not_owner();
		
		$list = new Model_List($this->request->param('id'));

		$view = $this->get_add_friend_view($list);
		$view->doing_wizard = true;

		$this->template->title = 'Add friends to my circle &raquo; ' . $list->name;
		$this->template->subtitle = 'Choose the friends and family you would like in your gift circle';

		if ($_POST) {
			$this->add_friends($view, 'gift/bookmarklet/' . $list->id);
		}

		$circle_ids = $view->circle->as_array('id');
		
		$me = new Model_Owner($this->me()->id);
		
		// friends not yet on the list
		$friends = $me->friends;
		if (count($circle_ids)) {
			$friends->where('id', 'NOT IN', $view->circle->as_array('id'));
		}
		$view->friends = $friends->find_all();

		$this->template->content = $view;

	}

	private function get_add_friend_view($list) {
		$view = View::factory('list/add_friend');
		$view->list = $list;
		
		// friends already on the list
		$view->circle = $list->friends->find_all();

		$view->errors = array();

		return $view;
	}

	private function add_friends($view, $redir) {
		$list = $view->list;
		
		$added = $this->add_existing_friends_from_post($view, $list);
		$added += $this->add_new_friends_from_post($view, $list);

		if ($added) {
			// mark the list as updated 
			// so it can send notifications
			$list->touch();

			Message::add('success', __('Successfully added ' . $added . ' friend(s).'));			
		}

		if ($added && empty($view->errors)) {
			Request::current()->redirect($redir);			
		}

		if (empty($view->errors)) {
			$view->errors['all'] = 'Please add some friends.';
		}
	}

	public function action_add_friend() {

		$this->redirect_if_not_owner();

		$list = new Model_List($this->request->param('id'));
		
		$view = $this->get_add_friend_view($list);
		$view->doing_wizard = false;

		$this->template->title = 'Add friends to my circle &raquo; ' . $list->name;
		$this->template->subtitle = 'Choose the friends and family you would like in your gift circle';

		if ($_POST) {
			$this->add_friends($view, 'list/mine/' . $list->id);
		}

		$circle_ids = $view->circle->as_array('id');
		
		$me = new Model_Owner($this->me()->id);
		
		// friends not yet on the list
		$friends = $me->friends;
		if (count($circle_ids)) {
			$friends->where('id', 'NOT IN', $view->circle->as_array('id'));
		}
		$view->friends = $friends->find_all();

		$this->template->content = $view;
	}

	public function action_delete() {
		// delete a list, its gifts and related friends
		$this->redirect_if_not_owner();

		$this->template->title = 'Delete circle';


		$list_id = $this->request->param('id');
		$list = new Model_List($list_id);

		$this->redirect_if_not_owner();

		if (arr::get($_POST, 'delete')) {
			$list->delete();		
			Message::add('success', 'Circle deleted.');
			Request::current()->redirect('list/all');
		}

		$view = View::factory('list/delete');
		$view->list = $list;
		$this->template->content = $view;		
	}

	public function action_delete_friend() {
		@list($list_id, $friend_id) = explode('-', $this->request->param('id'));

		$this->template->title = 'Confirm';

		if (!$list_id || !$friend_id) {
			Request::current()->redirect('user/noaccess');
		}

		$list = new Model_List($list_id);
		$friend = new Model_Friend($friend_id);

		if (arr::get($_POST, 'delete')) {
			$friend->remove('lists', $list);

			Message::add('success', 'Friend removed from list.');
			Request::current()->redirect('list/mine/' . $list->id);
		}

		$view = View::factory('list/delete-friend');
		$view->list = $list;
		$view->friend = $friend;
		$this->template->content = $view;		
	}

	public function action_unsubscribe() {
		$list_id = $this->request->param('id');
		$list = new Model_List($list_id);
		$this->redirect_if_not_on_list();

		if (!$list->is_user_subscribed($this->me())) {
			Message::add('danger', 'You are already unsubscribed from this list');
			Request::current()->redirect('list/friend/' . $list->id);
		}

		$me = new Model_Owner($this->me()->id);

		$me->unsubscribe_from_list($list);
		Message::add('success', 'Unsubscribed from this list');
		//Request::current()->redirect('list/friend/' . $list->id);
	}

	public function action_subscribe() {
		$list_id = $this->request->param('id');
		$list = new Model_List($list_id);
		$this->redirect_if_not_on_list();

		if ($list->is_user_subscribed($this->me())) {
			Message::add('danger', 'You are already subscribed to this list');
			Request::current()->redirect('list/friend/' . $list->id);
		}

		$me = new Model_Owner($this->me()->id);

		$me->subscribe_to_list($list);
		Message::add('success', 'Subscribed to this list');
		//Request::current()->redirect('list/friend/' . $list->id);
	}

}

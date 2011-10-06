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

		$this->template->title = 'My Lists';

		$view = View::factory('list/my');
		$me = ORM::factory('owner', $this->me()->id);

		$view->my_lists = $me->lists
			// TODO: this should be by created date
			->order_by('name', 'ASC')
			->find_all();
		
		$this->template->content = $view;
	}


	private function all_my_lists() {
		// get an array of all my lists, their total items and how many friends
		// they have

		$lists = ORM::factory('list')
			->where('owner_id', '=', $this->me())
			->find_all();
		
		$r = array();

		foreach ($lists as $list) {
			$total_items = $list->gifts->count_all();
			$total_friends = $list->friends->count_all();

			$list = $list->as_array();
			$list['total_items'] = $total_items;
			$list['total_friends'] = $total_friends;

			$r[] = (object) $list;
		}

		return $r;
	}

	private function friends_lists() {
		// get all the lists your email is on

		$email = $this->me()->email;
		$all_lists = array();
		
		// find all the "frriend" instances that you are
		$friends = ORM::factory('friend')
			->where('email', '=', $email)
			->find_all();


		foreach ($friends as $friend) {
			$lists = $friend->lists->find_all();
			foreach ($lists as $list) {
				$total_items = $list->gifts->count_all();
				$owner = $list->owner;

				$list = $list->as_array();
				$list['total_items'] = $total_items;				
				$list['owner'] = $owner;
				$all_lists[] = (object) $list;
			}
		}

		return $all_lists;
	}

	private function redirect_if_not_owner() {
		$list_id = $this->request->param('id');
		$list = new Model_List($list_id);

		if ($list->owner->id != $this->me()->id) {
			Request::current()->redirect('user/noaccess');
		}
	}

	private function my_shopping_list($include_bought = true) {
		$gifts = ORM::factory('gift')
			->where('reserver_id', '=', $this->me()->id);

		if (!$include_bought) {
			$gifts->where('buyer_id', '=', 0);
		}
		
		return $gifts->find_all();
	}


	public function action_all() {
		Request::current()->redirect('home/dashboard');
	}


	public function action_add() {
		$this->template->title = 'Add a list';
		
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

				$added = $this->add_existing_friends_from_post($view, $list);
				$added += $this->add_new_friends_from_post($view, $list);

				Message::add('success', __('Created new list with ' . $added . ' friends.'));
				Request::current()->redirect('list/mine/' . $list->id);
			}
			$view->errors = 'Please enter a list name';
		}
		$this->template->content = $view;
	}

	public function action_edit() {
		$this->redirect_if_not_owner();

		$list_id = $this->request->param('id');
		$list = new Model_List($list_id);


		$this->template->title = 'Edit list';
		$view = View::factory('list/edit');
		$view->list = $list;

		if ($_POST) {
			if (arr::get($_POST, 'name')) {
				$list->name = arr::get($_POST, 'name');
				$list->expiry = arr::get($_POST, 'expiry');
				$list->save();
				Message::add('success', __('List updated.'));
				Request::current()->redirect('list/mine/' . $list->id);
			}
			$view->errors = 'Please enter a list name';
		}
		$this->template->content = $view;
	}

	public function action_mine() {
		$this->redirect_if_not_owner();

		$this->template->title = 'View my list';

		$list = new Model_List($this->request->param('id'));

		$view = View::factory('list/mine');
		$view->list = $list;
		$view->gifts = $list->gifts->find_all();
		$view->friends = $list->friends->find_all();

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

	// view a freind's list
	public function action_friend() {
		$this->redirect_if_not_on_list();

		$this->template->title = 'View my friend\'s list';
		$list = new Model_List($this->request->param('id'));

		$view = View::factory('list/friend');
		$view->list = $list;
		$view->gifts = $list->gifts->find_all();
		$view->friends = $list->friends->find_all();
		$view->me = $this->me();

		if ($_POST) {
			if (arr::get($_POST, 'reserve')) {
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

				Message::add('success', __('Reserved ' . $reserved . ' gifts.'));
				Request::current()->redirect('gift/buy');
			}
			$view->errors = 'Please select some gifts to reserve';
		}

		$view->list_id = $this->request->param('id');
		$this->template->content = $view;
	}

	private function add_existing_friends_from_post(&$view, $list) {
		$added = 0;

		if (arr::get($_POST, 'id')) {
			foreach (arr::get($_POST, 'id') as $friend_id) {
				
				$friend = new Model_Friend((int) $friend_id);
				if (!$friend->loaded()) {
					$view->errors[] = 'Could not find your friend.';
					break;
				}

				$friend->add('lists', $list);
				$added++;
			}
		}

		return $added;
	}

	private function add_new_friends_from_post(&$view, $list) {
		$added = 0;

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

			// TODO: validate stuff, including dupes
			if (empty($firstname) || empty($surname) || empty($email)) {
				$view->errors[] = 'Please enter all friend details.';
				continue;
			}

			$friend = new Model_Friend;
			$friend->creator   = $this->me();
			$friend->firstname = $firstname;
			$friend->surname   = $surname;
			$friend->email     = $email;
			$friend->save();

			$friend->add('lists', $list);
			$added++;
		}

		return $added;
	}

	public function action_add_friend() {

		$this->redirect_if_not_owner();

		$this->template->title = 'Add friends to my list';

		$view = View::factory('list/add_friend');
		$list = new Model_List($this->request->param('id'));
		$view->list = $list;

		$me = new Model_Owner($this->me()->id);
		
		// friends already on the list
		$view->circle = $list->friends->find_all();
		$circle_ids = $view->circle->as_array('id');

		// friends not yet on the list
		$friends = $me->friends;
		if (count($circle_ids)) {
			$friends->where('id', 'NOT IN', $view->circle->as_array('id'));
		}
		$view->friends = $friends->find_all();
		
		$view->errors = array();

		if ($_POST) {
			$added = $this->add_existing_friends_from_post($view, $list);
			$added += $this->add_new_friends_from_post($view, $list);

			if ($added) {
				Message::add('success', __('Added ' . $added . ' friends.'));
				Request::current()->redirect('list/mine/' . $list->id);
			}

			$view->errors[] = 'Please add some friends.';
		}

		$this->template->content = $view;
	}

	public function action_delete() {
		// delete a list, its gifts and related friends
		$this->redirect_if_not_owner();

		$list_id = $this->request->param('id');
		$list = new Model_List($list_id);

		$this->redirect_if_not_owner();

		$gifts = $list->gifts->find_all();
		foreach ($gifts as $gift) {
			$gift->delete();
		}

		$friends = $list->friends->find_all();
		foreach ($friends as $friend) {
			$friend->delete();
		}

		$list->delete();		

		Message::add('success', 'List deleted.');
		Request::current()->redirect('list/all');
	}

	public function action_delete_friend() {
		@list($list_id, $friend_id) = explode('-', $this->request->param('id'));

		if (!$list_id || !$friend_id) {
			Request::current()->redirect('user/noaccess');
		}

		$list = new Model_List($list_id);
		$friend = new Model_Friend($friend_id);
		$friend->remove('lists', $list);

		// TODO: maybe delete their reservations or purchases

		Message::add('success', 'Friend removed from list.');
		Request::current()->redirect('list/mine/' . $list->id);

	}


}

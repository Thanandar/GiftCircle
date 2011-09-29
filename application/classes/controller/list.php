<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List extends Controller_Page {

	public function before() {
		if (!$this->me()->id) {
			Request::current()->redirect('');
		}		
		parent::before();
	}

	public function action_index() {
		Request::current()->redirect('');
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


	public function action_all() {
		if (!$this->me()->id) {
			Request::current()->redirect('');
		}

		$this->template->title = 'Home';

		$view = View::factory('list/all');
		$view->all_mine = View::factory('list/all-mine')
			->set('lists', $this->all_my_lists());

		$view->all_friends = View::factory('list/all-friends')
			->set('lists', $this->friends_lists());

		$view->all_shopping = View::factory('list/all-shopping');

		$this->template->content = $view;
	}


	public function action_add() {
		$this->template->title = 'Add a list';

		$view = View::factory('list/add');

		if ($_POST) {
			if (arr::get($_POST, 'name')) {
				$list = new Model_List;
				$list->owner_id = $this->me()->id;
				$list->name = arr::get($_POST, 'name');
				$list->save();
				Message::add('success', __('List added.'));
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

	public function action_friend() {
		$this->redirect_if_not_on_list();

		$this->template->title = 'View my friend\'s list';
		$list = new Model_List($this->request->param('id'));

		$view = View::factory('list/friend');
		$view->list = $list;
		$view->gifts = $list->gifts->find_all();
		$view->friends = $list->friends->find_all();

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

	public function action_add_friend() {
		$this->redirect_if_not_owner();

		$this->template->title = 'Add friends to my list';

		$view = View::factory('list/add_friend');
		$list = new Model_List($this->request->param('id'));
		$view->list = $list;

		$me = new Model_Owner($this->me()->id);
		$view->friends = $me->friends->find_all();
		
		$view->circle = $list->friends->find_all();
		
		$view->errors = array();

		if ($_POST) {
			$added = 0;
			//print_r(arr::get($_POST, 'firstname'));
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

			if ($added) {
				Message::add('success', __('Added ' . $added . ' friends.'));
				Request::current()->redirect('list/mine/' . $list->id);
			}

			$view->errors[] = 'Please add some friends.';
		}

		$this->template->content = $view;
	}

	public function action_delete() {
		$list_id = $this->request->param('id');
		$list = new Model_List($list_id);

		$this->redirect_if_not_owner();

		// TODO: maybe delete all gifts

		$list->delete();		
		Message::add('success', 'List deleted.');
		Request::current()->redirect('list/all');
	}




}

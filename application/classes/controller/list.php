<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List extends Controller_Page {

	public function action_index() {
		Request::current()->redirect('');
	}

	private function all_my_lists() {
		$lists = ORM::factory('list')
			->where('owner_id', '=', $this->me())
			->find_all();
		
		return $lists;
	}

	private function redirect_if_not_owner() {
		$list_id = $this->request->param('id');
		$list = new Model_List($list_id);

		if ($list->owner->id != $this->me()->id) {
			Request::current()->redirect('user/noaccess');
		}
	}


	public function action_all() {
		$this->template->title = 'Home';

		$view = View::factory('list/all');
		$view->all_mine = View::factory('list/all-mine')
			->set('lists', $this->all_my_lists());

		$view->all_friends = View::factory('list/all-friends');
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
		$this->template->title = 'View my list';

		$list = new Model_List($this->request->param('id'));
		if ($list->owner->id != $this->me()->id) {
			Request::current()->redirect('user/noaccess');
		}

		$gifts = ORM::factory('gift')
			->where('list_id', '=', $list)
			->find_all();

		$view = View::factory('list/mine');
		$view->list = $list;
		$view->gifts = $gifts;
		
		$this->template->content = $view;
	}

	public function action_friend() {
		$this->template->title = 'View my friend\'s list';

		$view = View::factory('list/friend');

		if ($_POST) {
			if (arr::get($_POST, 'reserve')) {
				Message::add('success', __('Gifts reserved.'));
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

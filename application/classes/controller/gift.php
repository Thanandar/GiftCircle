<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Gift extends Controller_Page {

	// make sure user is logged in
	public function before() {
		if (!$this->me()->id) {
			Request::current()->redirect('');
		}		
		parent::before();
	}

	private function redirect_if_not_owner() {
		$gift_id = $this->request->param('id');
		$gift = new Model_Gift($gift_id);

		if ($gift->list->owner->id != $this->me()->id) {
			Request::current()->redirect('user/noaccess');
		}
	}

	public function action_index() {
		Request::current()->redirect('');
	}
	
	public function action_add() {

		$this->template->title = 'Add gift';

		$list_id = $this->request->param('id');
		$list = new Model_List($list_id);
		
		if ($list->owner->id != $this->me()->id) {
			Request::current()->redirect('user/noaccess');
		}

		$view = View::factory('gift/add');
		$view->list = $list;

		if ($_POST) {
			if (arr::get($_POST, 'name')) {
				$gift              = new Model_Gift;
				$gift->list_id     = $list->id;
				$gift->name        = arr::get($_POST, 'name');
				$gift->price       = arr::get($_POST, 'price');
				$gift->url         = arr::get($_POST, 'url');
				$gift->category_id = arr::get($_POST, 'category_id');
				$gift->details     = arr::get($_POST, 'details');
				$gift->save();
				
				Message::add('success', __('Gift added.'));
				Request::current()->redirect('list/mine/' . $list->id);
			}
			$view->errors = 'Please enter a product title';
		}
		$this->template->content = $view;
	}

	public function action_edit() {
		$this->redirect_if_not_owner();

		$gift = new Model_Gift($this->request->param('id'));

		$this->template->title = 'Edit gift';
		$view = View::factory('gift/edit');

		$view->gift = $gift;

		if ($_POST) {
			if (arr::get($_POST, 'name')) {
				$gift->name        = arr::get($_POST, 'name');
				$gift->price       = arr::get($_POST, 'price');
				$gift->url         = arr::get($_POST, 'url');
				$gift->category_id = arr::get($_POST, 'category_id');
				$gift->details     = arr::get($_POST, 'details');
				$gift->save();
				Message::add('success', __('Gift updated.'));
				Request::current()->redirect('list/mine/' . $gift->list->id);
			}
			$view->errors = 'Please enter a product title';
		}
		$this->template->content = $view;
	}

	public function action_delete() {
		$gift_id = $this->request->param('id');
		$gift = new Model_Gift($gift_id);

		$this->redirect_if_not_owner();

		$list_id = $gift->list->id;
		$gift->delete();		
		Message::add('success', 'Gift deleted.');
		Request::current()->redirect('list/mine/' . $list_id);
	}

	public function action_browse() {
		$list = new Model_List($this->request->param('id'));
		if ($list->owner_id != $this->me()->id) {
			Request::current()->redirect('user/noaccess');
		}

		$this->template->title = 'Browse for a gift';
		$view = View::factory('gift/browse');
		$view->list = $list;
		$this->template->content = $view;
	}

	private function get_my_first_gift() {
		$gifts = new Model_Gift;
		$gifts
			->where('reserver_id', '=', $this->me()->id)
			->where('buyer_id', '=', '0');
		return $gifts->find_all();
	}

	public function action_buy() {
		if (!$this->request->param('id')) {
			$gifts = $this->get_my_first_gift();
			if (count($gifts)) {
				Request::current()->redirect('gift/buy/' . $gifts[0]->id);
			}

			Message::add('danger', __('You have no gifts to buy.'));
			Request::current()->redirect('');
		} else {
			$gift = new Model_Gift((int) $this->request->param('id'));
		}

		if ($gift->reserver_id != $this->me()->id) {
			Message::add('danger', __('You have not reserved this gift.'));
			Request::current()->redirect('');
		} 

		if ($gift->buyer_id) {
			Message::add('success', __('This gift has already been bought.'));
			Request::current()->redirect('');
		}


		$this->template->title = 'Buy a gift';
		$view = View::factory('gift/buy');
		$view->gift = $gift;
		$view->shopping_list = ORM::factory('gift')
			->where('reserver_id', '=', $this->me()->id)
			->where('buyer_id', '=', '0')
			->find_all();

		$this->template->content = $view;
	}

} 

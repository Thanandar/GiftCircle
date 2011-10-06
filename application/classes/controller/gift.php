<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Gift extends Controller_Page {

	// make sure user is logged in
	public function before() {
		if (!$this->me()->id) {
			Request::current()->redirect('');
		}		
		parent::before();
	}

	public function action_shopping() {
		if (!$this->me()->id) {
			Request::current()->redirect('');
		}

		$this->template->title = 'My Shopping List';

		$view = View::factory('gift/shopping');
		$me = ORM::factory('owner', $this->me()->id);

		$view->my_shopping_list = $me->shopping_list();
		
		$this->template->content = $view;
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

		$view->categories = ORM::factory('category')
			->find_all()
			->as_array('id', 'name');

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
				
				Message::add('success', Kohana::message('gift', 'added'));
				Request::current()->redirect('list/mine/' . $list->id);
			}
			$view->errors = Kohana::message('gift', 'title-required');
		}
		$this->template->content = $view;
	}

	public function action_edit() {
		$this->redirect_if_not_owner();

		$gift = new Model_Gift($this->request->param('id'));

		$this->template->title = 'Edit gift';
		$view = View::factory('gift/edit');

		$view->gift = $gift;

		$view->categories = ORM::factory('category')
			->find_all()
			->as_array('id', 'name');

		if ($_POST) {
			if (arr::get($_POST, 'name')) {
				$gift->name        = arr::get($_POST, 'name');
				$gift->price       = arr::get($_POST, 'price');
				$gift->url         = arr::get($_POST, 'url');
				$gift->category_id = arr::get($_POST, 'category_id');
				$gift->details     = arr::get($_POST, 'details');
				$gift->save();
				Message::add('success', Kohana::message('gift', 'updated'));
				Request::current()->redirect('list/mine/' . $gift->list->id);
			}
			$view->errors = Kohana::message('gift', 'title-required');
		}
		$this->template->content = $view;
	}

	public function action_delete() {
		$gift_id = $this->request->param('id');
		$gift = new Model_Gift($gift_id);

		$this->redirect_if_not_owner();

		$list_id = $gift->list->id;
		$gift->delete();		
		Message::add('success', Kohana::message('gift', 'deleted'));
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
		$view->shops = ORM::factory('shop')->find_all();
		$this->template->content = $view;
	}

	private function get_my_first_gift() {
		$gifts = $this->shopping_list();
		return count($gifts) ? $gifts[0] : null;
	}

	public function action_buy() {
		if (!$this->request->param('id')) {
			$gift = $this->get_my_first_gift();
			if ($gift) {
				Request::current()->redirect('gift/buy/' . $gift->id);
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
		$view->shops = ORM::factory('shop')->find_all();
		
		$view->shopping_list = $this->shopping_list();

		$this->template->content = $view;
	}

	public function action_bought() {
		$gift = new Model_Gift((int) $this->request->param('id'));

		if ($gift->reserver_id != $this->me()->id) {
			Message::add('danger', __('You have not reserved this gift.'));
			Request::current()->redirect('');
		} 

		if ($gift->buyer_id) {
			Message::add('success', __('This gift has already been bought.'));
			Request::current()->redirect('');
		}

		$gift->buyer_id = $gift->reserver_id;
		$gift->save();

		$this->template->title = 'Bought gift';
		$view = View::factory('gift/bought');
		$view->gift = $gift;

		$view->shopping_list = $this->shopping_list();

		$this->template->content = $view;
	}

	public function action_unreserve() {
		$gift = new Model_Gift((int) $this->request->param('id'));

		if ($gift->reserver_id != $this->me()->id) {
			Message::add('danger', __('You have not reserved this gift.'));
			Request::current()->redirect('');
		} 

		if ($gift->buyer_id) {
			Message::add('success', __('This gift has already been bought.'));
			Request::current()->redirect('');
		}

		$gift->reserver_id = 0;
		$gift->save();

		Message::add('success', __('Successfully un-reserved a gift.'));
		Request::current()->redirect('');
	}


	public function action_to_buy() {
		$this->template_extras = false;
		$this->template = View::factory('template/empty');

		$this->template->title = 'My shopping list';

		$gifts = $this->shopping_list();

		$view = View::factory('gift/to_buy')
			->set('gifts', $gifts);
		
		$this->template->content = $view;
		//$this->request->response = $view;
	}


	private function shopping_list() {
		// TODO: this should be in the model
		return ORM::factory('gift')
			->where('reserver_id', '=', $this->me()->id)
			->where('buyer_id', '=', 0)
			->find_all();
	}

} 

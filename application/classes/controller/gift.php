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

		$this->template->title = 'Shopping List';
		$this->template->subtitle = 'All the gifts you\'ve bought and need to buy for friends and family';

		$view = View::factory('gift/shopping');
		$me = ORM::factory('owner', $this->me()->id);

		$view->my_shopping_list = $me->shopping_list();
		$view->my_bought_list = $me->bought_list();
		
		$view->total_to_buy = 0;
		foreach ($view->my_shopping_list as $gift) {
			if ((float) $gift->price) {
				$view->total_to_buy += (float) $gift->price;
			}
		}

		$view->total_bought = 0;
		foreach ($view->my_bought_list as $gift) {
			if ((float) $gift->price || (float) $gift->bought_price) {
				$view->total_bought += (float) ($gift->bought_price ? $gift->bought_price : $gift->price);
			}
		}

		if (isset($_POST['budget'])) {
			$me->budget = (float) str_replace(',', '', $_POST['budget']);
			$me->save();
		}

		$view->budget = (int) $me->budget;
		$view->budget_left = $view->budget - ($view->total_to_buy + $view->total_bought);

		$this->template->content = $view;
	}

	public function action_bookmarklet() {
		$this->template->title = 'Browser Button';
		$this->template->subtitle = 'Get the Browser Button to make adding gifts easy';

		$view = View::factory('gift/bookmarklet');
		$view->list_id = $this->request->param('id');
		
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


		$list_id = $this->request->param('id');
		$list = new Model_List($list_id);
		$this->template->title = 'Add gifts to your list: ' . $list->name;
		
		if ($list->owner->id != $this->me()->id) {
			Request::current()->redirect('user/noaccess');
		}

		$view = View::factory('gift/add');
		$view->list = $list;

		$view->other_gifts = $list->gifts->find_all();

		$view->categories = ORM::factory('category')
			->order_by('name', 'ASC')
			->find_all()
			->as_array('id', 'name');

		// what's this for?
		$view->departments = ORM::factory('category')
			->order_by('name', 'ASC')
			->find_all();

		$view->shops = ORM::factory('shop')->find_all();

		$view->errors = array();

		if ($_POST) {
			if (arr::get($_POST, 'name') && arr::get($_POST, 'category_id')) {
				$gift              = new Model_Gift;
				$gift->list_id     = $list->id;
				$gift->name        = arr::get($_POST, 'name');
				$gift->price       = arr::get($_POST, 'price');
				$gift->url         = arr::get($_POST, 'url');
				$gift->category_id = arr::get($_POST, 'category_id');
				$gift->details     = arr::get($_POST, 'details');
				$gift->save();
				
				Message::add('success', 'Successfully added gift');
				Request::current()->redirect('list/mine/' . $list->id);
			}

			if (!arr::get($_POST, 'name')) {
				$view->errors['name'] = Kohana::message('gift', 'title-required');
			}
			if (!arr::get($_POST, 'category_id')) {
				$view->errors['cat'] ='Please select a category';
			}
		}
		$this->template->content = $view;
	}

	public function action_edit() {
		$this->redirect_if_not_owner();

		$gift = new Model_Gift($this->request->param('id'));

		$this->template->title = 'Edit gift';
		$view = View::factory('gift/edit');

		$view->gift = $gift;

		$view->other_gifts = $gift->list->gifts->find_all();

		$view->categories = ORM::factory('category')
			->order_by('name', 'ASC')
			->find_all()
			->as_array('id', 'name');

		$view->errors = array();

		if ($_POST) {
			if (arr::get($_POST, 'name') && arr::get($_POST, 'category_id')) {
				$gift->name        = arr::get($_POST, 'name');
				$gift->price       = arr::get($_POST, 'price');
				$gift->url         = arr::get($_POST, 'url');
				$gift->category_id = arr::get($_POST, 'category_id');
				$gift->details     = arr::get($_POST, 'details');
				$gift->save();
				Message::add('success', Kohana::message('gift', 'updated'));
				Request::current()->redirect('list/mine/' . $gift->list->id);
			}

			if (!arr::get($_POST, 'name')) {
				$view->errors['name'] = Kohana::message('gift', 'title-required');
			}
			if (!arr::get($_POST, 'category_id')) {
				$view->errors['cat'] ='Please select a category';
			}
		}
		$this->template->content = $view;
	}

	public function action_delete() {
		$this->template->title = 'Remove a gift';
		$this->template->subtitle = 'Confirm you want to remove this gift from your list';

		$gift_id = $this->request->param('id');
		$gift = new Model_Gift($gift_id);

		$this->redirect_if_not_owner();

		$list_id = $gift->list->id;

		if (arr::get($_POST, 'delete')) {
			$gift->delete();		
			Message::add('success', Kohana::message('gift', 'deleted'));
			Request::current()->redirect('list/mine/' . $list_id);
		}

		$view = View::factory('gift/delete');
		$view->gift = $gift;
		$this->template->content = $view;
	}

	/**
	 * @deprecated Merged into action_add()
	 */
	public function action_browse() {
		$list = new Model_List($this->request->param('id'));
		if ($list->owner_id != $this->me()->id) {
			Request::current()->redirect('user/noaccess');
		}

		$this->template->title = 'Browse for gifts';
		$view = View::factory('gift/browse');
		$view->list = $list;
		$view->shops = ORM::factory('shop')->find_all();
		$view->other_gifts = $list->gifts->find_all();


		$view->categories = ORM::factory('category')
			->order_by('name', 'ASC')
			->find_all()
			->as_array('id', 'name');

		$view->departments = ORM::factory('category')
			->find_all();

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

		if (!$gift->reserver_id) {
			Request::current()->redirect('gift/details/' . $gift->id);
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
		$view->shops = $gift->category->shops->order_by('orderfield', 'DESC')->order_by('name', 'ASC')->find_all();
		
		$view->shopping_list = $this->shopping_list();

		$this->template->content = $view;
	}

	/**
	 * View the details of a gift no one has reserved
	 */
	public function action_details() {
		$gift = new Model_Gift((int) $this->request->param('id'));
		
		if (!$gift->loaded()) {
			Request::current()->redirect('gift/shopping');
		}

		if ($gift->reserver_id) {
			// gift has been reserved

			if ($gift->reserver_id != $this->me()->id) {
				// reserved someone else
				Message::add('danger', __('Someone else has reserved this gift.'));
				Request::current()->redirect('gift/shopping');
			}

			// you have not bought it yet
			if (!$gift->buyer_id) {
				Request::current()->redirect('gift/buy/' . $gift->id);
			}
		}

		$this->template->title = 'Gift Details';
		$view = View::factory('gift/details');
		$view->gift = $gift;
		$view->shops = $gift->category->shops->order_by('orderfield', 'DESC')->order_by('name', 'ASC')->find_all();
		
		$view->shopping_list = $this->shopping_list();

		$this->template->content = $view;
	}

	public function action_mark_as_bought() {
		$gift = new Model_Gift((int) $this->request->param('id'));

		if ($gift->reserver_id != $this->me()->id) {
			Message::add('danger', __('You have not reserved this gift.'));
			Request::current()->redirect('');
		} 

		if ($gift->buyer_id) {
			Message::add('success', __('This gift has already been bought.'));
			Request::current()->redirect('');
		}

		if (arr::get($_POST, 'bought')) {
			$gift->buyer_id = $gift->reserver_id;
			$gift->save();

			// automnatically unsubscribe from list
			$me = new Model_Owner($this->me()->id);
			$me->unsubscribe_from_list($gift->list);
			
			Message::add('success', __('This gift has been marked as bought.'));
			Request::current()->redirect('gift/shopping');
		}

		$this->template->title = 'Confirm';
		$view = View::factory('gift/mark-as-bought');
		$view->gift = $gift;
		$this->template->content = $view;
	}

	public function action_bought() {
		$gift = new Model_Gift((int) $this->request->param('id'));

		if ($gift->reserver_id != $this->me()->id) {
			Message::add('danger', __('You have not reserved this gift.'));
			Request::current()->redirect('');
		} 

		if ($gift->buyer_id != $this->me()->id) {
			Message::add('success', __('This gift has not been bought.'));
			Request::current()->redirect('');
		}


		$this->template->title = 'Bought gift';
		$view = View::factory('gift/bought');
		$view->gift = $gift;

		$view->list = $gift->list;

		$view->previously_subscribed = $view->list->is_logged_in_user_subscribed();


		$view->shopping_list = $this->shopping_list();

		$this->template->content = $view;
	}

	public function action_unreserve() {
		$gift = new Model_Gift((int) $this->request->param('id'));
		$list = $gift->list;

		if ($gift->reserver_id != $this->me()->id) {
			Message::add('danger', __('You have not reserved this gift.'));
			Request::current()->redirect('');
		} 

		if ($gift->buyer_id) {
			Message::add('success', __('This gift has already been bought.'));
			Request::current()->redirect('');
		}

		if (arr::get($_POST, 'unreserve')) {
			$gift->reserver_id = 0;
			$gift->save();

			Message::add('success', __('Successfully removed a gift from your shopping list.'));
			Request::current()->redirect('gift/shopping');
		}

		$this->template->title = 'Confirm';
		$view = View::factory('gift/unreserve');
		$view->gift = $gift;
		$this->template->content = $view;
	}

	public function action_reserve() {
		$gift = new Model_Gift((int) $this->request->param('id'));
		$list = $gift->list;

		if ($gift->reserver_id) {
			Message::add('danger', __('This gift has already been reserved'));
			Request::current()->redirect('');
		} 

		$gift->reserver_id = $this->me()->id;
		$gift->save();

		Message::add('success', __('Successfully reserved a gift.'));
		Request::current()->redirect('gift/buy/' . $gift->id);
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
			->order_by('name')
			->find_all();
	}

	public function action_clear() {
		$gift = new Model_Gift((int) $this->request->param('id'));

		if ($gift->reserver_id != $this->me()->id || $gift->reserver_id != $gift->buyer_id) {
			Message::add('danger', __('You have not bought this gift.'));
			Request::current()->redirect('');
		} 

		if ($gift->loaded() && arr::get($_POST, 'clear')) {
			$gift->cleared = 1;
			$gift->save();

			Message::add('success', __('Successfully cleared a gift.'));
			Request::current()->redirect('gift/shopping');
		}

		$this->template->title = 'Confirm';
		$view = View::factory('gift/clear');
		$view->gift = $gift;
		$this->template->content = $view;

	}

	public function action_prices() {
		// update multiple gift prices

		if (empty($_POST['price']) || !is_array($_POST['price'])) {
			Message::add('danger', __('No prices to update.'));
			Request::current()->redirect('gift/shopping');
		}
		
		foreach ($_POST['price'] as $gift_id => $price) {

			$gift = new Model_Gift((int) $gift_id);

			if (!$gift->loaded() || $gift->reserver_id != $this->me()->id || $gift->reserver_id != $gift->buyer_id) {
				Message::add('danger', __('You have not bought this gift.'));
				Request::current()->redirect('');
			} 

			$gift->bought_price = (float) $price;
			$gift->save();
			
		}

		Message::add('success', __('Successfully updated gift prices.'));
		Request::current()->redirect('gift/shopping');
	}

} 

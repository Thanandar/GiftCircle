<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Gift extends Controller_Page {

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
				$gift->save();
				
				Message::add('success', __('Gift added.'));
				Request::current()->redirect('list/mine/' . $list->id);
			}
			$view->errors = 'Please enter a product title';
		}
		$this->template->content = $view;
	}

	public function action_edit() {
		$this->template->title = 'Edit gift';
		$view = View::factory('gift/edit');

		$view->gift_id = $this->request->param('id');


		if ($_POST) {
			if (arr::get($_POST, 'title')) {
				Message::add('success', __('Gift updated.'));
				Request::current()->redirect('list/mine/2');
			}
			$view->errors = 'Please enter a product title';
		}
		$this->template->content = $view;
	}

	public function action_delete() {
		$gift_id = $this->request->param('id');
		$gift = new Model_Gift($gift_id);

		if ($gift->list->owner->id != $this->me()->id) {
			Request::current()->redirect('user/noaccess');
		}
		
		$list_id = $gift->list->id;
		$gift->delete();		
		Message::add('success', 'Gift deleted.');
		Request::current()->redirect('list/mine/' . $list_id);
	}

	public function action_browse() {
		$this->template->title = 'Browse for a gift';
		$view = View::factory('gift/browse');

		$this->template->content = $view;
	}

	public function action_buy() {
		$this->template->title = 'Buy a gift';
		$view = View::factory('gift/buy');
		$view->gift_id = $this->request->param('id');

		$this->template->content = $view;
	}

} 

<?php defined('SYSPATH') or die('No direct script access.');

class Controller_List extends Controller {

	public function action_view() {
		$id = $this->request->param('id');
		$this->response->body('viewing list id:' . $id);
		//$this->response->body(View::factory('helloworld'));
	}

	public function action_add() {
		$view = View::factory('list/add');

		if ($_POST) {
			if (arr::get($_POST, 'name')) {
				Request::current()->redirect('list/mine/1');
			}
			$view->errors = 'Please enter a list name';
		}
		$this->response->body($view);
	}

	public function action_mine() {
		$view = View::factory('list/mine');
		$view->list_id = $this->request->param('id');
		$this->response->body($view);
	}

	public function action_friend() {
		$view = View::factory('list/friend');

		if ($_POST) {
			if (arr::get($_POST, 'reserve')) {
				Request::current()->redirect('gift/buy/1');
			}
			$view->errors = 'Please select some gifts to reserve';
		}

		$view->list_id = $this->request->param('id');
		$this->response->body($view);
	}

}

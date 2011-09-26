<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller {

	public function action_register() {
		// must be not logged in
		$this->response->body(View::factory('user/register'));
		//$this->response->body('register. <a href="/user/register_success">submit</a>');
		//$this->response->body(View::factory('helloworld'));
	}

	public function action_register_success() {
		$this->response->body('you can now log in <a href="/">home</a>');
		//$this->response->body(View::factory('helloworld'));
	}

	public function action_login() {
		$this->response->body('<a href="/user/login_success">login</a>');

		$view = View::factory('user/login');

		if ($_POST) {
			// Try to login
			// if (Auth::instance()->login(arr::get($_POST, 'username'), arr::get($_POST, 'password'))) {
			// 	Request::current()->redirect('user/action_login_success');
			// }
			if (arr::get($_POST, 'email')) {
				Request::current()->redirect('user/login_success');
			}

			$view->errors = 'Invalid email or password';
		}

		$this->response->body($view);


		//$this->response->body(View::factory('helloworld'));
	}

	public function action_login_success() {
		// TODO: set login session stuff
		Request::current()->redirect('home/index');
	}

	public function action_view_lists() {
		// must be logged in
		$this->response->body(View::factory('user/view_lists'));
	}

	public function action_friends() {
		// must be logged in
		$this->response->body(View::factory('user/friends'));
	}

}

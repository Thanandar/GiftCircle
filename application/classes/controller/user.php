<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller {

	public function action_register() {
		$view = View::factory('user/register');
		if ($_POST) {
			if (arr::get($_POST, 'email')) {
				Request::current()->redirect('user/register_success');
			}
			$view->errors = 'Please supply an email address';
		}
		$this->response->body($view);
	}

	public function action_register_success() {
		Request::current()->redirect('home/index');
		//$this->response->body('you can now log in <a href="/">home</a>');
		//$this->response->body(View::factory('helloworld'));
	}

	public function action_login() {
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

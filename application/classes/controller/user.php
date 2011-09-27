<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Page {

	public function action_index() {
		Request::current()->redirect('');
	}
	
	public function action_register() {
		$this->template->title = 'Register';

		$view = View::factory('user/register');
		if ($_POST) {
			if (arr::get($_POST, 'email')) {
				Request::current()->redirect('user/register_success');
			}
			$view->errors = 'Please supply an email address';
		}

		$this->template->content = $view;
	}

	public function action_register_success() {
		Request::current()->redirect('');
	}

	public function action_login() {
		$this->template->title = 'Login';
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

		$this->template->content = $view;
	}

	public function action_login_success() {
		// TODO: set login session stuff
		Request::current()->redirect('');
	}

	public function action_view_lists() {
		$this->template->title = 'Home';

		$this->template->content = View::factory('user/view_lists');
	}



}

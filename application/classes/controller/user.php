<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Useradmin_Controller_User /*Controller_Page*/ {

	public $template = 'template';

	public function action_index() {
		Request::current()->redirect('');
	}
	
	public function action_register() {
		if (!empty($_POST['email'])) {
			$_POST['username'] = $_POST['email'];
		}
		parent::action_register();

	}

	public function action_register_success() {
		Request::current()->redirect('');
	}

	public function action_logout() {
		$auth = Auth::instance();
		$auth->logout();
		Message::add('alert-message success', 'You have been logged out');
		Request::current()->redirect('');
	}

	public function xaction_login() {
		$this->template->title = 'Login';
		$view = View::factory('user/login');

		if ($_POST) {
			// Try to login

			$pass = arr::get($_POST, 'password');
			$user = arr::get($_POST, 'email');

			if (!$pass) {
				$view->errors = 'Please enter your password';
			}

			if (!$user) {
				$view->errors = 'Please enter a valid email';
			}

			if (empty($view->errors)) {
				if ( Auth::instance()->login($user, $pass)) {
					Request::current()->redirect('user/login_success');
				} else {
					$view->errors = 'Invalid email or password';
				}
			}

			// if (arr::get($_POST, 'email') && arr::get($_POST, 'password')) {
				
			// 	Request::current()->redirect('user/login_success');
			// }

		}

		$this->template->content = $view;
	}

	public function action_login_success() {
		//$auth = Auth::instance();
		//$auth->force_login('admin');
		// TODO: set login session stuff
		//var_dump(Auth::instance()->get_user());die();
		Request::current()->redirect('');
	}

	public function action_view_lists() {
		$this->template->title = 'Home';

		$this->template->content = View::factory('user/view_lists');
	}



}

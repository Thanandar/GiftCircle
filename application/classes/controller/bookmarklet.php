<?php

//make a new listtransaction whenever doing somehing with a list

class Controller_Bookmarklet extends Controller_Page {

	public $template = 'iframe';

	public function action_index() {
		if (!empty($_GET['u'])) {
			// save the URL for JS
			setcookie('bmu', $_GET['u']);
		}

		if ($this->is_test()) {
			$this->action_test();
		} else {
			if (Auth::instance()->logged_in()) {
				$this->action_add_gift();
			} else {
				$this->action_login();
			}			
		}

	}

	private function is_test() {
		return (
			strpos(@$_GET['u'], 'gift-circle') || 
			strpos(@$_GET['u'], 'giftcircle')
		);
	}

	public function action_add_gift() {
		$this->template->content = View::factory('bookmarklet/add_gift');;
	}

	public function action_login() {
		// set the template title (see Controller_App for implementation)
		$this->template->title = __('Login');
		// If user already signed-in
		if (Auth::instance()->logged_in() != 0)
		{
			// redirect to the user account
			$this->request->redirect(Session::instance()->get_once('returnUrl','bookmarklet/index'));
		}
		$view = View::factory('bookmarklet/login');
		// If there is a post and $_POST is not empty
		if ($_REQUEST && isset($_REQUEST['username'], $_REQUEST['password']))
		{
			// Check Auth if the post data validates using the rules setup in the user model
			if (Auth::instance()->login($_REQUEST['username'], $_REQUEST['password'],
                                        Arr::get($_REQUEST,'remember',false)!=false)
            ){
				// redirect to the user account
				$this->request->redirect(Session::instance()->get_once('returnUrl','bookmarklet/index'));
				return;
			}
			else
			{
				$view->set('username', $_REQUEST['username']);
				// Get errors for display in view
				$validation = Validation::factory($_REQUEST)
					->rule('username', 'not_empty')
					->rule('password', 'not_empty');
				if ($validation->check())
				{
					$validation->error('password', 'invalid');
				}
				$view->set('errors', $validation->errors('login'));
			}
		}
		// allow setting the username as a get param
		if (isset($_GET['username']))
		{
			$view->set('username', htmlspecialchars($_GET['username']));
		}
		$providers = Kohana::$config->load('useradmin.providers');
		$view->set('facebook_enabled', 
		isset($providers['facebook']) ? $providers['facebook'] : false);
		$this->template->content = $view;

	}

	public function action_test() {
		$this->template->content = View::factory('bookmarklet/test');
	}

}


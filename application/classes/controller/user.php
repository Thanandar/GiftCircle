<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Useradmin_Controller_User /*Controller_Page*/ {

	public $template = 'template';

	public function before() {
		 Session::instance()->set('returnUrl','');
		 parent::before();
	}

	public function action_login() {
		if (Auth::instance()->logged_in()) {
			Request::current()->redirect('home/dashboard');
		}

		$this->template->title = 'Login';
		$this->template->subtitle = 'Access your free account below.';
		return parent::action_login();
	}

	public function action_view_lists() {
		Request::current()->redirect('home/dashboard');
	}

	/**
	 * View: Profile editor
	 */
	public function action_profile_edit() {
		if (!empty($_POST['email'])) {
			$_POST['username'] = $_POST['email'];
		}

		// set the template title (see Controller_App for implementation)
		$this->template->title = __('Edit your profile');
		$user = Auth::instance()->get_user();
		$id = $user->id;
		// load the content from view
		$view = View::factory('user/profile_edit');
		// save the data
		if (! empty($_POST) && is_numeric($id))
		{
			
			$_POST['marketing'] = (int) @$_POST['marketing'];
			
			if (!empty($_POST['dob'])) {
				$_POST['dob'] = str_replace('/', '-', $_POST['dob']);
				$_POST['dob'] = date('Y-m-d', strtotime($_POST['dob']));
			}
//print_r($_POST);die();
			if (empty($_POST['password']) || empty($_POST['password_confirm']))
			{
				// force unsetting the password! Otherwise Kohana3 will automatically hash the empty string - preventing logins
				unset($_POST['password'], $_POST['password_confirm']);
			}
			try
			{
				$user->update_user($_POST, 
				array(
					'firstname', 
					'surname', 
					'username', 
					'password', 
					'email',
					'marketing',
					'dob',
				));
				// message: save success
				Message::add('success', __('Successfully updated details'));
				// redirect and exit
				$this->request->redirect('user/profile');
				return;
			}
			catch (ORM_Validation_Exception $e)
			{
				// Get errors for display in view
				// Note how the first param is the path to the message file (e.g. /messages/register.php)
				Message::add('error', __('Error: Values could not be saved.'));
				$errors = $e->errors('register');
				$errors = array_merge($errors, ( isset($errors['_external']) ? $errors['_external'] : array() ));
				$view->set('errors', $errors);
				// Pass on the old form values
				$user->password = '';
				$view->set('data', $user->as_array());
			}
		}
		else
		{
			// load the information for viewing
			$view->set('data', $user->as_array());
		}
		// retrieve roles into array
		$roles = array();
		foreach ($user->roles->find_all() as $role)
		{
			$roles[$role->name] = $role->description;
		}
		$view->set('user_roles', $roles);
		$view->set('id', $id);
		$this->template->content = $view;
	}

	/**
	 * Register a new user.
	 */
	public function action_register() {

		$this->template->title = 'Sign up';
		$this->template->subtitle = 'Register for your free account below. You\'ll be up and running in no time.';

		// we're using email addresses as usernames
		if (!empty($_POST['email'])) {
			$_POST['username'] = $_POST['email'];
		}


		// Load reCaptcha if needed
		if (Kohana::$config->load('useradmin')->captcha)
		{
			include Kohana::find_file('vendor', 'recaptcha/recaptchalib');
			$recaptcha_config = Kohana::$config->load('recaptcha');
			$recaptcha_error = null;
		}

		// If user already signed-in
		if (Auth::instance()->logged_in() != false)
		{
			// redirect to the user account
			$this->request->redirect('home/dashboard');
		}
		// Load the view
		$view = View::factory('user/register');
		// If there is a post and $_POST is not empty
		if ($_POST)
		{
			// optional checks (e.g. reCaptcha or some other additional check)
			$optional_checks = true;
			// if configured to use captcha, check the reCaptcha result
			// if (Kohana::$config->load('useradmin')->captcha)
			// {
			// 	$recaptcha_resp = recaptcha_check_answer(
			// 		$recaptcha_config['privatekey'], 
			// 		$_SERVER['REMOTE_ADDR'], 
			// 		$_POST['recaptcha_challenge_field'], 
			// 		$_POST['recaptcha_response_field']
			// 	);
			// 	if (! $recaptcha_resp->is_valid)
			// 	{
			// 		$optional_checks = false;
			// 		$recaptcha_error = $recaptcha_resp->error;
			// 		Message::add('error', __('The captcha text is incorrect, please try again.'));
			// 	}
			// }

			try
			{
				if (! $optional_checks)
				{
					throw new ORM_Validation_Exception("Invalid option checks");
				}

				if (empty($_POST['terms'])) {
					Message::add('error', __('You must accept the terms and conditions.'));
				 	throw new Exception("You must accept the terms and conditions");
				 }

				Auth::instance()->register($_POST, TRUE);
				// sign the user in
				Auth::instance()->login($_POST['username'], $_POST['password']);
				
				$user = Auth::instance()->get_user();
				$_POST['firstname'] = empty($_POST['firstname']) ? 'Anon' : @$_POST['firstname'];
				$user->firstname = @$_POST['firstname'];
				$user->surname = @$_POST['surname'];
	
				if (!empty($_POST['dob'])) {
					$dob = str_replace('/', '-', $_POST['dob']);
					$user->dob = date('Y-m-d', strtotime($dob));
				}

				$user->marketing = (int) @$_POST['marketing'];

				$user->save();

				// redirect to the user account
				$this->request->redirect('home/dashboard');
			}
			catch (ORM_Validation_Exception $e)
			{
				// Get errors for display in view
				// Note how the first param is the path to the message file (e.g. /messages/register.php)
				$errors = $e->errors('register');
				// Move external errors to main array, for post helper compatibility
				$errors = array_merge($errors, ( isset($errors['_external']) ? $errors['_external'] : array() ));
				$view->set('errors', $errors);
				// Pass on the old form values
				$_POST['password'] = $_POST['password_confirm'] = '';
				$view->set('defaults', $_POST);
			} catch (Exception $e) {
				
				// Pass on the old form values
				$_POST['password'] = $_POST['password_confirm'] = '';
				$view->set('defaults', $_POST);
				
			}
		}

		// if (Kohana::$config->load('useradmin')->captcha)
		// {
		// 	$view->set('captcha_enabled', true);
		// 	$view->set('recaptcha_html', recaptcha_get_html($recaptcha_config['publickey'], $recaptcha_error));
		// }

		$this->template->content = $view;
	}

	/**
	 * Close the current user's account.
	 */
	public function action_unregister()
	{
		// set the template title (see Controller_App for implementation)
		$this->template->title = __('Close user account');
		if (Auth::instance()->logged_in() == false)
		{
			// No user is currently logged in
			$this->request->redirect('user/login');
		}
		// get the user id
		$id = Auth::instance()->get_user()->id;
		$user = ORM::factory('user', $id);
		// KO3 ORM is lazy loading, which means we have to access a single field to actually have something happen.
		if ($user->id != $id)
		{
			// If the user is not the current user, redirect
			$this->request->redirect('user/profile');
		}
		// check for confirmation
		if (is_numeric($id) && isset($_POST['confirmation']) && $_POST['confirmation'] == 'Y')
		{

			$owner = new Model_Owner($id);
			$owner->clear_all_related();
			if (Auth::instance()->logged_in())
			{
				// Log the user out, their account will no longer exist
				Auth::instance()->logout();
			}

			// Delete the user
			$user->delete($id);
			// Delete any associated identities
			DB::delete('user_identity')->where('user_id', '=', $id)
			                           ->execute();
			// message: save success
			Message::add('success', __('Successfully deleted your account.'));
			$this->request->redirect(Session::instance()->get_once('returnUrl','user/profile'));
		}
		// display confirmation
		$this->template->content = View::factory('user/unregister')
			->set('id', $id)
			->set('data', array('username' => Auth::instance()->get_user()->username));
	}



	/**
	 * Log the user out.
	 */
	public function action_logout()
	{
		// Sign out the user
		Auth::instance()->logout();
		// redirect to the user account and then the signin page if logout worked as expected
		$this->request->redirect('');
	}


}

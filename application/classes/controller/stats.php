<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Stats extends Controller_Page {

	public function action_index() {
		//$id = $this->request->param('id');
		if (!Auth::instance()->logged_in()) {
			Request::current()->redirect('home/dashboard');
		}

		$email = $this->me()->email;

		
		if (strpos($email, '@basecreativeagency.com') === strpos($email, 'petermanlay')) {
			Request::current()->redirect('home/dashboard');	
		}

		$this->template->title = 'Stats';
		$this->template->subtitle = '';

		$users = ORM::factory('user')->count_all();
		$lists = ORM::factory('list')->count_all();
		$gifts = ORM::factory('gift')->count_all();

		$this->template->content = "
<pre>Users: $users
Lists: $lists
Gifts: $gifts</pre>";


	}


}

<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Page {

	public function action_index() {
		//$id = $this->request->param('id');
		if (Auth::instance()->logged_in()) {
			Request::current()->redirect('home/dashboard');
		}

		$this->template->title = 'Home';
		$this->template->content = View::factory('home/index');
	}

	public function action_features() {
		$this->template->title = 'Features';
		$this->template->content = View::factory('home/features');
	}

	public function action_support() {
		$this->template->title = 'Support';
		$this->template->content = View::factory('home/support');
	}

	public function action_faqs() {
		$this->template->title = 'FAQs';
		$this->template->content = View::factory('home/faqs');
	}

	public function action_dashboard() {
		if (!$this->me()->id) {
			Request::current()->redirect('');
		}

		$config = Kohana::$config->load('giftcircle.dashboard');

		$this->template->title = 'Dashboard';
		$this->template->subtitle = 'Your control panel for your circles and gifts';

		$view = View::factory('home/dashboard');
		$me = ORM::factory('owner', $this->me()->id);

		$view->pending = $me->pending_friend_requests();
		
		$view->my_lists = $me->lists
			// TODO: this should be by creted date
			->order_by('updated', 'DESC')
			->limit($config['my-lists'])
			->find_all();
		
		$view->friends_lists = $me->friends_lists();
		
		$view->my_shopping_list = $me->shopping_list();

		$this->template->content = $view;
	}



}

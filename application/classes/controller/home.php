<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Page {

	public function action_index() {
		//$id = $this->request->param('id');
		if (Auth::instance()->logged_in()) {
			Request::current()->redirect('home/dashboard');
		}

		$this->template->title = 'Create and share gift lists with your friends and family';
		$this->template->subtitle = '';
		$this->template->metakeywords = 'gift ideas, gift shopping, christmas gift ideas, wedding gift ideas, wedding gift list';
		$this->template->post_header = View::factory('home/header');
		$this->template->content = View::factory('home/index');
		$this->template->is_home = true;

		$this->template->styles['static/js/fancybox/jquery.fancybox-1.3.4.css'] = 'screen';
		$this->template->styles['static/swf/_styles/main.css'] = 'screen';
		$this->template->scripts[] = 'static/js/fancybox/jquery.fancybox-1.3.4.pack.js';

	}

	public function action_features() {
		$this->template->title = 'Features';
		$this->template->content = View::factory('home/features');
	}

	public function action_whatis() {
		$this->template->title = 'What is Gift Circle?';
		$this->template->content = View::factory('home/whatis');
	}

	public function action_support() {
		$this->template->title = 'Help';
		$this->template->content = View::factory('home/support');
	}

	public function action_faqs() {
		$this->template->title = 'FAQs';
		$this->template->content = View::factory('home/faqs');
	}

	public function action_company_info() {
		$this->template->title = 'Company Info';
		$this->template->content = View::factory('home/company_info');
	}

	public function action_terms() {
		$this->template->title = 'Terms &amp; Conditions';
		$this->template->content = View::factory('home/terms');
	}

	public function action_privacy() {
		$this->template->title = 'Privacy Policy';
		$this->template->content = View::factory('home/privacy');
	}

	public function action_contact() {
		$this->template->title = 'Contact us';
		$this->template->content = View::factory('home/contact');
	}

	public function action_partner() {
		$this->template->title = 'Partner with us';
		$this->template->content = View::factory('home/partner');
	}

	public function action_dashboard() {
		if (!$this->me()->id) {
			Request::current()->redirect('');
		}

		$config = Kohana::$config->load('giftcircle.dashboard');

		$this->template->title = 'Dashboard';
		$this->template->subtitle = 'Manage all your friends and lists';

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

<?php

class Model_Friend extends ORM {

	protected $_belongs_to = array(
		'creator' => array('foreign_key' => 'creator_id', 'model' => 'user'),
	);

	protected $_has_many = array(
		'lists' => array('through' => 'friends_lists'),
	);

	public function save(Validation $validation = NULL) {
		if (!$this->loaded()) {
			//$this->maybe_notify();
		}

		parent::save($validation);
	}

	public function delete() {
		// delete friend from all your lists
		$this->remove('lists');

		if ($this->is_confirmed()) {
			// friend is friends with you 
			// (as well as you being friends with friend)

			// get "you" as seen from your friend's friend list
			$friends_friend = $this->get_reverse_friend();

			// delete friend from your friend list
			// can't do this too soon or we'll loose IDs
			$ret = parent::delete();

			// delete you from friend's friend list
			// (which also deletes you from all friend's lists)
			// this has to be done after $this is deleted
			// othewise we'd get U.N.F.R.I.E.N.D.C.E.P.T.I.O.N.
			// That many dreams within dreams is too unstable! 
			try {
				$friends_friend->delete();
			} catch (Kohana_Exception $e) {
				// you're not your friend's friend for some reason
			}
			
			
		} else {
			// delete friend from your friend list
			$ret = parent::delete();
		}

		return $ret;
	}

	private function get_reverse_friend() {
		$me = Auth::instance()->get_user();
		return  $this->get_user()->get_friend_from_user($me);
	}

	public function get_user() {
		return new Model_Owner(array(
			'email' => $this->email,
		));
	}

	private function is_registered() {
		return $this->get_user()->loaded();
	}

	/**
	 * Whether they have confirmed your friend relationship
	 * 
	 * A confirmation of a freind request is your friend having you on their 
	 * friend list.
	 */
	public function is_confirmed() {
		$user = $this->get_user();

		$my_email = Auth::instance()->get_user()->email;

		return ORM::factory('friend')
			->where('email', '=', $my_email)
			->where('creator_id', '=', $user->id)
			->find_all()->count();
	}

	/**
	 * Send a friend an invitation if they're not a member
	 */
	private function maybe_notify() {
		if ($this->is_registered()) {
			if (!$this->is_confirmed()) {
				// not my friend yet
				$this->send_friend_request();
			} else {
				// already friends
				// this could come about from adding this friend instead of
				// accepting a friend request
			}
		} else {
			$this->send_new_user_invite();
		}
	}

	private function send_new_user_invite() {
		$user = Auth::instance()->get_user();
		$subject = Message::t('email', 'invite.subject', array(
			'friend_name' => $user->firstname.' '.$user->surname,
		));
		
		$register_link = URL::base('http') . 'user/register' . URL::query(array(
			'firstname' => $this->firstname,
			'surname'   => $this->surname,
			'email'     => $this->email,
		), false);

		$message = Message::t('email', 'invite.plain', array(
			'url'           => URL::base('http'),
			'email'         => $this->email,
			'surname'       => $this->surname,
			'firstname'     => $this->firstname,
			'register_link' => $register_link,
		), false);

		// LOG!
		$this->send_email($subject, $message);
	}

	private function send_friend_request() {
		$user = Auth::instance()->get_user();
		$subject = Message::t('email', 'friend_rquest.subject', array(
			'friend_name' => $user->firstname.' '.$user->surname,
		));
		
		$login_link = URL::base('http') . 'user/login';

		$message = Message::t('email', 'friend_request.plain', array(
			'url'           => URL::base('http'),
			'email'         => $this->email,
			'surname'       => $this->surname,
			'firstname'     => $this->firstname,
			'login_link' => $login_link,
		), false);

		// LOG!
		$this->send_email($subject, $message);
	}

	/**
	 * Send an email to the friend
	 */
	private function send_email($subject, $message) {
		$config = Kohana::$config->load('giftcircle');

		$to = array($this->email, $this->firstname.' '.$this->surname);
		
		$from = array(
			$config->get('email-from'),
			$config->get('email-from-name')
		);

		if (is_object(Kohana::$log)) {
			Kohana::$log->add(Log::INFO,
				'Sending email To "' . implode(' ', $to) . '", '
				. 'From "' . implode(' ', $from) . '", '
				. 'Subject "' . $subject . '".'
			);
			Kohana::$log->write();
		}

		Email::send($to, $from, $subject, $message);
	}

	public function is_on_list(Model_List $list) {
		return ORM::factory('friendlist', array(
				'friend_id' => $this->id,
				'list_id' => $list->id,
			))->loaded();
	}

	public function count_circles_im_in() {
		if (!$this->is_confirmed()) {
			return 0;
		}

		$user = $this->get_user();

		$my_email = Auth::instance()->get_user()->email;

		return $user->lists
			->join('friends_lists')
				->on('friends_lists.list_id', '=', 'list.id')
				
			->join('friends')
				->on('friends_lists.friend_id', '=', 'friends.id')

			->where('friends.email', '=', $my_email)
			->find_all()->count();
	}

}

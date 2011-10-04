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
			$this->maybe_send_invite();
		}

		parent::save($validation);
	}

	/**
	 * Send a friend an invitation if they're not a member
	 */
	private function maybe_send_invite() {
		$user = new Model_User(array(
			'email' => $this->email,
		));

		if ($user->loaded()) {
			// user is already registered
			return;
		}
		
		$config = Kohana::$config->load('giftcircle');

		$to = array($this->email, $this->firstname.' '.$this->surname);
		
		$from = array(
			$config->get('email-from'),
			$config->get('email-from-name')
		);

		$user = Auth::instance()->get_user();

		$subject = Message::t('email', 'invite.subject', array(
			'friend_name' => $user->firstname.' '.$user->surname,
		));
		
		$message = Message::t('email', 'invite.plain', array(
			'url' => URL::base('http'),
			'email' => $this->email,
			'surname' => $this->surname,
			'firstname' => $this->firstname,
			'register_link' => URL::base('http') . 'user/register?firstname=' . $this->firstname . '&surname=' . $this->surname . '&email=' . $this->email,
		), false);

		Email::send($to, $from, $subject, $message);

	}
}
<?php

class Model_Delayednotification {
	
	private $friendlist;

	private $transactions;
	
	private $user;

	public function __construct(Model_Friendlist $friendlist, $transactions) {
		
		$this->friendlist   = $friendlist;
		$this->transactions = $transactions;
		
		$this->friend       = $friendlist->friend;
		$this->list         = $friendlist->list;
		$this->owner        = $friendlist->list->owner;

		$this->user         = $this->get_user();
	}

	private function get_user() {
		return $this->friend->get_user();
	}

	private function is_confirmed_friend() {
		// we know $this->owner has a friend $this->user.
		// we what to check $this->user has a friend $this->owner
		return $this->user->is_on_my_friends_list($this->owner);
	}

	private function is_registered() {
		return $this->user->loaded();
	}

	private function has_notified_friend_before() {
		return ($this->friendlist->last_notification != '0000-00-00 00:00:00');
	}

	public function send() {
		if (!$this->is_confirmed_friend()) {
			if ($this->has_notified_friend_before()) {
				
			}
			echo 'not emailing {$this->friend->email} as they\'re not a user';

			return;
		}

		$config = Kohana::$config->load('giftcircle');

		$from = array(
			$config->get('email-from'),
			$config->get('email-from-name')
		);

		$updates = '';
		foreach ($this->transactions as $transaction) {
			$updates .= "{$transaction->description}\n";
		}
				


		if ($this->is_registered()) {
			
			$to = array($this->user->email, $this->user->fullname());
			
			if ($this->is_confirmed_friend()) {
				
				$subject = Message::t('email', 'list_update.subject', array(
					'friend_name' => $this->owner->fullname(),
					'list_name'     => $this->list->name,
				));
				
				$message = Message::t('email', 'list_update.plain', array(
					'url'           => URL::base('http'),
					'email'         => $this->user->email,
					'surname'       => $this->user->surname,
					'firstname'     => $this->user->firstname,
					'friend_name'   => $this->owner->fullname(),
					'list_name'     => $this->list->name,
					'updates'       => $updates,
					'home_link'     => URL::base('http'),
					'login_link'    => URL::base('http') . 'list/friend/' . $this->list->id,
				), false);


			} else {
				
				$subject = Message::t('email', 'friend_rquest.subject', array(
					'friend_name' => $this->owner->fullname(),
				));

				$message = Message::t('email', 'friend_request.plain', array(
					'url'           => URL::base('http'),
					'email'         => $this->user->email,
					'surname'       => $this->user->surname,
					'firstname'     => $this->user->firstname,
					'login_link'    => URL::base('http') . 'user/login',
				), false);

				
			}
			
			
			
		} else {

			$to = array($this->friend->email, $this->friend->firstname.' '.$this->friend->surname);

			$subject = Message::t('email', 'invite.subject', array(
				'friend_name' => $this->owner->fullname(),
			));

			$message = Message::t('email', 'invite.plain', array(
				'url'           => URL::base('http'),
				'email'         => $this->friend->email,
				'surname'       => $this->friend->surname,
				'firstname'     => $this->friend->firstname,
				'register_link' => URL::base('http') . 'user/register',
			), false);

		}

		Email::send($to, $from, $subject, $message);

		return true;
	}
}
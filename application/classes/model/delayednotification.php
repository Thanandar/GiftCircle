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

		$to = $this->friend->email;
		$from = 'no-reply@giftcircle.com';
		$subject = $this->owner->fullname() . ' has updated one of their lists.';
		$message = "Hi {$this->friend->firstname},

{$this->owner->firstname} has updated their list '{$this->list->name}':

";

		foreach ($this->transactions as $transaction) {
			$message .= "{$transaction->description}\n";
		}

		echo $message;
		Email::send($to, $from, $subject, $message);
	}
}
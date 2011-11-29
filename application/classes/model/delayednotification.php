<?php

class Model_Delayednotification {
	
	private $friendlist;

	private $transactions;
	
	private $user;

	/**
	 * Email a friend on a list about changes on the list
	 * 
	 * A Delayednotification is created for each friend on each list
	 * 
	 * @param Model_Friendlist $friendlist   Link between friend 
	 *                                       and list
	 * @param array            $transactions of Listtransactions
	 */
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

	/**
	 * Whether friend is friends with the list owner
	 * 
	 * @return bool
	 */
	private function is_confirmed_friend() {
		// we want to check $this->user has a friend $this->owner
		// and $this->owner has a friend $this->user
		return $this->user->is_on_my_friends_list($this->owner) && $this->user->is_on_friends_friends_list($this->owner);
	}

	/**
	 * Whether the friend has a user account
	 * 
	 * @return bool
	 */
	private function is_registered() {
		return $this->user->loaded();
	}

	/**
	 * Whether the friend has been notified about this list before
	 * 
	 * @return bool
	 */
	private function has_notified_friend_before() {
		return ($this->friendlist->last_notification != '0000-00-00 00:00:00');
	}

	/**
	 * Send an email to a friend
	 * 
	 * Will email unless it's the 2nd+ notification to an 
	 * unconfirmed friend
	 * 
	 * @todo refactor
	 * 
	 * @return bool whether email was sent
	 */
	public function send() {
		if (!$this->is_confirmed_friend()) {
			if ($this->has_notified_friend_before()) {
				//echo "\nNot emailing {$this->friend->email} as they're not a user ({$this->friendlist->last_notification})\n";
				return;
			}
		}

		$config = Kohana::$config->load('giftcircle');

		$from = array(
			$config->get('email-from'),
			$config->get('email-from-name')
		);

		$additions = array();

		$updates = array();

		foreach ($this->transactions as $transaction) {
			if (substr($transaction->description, 0, 13) == 'Added a gift:') {
				$additions[] = str_replace('Added a gift: ', '', " {$transaction->description}\n");
			} else {
				$updates[] = str_replace('Updated a gift: ', '', " {$transaction->description}\n");
			}
		}
		
		$additions = array_unique($additions);
		sort($additions);

		$updates = array_unique($updates);
		sort($updates);

		$transactions = '';

		if (count($additions)) {
			$transactions .= "These gifts were added:\n";
			$transactions .= '<ul><li>' . implode('</li><li>', $additions) . '</li></ul>';
		}

		if (count($updates)) {
			$transactions .= "\nThese gifts were updated:\n";
			$transactions .= '<ul><li>' . implode('</li><li>', $updates) . '</li></ul>';
		}

		if ($this->is_registered()) {
			
			$to = array($this->user->email, $this->user->fullname());
			
			if ($this->is_confirmed_friend()) {
				
				$subject = Message::t('email', 'list_update.subject', array(
					'friend_name' => $this->owner->fullname(),
					'list_name'     => $this->list->name,
				));
				
				$message = Message::t('email', 'list_update.html', array(
					'url'           => URL::base('http'),
					'email'         => $this->user->email,
					'surname'       => $this->user->surname,
					'firstname'     => $this->user->firstname,
					'friend_name'   => $this->owner->fullname(),
					'list_name'     => $this->list->name,
					'updates'       => $transactions,
					'home_link'     => URL::base('http'),
					'login_link'    => URL::base('http') . 'list/friend/' . $this->list->id,
				), false);


			} else {
				
				$subject = Message::t('email', 'friend_request.subject', array(
					'friend_name' => $this->owner->fullname(),
				));

				$message = nl2br(Message::t('email', 'friend_request.plain', array(
					'url'           => URL::base('http'),
					'email'         => $this->user->email,
					'surname'       => $this->user->surname,
					'firstname'     => $this->user->firstname,
					'friend_name'   => $this->owner->fullname(),
					'home_link'     => URL::base('http'),
					'login_link'    => URL::base('http') . 'user/login',
				), false));

				
			}
			
			
			
		} else {

			$to = array($this->friend->email, $this->friend->firstname.' '.$this->friend->surname);

			$subject = Message::t('email', 'invite.subject', array(
				'friend_name' => $this->owner->fullname(),
			));

			$message = nl2br(Message::t('email', 'invite.plain', array(
				'url'           => URL::base('http'),
				'email'         => $this->friend->email,
				'surname'       => $this->friend->surname,
				'firstname'     => $this->friend->firstname,
				'friend_name'   => $this->owner->fullname(),
				'home_link'     => URL::base('http'),
				'register_link' => URL::base('http') . 'user/register',
			), false));

		}

		if (is_object(Kohana::$log)) {
			Kohana::$log->add(Log::INFO,
				'Sending email To "' . implode(' ', $to) . '", '
				. 'From "' . implode(' ', $from) . '", '
				. 'Subject "' . $subject . '".'
			);
			Kohana::$log->write();
		}

		Email::send($to, $from, $subject, $message, true);

		return true;
	}
}
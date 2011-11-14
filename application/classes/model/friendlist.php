<?php

class Model_Friendlist extends ORM {

	protected $_table_name = 'friends_lists';

	protected $_belongs_to = array(
		'friend' => array(),
		'list' => array(),
	);

	public function save(Validation $validation = NULL) {
		if (!$this->loaded()) {
			// default subscribed
			$this->subscribed = 1;
		}

		parent::save($validation);
	}

	public function is_subscribed() {
		return $this->subscribed == 1;
	}

	public function subscribe() {
		$this->subscribed = 1;
		$this->save();
	}

	public function unsubscribe() {
		$this->subscribed = 0;
		$this->save();
	}

	/**
	 * Send an email to $this->friend about $this->list
	 * 
	 * @param {int} $debouncetime Ignore changes new than this number
	 *                            of seconds ago.
	 *                        
	 * @return {int} Number of emails sent
	 */
	public function send_notification($debounce_time) {

		$list_transactions = $this->list->listtransactions
			->where('updated', '>=', $this->last_notification)
			->where('updated', '<', date('Y-m-d H:i:s', time() - $debounce_time))
			->find_all();
		$count = count($list_transactions);

		if (!$this->friend->email) {
			// friend/account removed
			return 0;
		}

		if (!$count) {
			return 0;
		}

		$n = new Model_Delayednotification($this, $list_transactions);
		$sent = $n->send();

		$this->last_notification = date('Y-m-d H:i:s', time());
		$this->save();

		return $sent ? 1 : 0;
	}
}


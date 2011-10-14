<?php

class Model_List extends ORM {

	protected $_belongs_to = array(
		'owner' => array('model' => 'owner', 'foreign_key' => 'owner_id')
	);

	protected $_has_many = array(
		'gifts' => array(),
		'friends' => array('through' => 'friends_lists'),
		'friendlists' => array(),
		'listtransactions' => array(),
	);

	public function contains_me() {
		return $this->contains_user(Auth::instance()->get_user());
	}

	private function contains_user(Model_User $user) {
		$my_email = $user->email;
		$friends = $this->friends;
		$me = $friends->where('email', '=', $my_email)->find_all();
		count($me);
		return count($friends->where('email', '=', $my_email)) > 0;
	}

	public function total_gifts() {
		return count($this->gifts->find_all());
	}

	public function total_friends() {
		return count($this->friends->find_all());
	}

	public function is_user_subscribed(Model_User $user) {
		$friendlists = $this->friendlists
			->join('friends')
				->on('friends.id', '=', 'friendlist.friend_id')
			->where('friends.email', '=', $user->email)
			->find_all();

		return $friendlists[0]->is_subscribed();
	}

	public function is_logged_in_user_subscribed() {
		return $this->is_user_subscribed(Auth::instance()->get_user());
	}

	public function delete() {
		// delete gifts on the list
		$gifts = $this->gifts->find_all();
		foreach ($gifts as $gift) {
			$gift->delete();
		}

		// // delete friends on the list
		$friends = $this->friends->find_all();
		foreach ($friends as $friend) {
			$friend->delete();
		}

		return parent::delete();
	}

	/**
	 * Send email notifications to circle
	 * 
	 * Called from cron when a $this has been updates since its
	 * list notification.
	 * 
	 * @param {int} $debouncetime Ignore changes new than this number
	 *                            of seconds ago.
	 */
	public function send_notifications($debounce_time) {
		//echo $list->name;
		// find all friends on this list that are subscribed
		$circle = $this->friendlists
			// make sure they're subscribed
			->where('subscribed', '=', '1')

			// 
			->where('last_notification', '<', $this->updated)
			->find_all();

		foreach ($circle as $friend) {
			$friend->send_notification($debounce_time);
		}

		// add 1 second so it's slightly after the updated field
		$this->last_notification = date('Y-m-d H:i:s', time() + 1);
		$this->save();
	}

	public function touch() {
		if ($this->loaded()) {
			$this->updated = date('Y-m-d H:i:s', time());
			$this->save();
		}
	}

}
	
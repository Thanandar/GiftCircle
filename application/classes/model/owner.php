<?php

// list owner

class Model_Owner extends Model_User {

	protected $_table_name = 'users';

	protected $_has_many = array(
		'lists'        => array('foreign_key' => 'owner_id'),
		'friends'      => array('foreign_key' => 'creator_id'),
		'reservations' => array('model' => 'gifts', 'foreign_key' => 'reserver_id', 'through' => 'gifts'),
	);


	/**
	 * Find all users who have you as a friend but they're not your friend
	 */
	public function pending_friend_requests() {
		
		$my_friends = $this->friends
			->find_all()
			->as_array('email');

		$my_friends = array_keys($my_friends);

		$friends_friends = new Model_Friend();
		$friends_friends = $friends_friends->where('email', '=', $this->email)
			->find_all();

		$pending = array();

		foreach ($friends_friends as $friend) {
			if (!in_array($friend->creator->email, $my_friends)) {
				$pending[] = $friend->creator;
			}
		}

		return $pending;
	}

	/**
	 * See if $user is on $this' friends list
	 */
	public function is_on_my_friends_list(Model_Owner $user) {
		$my_friend = new Model_Friend(array(
			'email'      => $user->email,
			'creator_id' => $this->id,
		));

		return $my_friend->loaded();
	}

	/**
	 * See if $this is on $user's friends list
	 */
	public function is_on_friends_friends_list(Model_Owner $user) {
		$friends_friend = new Model_Friend(array(
			'email'      => $this->email,
			'creator_id' => $user->id,
		));

		return $friends_friend->loaded();
	}

	/**
	 * See if $this and $user are both on each other's friends list
	 */
	public function is_friends_with(Model_Owner $user) {
		return ($this->is_on_my_friends_list($user) 
			&& $this->is_on_friends_friends_list($user));
	}


}
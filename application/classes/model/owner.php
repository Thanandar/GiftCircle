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

	
}
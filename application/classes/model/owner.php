<?php

// list owner

class Model_Owner extends Model_User {

	protected $_table_name = 'users';

	protected $_has_many = array(
		'lists'        => array('foreign_key' => 'owner_id'),
		'friends'      => array('foreign_key' => 'creator_id'),
		'reservations' => array('model' => 'gift', 'foreign_key' => 'reserver_id'),
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
	public function is_on_my_friends_list(Model_User $user) {
		$my_friend = new Model_Friend(array(
			'email'      => $user->email,
			'creator_id' => $this->id,
		));

		return $my_friend->loaded();
	}

	/**
	 * See if $this is on $user's friends list
	 */
	public function is_on_friends_friends_list(Model_User $user) {
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


	/**
	 * Get all friends that also have $this as a friend
	 * 
	 * @return {Model_Friend} friends that are friends with you
	 */
	public function confirmed_friends() {
		// get all my friends
		return $this->friends
			
			// // get my friends user accounts
			->join('users')
				->on('users.email', '=', 'friend.email')
			
			// get all their friends
			->join(array('friends', 'friends_friends'))
				->on('friends_friends.creator_id', '=', 'users.id')
			
			// get only their friends that are me
			->where('friends_friends.email', '=', $this->email)
			->find_all();		
	}

	public function lists_containing_email($email) {
		return $this->lists

			// get their lists
			->join('friends_lists')
				->on('friends_lists.list_id', '=', 'list.id')
			
			// get their friends
			->join('friends')
				->on('friends.id', '=', 'friends_lists.friend_id')			 
			
			// get only their friends that are $email
			->where('friends.email', '=', $email)
			
			->find_all()
		;
	}

	public function shopping_list() {
		return $this->reservations
			->where('buyer_id', '=', 0)
			->find_all();
	}

	/**
	 * Get all friends lists that $this is on and $this is friends with
	 */
	public function friends_lists() {
		// find all lists
		return ORM::factory('list')

			// get their friends
			->join('friends_lists')
				->on('friends_lists.list_id', '=', 'list.id')

			// get their friends
			->join('friends')
				->on('friends.id', '=', 'friends_lists.friend_id')			 
			
			// get only their friends that are me
			->where('friends.email', '=', $this->email)

			// get the list's owners
			->join('users')
				->on('users.id', '=', 'list.owner_id')

			// join them to my friends
			->join(array('friends', 'my_friends'))
			 	->on('my_friends.email', '=', 'users.email')

			// check i'm friends with them
			->where('my_friends.creator_id', '=', $this->id)

			->find_all();
	}

}
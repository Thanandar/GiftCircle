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
		$my_friends = array_map('strtolower', $my_friends);

		$friends_friends = new Model_Friend();
		$friends_friends = $friends_friends->where('email', '=', $this->email)
			->find_all();

		$pending = array();

		foreach ($friends_friends as $friend) {
			if (!in_array(strtolower($friend->creator->email), $my_friends)) {
				$pending[] = $friend->creator;
			}
		}

		return $pending;
	}

	public function get_friend_from_user($user) {
		return new Model_Friend(array(
			'email'      => $user->email,
			'creator_id' => $this->id,
		));
	}

	/**
	 * See if $this has a friend with $email
	 * 
	 * @param {string} $email Friend's email
	 * 
	 * @return {bool} Whether they're a friend
	 */
	public function has_friend_with_email($email) {
		$my_friend = new Model_Friend(array(
			'email'      => $email,
			'creator_id' => $this->id,
		));

		return $my_friend->loaded();
	}

	/**
	 * See if $user is on $this' friends list.
	 * 
	 * Uses $user->email to check
	 * 
	 * @param {mixed} $user Model_User or Model_Friend
	 */
	public function is_on_my_friends_list($user) {
		return $this->has_friend_with_email($user->email);
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
			
			->order_by('friend.surname', 'ASC')

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

	/**
	 * Get all Gifts that I've reserved
	 * 
	 * The 3 joins and the where are the end are to make sure
	 * that $this is on the Gift's List's circle
	 */
	public function shopping_list() {
		return $this->reservations
			// gifts that have not been bought
			->where('buyer_id', '=', 0)

			// get the gift list
			->join('lists')
				->on('lists.id', '=', 'gift.list_id')
			
			// get the list's circle of friends
			->join('friends_lists')
				->on('lists.id', '=', 'friends_lists.list_id')
			
			// get friends from circle
			->join('friends')
				->on('friends.id', '=', 'friends_lists.friend_id')

			// make sure $this is in the circle
			->where('friends.email', '=', $this->email)

			->order_by('name', 'ASC')
			->find_all();
	}
	
	/**
	 * Get all Gifts that I've bought
	 * 
	 * The 3 joins and the where are the end are to make sure
	 * that $this is on the Gift's List's circle
	 */
	public function bought_list() {
		return $this->reservations
			// gifts that have been bought
			->where('buyer_id', '!=', 0)
			
			// gifts that haven't been cleared
			->where('cleared', '!=', 1)

			// get the gift list
			->join('lists')
				->on('lists.id', '=', 'gift.list_id')
			
			// get the list's circle of friends
			->join('friends_lists')
				->on('lists.id', '=', 'friends_lists.list_id')
			
			// get friends from circle
			->join('friends')
				->on('friends.id', '=', 'friends_lists.friend_id')

			// make sure $this is in the circle
			->where('friends.email', '=', $this->email)

			->order_by('name', 'ASC')
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

			->order_by('updated', 'DESC')

			->find_all();
	}

	public function subscribe_to_list(Model_List $list) {
		$friendlist = $this->get_friendlist($list);
		$friendlist->subscribe();
	}

	public function unsubscribe_from_list(Model_List $list) {
		$friendlist = $this->get_friendlist($list);
		$friendlist->unsubscribe();
	}

	private function get_friendlist(Model_List $list) {
		$friendlists = $list->friendlists
			->join('friends')
				->on('friends.id', '=', 'friendlist.friend_id')
			->where('friends.email', '=', $this->email)
			->find_all();
		
		if (!count($friendlists)) {
			throw new Exception('Cannot find connection to list');
		}

		return $friendlists[0];
	}

	public function fullname() {
		return $this->firstname . ' ' . $this->surname;
	}

	/**
	 * Clean up a user account that's about to be deleted
	 */
	public function clear_all_related() {
		// All gifts that user has bought or reserved stay "Taken" on their friends' lists

		// All user's lists (and the list's gifts/circle) are removed
		// Any gifts that have been reserved by friends get removed from their shopping list
		$lists = $this->lists->find_all();
		foreach ($lists as $list) {
			// this removes gifts and friends from the list
			$list->delete();
		}
		
		// User is removed from all friends' lists (including unconfirmed friends)
		$friends = $this->friends->find_all();
		foreach ($friends as $friend) {
			$friend->delete();
		}
		
	}




}
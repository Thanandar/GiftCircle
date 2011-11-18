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
			//$this->maybe_notify();
		}

		parent::save($validation);
	}

	public function delete() {
		// delete friend from all your lists
		$this->remove('lists');

		if ($this->is_confirmed()) {
			// friend is friends with you 
			// (as well as you being friends with friend)

			// get "you" as seen from your friend's friend list
			$friends_friend = $this->get_reverse_friend();

			// delete friend from your friend list
			// can't do this too soon or we'll loose IDs
			$ret = parent::delete();

			// delete you from friend's friend list
			// (which also deletes you from all friend's lists)
			// this has to be done after $this is deleted
			// othewise we'd get U.N.F.R.I.E.N.D.C.E.P.T.I.O.N.
			// That many dreams within dreams is too unstable! 
			try {
				$friends_friend->delete();
			} catch (Kohana_Exception $e) {
				// you're not your friend's friend for some reason
			}
			
			
		} else {
			// delete friend from your friend list
			$ret = parent::delete();
		}

		return $ret;
	}

	private function get_reverse_friend() {
		$me = Auth::instance()->get_user();
		return  $this->get_user()->get_friend_from_user($me);
	}

	public function get_user() {
		return new Model_Owner(array(
			'email' => $this->email,
		));
	}

	private function is_registered() {
		return $this->get_user()->loaded();
	}

	/**
	 * Whether they have confirmed your friend relationship
	 * 
	 * A confirmation of a freind request is your friend having you on their 
	 * friend list.
	 */
	public function is_confirmed() {
		$user = $this->get_user();

		$my_email = Auth::instance()->get_user()->email;

		return ORM::factory('friend')
			->where('email', '=', $my_email)
			->where('creator_id', '=', $user->id)
			->find_all()->count();
	}

	public function is_on_list(Model_List $list) {
		return ORM::factory('friendlist', array(
				'friend_id' => $this->id,
				'list_id' => $list->id,
			))->loaded();
	}

	public function count_circles_im_in() {
		if (!$this->is_confirmed()) {
			return 0;
		}

		$user = $this->get_user();

		$my_email = Auth::instance()->get_user()->email;

		return $user->lists
			->join('friends_lists')
				->on('friends_lists.list_id', '=', 'list.id')
				
			->join('friends')
				->on('friends_lists.friend_id', '=', 'friends.id')

			->where('friends.email', '=', $my_email)
			->find_all()->count();
	}

}

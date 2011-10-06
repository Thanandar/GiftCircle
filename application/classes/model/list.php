<?php

class Model_List extends ORM {

	protected $_belongs_to = array(
		'owner' => array('model' => 'owner', 'foreign_key' => 'owner_id')
	);

	protected $_has_many = array(
		'gifts' => array(),
		'friends' => array('through' => 'friends_lists'),
		'friendlists' => array(),
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

}
	
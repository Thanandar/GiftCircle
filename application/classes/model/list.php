<?php

class Model_List extends ORM {

	protected $_belongs_to = array(
		'owner' => array('model' => 'owner', 'foreign_key' => 'owner_id')
	);

	protected $_has_many = array(
		'gifts' => array(),
		'friends' => array('through' => 'friends_lists'),
	);

	public function contains_me() {
		$my_email = Auth::instance()->get_user()->email;
		$friends = $this->friends;
		$me = $friends->where('email', '=', $my_email)->find_all();
		count($me);
		print_r($me);
		return count($friends->where('email', '=', $my_email));
	}

}
	
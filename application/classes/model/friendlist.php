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

}


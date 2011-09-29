<?php

class Model_Friend extends ORM {

	protected $_belongs_to = array(
		'creator' => array('foreign_key' => 'creator_id', 'model' => 'user'),
	);

	protected $_has_many = array(
		'lists' => array('through' => 'friends_lists'),
	);



	
}
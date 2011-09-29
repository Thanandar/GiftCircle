<?php

// list owner

class Model_Owner extends Model_User {

	protected $_table_name = 'users';

	protected $_has_many = array(
		'lists'        => array('foreign_key' => 'owner_id'),
		'friends'      => array('foreign_key' => 'creator_id'),
		'reservations' => array('model' => 'gifts', 'foreign_key' => 'reserver_id', 'through' => 'gifts'),
	 );



	
}
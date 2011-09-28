<?php

class Model_Owner extends Model_User {

	protected $_table_name = 'users';

	protected $_has_many = array(
		'lists' => array('model' => 'list', 'foreign_key' => 'owner_id')
	 );



	
}
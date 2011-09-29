<?php

class Model_Gift extends ORM {

	protected $_belongs_to = array(
		'list' => array('model' => 'list')
	);



	
}
<?php

// category of gift
class Model_Category extends ORM {

	protected $_has_many = array(
		'gift'     => array(),
		'shops'     => array('through' => 'categories_shops'),
	);

	
}

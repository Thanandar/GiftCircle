<?php

return array(
	// sent to an unregistered user
	'invite' => array(
		'subject' => '{friend_name} would like to be your friend on GiftCircle',
		'plain'   => 'Hello {firstname} {surname}!

Register on GitftCircle: 
<{register_link}>


',
	),
	
	// sent to a registered user
	'friend_request' => array(
		'subject' => '{friend_name} would like to be your friend on GiftCircle',
		'plain'   => 'Hello {firstname} {surname}!,

Log in to your account on GiftCircle: 
<{login_link}>


',
	),

	// sent to someone who's reserved/bought a gift you've deleted
	'deleted_gift' => array(
		'subject' => '{owner_name} has just deleted a gift you\'ve reserved on GiftCircle',
		'plain'   => 'Hello  {reserver_firstname} {reserver_surname},

Just to keep you in the loop, {owner_name} has just deleted a gift you\'ve reserved on GiftCircle.
'
	),
);


<?php

return array(
	// sent to an unregistered user
	'invite' => array(
		'subject' => '{friend_name} wants to know what you\'d like for Christmas',
		'plain'   => 'Hello {firstname} {surname},

{friend_name} wants to know what you’d like for Christmas.

Join Gift Circle today and let {friend_name} and everyone in your circle know what you\'d like.

Register now! <{register_link}> | What is Gift Circle? <{home_link}>

--
Gift Circle from Net Optimisers Ltd, 145-157 St John Street, London, England, EC1V 4PW Company No. 07607399

',
	),
	
	// sent to a registered user
	'friend_request' => array(
		'subject' => '{friend_name} would like to be your friend on Gift Circle',
		'plain'   => 'Hello {firstname} {surname},

{friend_name} would like to be your friend on Gift Circle.

Log in to your account on Gift Circle: <{login_link}>

--
Gift Circle from Net Optimisers Ltd, 145-157 St John Street, London, England, EC1V 4PW Company No. 07607399

',
	),

	// sent to a confirmed friend
	'list_update' => array(
		'subject' => '{friend_name}\'s list "{list_name}" has been updated on Gift Circle',
		'plain'   => 'Hello {firstname} {surname},

{friend_name}\'s list "{list_name}" has been updated:

{updates}

Log in to your account on Gift Circle: <{login_link}>

The message was sent to {email}. If you don\'t want to receive these emails from your friend\'s list in the future, you can unsubscribe in your settings: <{login_link}>

--
Gift Circle from Net Optimisers Ltd, 145-157 St John Street, London, England, EC1V 4PW Company No. 07607399

',
	),

	// sent to someone who's reserved/bought a gift you've deleted
	'deleted_gift' => array(
		'subject' => '{owner_name} has just deleted a gift you\'ve reserved on Gift Circle',
		'plain'   => 'Hello {reserver_firstname} {reserver_surname},

Just to keep you in the loop, {owner_name} has just deleted the gift "{gift_name}" you\'ve reserved on Gift Circle.

Log in to your account on Gift Circle: 
<{url}>

--
Gift Circle from Net Optimisers Ltd, 145-157 St John Street, London, England, EC1V 4PW Company No. 07607399

'
	),

	// sent to someone who's reserved/bought a gift you've edited
	'edited_gift' => array(
		'subject' => '{owner_name} has just edited a gift you\'ve reserved on Gift Circle',
		'plain'   => 'Hello {reserver_firstname} {reserver_surname},

Just to keep you in the loop, {owner_name} has just edited the gift "{gift_name}" you\'ve reserved on Gift Circle.

Log in to your account on Gift Circle: 
<{url}>

--
Gift Circle from Net Optimisers Ltd, 145-157 St John Street, London, England, EC1V 4PW Company No. 07607399

'
	),
);


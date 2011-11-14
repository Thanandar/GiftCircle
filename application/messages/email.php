<?php

return array(
	// sent to an unregistered user
	'invite' => array(
		'subject' => '{friend_name} would like you to join them on Gift Circle',
		'plain'   => 'Hi {firstname},

{friend_name} wants to know what you\'d like for Christmas.

Gift Circle is the great new place where friends and family get
together to swap gift lists and find out what to buy each other 
to celebrate special occasions. Join up now and create a list 
of gifts you\'d like - it could make a special occasion great!

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

Log in to your account to accept the invitation: <{login_link}>

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


<?php

class Model_Gift extends ORM {

	protected $_belongs_to = array(
		'list'     => array('model' => 'list'),
		'reserver' => array('model' => 'owner'),
		'category' => array(),
	);


	public function delete() {

		// inform the reserver that the gift has been deleted
		if ($this->reserver_id) {
			$config = Kohana::$config->load('giftcircle');

			$reserver = $this->reserver;
			$gift_owner = $this->list->owner;

			$subject = Message::t('email', 'deleted_gift.subject', array(
				'owner_name' => $gift_owner->firstname.' '.$gift_owner->surname,
			));
			
			$message = Message::t('email', 'deleted_gift.plain', array(
				'url'                => URL::base('http'),
				'reserver_email'     => $reserver->email,
				'reserver_firstname' => $reserver->firstname,
				'reserver_surname'   => $reserver->surname,
				'owner_name'         => $gift_owner->firstname.' '.$gift_owner->surname,
			), false);


			$to = array($reserver->email, $reserver->firstname.' '.$reserver->surname);
			
			$from = array(
				$config->get('email-from'),
				$config->get('email-from-name')
			);

			Email::send($to, $from, $subject, $message);

		}

		parent::delete();
	}

	
}
<?php

class Model_Gift extends ORM {

	protected $_belongs_to = array(
		'list'     => array('model' => 'list'),
		'reserver' => array('model' => 'owner'),
		'category' => array(),
	);


	public function save(Validation $validation = NULL) {

		// inform the reserver that the gift has been edited
		// if it's not the current user that's just marked it as bought
		if ($this->reserver_id && $this->reserver_id != Auth::instance()->get_user()->id) {
			$config = Kohana::$config->load('giftcircle');

			$reserver = $this->reserver;
			$gift_owner = $this->list->owner;

			$subject = Message::t('email', 'edited_gift.subject', array(
				'owner_name' => $gift_owner->firstname.' '.$gift_owner->surname,
			));
			
			$message = Message::t('email', 'edited_gift.plain', array(
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

		} else {
			// not reserved yet
			// 
			if (!$this->loaded()) {
				Model_Listtransaction::log($this->list, 'Added a gift: ' . $this->name);
			} else {
				Model_Listtransaction::log($this->list, 'Updated a gift: ' . $this->name);
			}
			
		}


		if (!$this->loaded()) {
			// creating a new gift
			if ($this->url) {
				$this->url = $this->add_tracking_to_url($this->url);
			}


		}
		


		parent::save($validation);
	}

	private function add_tracking_to_url($url) {
		// This needs moving to another class and making work properly
		return 'http://www.awin1.com/cread.php?awinmid=530&awinaffid=125132&clickref=&p=' . urlencode($url);
	}

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
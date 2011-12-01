<?php

class Model_Gift extends ORM {

	protected $_belongs_to = array(
		'list'     => array('model' => 'list'),
		'reserver' => array('model' => 'owner'),
		'category' => array(),
	);


	public function save(Validation $validation = NULL) {

		$action = $this->loaded() ? 'Updated' : 'Added';

		if ($this->loaded()) {
			// get this gift from the DB again
			// so we can check for an unreserve action
			$original = ORM::factory('gift', $this->id);
		}

		parent::save($validation);

		if ($this->reserver_id == Auth::instance()->get_user()->id) {
			// the reserver is currently logged in
			// and has made a change to the gift
			// don't send any emails
			return;
		}

		if ($this->reserver_id) {
			// the gift owner has made a change
			// inform the reserver immediately that the gift
			// has been edited
			
			$config = Kohana::$config->load('giftcircle');

			$reserver = $this->reserver;
			$gift_owner = $this->list->owner;

			if (!$reserver->email || !$gift_owner->email) {
				// account deleted or something crazy
				return;
			}

			$subject = Message::t('email', 'edited_gift.subject', array(
				'owner_name' => $gift_owner->firstname.' '.$gift_owner->surname,
			));
			
			$message = Message::t('email', 'edited_gift.plain', array(
				'url'                => URL::base('http') . 'gift/shopping',
				'reserver_email'     => $reserver->email,
				'reserver_firstname' => $reserver->firstname,
				'reserver_surname'   => $reserver->surname,
				'owner_name'         => $gift_owner->firstname.' '.$gift_owner->surname,
				'gift_name'          => $this->name,
			), false);


			$to = array($reserver->email, $reserver->firstname.' '.$reserver->surname);
			
			$from = array(
				$config->get('email-from'),
				$config->get('email-from-name')
			);

			if (is_object(Kohana::$log)) {
				Kohana::$log->add(Log::INFO,
					'Sending email To "' . implode(' ', $to) . '", '
					. 'From "' . implode(' ', $from) . '", '
					. 'Subject "' . $subject . '".'
				);
				Kohana::$log->write();
			}

			Email::send($to, $from, $subject, $message);

		} else {
			// not reserved yet
			
			if (isset($original) && !empty($original->reserver_id)) {
				// there was a reserver_id but now there isn't
				// the "update" is just someone unreserving the gift
				return;
			}

			$link = '<a href="'.URL::base('http').'gift/details/'.$this->id.'">'.htmlspecialchars($this->name).'</a>';

			Model_Listtransaction::log($this->list, $action.' a gift: '.$link);

		}

	}

	public function affiliate_url() {
		$affiliate_url = new Model_AffialteUrl($this->url);
		return $affiliate_url->tracking_url();
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
				'gift_name'          => $this->name,
			), false);


			$to = array($reserver->email, $reserver->firstname.' '.$reserver->surname);
			
			$from = array(
				$config->get('email-from'),
				$config->get('email-from-name')
			);

			if ($reserver->email) {
				if (is_object(Kohana::$log)) {
					Kohana::$log->add(Log::INFO,
						'Sending email To "' . implode(' ', $to) . '", '
						. 'From "' . implode(' ', $from) . '", '
						. 'Subject "' . $subject . '".'
					);
					Kohana::$log->write();
				}

				Email::send($to, $from, $subject, $message);
			}

		}

		parent::delete();
	}

	public function price($pound = true, $bought = false) {
		if ($bought && empty($this->bought_price)) {
			$this->bought_price = $this->price;
			$this->save();
		}

		$price = $bought ? $this->bought_price : $this->price;
		$pound = $pound ? '&pound;' : '';
		return $pound . number_format((float) $price, 2);
	}

	
}
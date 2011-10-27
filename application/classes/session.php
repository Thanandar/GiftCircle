<?php

abstract class Session extends Kohana_Session {

	/**
	 * Loads existing session data.
	 *
	 *     $session->read();
	 *
	 * @param   string   session id
	 * @return  void
	 */
	public function read($id = NULL) {

		try {
			parent::read($id);
		} catch (Session_Exception $e) {
			@header('Location: ' . $_SERVER['REQUEST_URI']);
			die('Error. Please try again.');
		}

	}

}
<?php

class Message extends Useradmin_Message {


	public static function add($type, $message) {
		
		if (is_array($message)) {
			// get message from file
			$message = Kohana::message($message[0], $message[1]);
		}

		// should be one of warning, error, success, info
		if ($type == 'failure') {
			$type = 'error';
		}

		$type .= ' alert-message';
		parent::add($type, $message);
	}
	
	public static function e($file, $key) {
		$args = func_get_args();
		array_shift($args);
		array_shift($args);

		$args = array_map(array('HTML', 'chars'), $args);

		$s = Kohana::message($file, $key);
		array_unshift($args, $s);

		return call_user_func_array('sprintf', $args);
	}
}
<?php

class Message extends Useradmin_Message {


	public static function add($type, $message)
	{
		
		// should be one of warning, error, success, info
		if ($type == 'failure') {
			$type = 'error';
		}

		$type .= ' alert-message';
		parent::add($type, $message);
	}
	
}
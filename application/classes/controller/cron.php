<?php

//make a new listtransaction whenever doing somehing with a list

class Controller_Cron extends Controller {

	private $debounce_time = 10;//3600;

	public function action_index() {
		$hour_ago = date('Y-m-d H:i:s', time() - $this->debounce_time);

		// get al the lists that haven't been updated in the last hour
		$lists = ORM::factory('list')

		// haven't been updated too recently
		->where('list.updated', '<', $hour_ago)

		// but have been "updated" since their last notification
		// (here, adding a friend to a list is counted as updated)
		->where('list.updated', '>=', DB::expr('`last_notification`'))
		
		->find_all();

		foreach ($lists as $list) {
			$list->send_notifications($this->debounce_time);
		}
	}

	
}


/*

Matt Morgan just updated a list on Gift Circle

Hi Tom,

Matt Morgan has made the following changes to the list "Christmas":

 - Added gift foo
 - Updated gift bar

View Matt's updated list: <http://>
*/
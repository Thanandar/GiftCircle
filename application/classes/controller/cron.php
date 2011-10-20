<?php

//make a new listtransaction whenever doing somehing with a list

class Controller_Cron extends Controller {

	private $debounce_time = 3600;

	public function action_index() {
		$sent = 0;

 		$debounce_time = $this->request->param('id') 
 			? (int) $this->request->param('id') 
 			: $this->debounce_time;

		$hour_ago = date('Y-m-d H:i:s', time() - $debounce_time);

		// get al the lists that haven't been updated in the last hour
		$lists = ORM::factory('list')

		// haven't been updated too recently
		->where('list.updated', '<', $hour_ago)

		// but have been "updated" since their last notification
		// (here, adding a friend to a list is counted as updated)
		->where('list.updated', '>=', DB::expr('`last_notification`'))
		
		->find_all();

		foreach ($lists as $list) {
			$sent += $list->send_notifications($debounce_time);
		}

		echo $sent;
	}

	
}


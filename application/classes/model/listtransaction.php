<?php

/**
 * Every time a list is updated, a transaction is added
 * 
 * Events triggering a transaction:
 *  - Gift->add()
 *  - Gift->update()
 */
class Model_Listtransaction extends ORM {
	
	public static function log(Model_List $list, $description) {
		$list->touch();

		$t = new Model_Listtransaction;
		$t->list_id = $list->id;
		$t->description = $description;
		$t->save();
	}

}
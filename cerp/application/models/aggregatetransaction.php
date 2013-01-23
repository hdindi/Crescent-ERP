<?php
class Aggregatetransaction extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this->hasColumn('accountid', 'integer', 11);
		$this->hasColumn('journalid','integer', 11);
		$this->hasColumn('assetype', 'string', 255);
		$this->hasColumn('accountperiod', 'string' , 255);
		$this->hasColumn('amount', 'integer', 11);
	}

	
}

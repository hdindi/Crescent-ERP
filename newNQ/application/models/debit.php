<?php
class Debit extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this->hasColumn('amount', 'integer', 11);
		$this->hasColumn('accountid', 'integer', 11);
		$this->hasColumn('journalid','integer', 11);
		$this->hasColumn('assetype', 'string', 255);
		
	}

	
}

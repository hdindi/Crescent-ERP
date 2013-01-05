<?php
class Service extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this->hasColumn('vehicleid', 'integer', 11);
		$this->hasColumn('lastservicedate','integer', 11);
		$this->hasColumn('nextservicedate', 'string', 255);
		$this->hasColumn('description', 'string' , 255);
		$this->hasColumn('accountid', 'integer', 11);
		$this->hasColumn('journalid', 'integer' , 11);
	}

	
}

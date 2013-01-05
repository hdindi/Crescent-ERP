<?php
class Account extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this->hasColumn('accountname', 'string', 255);
	}

	
	
}

<?php
class Users extends Doctrine_Record {

	public function setTableDefinition() {
		
		$this->hasColumn('name', 'string', 255);
		$this->hasColumn('email', 'string', 255);
		$this->hasColumn('date', 'string', 255);
		
		
		
	}
	
	

	
}
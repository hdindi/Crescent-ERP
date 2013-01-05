<?php
class Vehicle extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this->hasColumn('vehicletype', 'string', 255);
		$this->hasColumn('registrationnumber','string', 255);
		
	}

	
}

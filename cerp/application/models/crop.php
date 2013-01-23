<?php
class Crop extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('cropname', 'string', 255);
		$this->hasColumn('croptype', 'string', 255);
		
		
		
	}
	
	

	
}
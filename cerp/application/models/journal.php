<?php
class Journal extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this->hasColumn('jounralname', 'string', 255);
	}

	
	
}

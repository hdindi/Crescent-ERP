<?php
class Weighbirdge extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this->hasColumn('vehicleid', 'integer', 11);
		$this->hasColumn('netweight','integer', 11);
		$this->hasColumn('plotnumber', 'string', 255);
		$this->hasColumn('ticketnumber', 'string' , 255);
		$this->hasColumn('canereceipt', 'string', 255);
	}

	
}

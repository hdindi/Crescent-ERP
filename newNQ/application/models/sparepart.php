<?php
class Sparepart extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this->hasColumn('sparepartname', 'integer', 11);
		$this->hasColumn('sarepartquantity','integer', 11);
		$this->hasColumn('sparepartprice', 'integer', 11);
		$this->hasColumn('spareparttotalprice', 'string' , 255);
		$this->hasColumn('accountid', 'integer', 11);
		$this->hasColumn('journalid' , 'integer' , 11);
	}

	
}

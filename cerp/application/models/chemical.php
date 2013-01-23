<?php
class Chemical extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('plotnumber', 'string', 255);
		$this->hasColumn('name', 'string', 255 );
		$this->hasColumn('type', 'string', 255);
		$this->hasColumn('quantity', 'integer', 10);
		$this->hasColumn('baseprice', 'integer', 10);
		$this->hasColumn('totalprice', 'integer' , 255);
		$this->hasColumn('journalid', 'integer' , 10);
		$this->hasColumn('accountid', 'integer' , 10);
		
		
	}
	
	

	
}
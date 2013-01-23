<?php
class Delivery extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('plotnumber', 'string', 255 );
		$this->hasColumn('canecycle', 'string', 255);
		$this->hasColumn('canestate', 'string', 255);
		$this->hasColumn('totalstack', 'integer', 10);
		$this->hasColumn('deliverynote', 'string', 255);
		$this->hasColumn('baseprice', 'integer' , 10);
		
		
	}
	
	

	
}
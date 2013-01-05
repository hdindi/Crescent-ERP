<?php
class Season extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('growthmonth', 'string', 255 );
		$this->hasColumn('expectedharvestmonth', 'string', 255 );
		$this->hasColumn('actualharvestmonth', 'string', 255);
		$this->hasColumn('plotnumber', 'string', 255);
		
		
		
	}
	
	

	
}
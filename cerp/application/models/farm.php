<?php
class Farm extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('plotnumber', 'string', 255);
		$this->hasColumn('farmname', 'string', 255);
		$this->hasColumn('crop', 'string', 255);
		$this->hasColumn('acre', 'integer', 10);
		$this->hasColumn('soiltype', 'string', 255);
		$this->hasColumn('fielddescription', 'string' , 255);
		//$this->hasColumn('dateofcontract', 'date' , 255);
		$this->hasColumn('leasorname', 'string', 255);
		
		
	}
	
	

	
}
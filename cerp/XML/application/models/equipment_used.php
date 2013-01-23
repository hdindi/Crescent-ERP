<?php
class Equipment_Used extends Doctrine_Record {
	
	public function setTableDefinition(){
		$this -> hasColumn('Equipment', 'int', 15);
		$this -> hasColumn('Last_calibrated', 'varchar', 15);
		$this -> hasColumn('Next_calibration', 'varchar', 15);
		$this -> hasColumn('Remarks', 'varchar', 255);
	}//end setTableDefinition
	
	public function setUp() {
		$this -> setTableName('equipment_used');
		$this -> hasOne('Equipment as Equipment_Object', array('local' => 'Equipment', 'foreign' => 'id'));
	}//end setUp
	
	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("equipment_used");
		$equipmentData = $query -> execute();
		return $equipmentData;
	}//end getAll

}//end class
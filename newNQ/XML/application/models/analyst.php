<?php

class Analyst extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('dept_id', 'int', 11);
		$this -> hasColumn('Name', 'int', 11);
			
		//$this -> hasColumn('Request_id', 'int', 25);
	}

	public function setUp() {
		$this -> setTableName('analysts');
		$this -> hasOne('Departments as Department',
		array(
		'local'=> 'dept_id',
		'foreign' => 'id'
		));
	}//end setUp

}
?>
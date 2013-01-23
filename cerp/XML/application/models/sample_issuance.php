<?php

class Sample_issuance extends Doctrine_Record {
	
	public function setTableDefinition() {
		
	$this -> hasColumn('Test_id','int', 11);
	$this -> hasColumn('Analyst_id','int',11);
	$this -> hasColumn('Lab_ref_no','varchar', 25);
	$this -> hasColumn('Samples_no','int', 11);
	$this -> hasColumn('Status_id','int',11);
	$this -> hasColumn('Department_id','int',11);
	
	
	}
	
	public function setUp(){
		
	$this -> setTableName('sample_issuance');		
		
	}
	
	public function getTests($user_id) {
		
		$query = Doctrine_Query::create()
		-> select('*') 
		-> from('sample_issuance s, tests t')
		-> where('s.analyst_id = ?', $user_id)
		-> andwhere('t.id = s.test_id');
		$testData = $query -> execute();
		return $testData;
		
	}
	
	
}

?>
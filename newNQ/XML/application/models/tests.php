<?php

class Tests extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('Name', 'varchar', 35);
		$this -> hasColumn('Charge', 'double');
		$this -> hasColumn('Department', 'varchar', 25);
		$this -> hasColumn('Alias', 'varchar', 25);
	}

	public function setUp() {
		$this -> setTableName('tests');
		$this -> hasOne('request_details as request_detail',
		array(
		'local'=>'id',
		'foreign' => 'test_id'
		));
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("tests");
		$testData = $query -> execute();
		return $testData;
	}//end getall

	public function getWetChemistry() {
		$query = Doctrine_Query::create() -> select("*") -> from("tests") -> where('Department = 1');
		$testData = $query -> execute();
		return $testData;
	}//end getall

	public function getMicrobiologicalAnalysis() {
		$query = Doctrine_Query::create() -> select("*") -> from("tests") -> where('Department = 2');
		$testData = $query -> execute();
		return $testData;
	}//end getall

	public function getMedicalDevices() {
		$query = Doctrine_Query::create() -> select("*") -> from("tests") -> where('Department = 3');
		$testData = $query -> execute();
		return $testData;
	}//end getall

	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("Name,Charge") -> from("tests");
		$testData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $testData;
	}
	


		public static function getTestName($reqid){
		$query=Doctrine_Query::create()
		->select("t.Name, t.Department, t.Id" )
		->from("Tests t, Request_details r")
		->where('r.Request_id = ?', $reqid)
		->andWhere('r.test_id = t.id')
		; 
		$testData=$query->execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}
	


}
?>
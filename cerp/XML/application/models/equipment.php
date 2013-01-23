<?php
class Equipment extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('Name', 'varchar', 35);
		$this -> hasColumn('Nqcl_code', 'varchar', 35);
	}//end setTableDefinition

	public function setUp() {
		$this -> setTableName('equipment');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("equipment");
		$equipmentData = $query -> execute();
		return $equipmentData;
	}//end getAll

	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("Name,Nqcl_code") -> from("Equipment");
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}

}//end class

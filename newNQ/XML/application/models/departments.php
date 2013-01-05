<?php

class Departments extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('Name', 'varchar', 25);
	}

	public function setUp() {
		$this ->hasMany('Users as User', array(
		'local'=>'id',
		'foreign'=> 'id'));
		$this -> setTableName('departments');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("departments");
		$departmentData = $query -> execute();
		return $departmentData;
	}
	
	
	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("*") -> from("departments");
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}
	
	public function getDepartments($reqid){
	
	$query = Doctrine_Query::create()
	-> select("d.Name")
	-> from('Departments d, Request_details r, Tests t')
	-> where('r.request_id = ?', $reqid)
	-> andWhere('r.test_id = t.id')
	-> andWhere('d.id = t.department')	
	;
	
	$deptdata = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
	return $deptdata;
	}

}
?>
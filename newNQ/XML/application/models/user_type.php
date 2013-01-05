<?php
class User_type extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('name', 'varchar', 20);
		
	}
	
	public function setUp() {
		$this->setTableName('user_type');
		$this -> hasMany('User as users', array('local' => 'id', 'foreign' => 'usertype_id'));
	}


	public function getAll() {
		$query = Doctrine_Query::create()
		-> select('*')
		-> from('user_type');
		$testData = $query -> execute();
		return $testData;
	}

	
}

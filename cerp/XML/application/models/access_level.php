<?php
class Access_level extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int',15);
		$this -> hasColumn('level', 'varchar',255);	
		$this -> hasColumn('type', 'int',255);		
	}

	public function setUp() {
		$this -> setTableName('access_level');
	//	$this -> hasMany('user as u_type1', array('local' => 'id', 'foreign' => 'usertype_id'));
		
	}

	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("access_level")-> where("type=1 or type=3 or type=4 or type=6");
		$level = $query -> execute();
		return $level;
	}
	public static function getAll1() {
		$query = Doctrine_Query::create() -> select("*") -> from("access_level")-> where("type=2 or type=5");
		$level = $query -> execute();
		return $level;
	}
	public static function getAll2() {
		$query = Doctrine_Query::create() -> select("*") -> from("access_level")-> where("type=5");
		$level = $query -> execute();
		return $level;
	}
	

}
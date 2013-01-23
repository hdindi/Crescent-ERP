<?php

class Request_details extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'varchar', 20);
		$this -> hasColumn('test_id', 'int', 11);
		$this -> hasColumn('limit', 'int', 11);
		$this -> hasColumn('samples_issued', 'int', 11);
		$this -> hasColumn('status', 'varchar', 20);
		$this -> hasColumn('assigned_to', 'varchar', 50);
			
		//$this -> hasColumn('Request_id', 'int', 25);
	}

	public function setUp() {
		$this -> setTableName('request_details');
		$this -> hasMany('Tests as Test_s',
		array(
		'local' => 'test_id',
		'foreign' => 'id'
		));
	}//end setUp

	
	public static function get_value2($reqid){
  	
		$query=Doctrine_Query::create()-> select("*")->from("request_details")-> where("request_id = '$reqid'");
		$testData=$query->execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}
	

}
?>
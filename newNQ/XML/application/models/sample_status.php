<?php

class Sample_status extends Doctrine_Record {
	
	public function setTableDefinition() {
		
		$this -> hasColumn('name','varchar',35);
	}
	
	public function setUp(){
		
		$this -> setTableName('sample_status');
		
	}

	public function getAll(){
		
		$query = Doctrine_Query::create() -> select("*") -> from("sample_status");
		$requestData = $query -> execute();
		return $requestData;
	}

}

?>
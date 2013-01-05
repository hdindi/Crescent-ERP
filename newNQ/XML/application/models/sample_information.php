<?php

class Sample_information extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('Submission_date', 'varchar', 15);
		$this -> hasColumn('Lab_ref_no', 'varchar', 25);
		$this -> hasColumn('Chemical_name', 'varchar', 35);
		$this -> hasColumn('Description', 'varchar', 255);
		$this -> hasColumn('Presentation', 'int', 15);
		$this -> hasColumn('Label_claim', 'varchar', 35);
		$this -> hasColumn('Product_lic_no', 'varchar', 35);
		$this -> hasColumn('Manufacturer', 'varchar', 35);
		$this -> hasColumn('Country_of_origin', 'varchar', 35);
		$this -> hasColumn('Request_id', 'int', 11);
		$this -> hasColumn('Product_id', 'int', 11);
	}//end setTableDefinition

	public function setTableName() {
		$this -> setTableName('sample_information');
	}//end setTableName

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("sample_information");
		$sampleData = $query -> execute();
		return $sampleData;
	}//end getAll
	
	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("*") -> from("sample_information");
		$sampleData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $sampleData;
	}
	

}//end class

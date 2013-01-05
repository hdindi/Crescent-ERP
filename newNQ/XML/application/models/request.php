<?php

class Request extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'varchar', 20);
		$this -> hasColumn('client_id', 'varchar', 11);
		$this -> hasColumn('sample_qty', 'int', 11);
		$this -> hasColumn('product_name', 'varchar', 30);
		$this -> hasColumn('active_ing', 'varchar', 50);
		$this -> hasColumn('Dosage_Form', 'varchar', 50);
		$this -> hasColumn('Manufacturer_Name', 'varchar', 50);
		$this -> hasColumn('Manufacturer_add', 'varchar', 50);
		$this -> hasColumn('Batch_no', 'varchar', 10);
		$this -> hasColumn('exp_date', 'date');
		$this -> hasColumn('Manufacture_date', 'date');
		$this -> hasColumn('Designator_Name', 'varchar', 50);
		$this -> hasColumn('Designation', 'varchar', 30);
		$this -> hasColumn('Designation_date', 'date');
		//$this -> hasColumn('date_of_req', 'date');
		
		//$this -> hasColumn('Request_id', 'int', 25);
	}

	public function setUp() {
		$this -> setTableName('request');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("request");
		$requestData = $query -> execute();
		return $requestData;
	}//end getall
	 public static function get_value($delivery){
  	
		$query=Doctrine_Query::create()-> select("*")->from("request")-> where("id=$delivery");
		$order=$query->execute();
		return $order[0];
	}

	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("Batch_no,Product_Name,Quantity,Expiry_date,Designator_Name,Designation,Designation_date,Applicant_reference_number") -> from("request");
		$requestData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $requestData;
	}

	public function getRequest($id) {
		$query = Doctrine_Query::create() -> select("*") -> from("request") -> where("Request_id = $id");
		$requestData = $query -> execute();
		return $requestData;
	}//end getRequest

	
	public function getRequestId() {
		$query = Doctrine_Query::create() 
		-> select('*')
		-> from("request");
		$requestData = $query -> execute() -> getLast();
		return $requestData;
	}//end getRequest
	

	
}
?>
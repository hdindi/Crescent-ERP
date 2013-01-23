<?php

class Clients extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('Name', 'varchar', 25);
		$this -> hasColumn('Address', 'varchar', 25);
		$this -> hasColumn('Client_type', 'varchar', 5);
		$this -> hasColumn('Contact_person', 'varchar', 25);
		$this -> hasColumn('Contact_phone', 'int', 10);
		$this -> hasColumn('Ref_number', 'varchar',20);
	}

	public function setUp() {
		$this -> setTableName('clients');
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("clients");
		$clientData = $query -> execute();
		return $clientData;
	}//end getall

	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("Name,Address,Client_type,Contact_person,Contact_phone") -> from("clients");
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}


	public function getClient($reqid) {

		$query = Doctrine_Query::create() 
		-> select("c.*") 
		-> from("clients c, request r")
		-> where("r.request_id = '$reqid' && r.client_id = c.id");
		$clientData =  $query -> execute() -> getFirst();
		return $clientData;
	}


}
?>
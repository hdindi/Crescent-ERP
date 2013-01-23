<?php

class Products extends Doctrine_Record {
	
	public function setTableDefinition() {
		
	$this->hasColumn('Name','varchar', 25);
	$this->hasColumn('Presentation','varchar', 200);
	$this->hasColumn('Batch_no','varchar', 25);
	$this->hasColumn('Manufacture_date','varchar',15);
	$this->hasColumn('Expiry_date','varchar',15);
	$this->hasColumn('Quantity_submitted','int', 15);
	
	}

	public function setUp() {
		$this -> setTableName('Products');
	}//end setUp


	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("Products");
		$productData = $query -> execute();
		return $productData;
	}//end getall

}

?>
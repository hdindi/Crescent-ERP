<?php
class Payroll extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('employeeid', 'string', 255);
		$this->hasColumn('paymentdate', 'date', 25 );
		$this->hasColumn('basicsalary', 'integer', 255);
		$this->hasColumn('medicalallowance', 'integer', 255);
		$this->hasColumn('houseallowance', 'integer', 255);
		$this->hasColumn('grosssalary', 'integer' , 255);
		$this->hasColumn('paye', 'integer' , 255);
		$this->hasColumn('nhifdeductions', 'string' , 255);
		$this->hasColumn('nssfdeductions', 'integer' , 10);
		$this->hasColumn('journalid', 'integer' , 10);
		$this->hasColumn('accountid', 'integer' , 10);
		

		
		
	}
	
	

	
}
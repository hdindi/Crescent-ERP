<?php
class Employee extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('firstname', 'string', 255);
		$this->hasColumn('lastname', 'string', 255 );
		$this->hasColumn('age', 'string', 255);
		$this->hasColumn('payroll', 'integer', 10);
		$this->hasColumn('appointment', 'date', 25);
		$this->hasColumn('grade', 'string' , 255);
		$this->hasColumn('nationalid', 'integer' , 10);
		$this->hasColumn('address', 'string' , 255);
		$this->hasColumn('nextofkin', 'integer' , 10);
		$this->hasColumn('nhifno', 'string' , 255);
		$this->hasColumn('nssfno', 'string' , 255);
		$this->hasColumn('krapin', 'integer' , 255);
		$this->hasColumn('homedistrict', 'string' , 10);
		$this->hasColumn('location', 'string' , 255);
		$this->hasColumn('employeetype', 'string' , 10);
		$this->hasColumn('paymenttype', 'string' , 10);
		$this->hasColumn('annulaleavedays', 'integer' , 10);
		$this->hasColumn('outstandingleavedays', 'integer' , 10);
		$this->hasColumn('promotiondate', 'string' , 10);
		$this->hasColumn('currentgrade', 'string' , 10);
		$this->hasColumn('password', 'string' , 255);

		
		
	}
	
	

	
}
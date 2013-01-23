<?php

class Dept_mgt extends MY_Controller {
	function __construct(){
		parent::__construct();
	}//end constructor


	public function listing(){
		$data = array();
		$data['dept_details'] = Departments::getAllHydrated();
		$data['dept_all'] = Departments::getAll();
		$this -> table -> set_heading(array('id', 'Name'));
		$this -> base_params($data);
	}//end listing
	
	
	public function base_params($data) {
		$data['title'] = "Department Test";	
		$this -> load -> view('dept_mgt_view',$data);
	}//end base_params

}
?>
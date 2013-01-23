<?php

class Test_Controller extends MY_Controller{
	function __construct(){
		parent::__construct();
	}//end constructor
	
	public function index(){
		$this -> listing();
	}//end index
	
	public function listing(){
		$data = array();
		$data['settings_view'] = "tests_v";
		$data['test_details'] = Tests::getAllHydrated();
		$this -> table -> set_heading(array('id', 'Test Name','Charge Per Test (KES.)'));
		$this -> base_params($data);
	}//end listing
		
	public function save(){
		$valid = $this -> _validate_submission();
		if($valid == false){
			$this -> listing();
		}else{
			$test_name = $this -> input -> post("test_name");
			$charges = $this -> input -> post("charges");
			
			$test = new Tests();
			$test -> Name = $test_name;
			$test -> Charge = $charges;
						
			$test -> save();
			redirect("test_controller/listing");
		}//end else
	}//end save
	
	private function _validate_submission() {
		$this -> form_validation -> set_rules('test_name', 'Test Name', 'trim|required|min_length[1]|max_length[35]');
		//$this -> form_validation -> set_rules('charges', 'Charges', 'required');
		return $this -> form_validation -> run();
	}//end validate_submission
	
	public function base_params($data) {
		$data['title'] = "Test Management";	
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['quick_link'] = "test";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "NQCL Settings";
		$data['link'] = "settings_management";
		
		$this -> load -> view('template',$data);
	}//end base_params
}//end class

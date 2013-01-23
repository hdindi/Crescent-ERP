<?php

class Sample_issue extends MY_Controller{
	function __construct(){
		parent::__construct();
	}//end constructor
	
	//public function index(){
		//$this -> listing();
	//}//end index
	
		public function save() {
		
		$test_id = $this -> input -> post("test_id");
		$lab_ref_no = $this -> input -> post("lab_ref_no");
		$analyst_id = $this -> input -> post("analyst_id");
		$department_id = $this -> input -> post("department_id");
		$samples_no = $this -> input -> post("samples_no");
		$status_id = $this -> input -> post("status_id");
		
		
		$sample_issue = new Sample_issuance();
		$sample_issue -> Test_id = $test_id;
		$sample_issue -> Lab_ref_no = $lab_ref_no;
		$sample_issue -> Department_id = $test_id;
		$sample_issue -> Samples_no = $samples_no;
		$sample_issue -> Status_id = $status_id;
		$sample_issue -> Analyst_id = $analyst_id;
		
		
		$sample_issue -> save();
		
		redirect("/sample_issue/assign/" . $lab_ref_no);

		}
	
		public function assign() {
			
		$ndq = $this -> uri -> segment(3);
		$yr = $this -> uri -> segment(4);
		$mnth = $this -> uri -> segment(5);
		$id = $this -> uri -> segment(6);
		
			
		$reqid = $ndq. "/".$yr."/".$mnth."/".$id;
	
		
		$data['departments'] = Departments::getDepartments($reqid);		
		$data['mytests'] = Tests::getTestName($reqid);
		$data['analysts'] = User::getAnalysts($reqid);
		
		
		$data['title'] = "Sample Information";
     	$data['content_view'] = "sample_issuance_v";
		$data['banner_text'] = "Sample Issuance";
		$data['link'] = "home";
		$data['quick_link'] = "sample_issuance_v";
		$this -> load -> view("template", $data);
		
		
	}
	
	
}

?>

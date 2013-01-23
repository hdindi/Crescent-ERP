<?php

class Analyst_Controller extends CI_Controller {

  
    public function index() {
      
        $data=array();        
       $data['settings_view'] = "analyst_v";
	   
	   	$userarray = $this->session->userdata;
		$user_id = $userarray['user_id'];
	   
	   $data['tests_assigned']= Sample_issuance::getTests($user_id);
       //$results=$this->get_tests();
       //var_dump($results);
        $this -> base_params($data);
    }
    
	
        public function base_params($data) {
		$data['title'] = "Analyst";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");		
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "NQCL Settings";
		$data['link'] = "settings_management";

		$this -> load -> view('template', $data);
	
        
        
    }
}



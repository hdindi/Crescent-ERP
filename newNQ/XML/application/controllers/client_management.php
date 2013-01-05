<?php

class Client_Management extends MY_Controller{
	function __construct(){
		//calls constructor method
		parent::__construct();
	}//end constructor
	
	public function index(){
		//redirects to listing method
		$this -> listing();
	}//end index
	
	public function listing(){
		//method listing() gives a tabular report of existing records
		$data = array();
		//places view on the right in the array key 'settings_view', and can thus be accessed under the key from elsewhere
		$data['settings_view'] = "clients_v";
				
		//the method call on the right passes the returned data as an array and stores it in the 'client_details' key to be called from another file
		$data['client_details'] = Clients::getAllHydrated();
		
		//formatting for the tabular report mentioned above, make sure to pass id and the rest are the way you'd like the title captions
		$this -> table -> set_heading(array('id', 'Client Name', 'Client Address','Client Type', 'Contact Person', 'Contact Phone'));
		
		//pass all the data in the '$data' array to the base_params method
		$this -> base_params($data);
	}//end listing
		
	public function save(){
		//stores the validation results in a variable, $valid
		$valid = $this -> _validate_submission();
		
		//if the result is true or false...
		if($valid == false){
			$this -> listing();
		}else{
		 //variable name   //class  //html control //php post function("control name in the html file")
			$client_name = $this -> input -> post("client_name");
			$client_address = $this -> input -> post("client_address");
			$client_number = $this -> input -> post("clientT");
			$contact_person = $this -> input -> post("contact_person");
			$contact_phone = $this -> input -> post("contact_phone");
			$client_ref_no = $this -> input -> post("client_ref_no");
			//variable storing the class instance
			$client = new Clients();
			
			//passing the variables posted above to the class variable
			$client -> Name = $client_name;
			$client -> Address = $client_address;
			$client -> Client_type = $client_number;
			$client -> Contact_person = $contact_person;
			$client -> Contact_phone = $contact_phone;
			$client -> Ref_number = $client_ref_no;

			//save the data						
			$client -> save();
			redirect("request_management/add");
		}//end else
	}//end save
	
	private function _validate_submission() {
		//validation rules
		$this -> form_validation -> set_rules('client_name', 'Client Name', 'trim|required|min_length[2]|max_length[25]');
		$this -> form_validation -> set_rules('client_address', 'Client Address', 'trim|required|min_length[2]|max_length[25]');
		//$this -> form_validation -> set_rules('client_number', 'Client Number', 'trim|required|min_length[1]|max_length[15]');
		$this -> form_validation -> set_rules('contact_person', 'Contact Person', 'trim|required|min_length[2]|max_length[25]');
		$this -> form_validation -> set_rules('contact_phone', 'Contact Telephone Number', 'trim|required|min_length[10]|max_length[10]');
		return $this -> form_validation -> run();
	}//end validate_submission
	
	public function base_params($data) {
		$data['title'] = "Client Management";	
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['quick_link'] = "client";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "NQCL Settings";
		$data['link'] = "settings_management";
		
		$this -> load -> view('template',$data);
	}//end base_params
}//end class

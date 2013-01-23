<?php

class Sample_Controller extends MY_Controller{
	function __construct(){
		parent::__construct();
	}//end constructor
	
	public function index(){
		$this -> listing();
	}//end index
	
	public function listing(){
		$data = array();
		$data['settings_view'] = "sample_v";
		$data['quick_link'] = "sample";
		$data['samples_details'] = Sample_information::getAllHydrated();
		$this -> table -> set_heading(array('id', 'Submission Date', 'Lab Reference Number', 'Generic Brand Name','Chemical Name','Description', 'Presentation', 'Label Claim', 'Batch Number', 'Product Number','Manufacture Date','Expiry Date','Client Name','Client Address', 'Client Reference','Manufacturer','Country of Origin','Samples Issued','Samples Returned','Tests Required','Tests Required Limits','Analyst', 'Checker','Approver','Date'));
		$this -> base_params($data);
	}//end listing
	
	public function add(){
		$data['settings_view'] = "sample_add_v";
		$data['title'] = "Add New Sample Information";
		//$data['tests'] = Tests::getAllJoined();
		$this -> base_params($data);
	}//end add
	
	
	public function save(){
		$valid = $this -> _validate_submission();
		//$valid = true;
		if($valid == false){
			$data['settings_view'] = "sample_add_v";
			$this -> base_params($data);
		}else{	
		
			 
			$submission_date = $this -> input -> post("submission_date");
			$lab_ref_no = $this -> input -> post("lab_ref_no");
			$chemical_name = $this -> input -> post("chemical_name");
			$description = $this -> input -> post("description");
			$presentation = $this -> input -> post("presentation");
			$label_claim = $this -> input -> post("label_claim");
			$product_lic_no = $this -> input -> post("product_lic_no");
			$country_of_origin = $this -> input -> post("country_of_origin");

			
			$sample = new Sample_Information();
			$sample -> Submission_date = $submission_date;
			$sample -> Lab_ref_no = $lab_ref_no;
			$sample -> Chemical_name = $chemical_name;
			$sample -> Description = $description;
			$sample -> Presentation = $presentation;
			$sample -> Label_claim = $label_claim;
			$sample -> Product_lic_no = $product_lic_no;
			$sample -> Manufacturer = $manufacturer;
			$sample -> Country_of_origin = $country_of_origin;
			//$sample -> Date = date("Y-m-d");
			$sample -> save();

			redirect("/sample_issue/assign/" . $lab_ref_no);
		}//end else
	}//end save
	
	public function test(){
		
		$delivery=$this->uri->segment(3);
		$ndq = $this -> uri -> segment(4);
		$yr = $this -> uri -> segment(5);
		$mnth = $this -> uri -> segment(6);
		$id = $this -> uri -> segment(7);
		
		$reqid = $ndq. "/".$yr."/".$mnth."/".$id;
		
		var_dump($reqid);
		
		$data['mylist'] =Request::get_value($delivery);
		$data['clientinfo'] =Clients::getClient($reqid);
		$data['title'] = "Sample Information";
     	$data['content_view'] = "sample_add_v";
		$data['banner_text'] = "Sample Information";
		$data['link'] = "home";
		$data['quick_link'] = "sample_add_v";
		$this -> load -> view("template", $data);
		//echo json_encode($x);	
		
	}
	
	

	 public function getit(){
		//for ajax
		$delivery=$this->uri->segment(3);
		$describe=Request::get_value($delivery);
		$x=$describe->toArray();
		echo json_encode($x);
		echo $delivery;
		//var_dump($x);
		
	}
	 
	
	private function _validate_submission() {
		$this -> form_validation -> set_rules('submission_date', 'Date of Submission', 'trim|required');
		$this -> form_validation -> set_rules('lab_ref_no', 'Lab Reference Number', 'trim|required');
		$this -> form_validation -> set_rules('generic_brand_name', 'Generic Brand Name', 'trim|required');
		$this -> form_validation -> set_rules('chemical_name', 'Chemical Name', 'trim|required');
		$this -> form_validation -> set_rules('description', 'Description', 'trim|required');
		$this -> form_validation -> set_rules('presentation', 'Presentation', 'trim|required');
		$this -> form_validation -> set_rules('label_claim', 'Label Claim', 'trim|required');
		$this -> form_validation -> set_rules('batch_no', 'Batch Number', 'trim|required');
		$this -> form_validation -> set_rules('product_lic_no', 'Product License Number', 'trim|required');
		$this -> form_validation -> set_rules('client_name', 'Client Name', 'trim|required');
		$this -> form_validation -> set_rules('client_address', 'Client Address', 'trim|required');
		$this -> form_validation -> set_rules('manufacturer', 'Manufacturer', 'trim|required');
		$this -> form_validation -> set_rules('country_of_origin', 'Country of Origin', 'trim|required');
		return $this -> form_validation -> run();

	}//end validate_submission*/
	
	public function base_params($data) {
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['quick_link'] = "sample";
		$data['title'] = "System Settings";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "System Settings";
		//$data['link'] = "settings_management";
		
		$this -> load -> view('template',$data);
	}//end base_params
}//end class

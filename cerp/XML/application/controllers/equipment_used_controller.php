<?php

class Equipment_Used_Controller extends MY_Controller{
	function __construct(){
		parent::__construct();
	}//end constructor
	
	public function index(){
		$this -> listing();
	}//end index
	
	public function listing(){
		$data = array();
		$data['settings_view'] = "equipment_used_v";
		$data['equipment_used'] = Equipment_used::getAll();
		$data['equipments'] = Equipment::getAll();
		$this -> base_params($data);
	}//end listing
	
	public function add(){
		$data['title'] = "Add New Equipment Used";
		$data['equipments'] = Equipment::getAll();
		$data['content_view'] = "equipment_used_add";
		$this -> base_params($data);
	}//end add
	
	public function save(){ 
		$valid = $this -> _validate_submission();
		if($valid == false){
			$data['content_view'] = "equipment_used_add";
			$this -> base_params($data);
		}else{
			$equipment = $this -> input -> post("equipment");
			$last_calibrated = $this -> input -> post("last_calibrated");
			$next_calibration = $this -> input -> post("next_calibration");
			$remarks = $this -> input -> post("remarks");
			
			$equipment_used = new Equipment_used();
			$equipment_used -> Equipment = $equipment;
			$equipment_used -> Last_calibrated = $last_calibrated;
			$equipment_used -> Next_calibration = $next_calibration;
			$equipment_used -> Remarks = $remarks;
			
			$equipment_used -> save();
			redirect("equipment_used_controller");
		}//end else
	}//end save
	
	private function _validate_submission() {
		$this -> form_validation -> set_rules('last_calibrated', 'Date of Last Calibration', 'trim|required|min_length[2]|max_length[25]');
		$this -> form_validation -> set_rules('next_calibration', 'Dtae of NExt Calibration', 'trim|required|min_length[2]|max_length[25]');
		return $this -> form_validation -> run();
	}//end validate_submission
	
	public function base_params($data) {
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['quick_link'] = "equipment_used";
		$data['title'] = "System Settings";
		$data['content_view'] = "settings_v";
		//$data['banner_text'] = "System Settings";
		//$data['link'] = "settings_management";
		
		$this -> load -> view('template',$data);
	}//end base_params
}//end class

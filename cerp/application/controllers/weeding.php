<?php

class Weeding extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		//parent::Controller();
		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	
	public function index() {
		$data['dropdown']=$this->get_dropdown();
		$this->load->view('weeding_form', $data);
	}

	public function get_dropdown(){
		$result = $this->db->select('id,plotnumber')->get('farm')->result_array();
		$dropdown = array();
		foreach($result as $r) {
			# code...
			$dropdown[$r['id']] = $r['plotnumber'];
		}
		return $dropdown;
	}
	
	 public function save() {
        if($_POST):

         //$data=  $this->input->post('result');
    	//$dataa = (double) ($data);
    	$datac = array(
             'amount' => $this->input->post( 'result', true )
        	
        	);
    	//'amount' => $this -> $dataa;
        $this->db->insert('debit',$datac);
        return true;
        else:
        return false;
        endif;
    }
	
	}

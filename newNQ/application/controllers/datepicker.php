<?php

class Datepicker extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		//parent::Controller();
		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}
	
	public function index() {
		$this->load->view('add');
	}
	
	public function create() {
		if( !empty( $_POST ) ) {
			$this->creates();
			echo 'New user created successfully!';
		}
	}
	public function creates() {
        $data = array(
            'name'  => $this->input->post( 'name', true ),
            'email' => $this->input->post( 'email', true ),
            'date' => $this->input->post( 'date', true )
        );
        
        $this->db->insert( 'users', $data );
    }
	
}

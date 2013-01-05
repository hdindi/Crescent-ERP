<?php
class Createaccount extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		//parent::Controller();
		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}
	
	public function index() {
		$this->load->view('createaccount_form');
	}
	}
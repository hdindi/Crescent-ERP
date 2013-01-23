<?php
//session_start();
class Logout extends CI_Controller {
	
	public function index() {
		
		 $this->session->unset_userdata('user_id');
		//session_destroy();
		$this->load->view('home');
	}
	
}

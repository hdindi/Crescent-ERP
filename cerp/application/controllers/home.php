<?php
error_reporting(0);
class Home extends CI_Controller {
	
	public function index() {
		$this->load->view('home');
	}	
	
}

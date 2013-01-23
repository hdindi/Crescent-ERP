<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_Management extends MY_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	public function index() {
		$this->load->view('login_v');
	}

	public function login() {
		$data = array();
		$data['title'] = "System Login";
		$this -> load -> view("login_v", $data);
	}

public function submit() {
		$username=$_POST['username'];
		$password=$_POST['password'];
		if ($this->_submit_validate() === FALSE) {
			$this->index();
			return;
		}
		$reply=User::login($username, $password);
		$n=$reply->toArray();
		//echo($n['username']);

		$myvalue=$n['user_type'];
		$namer=$n['fname'];
		$id_d=$n['id'];
		$inames=$n['lname'];
		//$disto=$n['district'];
		//$faci=$n['facility'];
	    $user_id=$n['id'];		
		
		
		
		
		if($myvalue == 2){	
		
		redirect("home_controller");
		}
		
		else if($myvalue == 1){
			
			redirect("analyst_controller");
		}
        
   
}


	public function Analyst_id(){
		
		
		
		
		
	}





	private function _submit_validate() {
		
		$this->form_validation->set_rules('username', 'Username', 
			'trim|required|callback_authenticate');
		
		$this->form_validation->set_rules('password', 'Password',
			'trim|required');
	
		$this->form_validation->set_message('authenticate','Invalid login. Please try again.');
	
		return $this->form_validation->run();

	}
	
	public function authenticate() {
		
		return Current_User::login($this->input->post('username'), 
									$this->input->post('password'));
		
	}
		

	public function go_home($data) {
		$data['title'] = "System Home";
		$data['content_view'] = "home_v";
		$data['banner_text'] = "Dashboards";
		$data['link'] = "home";
		$this -> load -> view("template", $data);
	}
		
	
}

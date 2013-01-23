<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_Registration extends MY_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}
	public function index() {
		$data['content_view'] = "signup_v";
		$data['banner_text'] = "Sign Up";
		$this -> load -> view("template", $data);
	}
	
	public function submit(){
		if ($this->_submit_validate() === FALSE) {
			$this->index();
			return;
		}
		$email=$this->input->post('email');
		$name1=$this->input->post('fname');
		$name2=$this->input->post('lname');
		$password=$this->input->post('password');
		$username=$this->input->post('username');
		
		$u = new User();
		$u->fname=$this->input->post('fname');
		$u->lname=$this->input->post('lname');
		$u->email = $this->input->post('email');
		$u->username = $this->input->post('username');
		$u->password = $this->input->post('password');
		$u->usertype_id = $this->input->post('type');
		$u->telephone = $this->input->post('tell');
		$u->district = $this->input->post('district');
		$u->facility = $this->input->post('facility');
		$u->save();
		
		$fromm='hcmpkenya@gmail.com';
		$messages='Hallo '.$name1.', You have been Registered as a user for the Health Commodities Management Platform System. Your username is '.$username.' and your password is '.$password.' . Please change your password when you login into the system. 
		
		Thank you';
	
  		$config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.googlemail.com',
  'smtp_port' => 465,
  'smtp_user' => 'hcmpkenya@gmail.com', // change it to yours
  'smtp_pass' => 'healthkenya', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
); 
		
        //$this->email->initialize($config);
		$this->load->library('email', $config);
 
  		$this->email->set_newline("\r\n");
  		$this->email->from($fromm,'Health Commodities Management Platform'); // change it to yours
  		$this->email->to($email); // change it to yours
  		$this->email->cc('kariukijackson@gmail.com,kelvinmwas@gmail.com,nicomaingi@gmail.com,jsphmk14@gmail.com');
  		$this->email->subject('User Registration :'.$name1.' '.$name2);
 		$this->email->message($messages);
 
  if($this->email->send())
 {

 }
 else
{
 show_error($this->email->print_debugger());
}

		$data['content_view'] = "moh/signup_v";
		$data['title'] = "User Registration";
		$data['banner_text'] = "Sign Up";
		$this -> load -> view("template", $data);
	}
	private function _submit_validate() {
		
		// validation rules
		$this->form_validation->set_rules('fname', 'First Name', 
			'trim|required|alpha_numeric|min_length[3]');
			
		$this->form_validation->set_rules('lname', 'Last Name', 
			'trim|required|alpha_numeric|min_length[3]');
			
		$this->form_validation->set_rules('username', 'Username', 
			'trim|required|alpha_numeric|min_length[3]|max_length[12]|unique[User.username]');
		
		$this->form_validation->set_rules('password', 'Password',
			'trim|required|min_length[3]|max_length[12]');
		
		$this->form_validation->set_rules('passconf', 'Confirm Password',
			'trim|required|matches[password]');
		
		$this->form_validation->set_rules('email', 'E-mail',
			'trim|required|valid_email|unique[User.email]');
			
			$this->form_validation->set_rules('tell', 'Mobile Number', 
			'trim|required|numeric|min_length[10]');
		
		return $this->form_validation->run();
		
	}
}
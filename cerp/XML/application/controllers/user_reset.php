<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class User_Reset extends MY_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}
	public function index($use_id) {
		$data['content_view'] = "reset_pass_v";
		$data['banner_text'] = " Reset Password";
		$data['detail_list1']=User::getAll4($use_id);
		$this -> load -> view("template", $data);
	}
	public function submit(){
		$id=$this->input->post('id');
		$password=$this->input->post('password');
		
		$use_id=$id;
		
		if ($this->_submit_validate() === FALSE) {
			$this->index($use_id);
			return;
		}
		$pass=Doctrine::getTable('user')->findOneById($id);
		$pass->password=$password;
		$pass->save();
		
		$data['title'] = "View Users";
		$data['content_view'] = "users_facility_v";
		$data['banner_text'] = "Facility Users";
		$data['result'] = User::getAll2();
		$data['counties'] = Counties::getAll();
		$this -> load -> view("template", $data);
		
	}
	private function _submit_validate() {
		// validation rules
	
		$this->form_validation->set_rules('opassword', 'Previous Password',
			'trim|required|min_length[3]|max_length[12]|equals[User.password]');
			
		$this->form_validation->set_rules('password', 'Password',
			'trim|required|min_length[3]|max_length[12]');
		
		$this->form_validation->set_rules('passconf', 'Confirm Password',
			'trim|required|matches[password]');
		
		return $this->form_validation->run();
		
	}	
}
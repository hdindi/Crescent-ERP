<?php

class Uploadlogin extends Controller {

	function Uploadlogin()
	{
		parent::Controller();
		//$this->load->model('users');
	}
	
	function index()
	{
		$this->load->view('uploadlogin');
	}
	
	function register()
	{
		if(isset($_POST['username'])){

			// User has tried registering, insert them into database.

			$username = $_POST['username'];
			$password = $_POST['password'];

			$this->register1($username, $password);

			redirect('uploadlogin');

		}
		else{
			//User has not tried registering, bring up registration information.
			$this->load->view('register');
		}
	}
	
	function go()
	{

		$username = $_POST['username'];
		$password = $_POST['password'];

		//Returns userid is successful, false is unsuccessful
		$results = $this->login($username,$password);

		if ($results==false) redirect('uploadlogin');
		else 
		{	
			$this->session->set_userdata(array('userid'=>$results));
			redirect('profile');
		}

	}
	
	function logout()
	{
		$this->session->set_userdata(array('userid'=>''));
		redirect('uploadlogin');
	}


	function register1($username, $password)
	{
	    $new_user = array (
	    	'username'=>$username,
	    	'password'=>$password
	    );

	    $this->db->insert('users', $new_user);

		return true;
	}
	
	function login($username, $password)
	{

		$query = $this->db->get_where('users', array('username'=>$username, 'password'=>$password));

		if ($query->num_rows()==0) return false;
		else{
			$result = $query->result();
			$userid = $result[0]->id;

			return $userid;
		}

	}
	
}
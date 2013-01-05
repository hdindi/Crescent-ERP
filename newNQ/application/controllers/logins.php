<?php

class Logins extends CI_Controller {
	public function __construct() {
		parent::__construct();
		//$this->load->model( 'mUsers' );
	}

	function Logins()
	{
		
		//parent::__construct();
		//$this->load->model('users');
	}
	
	function index()
	{
		$this->load->view('logins');
	}
	
	function register()
	{
		if(isset($_POST['username'])){

			// User has tried registering, insert them into database.

			$username = $_POST['username'];
			$password = $_POST['password'];

			$this->registers($username, $password);

			redirect('logins');

		}
		else{
			//User has not tried registering, bring up registration information.
			$this->load->view('registers');
		}
	}
	function registers($username, $password)
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
	
	function go()
	{

		$username = $_POST['username'];
		$password = $_POST['password'];

		//Returns userid is successful, false is unsuccessful
		$results = $this->login($username,$password);

		if ($results==false) redirect('logins');
		else 
		{	
			$this->session->set_userdata(array('userid'=>$results));
			redirect('profiles');
		}

	}
	
	function logout()
	{
		$this->session->set_userdata(array('userid'=>''));
		redirect('logins');
	}
	
}
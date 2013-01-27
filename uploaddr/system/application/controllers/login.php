<?php

class Login extends Controller {

	function Login()
	{
		parent::Controller();
		$this->load->model('users');
	}
	
	function index()
	{
		$this->load->view('login');
	}
	
	function register()
	{
		if(isset($_POST['username'])){

			// User has tried registering, insert them into database.

			$username = $_POST['username'];
			$password = $_POST['password'];

			$this->users->register($username, $password);

			redirect('login');

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
		$results = $this->users->login($username,$password);

		if ($results==false) redirect('login');
		else 
		{	
			$this->session->set_userdata(array('userid'=>$results));
			redirect('profile');
		}

	}
	
	function logout()
	{
		$this->session->set_userdata(array('userid'=>''));
		redirect('login');
	}
	
}
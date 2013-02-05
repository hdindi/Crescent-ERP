<?php
error_reporting(0);
class Profile extends Controller {

	function Profile()
	{
		parent::Controller();

		$this->load->model('users');	
		$this->load->model('files');

		$this->userid = $this->session->userdata('userid');
		if (!isset($this->userid) or $this->userid=='') redirect('login');
	}
	
	function index()
	{
		$data['files'] = $this->files->get($this->userid);
		$this->load->view('profile', $data);
	}
	
	function upload()
	{
		if(isset($_FILES['file'])){
			$file 	= read_file($_FILES['file']['tmp_name']);
			$name 	= basename($_FILES['file']['name']);

			write_file('files/'.$name, $file);

			$this->files->add($name);
			redirect('profile');		
		}

		else $this->load->view('upload');
	}
	
	function delete($id)
	{
		//This deletes the file from the database, before returning the name of the file.
		$name = $this->files->delete($id);		
		unlink('./files/'.$name);
		redirect('profile');
	}
	
}
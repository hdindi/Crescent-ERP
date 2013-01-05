<?php

class Profiles extends CI_Controller {

	function Profiles()
	{
		//parent::Controller();
		parent::__construct();

		//$this->load->model('users');	
		//$this->load->model('files');
		$this->load->helper('file');

		$this->userid = $this->session->userdata('userid');
		if (!isset($this->userid) or $this->userid=='') redirect('logins');
	}
	
	function index()
	{
		$data['files'] = $this->get($this->userid);
		$this->load->view('profiles', $data);
	}
	
	function upload()
	{
		if(isset($_FILES['file'])){
			$file 	= read_file($_FILES['file']['tmp_name']);
			$name 	= basename($_FILES['file']['name']);

			write_file('files/'.$name, $file);

			$this->adds($name);
			redirect('profiles');		
		}

		else $this->load->view('uploads');
	}
	
	function delete($id)
	{
		//This deletes the file from the database, before returning the name of the file.
		$name = $this->deletes($id);		
		unlink('./files/'.$name);
		redirect('profiles');
	}

	function get($userid)
	{
	    $query = $this->db->get_where('files', array('owner'=>$userid));
	    return $query->result();
	}

	function adds($file)
    {
        $this->db->insert('files', array(
								'owner'=>$this->session->userdata('userid'),
								'name'=>$file ));
    }

	function deletes($fileid)
	{
		$query = $this->db->get_where('files',array('id'=>$fileid));
		$result = $query->result();
		$query = $this->db->delete('files', array('id'=>$fileid));
		return $result[0]->name;
	}
}
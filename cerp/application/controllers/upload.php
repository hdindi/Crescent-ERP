<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url','file'));
	}

	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function do_upload()
	{
		if(isset($_FILES['userfile'])){
			$file 	= read_file($_FILES['userfile']['tmp_name']);
			$name 	= basename($_FILES['userfile']['name']);

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']	= '100';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';
		//echo $file;
		//echo $name;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			//echo  var_dump($data);


			$this->load->view('upload_success', $data);
		}
	}
	}


	function delete($id)
	{
		//This deletes the file from the database, before returning the name of the file.
		$name = $this->deletes($id);		
		unlink('./files/'.$name);
		redirect('profiles');
	}
}
?>
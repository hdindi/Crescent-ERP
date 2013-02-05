<?php
error_reporting(0);
session_start();
class Driverrenumeration extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
  function index(){
  
    //$data['title']='Farms';
    $data['driverrenumeration']=$this->driverrenumeration();
    $data['precost1']=$this->precost();

    $this->load->view('driverrenumeration_v',$data);
  }


function driverrenumeration(){
  	$query=$this->db->query('SELECT * FROM driverrenumeration');
  	
  
  	foreach ($query->result() as  $value) {
  		$driverrenumerations[]=$value;
  		
  	}
  	return $driverrenumerations;
  	
  }

  function go()
	{
		//Returns userid is successful, false is unsuccessful
		$results = $this->driverrenumeration();

		
			
			$this->session->set_userdata(array('farmid'=>$results));
			
		

	}

   function precost(){
    $this->db->select('constant');
    $this->db->where('id','1');
    $query=$this->db->get('constants');
    return $data=$query->result();
    

    
  }
}
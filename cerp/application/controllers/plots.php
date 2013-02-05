<?php
error_reporting(0);
session_start();
class Plots extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
  function index(){
  
    //$data['title']='Farms';
    $data['farms']=$this->farms();
    $data['precost1']=$this->precost();

    $this->load->view('plots_v',$data);
  }


function farms(){
  	$query=$this->db->query('SELECT * FROM farm');
  	
  
  	foreach ($query->result() as  $value) {
  		$farms[]=$value;
  		
  	}
  	return $farms;
  	
  }

  function go()
	{
		//Returns userid is successful, false is unsuccessful
		$results = $this->farms();

		
			
			$this->session->set_userdata(array('farmid'=>$results));
			
		

	}

   function precost(){
    $this->db->select('constant');
    $this->db->where('id','1');
    $query=$this->db->get('constants');
    return $data=$query->result();
    

    
  }
}
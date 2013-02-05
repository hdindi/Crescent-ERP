<?php
error_reporting(0);
session_start();
class Fleetrepairs extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
  function index(){
  
    //$data['title']='Farms';
    $data['fleetrepairs']=$this->fleetrepairs();
    $data['precost1']=$this->precost();

    $this->load->view('fleetrepairs_v',$data);
  }


function fleetrepairs(){
  	$query=$this->db->query('SELECT * FROM fleetrepairs');
  	
  
  	foreach ($query->result() as  $value) {
  		$fleetrepairs[]=$value;
  		
  	}
  	return $fleetrepairs;
  	
  }

  function go()
	{
		//Returns userid is successful, false is unsuccessful
		$results = $this->fleetrepairs();

		
			
			$this->session->set_userdata(array('farmid'=>$results));
			
		

	}

   function precost(){
    $this->db->select('constant');
    $this->db->where('id','1');
    $query=$this->db->get('constants');
    return $data=$query->result();
    

    
  }
}
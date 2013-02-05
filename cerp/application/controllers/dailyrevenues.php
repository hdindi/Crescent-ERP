<?php
error_reporting(0);
session_start();
class Dailyrevenues extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
  function index(){
  
    //$data['title']='Farms';
    $data['dailyrevenues']=$this->dailyrevenues();
    $data['precost1']=$this->precost();

    $this->load->view('dailyrevenues_v',$data);
  }


function dailyrevenues(){
  	$query=$this->db->query('SELECT * FROM dailyrevenuefiles');
  	
  
  	foreach ($query->result() as  $value) {
  		$dailyrevenues[]=$value;
  		
  	}
  	return $dailyrevenues;
  	
  }

  function go()
	{
		//Returns userid is successful, false is unsuccessful
		$results = $this->dailyrevenue();

		
			
			$this->session->set_userdata(array('dailyrevenuesid'=>$results));
			
		

	}

   function precost(){
    $this->db->select('constant');
    $this->db->where('id','1');
    $query=$this->db->get('constants');
    return $data=$query->result();
    

    
  }
}
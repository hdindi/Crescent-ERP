<?php
class Constants extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

function index(){
  	$query=$this->db->query('SELECT * FROM farm');
  	
   $data=$query->result();
  	foreach ($data as  $value) {
  		$farms[]=$value;
  		
  	}
  	return $farms;
  	
  }


  function precost(){
  	$this->db->select('constant');
  	$this->db->where('id','1');
  	$query=$this->db->get('constants');
  	return $data=$query->result();
  	
  }
  function postcost(){
  	$this->db->select('constant');
  	$this->db->where('id','2');
  	$query=$this->db->get('constants');
  	return $data=$query->result();
  
  }
  function chemical(){
  	$this->db->select('constant');
  	$this->db->where('id','3');
  	$query=$this->db->get('constants');
  	return $data=$query->result();
  	
  }
  function revenue(){
  	$this->db->select('constant');
  	$this->db->where('id','4');
  	$query=$this->db->get('constants');
  	return $data=$query->result();
  	
  }


}
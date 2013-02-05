<?php
error_reporting(0);
session_start();
class Newfarmingactivity extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
                
		$this->load->helper(array('form','url','string','text'));
		//$this->load->helper('string');
		//$this->load->helper('text');
		$this->load->library('form_validation');
	}
        
       
  function index(){
  
    //$data['title']='Farms';
    $data['farms']=$this->farms();
    //$data['precost1']=$this->precost();

    $this->load->view('newfarmingactivity_v',$data);
  }


function farms(){
  	$query=$this->db->query('SELECT * FROM farm where status = 0');
  	
  
  	foreach ($query->result() as  $value) {
  		$farms[]=$value;
  		
  	}
  	return $farms;
  	
  }
  public function cycles(){
      $cycles['cropcycles']=  $this->newfarmcycle();
      $farmname =$this->uri->segment(3);
      $cycles['farmname'] = $farmname;
      echo $farmname;
      
      $this->load->view('newfarmcycle_v',$cycles);
  }

  public function newfarmcycle(){
      
      
      $query = $this->db->query('SELECT * FROM cropcycles');
      foreach ($query->result() as $cropcyle) {
          $cropcyles[]=$cropcyle;
          
      }
      return $cropcyles;
  }
  public function submit(){
      if ($this->_submit_validate() === FALSE) {
			$this->cycles();
			return;
		}
 else {
     $farmname = $this->input->post('farmname');
     
     $this->db->select('id');
		$this->db->from('farm');
		$this->db->where('name', $farmname);
		$this->db->limit(1);
		$query_id = $this->db->get();
		if ($query_id -> num_rows() > 0){
		//$query_row = $query->result();
			foreach ($query_id->result() as $row){
			$farmid = $row->id;
                        //echo $farmid;
				
			}
			
		}
     
     $cropcycle = $this->input->post('cropcycle');
                $plantingdate = $this->input->post('plantingdate');
                $acre = $this->input->post('acres');
                
                $date = "1998-08-14";
                $newdate = strtotime ( '+18 month' , strtotime ( $plantingdate ) ) ;
                $newdate = date ( 'Y-m-j' , $newdate );
                //echo $plantingdate.'<br/>';
                //echo $newdate.'<br/>';
                $revisedplantingdate = date("Y-m-j", strtotime($plantingdate));
                //echo 'DINDI';
                //echo $revisedplantingdate.'<br/>';
                
                $data = array(
            
            'cyclename' => $cropcycle,
            'farmid' => $farmid,
            'monthofplantation' => $plantingdate,
            'monthofharvesting' => $newdate
        );
        $this->db->insert( 'cycle', $data );
        
        
        $this->db->query("UPDATE farm
SET status=1
WHERE name='{$farmname}'");


        
        ob_start();
        echo "Registration for  plotname:".$farmname." for crop cycle :".$cropcycle."was sucessful";
        header("Refresh:5;" .base_url()."cropmanagement/");
		//redirect("");
 }}

  public function _submit_validate(){
      
      // validation rules
		$this->form_validation->set_rules('cropcycle', 'Crop Cycle ', 
			'trim|required');
		
		/*$this->form_validation->set_rules('plotnumber', 'Plot No',
			'trim|required|unique[Farm.plotnumber]');*/
		
		$this->form_validation->set_rules('plantingdate', 'Date of Plantation',
			'trim|required');
		
		$this->form_validation->set_rules('acres', 'Number of Acres',
			'trim|required');
                
                return $this->form_validation->run();
		
      
  }
}
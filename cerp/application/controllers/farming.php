<?php
error_reporting(0);
class Farming extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		
		$this->load->helper(array('form','url','string','text'));
		
		$this->load->library('form_validation');
	}
	
	public function index() {
		 //$data['statename']=$this->get_state();
//var_dump( $this->get_state());
		//$this ->load-> view('farming_view',$data );
		$this->load->view('farming_view');
	}	



	public function add_all(){

        #Validate entry form information
        //$this->load->model('Model_form','', TRUE);        
        /*$this->form_validation->set_rules('f_state', 'State', 'required');
        $this->form_validation->set_rules('f_city', 'City', 'required');
        $this->form_validation->set_rules('f_membername', 'Member Name', 'required');*/

        $data['statename'] = $this->get_state(); //gets the available groups for the dropdown
        //var_dump($data);
       //echo  var_dump($data);

       //return $data;
              //$this->load->view('farmview', $data);
              
       
    }


    public function get_state(){
        //$result = $this->db->select('id,statename')->get('state')->result();
        $this->db->select('id,zonename');
       $query= $this->db->get('zone');

       foreach ($query->result() as $value) {
           $state[]=$value;
       }
       return $state;




       // $query = $this->db->query('SELECT id, statename FROM state');
       // return $query->result_array();
        //return $result ;
    }






    public function add_alls(){
                $v_state = $this->input->post('f_state');
        $v_membername = $this->input->post('f_membername');
    
        $data = array(
                    'id' => NULL,
                    'state' => $v_state,
                'membername' => $v_membername,
        );

        $this->db->insert('members', $data);
    }



    public  function get_cities(){
        //$this->load->model('Model_form','', TRUE);
        header('Content-Type: application/json');    
        //header('Content-Type: application/json; charset=utf-8');
        echo json_encode($this->get_cities_by_state( $state ));
    }





     public function get_cities_by_state ($state){
        $this->db->select('id, farmname');

        //if($tree != NULL){
            $this->db->where('zoneindex', $state);
       // }

        $query = $this->db->get('farm');
        //$cities = array();

        if($query->result()){
            foreach ($query->result() as $city) {
                $cities[] = $city;
            }
            echo json_encode( $cities);
       
        
    }
}


	function getallfarms(){

	   $datas['statename']=$this->get_state();
//var_dump( $this->get_state());
		//$this ->load-> view('farmview',$data );
	
		$add_all = $this->add_all();
	$data['query']=
	$this->farm_getall();
	$this->load->view('farmview', array_merge($data, $datas));

	//$this->load->view('farmview',$data,$datas);
		
	}

	function farm_getall(){

	$this->load->database();

	$query = $this->db->get('farm');

	return $query->result();
	}

	function landregistration(){
    /*$data['query']=
  $this->filterzones();*/

		$this->load->view('landregistration_form');
	}
 /* function filterzones(){
    //$zonename = $this->input->post('f_state');
    $zoneid = $this->getzones();
   // $this->load->database();
     $this->db->select('id,plotnumber,farmname,leasorname,acre,soiltype');
     $this->db->from('farm');
      $this->db->where('zoneindex', $zoneid);
      $query = $this->db->get();
      if($query -> num_rows() > 0){
        foreach ($query->result() as  $row) {
          # code...
          $this->load->view('farmview',$row);
        }
      }
       // }

        //$query = $this->db->get('farm');

  }*/
 /* public function getzones(){
    $zonename = $this->input->post('f_state');
    $this->db->select('id');
    $this->db->from('zone');
    $this->db->where('zonename', $zonename );
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query -> num_rows() > 0) {
      foreach ($query->result() as $row) {
        return $row->id;
      }
      
    }

  }*/

  function toExcelAll() {
$query['data1'] = $this->ToExcelAll1();
$this->load->view('farmview_excel',$query);
}
  //query for get all data
function toExcelAll1() {
$this->db->select('*');
$this->db->from('farm');
$this->db->order_by('id','asc');
$getData = $this->db->get();
if($getData->num_rows() > 0)
return $getData->result_array();
else
return null;
}
	
}

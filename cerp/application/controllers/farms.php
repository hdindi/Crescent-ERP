<?php
error_reporting(0);
class Farms extends CI_Controller{
	
	function Farms(){
		parent::__construct();

	//parent::Controller();

	}

	function get_All(){

	
	//$this->load->model('books_model');

	$data['query']=
	$this->farm_getall();
	$add_all = $this -> add_all();
	

	$this->load->view('farms_view',$data ,$add_all);	
	}

	function farm_getall(){

	$this->load->database();

	$query = $this->db->get('farm');

	$query1= $query->result();
	return $query1;
	}







	public function add_all(){

        #Validate entry form information
        //$this->load->model('Model_form','', TRUE);        
        /*$this->form_validation->set_rules('f_state', 'State', 'required');
        $this->form_validation->set_rules('f_city', 'City', 'required');
        $this->form_validation->set_rules('f_membername', 'Member Name', 'required');*/

        $data['statename'] = $this->get_state(); //gets the available groups for the dropdown

        if ($this->form_validation->run() == FALSE)
        {
              $this->load->view('farms_view', $data);
              }
        else
        {
            #Add Member to Database
            $this->add_alls();
            $this->load->view('view_form_success');
        }
    }

    public function get_state(){
        //$result = $this->db->select('id,statename')->get('state')->result();
        $this->db->select('id,statename');
       $query= $this->db->get('state');

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
        $this->db->select('id, cityname');

        //if($tree != NULL){
            $this->db->where('stateindex', $state);
       // }

        $query = $this->db->get('cities');
        //$cities = array();

        if($query->result()){
            foreach ($query->result() as $city) {
                $cities[] = $city;
            }
            echo json_encode( $cities);
       
        
    }
}

}
?>
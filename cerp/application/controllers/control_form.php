<?php
class Control_form extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		
		$this->load->helper(array('form','url','string','text'));
		
		$this->load->library('form_validation');
	}
	public function index(){
        $data['statename']=$this->get_state();
//var_dump( $this->get_state());
		$this ->load-> view('view_form_all',$data );
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
              $this->load->view('view_form_all', $data);
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
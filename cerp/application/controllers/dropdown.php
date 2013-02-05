<?php
error_reporting(0);
class Dropdown extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		//parent::Controller();
		
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	
	public function index() {
		$data['dropdown']=$this->get_dropdown();
		$this->load->view('dropdown_form', $data);
	}

	public function get_dropdown(){
		$result = $this->db->select('id,statename')->get('state')->result_array();
		$dropdown = array();
		foreach($result as $r) {
			# code...
			$dropdown[$r['id']] = $r['statename'];
		}
		return $dropdown;
	}

	public function add_all(){

        #Validate entry form information
        //$this->load->model('Model_form','', TRUE);        
       /* $this->form_validation->set_rules('f_state', 'State', 'required');
        $this->form_validation->set_rules('f_city', 'City', 'required');
        $this->form_validation->set_rules('f_membername', 'Member Name', 'required');*/

        $data['statename'] = $this->get_state(); //gets the available groups for the dropdown

        /*if ($this->form_validation->run() == FALSE)
        {
              $this->load->view('view_form_all', $data);
              }
        else
        {*/
            #Add Member to Database
            $this->add_alls();
            $this->load->view('view_form_success');
        //}
    }

	/*public function get_state(){
        //$result = $this->db->select('id,statename')->get('state')->result();
        $query = $this->db->query('SELECT id, statename FROM state');
        return $query->result();
        //return $result ;
    }*/
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

    public  function get_cities($state){
        //$this->load->model('Model_form','', TRUE);    
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->get_cities_by_state($state)));
    }
    public function get_cities_by_state ($state, $tree = null){
        $this->db->select('id, cityname');

        if($tree != NULL){
            $this->db->where('stateindex', $state);
        }

        $query = $this->db->get('cities');
        $cities = array();

        if($query->result()){
            foreach ($query->result() as $city) {
                $cities[$city->id] = $city->cityname;
            }
            return $cities;
        } else {
            return FALSE;
        }
    }
}
	
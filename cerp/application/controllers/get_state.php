<?php
class Get_state extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		
		$this->load->helper(array('form','url','string','text'));
		
		$this->load->library('form_validation');
	}
	public function index(){
		$this ->load-> view('get_state');
	}

	public function add_all(){

        #Validate entry form information
        //$this->load->model('Model_form','', TRUE);        
       /* $this->form_validation->set_rules('f_state', 'State', 'required');
        $this->form_validation->set_rules('f_city', 'City', 'required');
        $this->form_validation->set_rules('f_membername', 'Member Name', 'required'); */

        $data['city'] = $this->get_state(); //gets the available groups for the dropdown

        /*if ($this->form_validation->run() == FALSE)
        { */
              //$this->load->view('get_state', $data);
       /* }
        else
        { */
            #Add Member to Database
            //$this->add_alls();
            //$this->load->view('view_form_success');
       // }*/
        	$query = $this->db->query('SELECT id, state_name FROM state');
        return $query->result();
    }

    public function get_state(){
        $query = $this->db->query('SELECT id, state_name FROM state');
        return $query->result();
    }
}
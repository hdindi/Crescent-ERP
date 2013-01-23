<?php
class Add extends CI_Controller {
 
	public function __construct() {
		parent::__construct();
		//$this->load->model( 'mUsers' );
	}
 
 
	public function index()
	{
		$this->load->view( 'add' );
	}
 
 
 
	public function read() {
		echo json_encode( $this->getAll() );
	}

	 public function getAll() {
 
        //get all records from users table
        $query = $this->db->get( 'users' );
 
        if( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
 
    } //end getAll
 

} //end class
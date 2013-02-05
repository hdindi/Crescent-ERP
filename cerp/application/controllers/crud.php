<?php
error_reporting(0);

class Crud extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function index()
	{
		$this->load->view( 'crud' );
	}
	
	public function getById( $id ) {
		if( isset( $id ) )
			echo json_encode( $this->getByIds( $id ) );
	}
	
	public function create() {
		if( !empty( $_POST ) ) {
			$this->creates();
			echo 'New user created successfully!';
		}
	}
	
	public function read() {
		echo json_encode( $this->getAlls() );
	}
	
	public function update() {
		if( !empty( $_POST ) ) {
			$this->updates();
			echo 'Record updated successfully!';
		}
	}
	
	public function delete( $id = null ) {
		if( is_null( $id ) ) {
			echo 'ERROR: Id not provided.';
			return;
		}
		
		$this->deletes( $id );
		echo 'Records deleted successfully';
	}
	 public function creates() {
        $data = array(
            'name'  => $this->input->post( 'cName', true ),
            'email' => $this->input->post( 'cEmail', true ),
            'date' => $this->input->post( 'cDate', true )
        );
        
        $this->db->insert( 'users', $data );
    }

	 public function getByIds( $id ) {
        $id = intval( $id );
        
        $query = $this->db->where( 'id', $id )->limit( 1 )->get( 'users' );
        
        if( $query->num_rows() > 0 ) {
            return $query->row();
        } else {
            return array();
        }
    }
    public function getAlls() {
        //get all records from users table
        $query = $this->db->get( 'users' );
        
        if( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    } //end getAlls
    public function updates() {
        $data = array(
            'name' => $this->input->post( 'name', true ),
            'email' => $this->input->post( 'email', true ),
            'date' => $this->input->post( 'date', true )
        );
        
        $this->db->update( 'users', $data, array( 'id' => $this->input->post( 'id', true ) ) );
    }
    public function deletes( $id ) {
        /*
        * Any non-digit character will be excluded after passing $id
        * from intval function. This is done for security reason.
        */
        $id = intval( $id );
        
        $this->db->delete( 'users', array( 'id' => $id ) );
    } //end delete

} //end class

<?php
error_reporting(0);
class Employeedata extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function index()
	{
		$this->load->view( 'employeedata' );
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
            'firstname'  => $this->input->post( 'cName', true ),
            'surname' => $this->input->post( 'cSurname', true ),
            'date' => $this->input->post( 'cDate', true ),
			'address'  => $this->input->post( 'cAddress', true ),
            'nhifno' => $this->input->post( 'cNhifno', true ),
            'employeetype' => $this->input->post( 'cEmployeetype', true )
        );
        
        $this->db->insert( 'employee', $data );
    }

	 public function getByIds( $id ) {
        $id = intval( $id );
        
        $query = $this->db->where( 'id', $id )->limit( 1 )->get( 'employee' );
        
        if( $query->num_rows() > 0 ) {
            return $query->row();
        } else {
            return array();
        }
    }
    public function getAlls() {
        //get all records from users table
        $query = $this->db->get( 'employee' );
        
        if( $query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    } //end getAlls
    public function updates() {
        $data = array(
            'firstname' => $this->input->post( 'name', true ),
            'surname' => $this->input->post( 'surname', true ),
            'date' => $this->input->post( 'date', true ),
			'address' => $this->input->post( 'address', true ),
            'nhifno' => $this->input->post( 'nhifno', true ),
            'employeetype' => $this->input->post( 'employeetype', true )
        );
        
        $this->db->update( 'employee', $data, array( 'id' => $this->input->post( 'id', true ) ) );
    }
    public function deletes( $id ) {
        /*
        * Any non-digit character will be excluded after passing $id
        * from intval function. This is done for security reason.
        */
        $id = intval( $id );
        
        $this->db->delete( 'employee', array( 'id' => $id ) );
    } //end delete

} //end class

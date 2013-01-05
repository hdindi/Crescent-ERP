<?php
class Landregistration extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//parent::CI_Controller();
		
		$this->load->helper(array('form','url','string','text'));
		//$this->load->helper('string');
		//$this->load->helper('text');
		$this->load->library('form_validation');
	}
	
	public function index() {
		$this->load->view('landregistration_form');
		
	}	

	public function calculation(){
		
		$amount = $this->input->post('leasecost');
		 $amounta = (double)( $amount );
		$acre = $this->input->post('acre');
		 $acrea = (double)( $acre );
		
		$total = $amounta * $acrea;
		return $total;
		
	}
	
	public function getaccount_id(){
		$meansofpayment = $this->input->post('meansofpayment');
		$this->db->select('id');
		$this->db->from('account');
		$this->db->where('accountname', $meansofpayment );
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $row) {
				return $row->id;
			}
			
		}

	}

	public function getjournal_id(){
		$journalid = "Cash Payments Journal";
		$this->db->select('id');
		$this->db->from('journal');
		$this->db->where('journalname', $journalid );
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $row) {
				return $row->id;
			}
			
		}

	}

	public function landpreparationcost(){
		$bushclearing = $this ->input->post('bushclearing');
		$bushclearinga = (double)($bushclearing);
		$harrowingcost = $this ->input->post('harrowingcost');
		$harrowingcosta = (double)($harrowingcost);
		$ploughingcost = $this ->input->post('ploughingcost');
		$ploughingcosta = (double)($ploughingcost);
		$sum =array($bushclearinga,$harrowingcosta,$ploughingcosta);
		$summed = array_sum($sum);
		return $summed;

	}

	public function preparationpaymentmeans(){
		$meansofpayment = $this->input->post('preparationpaymentmeans');
		$this->db->select('id');
		$this->db->from('account');
		$this->db->where('accountname', $meansofpayment );
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $row) {
				return $row->id;
			}
			
		}

	}
	public function getpreparation_id(){
		$preparationaccount = "Landpreparation";
		$this->db->select('id');
		$this->db->from('account');
		$this->db->where('accountname', $preparationaccount);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query ->num_rows() > 0) {
			# code...
			foreach ($query->result() as $row ) {
				# code...
				return $row->id;
			}
		}
	}

	
	
	

	public function submit() {
		//Insert function to the database
		
		if ($this->_submit_validate() === FALSE) {
			$this->index();
			return;
		}
				//insert into the account table
		        $datab = array(
			'accountname' => $this ->input->post('leasorname',true)
			);
        $this->db->insert('account', $datab);
        //select the last inserted id in the account table
        $id = mysql_insert_id();
        //calculate the total amount for lease
        $amount = $this->input->post('leasecost');
		 $amountaa = (double)( $amount );
		$acre = $this->input->post('acre');
		 $acreaa = (double)( $acre );
		$totala = $amountaa * $acreaa;
		$getjournalid = $this -> getjournal_id();
        $this ->db -> query ( "INSERT INTO debit (accountid,amount,journalid) VALUES ('$id', '$totala','$getjournalid')");
        
        //farm registration
		$data = array(
            'plotnumber'  => $this->input->post( 'plotnumber', true ),
            'farmname' => $this->input->post( 'farmname', true ),
            'crop' => $this->input->post( 'crop', true ),
            'acre' => $this->input->post( 'acre', true),
            'soiltype' => $this->input->post('soiltype',true),
            'fielddescription' => $this->input->post( 'fielddescription', true),
            'dateofcontract' => $this->input->post('dateofcontract',true)
        );
        $this->db->insert( 'farm', $data );
        //chemical registration
        $dataa = array(
			'plotnumber' => $this->input->post('plotnumber',true),
			'type' => $this->input->post('fertilizername',true),
			'quantity' => $this->input->post('fertilizeramount',true)
			);
        $this->db->insert('chemical', $dataa);
        //credit registration
        $datac = array(
             'amount' => $this ->calculation() ,
        	'accountid' => $this ->getaccount_id() ,
        	'journalid' => $this -> getjournal_id()
        	);
        $this ->db -> insert('credit' , $datac);

        $datad = array(
        	'amount' => $this->landpreparationcost() ,
        	'accountid' => $this -> preparationpaymentmeans() ,
        	'journalid' => $this -> getjournal_id()
        	);
        $this ->db -> insert('credit' , $datad);

        $datae = array( 
        	'amount' => $this-> landpreparationcost(),
        	'accountid' => $this -> getpreparation_id(),
        	'journalid' => $this -> getjournal_id()
        	); 
        $this ->db ->insert('debit', $datae);


        
		$this->load->view('submit_success');
	
	}

	private function _submit_validate() {
		
		// validation rules
		$this->form_validation->set_rules('leasorname', 'Leasor Name ', 
			'trim|required');
		
		$this->form_validation->set_rules('plotnumber', 'Plot No',
			'trim|required|unique[Farm.plotnumber]');
		
		/*$this->form_validation->set_rules('farmname', 'Farm Name',
			'trim|required|unique[Farm.farmname]');*/
		
		$this->form_validation->set_rules('acre', 'Acre',
			'trim|required');
		$this->form_validation->set_rules('dateofcontract', 'Date of Contract ', 
			'trim|required');
		
		$this->form_validation->set_rules('leasecost', ' Lease cost per acre',
			'trim|required');
		
		/*$this->form_validation->set_rules('landclearing', 'Land Clearing ',
			'trim|required');*/
		/*$this->form_validation->set_rules('harrowingcost', 'Acre',
			'trim|required');
		$this->form_validation->set_rules('ploughing', 'Leasor Name ', 
			'trim|required');
		
		$this->form_validation->set_rules('cropname', 'Plot No',
			'trim|required');
		
		$this->form_validation->set_rules('fertilizeramount', 'Farm Name',
			'trim|required');
		
		$this->form_validation->set_rules('seedlingcost', 'Acre',
			'trim|required'); */
		
		return $this->form_validation->run();
		
	}

	/*public function getjournal_id($journalname){
		$this->db->select('id');
		$this->db->from('journal');
		$this->db->where('journalname',$journalname);
		$this->db->get();
		if ($query -> num_rows() > 0) {
			# code...
			$row = $query -> row_array();
			return $row;
		}
	}*/
	/*public function getLastInserted() {
		$query = $this->db->query(  "SELECT LAST_INSERT_ID() from account LIMIT 1" );
//$query ="SELECT $id as lastid from account where $id = LAST_INSERT_ID()"

		return $query; //line 69
       }*/
       /*$query = $this->db->query(  "SELECT LAST_INSERT_ID() " );
        $queryrow = $query ->row();*/
        //$resultquery = $queryrow -> content;

         //$queryint = (integer)( $query );
       /* $datad = array(
        	'amount' =>$this ->calculation() ,
        	'accountid' => $this ->$id
        	);*/
 // $this ->db ->insert('debit' , $datad);

	
}

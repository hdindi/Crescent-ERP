<?php
//error_reporting(0);
session_start();
class Transportupload extends CI_Controller{
	private $_variable = "";
	private $_variable1 = "";
	private $_variable2 = "";
	private $_variable3 = "";
	private $_variable4 = "";
 	public function __construct(){
		
        parent ::__construct ();
        $this ->load -> library('excel');
		$this->load->helper(array('form', 'url','file'));

        $this->userid = $this->session->userdata('userid');
        if (!isset($this->userid) or $this->userid=='') redirect('logins');
		$farmname= $this->uri->segment(3);
		$cycle = $this->uri->segment(4);
		
	}
	
	function data(){
	$farmid =  $this->input->post("farmname");
	$farmname =$this->uri->segment(3);
	$data['fleetrepairs'] =$this->uri->segment(3);
	
	//$data['precost1']=$this->cycle();
	

	$this->load->view('fleetrepair_v',$data);
	}
	

	
	
	public function do_upload(){
	  $driverrenumeration= $this->uri->segment(3);
	  echo $driverrenumeration;
	  $cyclename = $this->uri->segment(4);
	  echo $cyclename;
	  
	 $try = $this->_variable;
		echo $try;
	if(isset($_FILES['userfile'])){
		
		// $farmid =  $this->input->post("farmname");
		 $file   = read_file($_FILES['userfile']['tmp_name']);
		
        $name   = basename($_FILES['userfile']['name']);
		$info = pathinfo($name);
		
		$file_name =  basename($name,'.'.$info['extension']);
	    
		$userid =  $this->session->userdata('userid');
        
		$structure = "./uploadedfiles/fleet/";
		$structure2 = "./uploadedfiles/fleet/oldfiles/";
		
		if($fleetrepairs == $file_name){
		if($fleetrepairs == $file_name){
			
		
		if (!mkdir($structure, 0, true)) {
		
		$path = "./uploadedfiles/fleet/{$fleetrepairs}.xlsx";
		$destination = "./uploadedfiles/fleet/oldfiles/".date("Y-m-d")."{$fleetrepairs}.xlsx";
     
        rename($path,$destination);
		
        unlink($path);
       
        } else{
            mkdir($structure, 0777, true);
			mkdir($structure2, 0777, TRUE);
			$path = "./uploadedfiles/fleet/{$fleetrepairs}.xlsx";
            $destination = "./uploadedfiles/fleet/oldfiles/".date("Y-m-d")."{$fleetrepairs}.xlsx";
        //$destination="./files/{$driverrenumeration}/{$userid}/".date("Y-m-d ")."{$driverrenumeration}.xlsx";
		//move_uploaded_file($path,$destination);
     	rename($path,$destination);
        
        }
      
        $config['upload_path'] = "./uploadedfiles/fleet/";
        $config['allowed_types'] = 'xlsx';
        //$config['max_size']   = '1000';
        //$config['max_width']  = '1024';
        //$config['max_height']  = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('upload_form', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            $file=
            
            $objReader = new PHPExcel_Reader_Excel2007();
            $path = "./uploadedfiles/fleet/{$fleetrepairs}.xlsx";
			echo($path);
			
			
           
           
       
           	 $objPHPExcel = $objReader->load($path);
            $B2 = $objPHPExcel->getActiveSheet()->getCell('B2') ->getCalculatedValue();
			
            $E2 = $objPHPExcel->getActiveSheet()->getCell('E2')->getCalculatedValue();
			
            $C3 = $objPHPExcel->getActiveSheet()->getCell('C3') ->getCalculatedValue();
            $D3 = $objPHPExcel->getActiveSheet()->getCell('D3') ->getCalculatedValue();
            $E3 = $objPHPExcel->getActiveSheet()->getCell('E3') ->getCalculatedValue();
			$F3 = $objPHPExcel->getActiveSheet()->getCell('F3') ->getCalculatedValue();
            $G3 = $objPHPExcel->getActiveSheet()->getCell('G3') ->getCalculatedValue();
			$H3 = $objPHPExcel->getActiveSheet()->getCell('H3') ->getCalculatedValue();
			
			
				
			$this->db->select('fleet.id');
		//$this->db->from('tractor');
		$this->db->where('fleet.regno', $C3);
		$this->db->limit(1);
		$query_id = $this->db->get('fleet');
		
		if ($query_id -> num_rows() > 0){

			foreach ($query_id->result() as $row){
			$regno = $row->id;
			echo($regno);
			$GLOBALS['$_variable'] = $regno;
				
			}
			
		}
			
				$this->db->select('fleet.id');
		//$this->db->from('tractor');
		$this->db->where('fleet.regno', $D3);
		$this->db->limit(1);
		$query_id = $this->db->get('fleet');
		
		if ($query_id -> num_rows() > 0){

			foreach ($query_id->result() as $row){
			$regno1 = $row->id;
			echo($regno1);
			$GLOBALS['$_variable'] = $regno1;
				
			}
			
		}
			
			$this->db->select('fleet.id');
		//$this->db->from('tractor');
		$this->db->where('fleet.regno', $E3);
		$this->db->limit(1);
		$query_id = $this->db->get('fleet');
		
		if ($query_id -> num_rows() > 0){

			foreach ($query_id->result() as $row){
			$regno2 = $row->id;
			
			}
			
		}
			
			$this->db->select('fleet.id');
		//$this->db->from('tractor');
		$this->db->where('fleet.regno', $F3);
		$this->db->limit(1);
		$query_id = $this->db->get('fleet');
		
		if ($query_id -> num_rows() > 0){

			foreach ($query_id->result() as $row){
			$regno3 = $row->id;
			
				
			}
			
		}
			
			$this->db->select('fleet.id');
		//$this->db->from('tractor');
		$this->db->where('fleet.regno', $G3);
		$this->db->limit(1);
		$query_id = $this->db->get('fleet');
		
		if ($query_id -> num_rows() > 0){

			foreach ($query_id->result() as $row){
			$regno4 = $row->id;
			echo($regno4);
			
				
			}
			
		}
		
		$this->db->select('fleet.id');
		//$this->db->from('tractor');
		$this->db->where('fleet.regno', $H3);
		$this->db->limit(1);
		$query_id = $this->db->get('fleet');
		
		if ($query_id -> num_rows() > 0){

			foreach ($query_id->result() as $row){
			$regno5 = $row->id;
			echo($regno5);
			
				
			}
			
		}
	
			$C34 = $objPHPExcel->getActiveSheet()->getCell('C34') ->getCalculatedValue();
            $D34 = $objPHPExcel->getActiveSheet()->getCell('D34') ->getCalculatedValue();
            $E34 = $objPHPExcel->getActiveSheet()->getCell('E34')->getCalculatedValue();
            $F34 = $objPHPExcel->getActiveSheet()->getCell('F34') ->getCalculatedValue();
            $G34 = $objPHPExcel->getActiveSheet()->getCell('G34')->getCalculatedValue();
            $H34 = $objPHPExcel->getActiveSheet()->getCell('H34')->getCalculatedValue();
           
            
			
			
            $chemicalarray = array(
                1=>array('fleetid'=>$regno,'month'=>$B2,'monthlycost'=>$C34,'year'=>$E2),
                2=>array('fleetid'=>$regno1,'month'=>$B2,'monthlycost'=>$D34,'year'=>$E2),
                3=>array('fleetid'=>$regno2,'month'=>$B2,'monthlycost'=>$E34,'year'=>$E2),
                4=>array('fleetid'=>$regno3,'month'=>$B2,'tonnmonthlycostes'=>$F34,'year'=>$E2),
                5=>array('fleetid'=>$regno4,'month'=>$B2,'monthlycost'=>$G34,'year'=>$E2),
				6=>array('fleetid'=>$regno5,'month'=>$B2,'monthlycost'=>$H34,'year'=>$E2),
			
               
                );
            foreach ($chemicalarray as $key) {
                # code...
                $unitsql = "INSERT INTO repairs (fleetid,month,monthlycost,year)
                value
                ('{$key['fleetid']}','{$key['month']}','{$key['monthlycost']}','{$key['year']}')";
                $q = mysql_query($unitsql);
                if($q==true){
                    echo 'Done';
                }else{
                    echo mysql_error();
                }
            }
			
			//TOTAL MONTHLY TONNAGE
            $I34 = $objPHPExcel->getActiveSheet()->getCell('I34')->getCalculatedValue();
			 //$this->db ->query("INSERT INTO mo (cummulativeamount) VALUES ('$sum')");
			
			
			
			
			$monthly = "INSERT INTO totalmonthlytonnage (month,cost,year) VALUES ('$B2','$L37','$I34')";
			$monthlyinsert = mysql_query($monthly);
			if($month==TRUE){
				echo("DONE");
			}else{
				echo mysql_error();
			}
			
			
			
			$yearly = "INSERT INTO yearlytonnage (year,tonnage) VALUES(),()";
			$yearlyinsert = mysql_query($yearly);
			
			
			
			$filename = $this->checkfile();
            $owner = $this->checkowner();
            $userid = $this->session->userdata('userid');
			
			$file   = read_file($_FILES['userfile']['tmp_name']);
            $name   = basename($_FILES['userfile']['name']);
            $userid =  $this->session->userdata('userid');
            
           if ($name !== $filename ) {
           
                    $file   = read_file($_FILES['userfile']['tmp_name']);
                    $name   = basename($_FILES['userfile']['name']);
                    $userid =  $this->session->userdata('userid');

            $this->adds($name);
            // redirect('profiles');
       
            }
           
            elseif ($name == $filename ) {
               
               //redirect('profiles');
      
          
        }
            
        }
		}
		else{
		//Insert into the data Base...
			
		}
		
		
		 } else {
		$farmname = $this->uri->segment(3);
		$cropcycle = $this->uri->segment(4);	
		/*echo "Wrong file please upload right file with the name:".$farmname.".xlsx";
		header("Refresh:5;" .base_url()."uploads/do_upload/".$farmname."/".$cropcycle);*/
		//header("Refresh:3;" .base_url()."uploads/do_upload/".$farmname);
			
		}
		} else {
		$driverrenumerationfile = $this->uri->segment(3);
		$cropcycle = $this->uri->segment(4);
		$data['driverrenumerationfile'] = $driverrenumerationfile;
		$data['cyclename'] = $cropcycle;
		$this->load->view('transportupload_v',$data);
		
		}
    }
	
	   public function checkfile(){
         $userid =  $this->session->userdata('userid');
		 echo $userid;
        $this->db->select('name');
        $this->db->from('files');
        $this->db->where('owner', $userid );
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query -> num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->name;
            }
            
        }

    
    }
        public function checkowner(){
           $name   = basename($_FILES['userfile']['name']);
        $this->db->select('owner');
        $this->db->from('files');
        $this->db->where('name', $name );
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query -> num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->owner;
            }
            
        }

        }

    function delete($id)
    {
        //This deletes the file from the database, before returning the name of the file.
        $name = $this->deletes($id);  
		$path = "./uploadedfiles/farm/{$name}";      
        unlink('./uploadedfiles/farm/'.$name);
        redirect('profiles');
    }
function adds($file)
    {
        $this->db->insert('files', array(
                                'owner'=>$this->session->userdata('userid'),
                                'name'=>$file ));
    }
function deletes($fileid)
    {
        $query = $this->db->get_where('files',array('id'=>$fileid));
        $result = $query->result();
        $query = $this->db->delete('files', array('id'=>$fileid));
        return $result[0]->name;
    }


  

}
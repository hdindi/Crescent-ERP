<?php
error_reporting(0);
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
	$data['driverrenumerationfile'] =$this->uri->segment(3);
	
	//$data['precost1']=$this->cycle();
	

	$this->load->view('transportupload_v',$data);
	}

	
	
	public function do_upload(){
	  $driverrenumeration= $this->uri->segment(3);
	  echo $driverrenumeration;
	  $cyclename = $this->uri->segment(4);
	  echo $cyclename;
	  
	 $try = $this->_variable;
		echo $try;
	if(isset($_FILES['userfile'])){
		
		 $farmid =  $this->input->post("farmname");
		 $file   = read_file($_FILES['userfile']['tmp_name']);
		
        $name   = basename($_FILES['userfile']['name']);
		$info = pathinfo($name);
		
		$file_name =  basename($name,'.'.$info['extension']);
	    
		$userid =  $this->session->userdata('userid');
        
		$structure = "./uploadedfiles/fleet/";
		$structure2 = "./uploadedfiles/fleet/oldfiles/";
		
		if($driverrenumeration == $file_name){
		IF($driverrenumeration == $file_name){
			
		
		if (!mkdir($structure, 0, true)) {
		
		$path = "./uploadedfiles/fleet/{$driverrenumeration}.xlsx";
		$destination = "./uploadedfiles/fleet/oldfiles/".date("Y-m-d")."{$driverrenumeration}.xlsx";
     
        rename($path,$destination);
		
        unlink($path);
       
        } else{
            mkdir($structure, 0777, true);
			mkdir($structure2, 0777, TRUE);
			$path = "./uploadedfiles/fleet/{$driverrenumeration}.xlsx";
            $destination = "./uploadedfiles/fleet/oldfiles/".date("Y-m-d")."{$driverrenumeration}.xlsx";
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
            $path = "./uploadedfiles/fleet/{$driverrenumeration}.xlsx";
			echo($path);
			
			
           
           
       
           	 $objPHPExcel = $objReader->load($path);
            $B4 = $objPHPExcel->getActiveSheet()->getCell('B4') ->getCalculatedValue();
			
            $D4 = $objPHPExcel->getActiveSheet()->getCell('D4')->getCalculatedValue();
			
            $F4 = $objPHPExcel->getActiveSheet()->getCell('F4') ->getCalculatedValue();
            $H4 = $objPHPExcel->getActiveSheet()->getCell('H4') ->getCalculatedValue();
            $J4 = $objPHPExcel->getActiveSheet()->getCell('J4') ->getCalculatedValue();
			$G2 = $objPHPExcel->getActiveSheet()->getCell('G2') ->getCalculatedValue();
            $I2 = $objPHPExcel->getActiveSheet()->getCell('I2') ->getCalculatedValue();
			
			
			
				
			$this->db->select('tractor.id');
		//$this->db->from('tractor');
		$this->db->where('tractor.registrationnumber', $B4);
		$this->db->limit(1);
		$query_id = $this->db->get('tractor');
		
		if ($query_id -> num_rows() > 0){

			foreach ($query_id->result() as $row){
			$regno = $row->id;
			echo($regno);
			$GLOBALS['$_variable'] = $regno;
				
			}
			
		}
			
				$this->db->select('tractor.id');
		//$this->db->from('tractor');
		$this->db->where('tractor.registrationnumber', $D4);
		$this->db->limit(1);
		$query_id = $this->db->get('tractor');
		
		if ($query_id -> num_rows() > 0){

			foreach ($query_id->result() as $row){
			$regno1 = $row->id;
			echo($regno1);
			$GLOBALS['$_variable'] = $regno1;
				
			}
			
		}
			
			$this->db->select('tractor.id');
		//$this->db->from('tractor');
		$this->db->where('tractor.registrationnumber', $F4);
		$this->db->limit(1);
		$query_id = $this->db->get('tractor');
		
		if ($query_id -> num_rows() > 0){

			foreach ($query_id->result() as $row){
			$regno2 = $row->id;
			
			}
			
		}
			
			$this->db->select('tractor.id');
		//$this->db->from('tractor');
		$this->db->where('tractor.registrationnumber', $H4);
		$this->db->limit(1);
		$query_id = $this->db->get('tractor');
		
		if ($query_id -> num_rows() > 0){

			foreach ($query_id->result() as $row){
			$regno3 = $row->id;
			
				
			}
			
		}
			
			$this->db->select('tractor.id');
		//$this->db->from('tractor');
		$this->db->where('tractor.registrationnumber', $J4);
		$this->db->limit(1);
		$query_id = $this->db->get('tractor');
		
		if ($query_id -> num_rows() > 0){

			foreach ($query_id->result() as $row){
			$regno4 = $row->id;
			echo($regno4);
			
				
			}
			
		}
		
	
			$B37 = $objPHPExcel->getActiveSheet()->getCell('B37') ->getCalculatedValue();
            $D37 = $objPHPExcel->getActiveSheet()->getCell('D37') ->getCalculatedValue();
            $F37 = $objPHPExcel->getActiveSheet()->getCell('F37')->getCalculatedValue();
            $H37 = $objPHPExcel->getActiveSheet()->getCell('H37') ->getCalculatedValue();
            $J37 = $objPHPExcel->getActiveSheet()->getCell('J37')->getCalculatedValue();
            $L37 = $objPHPExcel->getActiveSheet()->getCell('L37')->getCalculatedValue();
            
			
			
            $chemicalarray = array(
                1=>array('vehicleid'=>$regno,'month'=>$G2,'tonnes'=>$B37,'year'=>$I2),
                2=>array('vehicleid'=>$regno1,'month'=>$G2,'tonnes'=>$D37,'year'=>$I2),
                3=>array('vehicleid'=>$regno2,'month'=>$G2,'tonnes'=>$F37,'year'=>$I2),
                4=>array('vehicleid'=>$regno3,'month'=>$G2,'tonnes'=>$H37,'year'=>$I2),
                5=>array('vehicleid'=>$regno4,'month'=>$G2,'tonnes'=>$J37,'year'=>$I2),
                
               
                );
            
           if ($name !== $filename ) {
               
               
            foreach ($chemicalarray as $key) {
                # code...
                $unitsql = "INSERT INTO vehiclemonthlytonnage (vehicleid,month,tonnes,year)
                value
                ('{$key['vehicleid']}','{$key['month']}','{$key['tonnes']}','{$key['year']}')";
                $q = mysql_query($unitsql);
                if($q==true){
                    echo 'Done';
                }else{
                    echo mysql_error();
                }
            }
			
			//TOTAL MONTHLY TONNAGE
            
			 //$this->db ->query("INSERT INTO mo (cummulativeamount) VALUES ('$sum')");
			
			
			
			
			$monthly = "INSERT INTO totalmonthlytonnage (month,tonnage,year) VALUES ('$G2','$L37','$I2')";
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
            
          // if ($name !== $filename ) {
               
               
           
                    $file   = read_file($_FILES['userfile']['tmp_name']);
                    $name   = basename($_FILES['userfile']['name']);
                    $userid =  $this->session->userdata('userid');

            $this->adds($name);
            // redirect('profiles');
       
            }
           
            elseif ($name == $filename ) {
                 $this->db->select('month');
             $this->db->select('year');
		$this->db->from('vehiclemonthlytonnage');
		$this->db->where('month', $G2);
		$this->db->where('year',$I2);
		$this->db->limit(1);
		$query_id = $this->db->get();
		if ($query_id -> num_rows() > 0){
		$query_row = $query->result();
			foreach ($query_id->result() as $row){
			$month = $row->month;
                        $year = $row->year;
			echo $month.'<br/>';
                        echo $year.'<br/>';
			}
			
		}
                echo $month.'<br/>';
                echo $year.'<br/>';
                
                if ($month === $G2 && $year === $I2){
                   
                    
                   
                    $unitsql = "DELETE FROM vehiclemonthlytonnage
WHERE month='$G2' AND year='$I2'";    
                $q = mysql_query($unitsql);
                foreach ($chemicalarray as $key) {
                # code...
                $unitsql = "INSERT INTO vehiclemonthlytonnage (vehicleid,month,tonnes,year)
                value
                ('{$key['vehicleid']}','{$key['month']}','{$key['tonnes']}','{$key['year']}')";
                $q = mysql_query($unitsql);
                if($q==true){
                    echo 'Done';
                }else{
                    echo mysql_error();
                }
            }
            $this->db ->query("UPDATE totalmonthlytonnage SET tonnage = '$L37' WHERE year = '$I2 ' AND month = '$G2'");
                
                    
                }
                elseif ($month !== $G2 && $year !== $I2) {
                 foreach ($chemicalarray as $key) {
                # code...
                $unitsql = "INSERT INTO vehiclemonthlytonnage (vehicleid,month,tonnes,year)
                value
                ('{$key['vehicleid']}','{$key['month']}','{$key['tonnes']}','{$key['year']}')";
                $q = mysql_query($unitsql);
                if($q==true){
                    echo 'Done';
                }else{
                    echo mysql_error();
                }
            }
            
                 $monthly = "INSERT INTO totalmonthlytonnage (month,tonnage,year) VALUES ('$G2','$L37','$I2')";
			$monthlyinsert = mysql_query($monthly);
			if($month==TRUE){
				echo("DONE");
			}else{
				echo mysql_error();
			}
			
			
			
			$yearly = "INSERT INTO yearlytonnage (year,tonnage) VALUES(),()";
			$yearlyinsert = mysql_query($yearly);   
                
            }
              
               
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
    public function getfarms(){

    }

    function get_All(){
	$data['query']=
    $this->farm_getall();
    $add_all = $this -> add_all();
    $this->load->view('farms_view',$data ,$add_all);    
    }

    function farm_getall(){
	$this->load->database();
	$query = $this->db->get('farm');
	return $query->result();
    }

}
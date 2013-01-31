<?php
error_reporting(0);
session_start();
class Dailyrevenue extends CI_Controller{
	private $_variable = "";
 	public function __construct(){
		
        parent ::__construct ();
        $this ->load -> library('excel');
		$this->load->helper(array('form', 'url','file'));

        $this->userid = $this->session->userdata('userid');
        if (!isset($this->userid) or $this->userid=='') redirect('logins');
		$farmname= $this->uri->segment(3);
		$cycle = $this->uri->segment(4);
		
		
	}
	
	
	

  


	
	public function do_upload(){
	  $dailyrevenuename= $this->uri->segment(3);
	 // echo $dailyrevenuename;
	  
	  
	 $try = $this->_variable;
		echo $try;
	if(isset($_FILES['userfile'])){
		
		 $file   = read_file($_FILES['userfile']['tmp_name']);
		
        $name   = basename($_FILES['userfile']['name']);
		$info = pathinfo($name);
		
		$file_name =  basename($name,'.'.$info['extension']);
	    
		$userid =  $this->session->userdata('userid');
        
		$structure = "./uploadedfiles/dailyrevenues/";
		$structure2 = "./uploadedfiles/dailyrevenues/oldfiles/";
		
		if($dailyrevenuename == $file_name){
		if (!mkdir($structure, 0, true)) {
		
		$path = "./uploadedfiles/dailyrevenues/{$dailyrevenuename}.xlsx";
		$destination = "./uploadedfiles/dailyrevenues/oldfiles/".date("Y-m-d")."{$dailyrevenuename}.xlsx";
     
        rename($path,$destination);
		
        unlink($path);
       
        } else{
            mkdir($structure, 0777, true);
			mkdir($structure2, 0777, TRUE);
			$path = "./uploadedfiles/dailyrevenues/{$dailyrevenuename}.xlsx";
            $destination = "./uploadedfiles/dailyrevenues/oldfiles/".date("Y-m-d")."{$dailyrevenuename}.xlsx";
        //$destination="./files/{$farmname}/{$userid}/".date("Y-m-d ")."{$farmname}.xlsx";
		//move_uploaded_file($path,$destination);
     	rename($path,$destination);
        
        }
      
        $config['upload_path'] = "./uploadedfiles/dailyrevenues/";
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
            $path = "./uploadedfiles/dailyrevenues/{$dailyrevenuename}.xlsx";
			echo $path;
            $objPHPExcel = $objReader->load($path);
            $C21 = $objPHPExcel->getActiveSheet()->getCell('C21')->getCalculatedValue();
       


            //$D21 = $objPHPExcel->getActiveSheet()->getCell('D21')->getCalculatedValue();
            $E21 = $objPHPExcel->getActiveSheet()->getCell('E21') ->getCalculatedValue();
            //$F21 = $objPHPExcel->getActiveSheet()->getCell('F21') ->getCalculatedValue();
            $G21 = $objPHPExcel->getActiveSheet()->getCell('G21') ->getCalculatedValue();
           // $H21 = $objPHPExcel->getActiveSheet()->getCell('H21')->getCalculatedValue();
            $I21 = $objPHPExcel->getActiveSheet()->getCell('I21') ->getCalculatedValue();
            $K21 = $objPHPExcel->getActiveSheet()->getCell('K21') ->getCalculatedValue();
            $M21 = $objPHPExcel->getActiveSheet()->getCell('M21') ->getCalculatedValue();
            $O21 = $objPHPExcel->getActiveSheet()->getCell('O21')->getCalculatedValue();
            $Q21 = $objPHPExcel->getActiveSheet()->getCell('Q21') ->getCalculatedValue();
            $A3 = $objPHPExcel->getActiveSheet()->getCell('A3')->getCalculatedValue();
            $S3 = $objPHPExcel->getActiveSheet()->getCell('S3') ->getCalculatedValue();
           
            echo $D10.'<br/>';

            $multplicationarray = array(
                0=>$E21,
                1=>$G21,
                3=>$I21,
                4=>$K21,
                5=>$M21,
                6=>$O21,
                7=>$Q21
                                        );
            
			$date = date("Y-m-d");
			$id1 = 1; $id2 = 2; $id3 = 3;$id4 = 4; $id5 = 5; $id6 = 6; $id7 = 7; $id8 = 8;
			
			
      $unitarray = array(
                1=>array('zoneid'=>$id1,'tonnes'=>$E21,'date'=>$date,'period'=>$A3,'month'=>$S3),
                2=>array('zoneid'=>$id2,'tonnes'=>$G21,'date'=>$date,'period'=>$A3,'month'=>$S3),
                3=>array('zoneid'=>$id3,'tonnes'=>$I21,'date'=>$date,'period'=>$A3,'month'=>$S3),
                4=>array('zoneid'=>$id4,'tonnes'=>$K21,'date'=>$date,'period'=>$A3,'month'=>$S3),
                5=>array('zoneid'=>$id5,'tonnes'=>$M21,'date'=>$date,'period'=>$A3,'month'=>$S3),
                6=>array('zoneid'=>$id6,'tonnes'=>$O21,'date'=>$date,'period'=>$A3,'month'=>$S3),
                7=>array('zoneid'=>$id7,'tonnes'=>$Q21,'date'=>$date,'period'=>$A3,'month'=>$S3)
                );
			
				var_dump($unitarray);
			
				
            foreach ($unitarray as $key) {
                # code...
                $unitsql = "INSERT INTO tonnage (zoneid,tonnes,date,period,month)
                value
                ('{$key['zoneid']}','{$key['tonnes']}','{$key['date']}','{$key['period']}','{$key['month']}')";
                $q = mysql_query($unitsql);
                if($q==true){
                    echo 'Done';
                }else{
                    echo mysql_error();
                }
            }
            
			
			$cropcycle = $this->uri->segment(4);
			$plotname = $this->uri->segment(3);
			echo $plotname;
			echo $cropcycle;
			echo "ACCA";
			$this->db->select('id');
		$this->db->from('farm');
		$this->db->where('name', $farmname );
	    $this->db->limit(1);
		$query = $this->db->get();
		if ($query -> num_rows() > 0) {
		$row_id = $query->result();
			foreach ($query->result() as $row) {
				$farmname_id = $row->id;
				
			}
			
		}
		$this->db->select('id');
		$this->db->from('cycle');
		$this->db->where('cyclename', $cropcycle);
		$this->db->where('farmid',$farmname_id);
		$this->db->limit(1);
		$query_id = $this->db->get();
		if ($query_id -> num_rows() > 0){
		$query_row = $query->result();
			foreach ($query_id->result() as $row){
			$cycleid = $row->id;
				
			}
			
		}
		
			 
           
            
			
	
            
			$filename = $this->checkfile();
            $owner = $this->checkowner();
            $userid = $this->session->userdata('userid');
			
			$file   = read_file($_FILES['userfile']['tmp_name']);
            $name   = basename($_FILES['userfile']['name']);
            $userid =  $this->session->userdata('userid');
            
           if ($name !== $filename ) {
            
                 foreach ($unitarray as $key) {
                # code...
                $unitsql = "INSERT INTO tonnage (zoneid,tonnes,date,period,month)
                value
                ('{$key['zoneid']}','{$key['tonnes']}','{$key['date']}','{$key['period']}','{$key['month']}')";
                $q = mysql_query($unitsql);
                if($q==true){
                    echo 'Done';
                }else{
                    echo mysql_error();
                }
            }
               
               
               
               
             
           
                    $file   = read_file($_FILES['userfile']['tmp_name']);
                    $name   = basename($_FILES['userfile']['name']);
                    $userid =  $this->session->userdata('userid');

            $this->adds($name);
             redirect('profiles');
       
            }
           
            elseif ($name == $filename ) {
               
                   
                $this->db->select('perod');
                $this->db->select('month');
                $this->db->from('tonnage');
		$this->db->where('month', $S3);
                $this->db->where('period',$A3);
		//$this->db->where('year',$E2);
		$this->db->limit(1);
		$query_id = $this->db->get();
		if ($query_id -> num_rows() > 0){
		$query_row = $query->result();
			foreach ($query_id->result() as $row){
			$month = $row->month;
                        
                        echo $month.'<br/>';
			}
			
		}
                echo $month.'<br/>';
                
                if($month == $S3){
                    
                    
                    $unitsql = "DELETE FROM repiars
WHERE month='$S3' AND period='$A3'";    
                $q = mysql_query($unitsql);
                
                foreach ($unitarray as $key) {
                # code...
                $unitsql = "INSERT INTO tonnage (zoneid,tonnes,date,period,month)
                value
                ('{$key['zoneid']}','{$key['tonnes']}','{$key['date']}','{$key['period']}','{$key['month']}')";
                $q = mysql_query($unitsql);
                if($q==true){
                    echo 'Done';
                }else{
                    echo mysql_error();
                }
            }
            
             //$this->db ->query("UPDATE totalmonthlyrepairscost SET cost = '$I34' WHERE year = '$B2 ' AND month = '$E2'");
           
                redirect('profiles');
                    
                } elseif ($date1 !== $date) {
                    
                  foreach ($unitarray as $key) {
                # code...
                $unitsql = "INSERT INTO tonnage (zoneid,tonnes,date,period,month)
                value
                ('{$key['zoneid']}','{$key['tonnes']}','{$key['date']}','{$key['period']}','{$key['month']}')";
                $q = mysql_query($unitsql);
                if($q==true){
                    echo 'Done';
                }else{
                    echo mysql_error();
                }
            }
            redirect('profiles');
                    
                }
                
               redirect('profiles');
      
          
        }
            
        }
		} else {
		$farmname = $this->uri->segment(3);
		$cropcycle = $this->uri->segment(4);	
		echo "Wrong file please upload right file with the name:".$farmname.".xlsx";
		header("Refresh:5;" .base_url()."uploads/do_upload/".$farmname."/".$cropcycle);
			
		}
		} else {
		$farmname = $this->uri->segment(3);
		$cropcycle = $this->uri->segment(4);
		$data['farm'] = $farmname;
		$data['cyclename'] = $cropcycle;
		$this->load->view('dailyrevenueuploads_v',$data);
		
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
        unlink('./files/'.$name);
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
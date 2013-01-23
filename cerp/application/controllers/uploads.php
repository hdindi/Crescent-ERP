<?php
//error_reporting(0);
session_start();
class Uploads extends CI_Controller{
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
	
	function data(){
	$farmid =  $this->input->post("farmname");
	$farmname =$this->uri->segment(3);
	$data['farm'] =$this->uri->segment(3);
	
	$data['precost1']=$this->cycle();
	

	$this->load->view('uploads_v',$data);
	}
	
	function precost(){
  	$this->db->select('constant');
  	$this->db->where('id','1');
  	$query=$this->db->get('constants');//*/
	$farm_id = $this->farmid();
     return $data=$row->cyclename;
return $data=$query->result();
  }
  
	
	 public function farmid(){
         $farmname =  $this->input->post("farmname");
		 $this->db->select('id');
		 $this->db->from('farm');
		 $this->db->where('name',$farmname);
		 $this->db->limit(1);
		 $query=$this->db->get();
		 if($query->num_rows()>0){
		foreach ($query->result() as $row){
		   $farmid =$row->id;
		   $this->$_variable = $farmid;
		}
}
return $data1;
}
    public function cycle(){
	
	
	 $farm_id = $this->uri->segment(3);

		$this->db->select('id');
		$this->db->from('farm');
		$this->db->where('name', $farm_id );
	
		$query = $this->db->get();
		if ($query -> num_rows() > 0) {
		$row_id = $query->result();
			foreach ($query->result() as $row) {
				$row_id = $row->id;
				echo $row_id;
			}
		}
	$farm_value = $row_id;
	$this->db->select('cyclename');
		$this->db->where('farmid', $farm_value);
		$query = $this->db->get('cycle');
		if($query->num_rows()>0){
		foreach ($query->result() as $row){
		 $data1[]=$row;
		}
	}
	return $data1;
}
	public function cycleid(){
	$farmid = $this->_variable;
		
		$this ->db->query("SELECT suppliers.suppler_name, orders.order_id
FROM suppliers, orders
WHERE suppliers.supplier_id = orders.supplier_id
and suppliers.supplier_city = 'Atlantic City';");
	}
	
	public function do_upload(){
	  $farmname= $this->uri->segment(3);
	  echo $farmname;
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
        
		$structure = "./uploadedfiles/farm/";
		$structure2 = "./uploadedfiles/farm/oldfiles/";
		
		if($farmname == $file_name){
		if (!mkdir($structure, 0, true)) {
		
		$path = "./uploadedfiles/farm/{$farmname}.xlsx";
		$destination = "./uploadedfiles/farm/oldfiles/".date("Y-m-d")."{$farmname}.xlsx";
     
        rename($path,$destination);
		
        unlink($path);
       
        } else{
            mkdir($structure, 0777, true);
			mkdir($structure2, 0777, TRUE);
			$path = "./uploadedfiles/farm/{$farmname}.xlsx";
            $destination = "./uploadedfiles/farm/oldfiles/".date("Y-m-d")."{$farmname}.xlsx";
        $destination="./files/{$farmname}/{$userid}/".date("Y-m-d ")."{$farmname}.xlsx";
		//move_uploaded_file($path,$destination);
     	rename($path,$destination);
        
        }
      
        $config['upload_path'] = "./uploadedfiles/farm/";
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
            $path = "./uploadedfiles/farm/{$farmname}.xlsx";
			echo $path;
            $objPHPExcel = $objReader->load($path);
            $C10 = $objPHPExcel->getActiveSheet()->getCell('C10')->getCalculatedValue();
            $C11 = $objPHPExcel->getActiveSheet()->getCell('C11') ->getCalculatedValue();
            $C12 = $objPHPExcel->getActiveSheet()->getCell('C12') ->getCalculatedValue();
            $C13 = $objPHPExcel->getActiveSheet()->getCell('C13') ->getCalculatedValue();
            $C14 = $objPHPExcel->getActiveSheet()->getCell('C14')->getCalculatedValue();
            $C15 = $objPHPExcel->getActiveSheet()->getCell('C15') ->getCalculatedValue();
            $C16 = $objPHPExcel->getActiveSheet()->getCell('C16') ->getCalculatedValue();
            $C17 = $objPHPExcel->getActiveSheet()->getCell('C17') ->getCalculatedValue();
            $C18 = $objPHPExcel->getActiveSheet()->getCell('C18')->getCalculatedValue();
            $C19 = $objPHPExcel->getActiveSheet()->getCell('C19') ->getCalculatedValue();
            $C20 = $objPHPExcel->getActiveSheet()->getCell('C20') ->getCalculatedValue();
            $C21 = $objPHPExcel->getActiveSheet()->getCell('C21') ->getCalculatedValue();
            $C22 = $objPHPExcel->getActiveSheet()->getCell('C22')->getCalculatedValue();
            $C23 = $objPHPExcel->getActiveSheet()->getCell('C23') ->getCalculatedValue();
            $C24 = $objPHPExcel->getActiveSheet()->getCell('C24') ->getCalculatedValue();
            $C25 = $objPHPExcel->getActiveSheet()->getCell('C25') ->getCalculatedValue();
            $C26 = $objPHPExcel->getActiveSheet()->getCell('C26')->getCalculatedValue();
            $C27 = $objPHPExcel->getActiveSheet()->getCell('C27') ->getCalculatedValue();
            $C28 = $objPHPExcel->getActiveSheet()->getCell('C28') ->getCalculatedValue();
            $C29 = $objPHPExcel->getActiveSheet()->getCell('C29') ->getCalculatedValue();
            $C30 = $objPHPExcel->getActiveSheet()->getCell('C30')->getCalculatedValue();
            $G10 = $objPHPExcel->getActiveSheet()->getCell('G10')->getCalculatedValue();
            $G11 = $objPHPExcel->getActiveSheet()->getCell('G11') ->getCalculatedValue();
            $G12 = $objPHPExcel->getActiveSheet()->getCell('G12') ->getCalculatedValue();
            $G13 = $objPHPExcel->getActiveSheet()->getCell('G13') ->getCalculatedValue();
            $G14 = $objPHPExcel->getActiveSheet()->getCell('G14')->getCalculatedValue();
            $G15 = $objPHPExcel->getActiveSheet()->getCell('G15') ->getCalculatedValue();
            $G16 = $objPHPExcel->getActiveSheet()->getCell('G16') ->getCalculatedValue();
            $G17 = $objPHPExcel->getActiveSheet()->getCell('G17') ->getCalculatedValue();
            $G18 = $objPHPExcel->getActiveSheet()->getCell('G18')->getCalculatedValue();
            $G19 = $objPHPExcel->getActiveSheet()->getCell('G19') ->getCalculatedValue();
            $G20 = $objPHPExcel->getActiveSheet()->getCell('G20') ->getCalculatedValue();
            $G21 = $objPHPExcel->getActiveSheet()->getCell('G21') ->getCalculatedValue();
            $G22 = $objPHPExcel->getActiveSheet()->getCell('G22')->getCalculatedValue();
            $G23 = $objPHPExcel->getActiveSheet()->getCell('G23') ->getCalculatedValue();
            $G24 = $objPHPExcel->getActiveSheet()->getCell('G24') ->getCalculatedValue();
            $G25 = $objPHPExcel->getActiveSheet()->getCell('G25') ->getCalculatedValue();
            $G26 = $objPHPExcel->getActiveSheet()->getCell('G26')->getCalculatedValue();
            $G27 = $objPHPExcel->getActiveSheet()->getCell('G27') ->getCalculatedValue();
            $G28 = $objPHPExcel->getActiveSheet()->getCell('G28') ->getCalculatedValue();
            $G29 = $objPHPExcel->getActiveSheet()->getCell('G29') ->getCalculatedValue();
            $G30 = $objPHPExcel->getActiveSheet()->getCell('G30')->getCalculatedValue();
            $multiply10 = $C10 * $G10;
            $multiply11 = $C11 * $G11;
            $multiply12 = $C12 * $G12;
            $multiply13 = $C13 * $G13;
            $multiply14 = $C14 * $G14;
            $multiply15 = $C15 * $G15;
            $multiply16 = $C16 * $G16;
            $multiply17 = $C17 * $G17;
            $multiply18 = $C18 * $G18;
            $multiply19 = $C19 * $G19;
            $multiply20 = $C20 * $G20;
            $multiply21 = $C21 * $G21;
            $multiply22 = $C22 * $G22;
            $multiply23 = $C23 * $G23;
            $multiply24 = $C24 * $G24;
            $multiply25 = $C25 * $G25;
            $multiply26 = $C26 * $G26;
            $multiply27 = $C27 * $G27;
            $multiply28 = $C28 * $G28;
            $multiply29 = $C29 * $G29;
            $multiply30 = $C30 * $G30;


            $D10 = $objPHPExcel->getActiveSheet()->getCell('D10')->getCalculatedValue();
            $D11 = $objPHPExcel->getActiveSheet()->getCell('D11') ->getCalculatedValue();
            $D12 = $objPHPExcel->getActiveSheet()->getCell('D12') ->getCalculatedValue();
            $D13 = $objPHPExcel->getActiveSheet()->getCell('D13') ->getCalculatedValue();
            $D14 = $objPHPExcel->getActiveSheet()->getCell('D14')->getCalculatedValue();
            $D15 = $objPHPExcel->getActiveSheet()->getCell('D15') ->getCalculatedValue();
            $D16 = $objPHPExcel->getActiveSheet()->getCell('D16') ->getCalculatedValue();
            $D17 = $objPHPExcel->getActiveSheet()->getCell('D17') ->getCalculatedValue();
            $D18 = $objPHPExcel->getActiveSheet()->getCell('D18')->getCalculatedValue();
            $D19 = $objPHPExcel->getActiveSheet()->getCell('D19') ->getCalculatedValue();
            $D20 = $objPHPExcel->getActiveSheet()->getCell('D20') ->getCalculatedValue();
            $D21 = $objPHPExcel->getActiveSheet()->getCell('D21') ->getCalculatedValue();
            $D22 = $objPHPExcel->getActiveSheet()->getCell('D22')->getCalculatedValue();
            $D23 = $objPHPExcel->getActiveSheet()->getCell('D23') ->getCalculatedValue();
            $D24 = $objPHPExcel->getActiveSheet()->getCell('D24') ->getCalculatedValue();
            $D25 = $objPHPExcel->getActiveSheet()->getCell('D25') ->getCalculatedValue();
            $D26 = $objPHPExcel->getActiveSheet()->getCell('D26')->getCalculatedValue();
            $D27 = $objPHPExcel->getActiveSheet()->getCell('D27') ->getCalculatedValue();
            $D28 = $objPHPExcel->getActiveSheet()->getCell('D28') ->getCalculatedValue();
            $D29 = $objPHPExcel->getActiveSheet()->getCell('D29') ->getCalculatedValue();
            $D30 = $objPHPExcel->getActiveSheet()->getCell('D30')->getCalculatedValue();
            echo $D10.'<br/>';

            $multplicationarray = array(
                0=>$D10,
                1=>$D11,
                3=>$D12,
                4=>$D13,
                5=>$D14,
                6=>$D15,
                7=>$D16,
                8=>$D17,
                9=>$D18,
                10=>$D19,
                11=>$D20,
                12=>$D21,
                13=>$D22,
                14=>$D23,
                15=>$D24,
                16=>$D25,
                17=>$D26,
                18=>$D27,
                19=>$D28,
                20=>$D29,
                21=>$D30
                                        );
            $sum = array_sum($multplicationarray);
            
             $this->db ->query("INSERT INTO transportrevenue (cummulativeamount) VALUES ('$sum')");
			
           
            echo array_sum($multplicationarray).'<br/>';
			echo "kenya";
			
			
			//Chemical Table insertion starts from here!!!
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
				//echo $row_id;
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
		
			  $B41 = $objPHPExcel->getActiveSheet()->getCell('B41')->getCalculatedValue();
            $B42 = $objPHPExcel->getActiveSheet()->getCell('B42') ->getCalculatedValue();
            $B43 = $objPHPExcel->getActiveSheet()->getCell('B43') ->getCalculatedValue();
            $B44 = $objPHPExcel->getActiveSheet()->getCell('B44') ->getCalculatedValue();
            $B45 = $objPHPExcel->getActiveSheet()->getCell('B45')->getCalculatedValue();
			$B46 = $objPHPExcel->getActiveSheet()->getCell('B46') ->getCalculatedValue();
            $B47 = $objPHPExcel->getActiveSheet()->getCell('B47') ->getCalculatedValue();
            $B48 = $objPHPExcel->getActiveSheet()->getCell('B48')->getCalculatedValue();
           
            $C41 = $objPHPExcel->getActiveSheet()->getCell('C41') ->getCalculatedValue();
            $C42 = $objPHPExcel->getActiveSheet()->getCell('C42') ->getCalculatedValue();
            $C43 = $objPHPExcel->getActiveSheet()->getCell('C43') ->getCalculatedValue();
            $C44 = $objPHPExcel->getActiveSheet()->getCell('C44')->getCalculatedValue();
            $C45 = $objPHPExcel->getActiveSheet()->getCell('C45') ->getCalculatedValue();
			$C46 = $objPHPExcel->getActiveSheet()->getCell('C46') ->getCalculatedValue();
            $C47 = $objPHPExcel->getActiveSheet()->getCell('C47') ->getCalculatedValue();
            $C48 = $objPHPExcel->getActiveSheet()->getCell('C48')->getCalculatedValue();
           
            $D41 = $objPHPExcel->getActiveSheet()->getCell('D41') ->getCalculatedValue();
            $D42 = $objPHPExcel->getActiveSheet()->getCell('D42') ->getCalculatedValue();
            $D43 = $objPHPExcel->getActiveSheet()->getCell('D43')->getCalculatedValue();
            $D44 = $objPHPExcel->getActiveSheet()->getCell('D44') ->getCalculatedValue();
            $D45 = $objPHPExcel->getActiveSheet()->getCell('D45') ->getCalculatedValue();
			$D46 = $objPHPExcel->getActiveSheet()->getCell('D46') ->getCalculatedValue();
            $D47 = $objPHPExcel->getActiveSheet()->getCell('D47') ->getCalculatedValue();
            $D48 = $objPHPExcel->getActiveSheet()->getCell('D48')->getCalculatedValue();
           
            $E41 = $objPHPExcel->getActiveSheet()->getCell('E41') ->getCalculatedValue();
            $E42 = $objPHPExcel->getActiveSheet()->getCell('E42')->getCalculatedValue();
            $E43 = $objPHPExcel->getActiveSheet()->getCell('E43') ->getCalculatedValue();
            $E44 = $objPHPExcel->getActiveSheet()->getCell('E44') ->getCalculatedValue();
            $E45 = $objPHPExcel->getActiveSheet()->getCell('E45') ->getCalculatedValue();
			$E46 = $objPHPExcel->getActiveSheet()->getCell('E46') ->getCalculatedValue();
            $E47 = $objPHPExcel->getActiveSheet()->getCell('E47') ->getCalculatedValue();
            $E48 = $objPHPExcel->getActiveSheet()->getCell('E48')->getCalculatedValue();
           
            
			
			
            $chemicalarray = array(
                1=>array('name'=>$B41,'farmid'=>$farmname_id,'amount'=>$D41,'cycleid'=>$cycleid,'totalprice'=>$E41,'quantity'=>$C41),
                2=>array('name'=>$B42,'farmid'=>$farmname_id,'amount'=>$D42,'cycleid'=>$cycleid,'totalprice'=>$E42,'quantity'=>$C42),
                3=>array('name'=>$B43,'farmid'=>$farmname_id,'amount'=>$D43,'cycleid'=>$cycleid,'totalprice'=>$E43,'quantity'=>$C43),
                4=>array('name'=>$B44,'farmid'=>$farmname_id,'amount'=>$D44,'cycleid'=>$cycleid,'totalprice'=>$E44,'quantity'=>$C44),
                5=>array('name'=>$B45,'farmid'=>$farmname_id,'amount'=>$D45,'cycleid'=>$cycleid,'totalprice'=>$E45,'quantity'=>$C45),
                6=>array('name'=>$B46,'farmid'=>$farmname_id,'amount'=>$D46,'cycleid'=>$cycleid,'totalprice'=>$E46,'quantity'=>$C46),
                7=>array('name'=>$B47,'farmid'=>$farmname_id,'amount'=>$D47,'cycleid'=>$cycleid,'totalprice'=>$E47,'quantity'=>$C47),
                8=>array('name'=>$B48,'farmid'=>$farmname_id,'amount'=>$D48,'cycleid'=>$cycleid,'totalprice'=>$E48,'quantity'=>$C48),
                
               
                );
            foreach ($chemicalarray as $key) {
                # code...
                $unitsql = "INSERT INTO chemical (name,farmid,amount,cycleid,totalprice,quantity)
                value
                ('{$key['name']}','{$key['farmid']}','{$key['amount']}','{$key['cycleid']}','{$key['totalprice']}','{$key['quantity']}')";
                $q = mysql_query($unitsql);
                if($q==true){
                    echo 'Done';
                }else{
                    echo mysql_error();
                }
            }
            
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
             redirect('profiles');
       
            }
           
            elseif ($name == $filename ) {
               
               redirect('profiles');
      
          
        }
            
        }
		} else {
		$farmname = $this->uri->segment(3);
		$cropcycle = $this->uri->segment(4);	
		echo "Wrong file please upload right file with the name:".$farmname.".xlsx";
		header("Refresh:5;" .base_url()."uploads/do_upload/".$farmname."/".$cropcycle);
		//header("Refresh:3;" .base_url()."uploads/do_upload/".$farmname);
			
		}
		} else {
		$farmname = $this->uri->segment(3);
		$cropcycle = $this->uri->segment(4);
		$data['farm'] = $farmname;
		$data['cyclename'] = $cropcycle;
		$this->load->view('uploads',$data);
		
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
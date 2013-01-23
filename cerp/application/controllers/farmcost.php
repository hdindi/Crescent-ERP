<?php
//error_reporting(0);
 /**
 * 
 */
 class Farmcost extends CI_Controller
 {
    
    function __construct()
    {
        parent ::__construct ();
        $this ->load -> library('excel');
        //$uploadpath = "/xampp/htdocs/newNQ/uploads";
        //$this ->excel_reader -> read($uploadpath);
        // Read the first workbook in the file
        //$worksheetrows =$this->excel_reader->worksheets[0];
        //$worksheetcolumns = 5;
        $this->load->helper(array('form', 'url','file'));

        $this->userid = $this->session->userdata('userid');
        if (!isset($this->userid) or $this->userid=='') redirect('logins');
    
        # code...

    }
    function index()
    {
         $data['files'] = $this->get($this->userid);
        $this->load->view('farmcost_view', array('error' => ' ' ));

        //$this->load->view('profiles', $data,array('error' => ' ' ));
        //$this->load->view('upload_form', array('error' => ' ' ));
    }
    function get($userid)
    {
        $query = $this->db->get_where('files', array('owner'=>$userid));
        return $query->result();
    }


    function do_upload(){
        $file   = read_file($_FILES['userfile']['tmp_name']);
        $name   = basename($_FILES['userfile']['name']);
        $userid =  $this->session->userdata('userid');
        // Desired folder structure
        $structure = "./uploads/files/{$userid}";
        echo $structure;

        // To create the nested structure, the $recursive parameterto mkdir() must be specified.

        if (!mkdir($structure, 0, true)) {
        //die('Failed to create folders...');
        $path = "./uploads/AMUKURA_84.xlsx";
        $destination="./uploads/files/{$userid}/".date("Y-m-d ")."_AMUKURA_84.xlsx";
        rename($path,$destination);
        unlink($path);
       
        } else{
            mkdir($structure, 0777, true);
            $path = "./uploads/Farm/AMUKURA_84.xlsx";
        $destination="./uploads/files/{$userid}/".date("Y-m-d ")."_AMUKURA_84.xlsx";
        rename($path,$destination);
        unlink($path);
        
        }
      
        $config['upload_path'] = './uploads/Farm';
        $config['allowed_types'] = 'xlsx';
        //$config['max_size']   = '1000';
        //$config['max_width']  = '1024';
        //$config['max_height']  = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('farmcost_view', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            $file=
            //$data = array('upload_data' => $this->upload->data());
            //$this->load->view('upload_success', $data);

            $objReader = new PHPExcel_Reader_Excel2007();
            $path = "./uploads/Farm/AMUKURA_84.xlsx";
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
            $multplicationarray = array(
                0=>array('cummulativeamount'=>$multiply10),
                1=>array('cummulativeamount'=>$multiply11),
                3=>array('cummulativeamount'=>$multiply12),
                4=>array('cummulativeamount' =>$multiply13),
                5=>array('cummulativeamount'=>$multiply14),
                6=>array('cummulativeamount'=>$multiply15),
                7=>array('cummulativeamount'=>$multiply16),
                8=>array('cummulativeamount' =>$multiply17),
                9=>array('cummulativeamount' =>$multiply18),
                10=>array('cummulativeamount' =>$multiply19),
                11=>array('cummulativeamount' =>$multiply20),
                12=>array('cummulativeamount' =>$multiply21),
                13=>array('cummulativeamount'=>$multiply22),
                14=>array('cummulativeamount' =>$multiply23),
                15=>array('cummulativeamount'=>$multiply24),
                16=>array('cummulativeamount'=>$multiply25),
                17=>array('cummulativeamount'=>$multiply26),
                18=>array('cummulativeamount'=>$multiply27),
                19=>array('cummulativeamount'=>$multiply28),
                20=>array('cummulativeamount'=>$multiply29),
                21=>array('cummulativeamount'=>$multiply30)
                                        );
           /* foreach ($multplicationarray as  $v) {
            	$sum = array_sum($multplicationarray);
            	echo $sum;
                # code...

                $sql = "INSERT INTO transportrevenue (cummulativeamount) 
            value
            ('{$sum['cummulativeamount']}')";
            $k= mysql_query($sql);
            
            }*/
            $sum = array_sum($multplicationarray);
            $data = array( "cummulativeamount"=>$this->$sum
            	);
            $this->db ->insert('transportrevenue' $data);
            $this->db ->query("INSERT INTO transportrevenue (cummulativeamount) VALUES ('$sum')");
           
            //echo($sum);
          


           /* $unitarray = array(
                1=>array('units'=>$G10,'rate'=>$C10),
                2=>array('units'=>$G11,'rate'=>$C11),
                3=>array('units'=>$G12,'rate'=>$C12),
                4=>array('units'=>$G13,'rate'=>$C13),
                5=>array('units'=>$G14,'rate'=>$C14),
                6=>array('units'=>$G15,'rate'=>$C15),
                7=>array('units'=>$G16,'rate'=>$C16),
                8=>array('units'=>$G17,'rate'=>$C17),
                9=>array('units'=>$G18,'rate'=>$C18),
                10=>array('units'=>$G19,'rate'=>$C19),
                11=>array('units'=>$G20,'rate'=>$C20),
                12=>array('units'=>$G21,'rate'=>$C21),
                13=>array('units'=>$G22,'rate'=>$C22),
                14=>array('units'=>$G23,'rate'=>$C23),
                15=>array('units'=>$G24,'rate'=>$C24),
                16=>array('units'=>$G25,'rate'=>$C25),
                17=>array('units'=>$G26,'rate'=>$C26),
                18=>array('units'=>$G27,'rate'=>$C27),
                19=>array('units'=>$G28,'rate'=>$C28),
                20=>array('units'=>$G29,'rate'=>$C29),
                20=>array('units'=>$G30,'rate'=>$C30)
                );
            foreach ($unitarray as $key) {
                # code...

                $unitsql = "INSERT INTO landactivity (units,rate)
                value
                ('{$key['units']}','{$key['rate']}')";
                $q = mysql_query($unitsql);
                if($q==true){
                    echo 'Done';
                }else{
                    echo mysql_error();
                }
            } 
            /*echo var_dump($unitsql).'<br/>';
            echo var_dump($unitarray);*/
            $filename = $this->checkfile();
            $owner = $this->checkowner();
            $userid = $this->session->userdata('userid');
            //echo $filename.'<br/>';
           
            //echo $file.'<br/>';
            // echo $name.'<br/>';
            //$this->adds($name);
           if ($name !== $filename ) {
            //if ($userid !== $owner) {
                # code...
            
                    $file   = read_file($_FILES['userfile']['tmp_name']);
                    $name   = basename($_FILES['userfile']['name']);
                    $userid =  $this->session->userdata('userid');

                # code...
            $this->adds($name);
            redirect('profiles');
            echo "dindi".'<br/>';
            }
            // }
            elseif ($name == $filename ) {
                
                echo "samuel".'<br/>';
           // }
        }
            
        }
    }


        public function checkfile(){
         $userid =  $this->session->userdata('userid');
        $this->db->select('name');
        $this->db->from('files');
        $this->db->where('owner', $userid );
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query -> num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->id;
            }
            
        }

    
    }
        public function checkowner(){
           $name   = basename($_FILES['userfile']['name']);
        $this->db->select('owner');
        $this->db->from('files');
        $this->db->where('name', $userid );
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query -> num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->id;
            }
            
        }

        }

    function delete($id)
    {
        //This deletes the file from the database, before returning the name of the file.
        $name = $this->deletes($id);        
        unlink('./files/'.$name);
        //#redirect('profiles');
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

?>
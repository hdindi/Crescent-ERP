<?php
 /**
 * 
 */
 class Excelupload extends CI_Controller
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
		$this->load->helper(array('form', 'url'));
	
 		# code...

 	}
 	function index()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xlsx';
		//$config['max_size']	= '1000';
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

			
			//$data = array('upload_data' => $this->upload->data());


			//$this->load->view('upload_success', $data);

			$objReader = new PHPExcel_Reader_Excel2007();
            $path = "./uploads/revenuesheet.xlsx";
            $objPHPExcel = $objReader->load($path);
            // $objPHPExcel = PHPExcel_IOFactory::load("MyExcel.xlsx");
            $G74 = $objPHPExcel->getActiveSheet()->getCell('B6')->getFormattedValue();
            
           // $G74A = PHPExcel_Shared_Date::ExcelToPHP($G74);
            //$G74B = date($G74A,'');
        	$G75 = $objPHPExcel->getActiveSheet()->getCell('K6')->getCalculatedValue();
        	$G76 = $objPHPExcel->getActiveSheet()->getCell('W6')->getCalculatedValue();
        	$G77 = "dindi" ;
       		//$G77 = $objPHPExcel->getActiveSheet()->getCell('W6')->getValue();
       		echo $G77.'<br/>';
       		echo  $G76.'<p><br/>';
       		echo $G75.'<br/>';
       		echo $G74.'<br/>';
       		/*$G78 = $objPHPExcel->getActiveSheet()->getCell('B7')->getValue();
        	$G79 = $objPHPExcel->getActiveSheet()->getCell('U7')->getValue();
       		$G80 = $objPHPExcel->getActiveSheet()->getCell('V7')->getValue();
       		$G81 = $objPHPExcel->getActiveSheet()->getCell('W7')->getValue();*/

       		$data1 = array(
                'date' => $G74,
                'dailytotal' => $G75,
                'cummulativeamount' => $G76,
                //'periodexpected' => $G74
            );
            $this->db->insert('transportrevenue', $data1);

		}
	}



	
 }

?>
<?php
error_reporting(0);
class Buku_con extends CI_Controller {
public function Buku_con() {
parent::__construct();
//$this->load->model('buku_model');//load the model
$this->load->library('pagination');
$this -> load -> library('excel');
}
//function to get the data from tb_book
function getBuku() {
$data['title'] = 'menampilkan isi buku';
$data['detail'] = $this->getBuku1();//call the model and save the result in $detail
$this->load->view('buku_view', $data);
}
//function to export to excel
function toExcelAll() {
$query['data1'] = $this->ToExcelAll1();
$this->load->view('excel_view',$query);
}

function getBuku1() {
$this->db->select('*');
$this->db->from('farm');
$this->db->order_by('id','DESC');
$getData = $this->db->get();
if($getData->num_rows() > 0)
return $getData->result_array();
else
return null;
}
//query for get all data
function toExcelAll1() {
$this->db->select('*');
$this->db->from('farm');
$this->db->order_by('id','desc');
$getData = $this->db->get();
if($getData->num_rows() > 0)
return $getData->result_array();
else
return null;
}


public function exportResults() {

		$this -> load -> database();
		$query = $this -> db -> query("
		SELECT * FROM farm LIMIT 2");
		$results = $query -> result_array();
		$objPHPExcel = new Excel();
		//echo BASEPATH;
		
		/* PHPExcel_Cell_AdvanceValueBinder required for this sample */
		//require_once BASEPATH.'application/third_party/PHPExcel/Cell/AdvancedValueBinder.php';


		
		
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		$objPHPExcel = $objReader->load('./files/farmdetails.xlsx');

		
		$objPHPExcel ->getActiveSheet()->setTitle('farmreport');
		
		$objPHPExcel -> setActiveSheetIndex(0);
		$i = 1;
		foreach ($results as $result) {

			$objPHPExcel -> getActiveSheet() -> SetCellValue('A' . $i, $result["name"]);
			
			// MySQL-like timestamp '2008-12-31' or date string
			//PHPExcel_Cell::setValueBinder(new PHPExcel_Cell_AdvancedValueBinder());
			//$objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $result['dateofcontract']);
			//$objPHPExcel->getActiveSheet()->getStyle('B' . $i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
			//$objPHPExcel -> getActiveSheet() -> SetCellValue('B' . $i, $result["dateofcontract"]);
			$objPHPExcel -> getActiveSheet() -> SetCellValue('C' . $i, $result["leasorname"]);
			$objPHPExcel -> getActiveSheet() -> SetCellValue('D' . $i, $result["acre"]);
			$objPHPExcel -> getActiveSheet() -> SetCellValue('E' . $i, $result["zone"]);

			$i++;
			//echo $result["name"];
			}
		
		

		//ob_end_clean();
		$filename = "Reportofpoll.xlsx";
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename=' . $filename);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		//ob_end_clean();

		$objWriter -> save('php://output');

		$objPHPExcel -> disconnectWorksheets();
		unset($objPHPExcel);

		

	}



}
?>
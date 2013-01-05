<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Raw_data extends MY_Controller {
		function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		
		
	}

	public function index() {
		$this -> listing();
	}
	public function reports_Home()
	{
		
		$data['title'] = "Reports Home";
		$data['quick_link'] = "Reports";
		$data['content_view'] = "reportsview";
		$data['link'] = "raw_data";   
		$data['banner_text'] = "Reports Home";
		$data['link'] = "Reports";
		$this -> load -> view("template", $data);
	}
	
	public function getconsumption(){
		
		//$data_type=$_POST['type_of_data'];
		//$duration=$_POST['duration'];
		$year=$_POST['year_from'];
		$report_type=$_POST['type_of_report'];
		$title='test';
		$report_name="Stock Contol Card For".$year;
		//$facility_code=$this -> session -> userdata('news');
		$report=Facility_Issues::getAll();
		//$facility_name=Facilities::get_facility_name($facility_code);
		
/**************************************set the style for the table****************************************/

$html_data='<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#C9C299;}</style>';


		$html_data1 ='';// order analysis
		$html_data2=''; // raw order details
		
		
		
		/*****************************setting up the report*******************************************/

$html_data1 .='<table class="data-table"><thead>

			<tr > <th ><strong>Date Issued</strong></th>
			<th><strong>S11 No</strong></th>
			<th><strong>Receipts</strong></th>
			
			
			<th><strong>Batch No</strong></th>
			<th><strong>Quantity Issued</strong></th>
			<th ><strong><b>Balances</b></strong></th>

</tr> </thead><tbody>';


$html_data2 .='<table class="data-table"><thead>

			<tr> <th><strong>Date Issued</strong></th>
			<th><strong>S11 No</strong></th>
			<th><strong>Receipts</strong></th>
			
			
			<th><strong>Batch No</strong></th>
			<th><strong>Quantity Issued</strong></th>
			<th ><strong><b>Balances</b></strong></th>
					    	
</tr> </thead><tbody>';
		
		foreach($report as $report){
			
				


/*******************************begin adding data to the report*****************************************/
		   
	
			 $html_data1 .='<tr><td>'.$report->date_issued.'</td>
							<td>'.$report->s11_No.'</td>
							<td >'.$report->SumColumn.'</td>
							
							
							<td >'.$report->batch_no.'</td>
							<td>'.$report->qty_issued.'</td>
							<td class="col5" >'.$report->balanceAsof.'</td>
							
							</tr>';

/***********************************************************************************************/


/****************************************************************************************************************/						
			
		  
		  }
		$html_data1 .='</tbody></table>';
		 // $html_data2 .='</tbody></table>';

		
			$html_data .= $html_data1;
		
		
         
	   // $html_data .= $html_data2;
            /**************************finally generate the report***********************/

		$this->generate_pdf($report_name,$title,$html_data,$report_type);
		
			}


public function generate_pdf($r_name,$title,$data,$display_type){
		$desc=$_POST['desc'];
		$drug=$_POST['drugname'];
		//echo $drug ;
		//$facility_code=$this -> session -> userdata('news');
		//$facility_name_array=Facilities::get_facility_name($facility_code)->toArray();
		//$facility_name=$facility_name_array['facility_name'];
		
		if ($display_type == "Download PDF") {
			
			/********************************************setting the report title*********************/
			
		$html_title="<img src='".base_url()."Images/coat_of_arms.png' style='position:absolute;  width:160px; width:160px; top:0px; left:0px; margin-bottom:-100px;margin-right:-100px;'></img>
       <h2 style='text-align:center;'>".$r_name."</h2><br><br>
       <span style=' margin-left:500px; text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>
       Ministry of Public Health and Sanitation/Ministry of Medical Services</span><br>
        <span style='display: block; font-size: 12px;'>Health Commodities Management Platform</span><span style='text-align:center;' ><hr /> 
        <span><p style='font-weight: bold;'>Kemsa Code: ".$desc."</p><p style='font-weight: bold;'> Drug Description: ".$drug."</p>
          ";
		
		/**********************************initializing the report **********************/
            $this->load->library('mpdf');
            $this->mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
            $this->mpdf->SetTitle($title);
            $this->mpdf->WriteHTML($html_title);
            $this->mpdf->simpleTables = true;
            $this->mpdf->WriteHTML('<br/>');
            $this->mpdf->WriteHTML($data);
			$report_name = $r_name.".pdf";
            $this->mpdf->Output($report_name,'D');
			
		
            
        } 
        else if ($display_type == "View Report") {
        	
        $html_title= '<link href="'.base_url().'CSS/style.css" type="text/css" rel="stylesheet"/> 
		<div class="logo"><a class="logo" ></a> </div>
		 <div id="system_title">
		<span style="display: block; font-weight: bold; font-size: 14px; margin:2px;">Ministry of Public Health and Sanitation/Ministry of Medical Services</span>
		<span style="display: block; font-size: 12px;">Health Commodities Management Platform</span>
		</div>
		</div>
		<span style="display: block; font-size: 12px;">Health Commodities Management Platform</span><span style="text-align:center;" ><hr /> 
        <span><p style="font-weight: bold;">Drug Description: '.$drug.'</p><p style="font-weight: bold;"> Kemsa Code: '.''.''.$desc.'</p>';
		
            echo $html_title.$data;
        }
		
	}
	
	
	
	
	
	
	
	
	
	
}
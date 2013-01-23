<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Report_Management extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		
	}

	public function index() {
		$data['title'] = "System Reports";
		$data['content_view'] = "reports_v";
		$data['banner_text'] = "System Reports";
		$data['link'] = "reports_management";
		$this -> load -> view("template", $data);
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
	public function consum_v(){                   //New
               $data['title'] = "Stock Control Card";
			   $data['drugs'] = Drug::getAll();
			   $data['content_view'] = "stockcontrolC";
               $data['banner_text'] = "Stock Control Card";
               $data['link'] = "order_management";
               $data['quick_link'] = "facility_consumption";
               $this -> load -> view("template", $data);           
}
	
	//all the order reports to be generated
	public function order_report(){
					/****************************8get the facility code***************************************************/
  $facility_code=$this -> session -> userdata('news');
  $from_ordertbl=Ordertbl::get_facilitiy_orders($facility_code);
  //setting up the variables 
  $total_item_received=0;
  $total_item_ordered=0;
  $order_fill_rate=0;
  /****************************create a loop to fetch a facilities order details ***************/
  foreach($from_ordertbl as $infor_array){
		  
		  foreach($infor_array->Ord as $Ord_array){
		  	//giving the variables data
		  	$o_q=$Ord_array->quantityOrdered; 
		  	$total_item_ordered=$total_item_ordered+$o_q;
			$o_qr=$Ord_array->quantityRecieved; 
			$total_item_received=$total_item_received+$o_qr;
			
		  }

		    $order_fill_rate=($total_item_received/$total_item_ordered)*100;
		}
   //Create an XML data document in a string variable
   $strXML  = "";
   $strXML1="";
   $strXML .= "<chart bgAlpha='0' bgColor='FFFFFF' lowerLimit='0' upperLimit='100' numberSuffix='%25' showBorder='0' basefontColor='FFFFDD' chartTopMargin='25' chartBottomMargin='25' chartLeftMargin='25' chartRightMargin='25' toolTipBgColor='80A905' gaugeFillMix='{dark-10},FFFFFF,{dark-10}' gaugeFillRatio='3'>";
   $strXML .= "<colorRange><color minValue='0' maxValue='45' code='FF654F'/><color minValue='45' maxValue='80' code='F6BD0F'/><color minValue='80' maxValue='100' code='8BBA00'/></colorRange>";
   $strXML .= "<dials><dial value='".$order_fill_rate."' rearExtension='10'/></dials>";
   $strXML .= "<trendpoints><point value='50' displayValue='Order Fill Rate' fontcolor='FF4400' useMarker='1' dashed='1' dashLen='2' dashGap='2' valueInside='1' /></trendpoints>";
   $strXML .= "<annotations><annotationGroup id='Grp1' showBelow='1' ><annotation type='rectangle' x='5' y='5' toX='345' toY='195' radius='10' color='009999,333333' showBorder='1' /></annotationGroup></annotations>";
   $strXML .= "<styles><definition><style name='RectShadow' type='shadow' strength='3'/></definition><application><apply toObject='Grp1' styles='RectShadow' /></application></styles>";
   $strXML .= "</chart>";
   
   /**********************************************/
    $strXML1 .= "<chart lowerLimit='0' upperLimit='100' lowerLimitDisplay='Good' upperLimitDisplay='Bad' palette='1' chartRightMargin='20'>";
    $strXML1 .="<colorRange><color minValue='0' maxValue='15'  code='8BBA00' label='Good'/><color minValue='16' maxValue='44' code='F6BD0F' label='Moderate'/><color code='FF654F'minValue='45' maxValue='100'  label='BAD'/></colorRange>";
    $strXML1 .="<pointers><pointer value='92' /></pointers>";
	$strXML1 .='</chart>';
		
		$data['strXML']=$strXML;
		$data['strXML1']=$strXML1;
		$data['title'] = "Order Report";
		$data['content_view'] = "facility/order_report";
		$data['banner_text'] = "Orders Report";
		$data['link'] = "order_management";
		$data['quick_link'] = "stock_level";
		$this -> load -> view("template", $data);
	}
	
	//generate order report
	public function generate_order_report(){
		$data_type=$_POST['type_of_data'];
		$duration=$_POST['duration'];
		$year=$_POST['year_from'];
		$report_type=$_POST['type_of_report'];
		$title='test';
		$report_name="Order Report For".$year;
		$facility_code=$this -> session -> userdata('news');
		$from_ordertbl=Ordertbl::get_facilitiy_orders($facility_code);
		$facility_name=Facilities::get_facility_name($facility_code);
		
/**************************************set the style for the table****************************************/

$html_data='<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#D8D8D8;}</style>';

		//create the report based on the request of the user 
/**********bug detected mpdf cannot print a report that has nesteded loops the solution is to create the html body before creating the mpdf object****/
		$html_data1 ='';// order analysis
		$html_data2=''; // raw order details
		
		foreach($from_ordertbl as $infor_array){
			//setting up the variables
		$total_item_received=0;
		$total_item_ordered=0;
		$date=$infor_array->orderDate;
		$draw=$infor_array->drawing_rights;
		$total=$infor_array->orderTotal;
		$bal=number_format($draw-$total, 2, '.', ',');
		
/*****************************setting up the report*******************************************/

$html_data1 .='<table class="data-table"><thead>
<tr><td colspan="16"><p style="font-weight: bold;">Facility Order No: '.$infor_array->id.' | KEMSA Order No: '.$infor_array->kemsaOrderid.' | Order Date:'.$date.' | Order Total: '.number_format($total, 2, '.', ',').' | Drawing rights: '.number_format($draw, 2, '.', ',').' | 
Balance(Drawing rights - Order Total):'.$bal.' </p></span></td></tr>
<tr> <th><strong>KEMSA Code</strong></th><th><strong>Description</strong></th><th><strong>Quantity Ordered</strong></th><th><strong>Unit Cost</strong></th><th class="col5" ><strong><b>Total Cost</b></strong></th>
<th><strong>Quantity Ordered</strong></th><th><strong>Quantity Received</strong></th><th class="col5" ><strong><b>Fill rate</b></strong></th>
<th><strong><b>Opening Balance</b></strong></th>
<th><strong><b>Total Receipts</b></strong></th>
<th><strong><b>Total Issues</b></strong></th>
<th><strong><b>ADJ</b></strong></th>
<th><strong><b>Losses</b></strong></th>
<th><strong><b>Closing Stock</b></strong></th>
<th><strong><b>Days Out Of stock</b></strong></th>
<th><strong><b>Comment</b></strong></th>
</tr> </thead><tbody>';

/***********************************************************************************************/
$html_data2 .='<table class="data-table"><thead>
<tr><td colspan="16"><p style="font-weight: bold;">Facility Order No: '.$infor_array->id.' | KEMSA Order No: '.$infor_array->kemsaOrderid.' | Order Date:'.$date.' | Order Total: '.number_format($total, 2, '.', ',').' | Drawing rights: '.number_format($draw, 2, '.', ',').' | 
Balance(Drawing rights - Order Total):'.$bal.' </p></span></td></tr>
<tr> <th><b>KEMSA Code</b></th>
						<th><b>Description</b></th>
						<th><b>Order Unit Size</b></th>
						<th><b>Order Unit Cost</b></th>
						<th ><b>Opening Balance</b></th>
						<th ><b>Total Receipts</b></th>
					    <th><b>Total issues</b></th>
					    <th><b>Adjustments</b></th>
					    <th><b>Losses</b></th>
					    <th><b>Closing Stock</b></th>
					    <th><b>No days out of stock</b></th>
					    <th><b>Order Quantity</b></th>
					    <th><b>Order cost(Ksh)</b></th>	
					   <th><b>Comment(if any)</b></th>	
</tr> </thead><tbody>';

/*****************************creating the rows **************************************/
		  
		  foreach($infor_array->Ord as $Ord_array){
		  	//setting the variables
		  	$o_q=$Ord_array->quantityOrdered; $total_item_ordered=$total_item_ordered+$o_q;
		  	$o_p=$Ord_array->price;
		  	$o_t=number_format($o_p*$o_q, 2, '.', ',');
			$o_qr=$Ord_array->quantityRecieved; $total_item_received=$total_item_received+$o_qr;
			$fill=($o_qr/$o_q)*100;
			
/*******************************begin adding data to the report*****************************************/
		   $html_data1 .='<tr><td>'.$Ord_array->kemsaCode.'</td>';
		   $html_data2 .='<tr><td>'.$Ord_array->kemsaCode.'</td>';
	foreach($Ord_array->Code as $d){
		 $name=$d->Drug_Name; $html_data1 .='<td>'.$name.'</td>'; 
		/*********************************************************************************************/ 
		 $html_data2 .='<td>'.$name.'</td><td>'.$d->Unit_Size.'</td><td>'.$o_p.'</td>';
}
			 $html_data1 .='<td>'.$o_q.'</td>
							<td>'.$o_p.'</td>
							<td class="col5">'.$o_t.'</td>
							<td>'.$o_q.'</td>
							<td>'.$o_qr.'</td>
							<td class="col5">'.$fill.'%'.'</td>
							<td>'.$Ord_array->o_balance.'</td>
							<td >'.$Ord_array->t_receipts.'</td>
							<td >'.$Ord_array->t_issues.'</td>
							<td >'.$Ord_array->adjust.'</td>
							<td >'.$Ord_array->losses.'</td>
							<td >'.$Ord_array->c_stock.'</td>
							<td >'.$Ord_array->days.'</td>
							<td >'.$Ord_array->comment.'</td>
							</tr>';
	/****************************************************************************************************************/						
							$html_data2 .='<td>'.$Ord_array->o_balance.'</td>
							<td>'.$Ord_array->t_receipts.'</td>
							<td >'.$Ord_array->t_issues.'</td>
							<td>'.$Ord_array->adjust.'</td>
							<td>'.$Ord_array->losses.'</td>
							<td >'.$Ord_array->c_stock.'</td>
							<td>'.$Ord_array->days.'</td>
							<td >'.$o_q.'</td>
							<td class="col5">'.$o_t.'</td>
							<td >'.$Ord_array->comment.'</td>
							</tr>';
		  }

		    $order_fill_rate=($total_item_received/$total_item_ordered)*100;
		  
		  //close the table
		  $html_data1 .='<tr><td colspan="16"> <b>Total Items Received: '.$total_item_received.' | Total Items Ordered : '.$total_item_ordered.'|    Order Fill Rate(Total items received/Total Items Ordered)*100 :'.$order_fill_rate.' %</td></tr></tbody></table></b><hr /></br></br>';
		  $html_data2 .='</tbody></table></b><hr /></br></br>';	
		}

		if($data_type=='Order Analysis'){
			$html_data .= $html_data1;
		}
		
         else if($data_type=='Raw Order Data'){
	    $html_data .= $html_data2;
         }
		
    /**************************finally generate the report***********************/

		$this->generate_pdf($report_name,$title,$html_data,$report_type);
		
	}
	//generate pdf
	public function generate_pdf($r_name,$title,$data,$display_type){
		
		$facility_code=$this -> session -> userdata('news');
		$facility_name_array=Facilities::get_facility_name($facility_code)->toArray();
		$facility_name=$facility_name_array['facility_name'];
		
		if ($display_type == "Download PDF") {
			
			/********************************************setting the report title*********************/
			
		$html_title="<img src='".base_url()."Images/coat_of_arms.png' style='position:absolute;  width:160px; width:160px; top:0px; left:0px; margin-bottom:-100px;margin-right:-100px;'></img>
       <h2 style='text-align:center;'>".$r_name."</h2><br><br>
       <span style=' margin-left:500px; text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>
       Public Health and Sanitation/Ministry of Medical Services</span><br>
        <span style='display: block; font-size: 12px;'>Health Commodities Management Platform</span><span style='text-align:center;' ><hr /> 
        <span><p style='font-weight: bold;'>MFL CODE: ".$facility_code."</p><p style='font-weight: bold;'> FACILITY NAME: ".$facility_name."</p>
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
		<span style="display: block; font-weight: bold; font-size: 14px; margin:2px;">Public Health and Sanitation/Ministry of Medical Services</span>
		<span style="display: block; font-size: 12px;">Health Commodities Management Platform</span>
		</div>
		</div>
		<span style="display: block; font-size: 12px;">Health Commodities Management Platform</span><span style="text-align:center;" ><hr /> 
        <span><p style="font-weight: bold;">MFL CODE: '.$facility_code.'</p><p style="font-weight: bold;"> FACILITY NAME: '.$facility_name.'</p>';
		
            echo $html_title.$data;
        }
		
	}


}

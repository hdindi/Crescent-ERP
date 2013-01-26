<?php
class Transportchart extends CI_Controller{
	
	function Transportchart(){
		parent::__construct();
		$this -> load -> helper('fusioncharts');
		//$this->load->view('fussioncharts_view');
        $pie_chart=array();

	}
	public function index(){

		$this->view();
	}

	public function view(){
		$strDataURL = base_url() . "transportchart/ViewResults/";
		$piedataURL = base_url(). "transportchart/piechartviews";
$column_chart = Fusioncharts(base_url() . "Scripts/FusionCharts/MSColumn3D.swf", $strDataURL, "", "COLUMN_POLL_RESULTS", 800, 600, false, false,false);
$pie_chart = Fusioncharts(base_url() . "Scripts/FusionCharts/Pie2D.swf", $strDataURL, "", "PIE_POLL_RESULTS", 500, 500, false, false,false);

$data['pie_graph'] = $pie_chart;
$data['column_graph'] = $column_chart;

		$this ->load -> view('transportcharts_v', $data);
		
		
		/*$strDataURL = base_url() . "dailycharts/ViewResults/" . $poll_id;
		$pie_chart = Fusioncharts(base_url() . "Scripts/FusionCharts/Pie3D.swf", $strDataURL, "", "PIE_POLL_RESULTS", 800, 300, false, false);
		$bar_chart = Fusioncharts(base_url() . "Scripts/FusionCharts/Bar2D.swf", $strDataURL, "", "BAR_POLL_RESULTS", 800, 300, false, false);
		$column_chart = Fusioncharts(base_url() . "Scripts/FusionCharts/Column3D.swf", $strDataURL, "", "COLUMN_POLL_RESULTS", 800, 300, false, false);
		$data['pie_graph'] = $pie_chart;
		$data['bar_graph'] = $bar_chart;
		$data['column_graph'] = $column_chart;*/
	
	}
	


	public function ViewResults() {
		$strXML = "<chart caption='VEHICLE TONNAGE DELIVERY PER MONTH'  pieSliceDepth='30' showBorder='0' formatNumberScale='0' showValues='1' showPercentageInLabel='1'  showPercentageValues='1' numberSuffix=' Tonnage'>";
		$this -> load -> database();
		$first_query = $this -> db -> query("SELECT DISTINCT  vehiclemonthlytonnage.month AS Category
FROM vehiclemonthlytonnage, tractor
WHERE tractor.id = vehiclemonthlytonnage.vehicleid ");
		$first_results = $first_query -> result_array();
		$strXML .="<categories>";
		foreach($first_results as $first_result ){
			
			$strXML .= "<category label='" . $first_result['Category'] . "'/>";
			
			
		}
		$strXML .="</categories>";

       $second_query = $this -> db -> query("SELECT DISTINCT  tractor.registrationnumber AS Semi_Category
FROM tractor, vehiclemonthlytonnage WHERE tractor.id = vehiclemonthlytonnage.vehicleid ");
$second_results = $second_query -> result_array();

		foreach($second_results as $second_result ){
		
		$strXML .="<dataset seriesName='".$second_result['Semi_Category']."'  showValues='0'>";
			$third_query = $this -> db -> query("SELECT vehiclemonthlytonnage.tonnes AS Semi_Category_value
FROM tractor, vehiclemonthlytonnage WHERE tractor.id = vehiclemonthlytonnage.vehicleid  and tractor.registrationnumber='" .$second_result['Semi_Category'] . "' ");
$third_results = $third_query -> result_array();
foreach($third_results as $third_result){
$strXML .= "<set value='".$third_result['Semi_Category_value'] ."'/>";	
}

			
$strXML .="</dataset>";	
		}

			$strXML .= "</chart>";

			header('Content-type: text/xml');
			echo $strXML;
		}
		//public function 

	}


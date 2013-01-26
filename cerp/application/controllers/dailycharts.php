<?php
class Dailycharts extends CI_Controller{
	
	function Dailycharts(){
		parent::__construct();
		$this -> load -> helper('fusioncharts');
		//$this->load->view('fussioncharts_view');
        $pie_chart=array();

	}
	public function index(){

		$this->view();
	}

	public function view(){
		$strDataURL = base_url() . "dailycharts/ViewResults/";
		$piedataURL = base_url(). "dailycharts/piechartviews";
$column_chart = Fusioncharts(base_url() . "Scripts/FusionCharts/MSColumn3D.swf", $strDataURL, "", "COLUMN_POLL_RESULTS", 500, 500, false, false,false);
$pie_chart = Fusioncharts(base_url() . "Scripts/FusionCharts/Line.swf", $piedataURL, "", "PIE_POLL_RESULTS", 500, 500, false, false,false);

$data['pie_graph'] = $pie_chart;
$data['column_graph'] = $column_chart;

		$this ->load -> view('dailyrevenuecharts_v', $data);
		
		
		/*$strDataURL = base_url() . "dailycharts/ViewResults/" . $poll_id;
		$pie_chart = Fusioncharts(base_url() . "Scripts/FusionCharts/Pie3D.swf", $strDataURL, "", "PIE_POLL_RESULTS", 800, 300, false, false);
		$bar_chart = Fusioncharts(base_url() . "Scripts/FusionCharts/Bar2D.swf", $strDataURL, "", "BAR_POLL_RESULTS", 800, 300, false, false);
		$column_chart = Fusioncharts(base_url() . "Scripts/FusionCharts/Column3D.swf", $strDataURL, "", "COLUMN_POLL_RESULTS", 800, 300, false, false);
		$data['pie_graph'] = $pie_chart;
		$data['bar_graph'] = $bar_chart;
		$data['column_graph'] = $column_chart;*/
	
	}
	


	public function ViewResults() {
		$strXML = "<chart caption='Number of Tonnage Delivered per 15 Day Period'  pieSliceDepth='30' showBorder='0' formatNumberScale='0' showValues='1' showPercentageInLabel='1'  showPercentageValues='1' numberSuffix=' Tonnage'>";
		$this -> load -> database();
		$first_query = $this -> db -> query("SELECT DISTINCT  tonnage.date AS Category
FROM zone, tonnage
WHERE zone.id = tonnage.zoneid ");
		$first_results = $first_query -> result_array();
		$strXML .="<categories>";
		foreach($first_results as $first_result ){
			
			$strXML .= "<category label='" . $first_result['Category'] . "'/>";
			
			
		}
		$strXML .="</categories>";

       $second_query = $this -> db -> query("SELECT DISTINCT  zone.zonename AS Semi_Category
FROM zone, tonnage WHERE zone.id = tonnage.zoneid ");
$second_results = $second_query -> result_array();

		foreach($second_results as $second_result ){
		
		$strXML .="<dataset seriesName='".$second_result['Semi_Category']."'  showValues='0'>";
			$third_query = $this -> db -> query("SELECT tonnage.tonnes AS Semi_Category_value
FROM zone, tonnage WHERE zone.id = tonnage.zoneid  and zone.zonename='" .$second_result['Semi_Category'] . "' ");
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
		
		
		
		
		
		
		
		
			public function piechartviews() {
		$strXML = "<chart caption='Number of Acres per Farms'  pieSliceDepth='30' showBorder='0' formatNumberScale='0' showValues='1' showPercentageInLabel='1'  showPercentageValues='1' numberSuffix=' Acres'>";
		$this -> load -> database();
		$first_query = $this -> db -> query("SELECT * from transportrevenue");
		$first_results = $first_query -> result_array();
		if ($first_results) {
			$i = 0;
			foreach ($first_results as $first_result) {

				$second_query = $this -> db -> query("select cummulativeamount as Tally from transportrevenue where cummulativeamount >= '1' and id='".$first_result['id']."'");
				$second_results = $second_query -> result_array();
				//echo($second_query);

				foreach ($second_results as $second_result) {

					if ($second_results) {
						$strXML .= "<set label='" . $first_result['id'] . "' value='" . $second_result['Tally'] . "' />";
					}
					if (!$second_results) {
						echo "No of Acres for " . $first_result['plotnumber//'] . "<br/>";
					}
				}
				//mysql_free_result($second_results);
			}
			$strXML .= "</chart>";

			header('Content-type: text/xml');
			echo $strXML;
		}

	}

	}


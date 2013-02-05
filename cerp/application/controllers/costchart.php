<?php
error_reporting(0);
class Costchart extends CI_Controller{
	
	function Fusioncharts(){
		parent::__construct();
		$this -> load -> helper('fusioncharts');
		//$this->load->view('fussioncharts_view');
        $pie_chart=array();

	}
	public function index(){

		$this->view();
	}

	public function view(){
		$strDataURL = base_url() . "fusioncharts/ViewResults/";
$pie_chart['pie_charts'] = Fusioncharts(base_url() . "Scripts/FusionCharts/Line.swf", $strDataURL, "", "PIE_POLL_RESULTS", 1000, 800, false, false,false);


		$this ->load -> view('chartsview', $pie_chart);
	
	}
	/*public function getdata(){
		$this->load->database();

		//Generate the chart element
   $strXML = "<chart caption='Factory Output report' subCaption='By Quantity' pieSliceDepth='30' showBorder='1' formatNumberScale='0' numberSuffix=' Units' animation=' " . $animateChart . "'>";
   //Fetch all factory records
   $query = $this ->db -> query('select * from farm');
   $results = $query -> result_array();
   //'Iterate through each factory
   if ($result) {
      while($ors = mysql_fetch_array($result)) {
      	//Now create a second query to get details for this factory
      	$query2 = $this -> db -> query( 'select plotnumber as TotOutput from farm where id=' . $ors['id']);
      	$ors2 = mysql_fetch_array($query2);
      	//Generate <set label='..' value='..' />
         $strXML .= "<set label='" . $ors['farmname'] . "' value='" . $ors2['TotOutput'] . "' />";
         //free the resultset
         mysql_free_result($result2);
      }

    //Finally, close <chart> element
   $strXML .= "</chart>";

   //Set Proper output content-type
   header('Content-type: text/xml');

   //Just write out the XML data
   //NOTE THAT THIS PAGE DOESN'T CONTAIN ANY HTML TAG, WHATSOEVER
   echo $strXML;
			}
	}*/


	public function ViewResults() {
		$strXML = "<chart caption='Costs incurred per year'  pieSliceDepth='30' showBorder='0' formatNumberScale='0' showValues='1' showPercentageInLabel='1'  showPercentageValues='1' numberSuffix=' Acres'>";
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
						$strXML .= "<set label='" . $first_result['plotnumber'] . "' value='" . $second_result['Tally'] . "' />";
					}
					if (!$second_results) {
						echo "No of Acres for " . $first_result['plotnumber//'] . "<br/>";
					}
				}
				//mysql_free_result($second_results);
			}
			$strXML .= "</chart>";

			//header('Content-type: text/xml');
			echo $strXML;
		}

	}

}
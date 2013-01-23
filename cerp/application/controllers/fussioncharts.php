<?php
class Fusioncharts extends CI_Controller{
	
	function Fusioncharts(){
		parent::__construct();
		$this -> load -> helper('fusioncharts');
		$this->load->view('fussioncharts_view');

	//parent::Controller();

	}

	function get_All(){

	
	//$this->load->model('books_model');

	//$data['query']=
	$this->farm_getall();
	

	$this->load->view('fussioncharts_view',$data);	
	}

	function farm_getall(){

	$this->load->database();

	$query = $this->db->get('farm');

	return $query->result();
	}
	public function view(){
		$pie_chart['pie_charts'] = Fusioncharts(base_url() . "Scripts/FusionCharts/Pie3D.swf", $strXML->getdata(), "", "PIE_POLL_RESULTS", 800, 300, false, false);

		$this ->load -> view('fussioncharts_view', $pie_chart);
	
	}

	public function getdata(){
		$this->load->database();
		$query = $this->db->get('farm');
		//$strXML will be used to store the entire XML document generated
   //Generate the chart element
   $strXML = "<chart caption='Factory Output report' subCaption='By Quantity' pieSliceDepth='30' showBorder='1' formatNumberScale='0' numberSuffix=' Units' animation=' " . $animateChart . "'>";

   //Fetch all factory records
   $query = $this ->db -> query('select * from farm');
   $results = $query -> result_array();
   //$strQuery = "select * from farm";
   //$result = mysql_query($query) or die(mysql_error());

   //'Iterate through each factory
   if ($result) {
      while($ors = mysql_fetch_array($result)) {
         //Now create a second query to get details for this factory
      	$query2 = $this -> db -> query( 'select plotnumber as TotOutput from farm where id=' . $ors['id']);
         //$strQuery = "select plotnumber as TotOutput from farm where id=" . $ors['id']
         //$result2 = mysql_query($strQuery) or die(mysql_error());
         $ors2 = mysql_fetch_array($query2);
         //Generate <set label='..' value='..' />
         $strXML .= "<set label='" . $ors['farmname'] . "' value='" . $ors2['TotOutput'] . "' />";
         //free the resultset
         mysql_free_result($result2);
      }
   }
   mysql_close($link);

   //Finally, close <chart> element
   $strXML .= "</chart>";

   //Set Proper output content-type
   header('Content-type: text/xml');

   //Just write out the XML data
   //NOTE THAT THIS PAGE DOESN'T CONTAIN ANY HTML TAG, WHATSOEVER
   echo $strXML;
	}



}
?>
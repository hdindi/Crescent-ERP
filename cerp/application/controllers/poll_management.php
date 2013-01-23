<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Poll_Management extends MY_Controller {
	function __construct() {
		parent::__construct();
		$data = array();
		$this -> load -> library('AfricasTalkingGateway');
		$this -> load -> library('PHPExcel');
		$this -> load -> helper('fusioncharts');
	}

	public function index() {
		$data['polls'] = $this -> getPolls();
		$this -> load -> view("Poll_Home", $data);

	}
	
	public function admin() {
		$this->load->view("Poll_Admin");
	}

	public function create() {

		$poll_type = $_POST['poll_type'];
		$poll_question = $_POST['poll_question'];
		$user_id = $this -> session -> userdata['user_id'];

		//array containing choices
		$poll_choices = $_POST['multiple_choice'];

		//array containing categories
		$poll_categories = $_POST['category'];

		//choice_id counter
		$choice_id = 1;

		//category_id counter
		$category_id = 1;

		$message = "";

		
		//check values of arrays
		$category_length = sizeof($poll_categories) - 1;
		$choices_length = sizeof($poll_choices) - 1;

		

		if ($category_length == 0 && $choices_length == 0) {

			$this -> session -> set_userdata('create_poll', "2");
			redirect("poll_management/index");

		}

		//Runs if poll is multiple choice
		if ($choices_length != 0) {

			$last_poll_id = Polls::createPoll($poll_question, $poll_type, $user_id);

			foreach ($last_poll_id as $last_poll) {

			}
			$poll_id = $last_poll['id'];
			//Last Poll_Id
            foreach ($poll_choices as $poll_choice) {
				Multiple_Choice::saveChoices($poll_id, $choice_id, $poll_choice);
				$choice_id++;
			}
			
			$this -> session -> set_userdata('create_poll', "1");
			redirect("poll_management/index");

		}
		if ($category_length != 0) {

			$last_poll_id = Polls::createPoll($poll_question, $poll_type, $user_id);

			foreach ($last_poll_id as $last_poll) {

			}
			$poll_id = $last_poll['id'];
			//Last Poll_Id
			
			foreach ($poll_categories as $poll_category) {
				Open_Ended::saveCategories($poll_id, $category_id, $poll_category);
				$category_id++;
			}

			$this -> session -> set_userdata('create_poll', "1");
			redirect("poll_management/index");

		}

	}

	public function getPolls() {
		$user_id = $this -> session -> userdata['user_id'];
		$this -> load -> database();
		$query = $this -> db -> query("SELECT a.id AS id,a.question AS question,b.type AS type,a.valid as valid FROM POLLS a,POLL_TYPE b WHERE a.question_type=b.id AND a.user_id='$user_id'");
		$results=$query -> result_array();
		if(!$results){
		$new_query = $this -> db -> query("SELECT a.id AS id,a.question AS question,b.type AS type,a.valid as valid FROM POLLS a,POLL_TYPE b WHERE a.question_type=b.id AND a.id='1'");
		return $new_query -> result_array();	
		}else{
		return $query -> result_array();	
		}
		
		

	}

	public function ViewResults($poll_id) {
		$strXML = "<chart caption='Poll Results'  pieSliceDepth='30' showBorder='0' formatNumberScale='0' showValues='1' showPercentageInLabel='1'  showPercentageValues='1' numberSuffix=' Votes'>";
		$this -> load -> database();
		$first_query = $this -> db -> query("SELECT IF( a.question_type =1, b.category_name, c.choice_name ) AS Choice, IF( a.question_type =1, b.category_id, c.choice_id ) AS poll_choice FROM polls a, open_ended b, multiple_choice c WHERE a.id ='$poll_id' AND ( a.id = b.poll_id OR a.id = c.poll_id )GROUP BY Choice");
		$first_results = $first_query -> result_array();
		if ($first_results) {
			$i = 0;
			foreach ($first_results as $first_result) {

				$second_query = $this -> db -> query("select count(poll_choice) as Tally from poll_results where poll_choice='" . $first_result['poll_choice'] . "' and poll_id='$poll_id'");
				$second_results = $second_query -> result_array();

				foreach ($second_results as $second_result) {

					if ($second_results) {
						$strXML .= "<set label='" . $first_result['Choice'] . "' value='" . $second_result['Tally'] . "' />";
					}
					if (!$second_results) {
						echo "No Votes for " . $first_result['Choice'] . "<br/>";
					}
				}
				mysql_free_result($second_results);
			}
			$strXML .= "</chart>";
			header('Content-type: text/xml');
			echo $strXML;
		}

	}

	public function stop($poll_id) {
		Polls::stopPoll($poll_id);
		$this -> session -> set_userdata('create_poll', "5");
		redirect("poll_management/index");

	}

	public function start($poll_id) {
		
		Polls::startPoll($poll_id);
		$this -> load -> database();
		$query = $this -> db -> query("SELECT IF( a.question_type =1, c.category_name, d.choice_name ) AS Choice, IF( a.question_type =1, c.category_id, d.choice_id ) AS poll_choice, a.question AS Question, b.type AS Question_Type FROM polls a, poll_type b, open_ended c, multiple_choice d WHERE a.id ='$poll_id' AND ( a.id = c.poll_id OR a.id = d.poll_id) GROUP BY IF( a.question_type =1, c.category_id, d.choice_id )");
		$results = $query -> result_array();
		$the_message = "";
		$the_message .= "Poll_id: " . $poll_id . " Question:" . $results[0]['Question'] . "\n";
		$the_message .= "Choices";
		foreach ($results as $result) {
			$data[] = $result;

			$the_message .= " \n " . $result['poll_choice'] . "." . $result['Choice'];

		}
		if ($results[0]['Question_Type'] == "Open_Ended") {
			$the_message .= "\n Simply Reply to this message with poll_id#category_no#answer e.g " . $poll_id . "#1#myreponse \n SMS are charged at KES 1 only.";
		} else {
			$the_message .= "\n Simply Reply to this message with poll_id#choice_no e.g " . $poll_id . "#1 \n SMS are charged at KES 1 only.";
		}
		 $the_message;
		//The message

		//Retrieve Participants Phone Numbers
		$participants_phones = Participants::getALLPhones();
		$sms_list = "";
		$system_message="";
		$i = 0;
		$j = 1;
		foreach ($participants_phones as $participants_phone) {
			if ($j != sizeof($participants_phones)) {
				$sms_list .= $participants_phone['phone'] . ",";
				$j++;
			} else if ($j > sizeof($participants_phones) - 1) {

				$sms_list .= $participants_phone['phone'];
			}
			$i++;

		}
		//This is the sms list
		$sms_list;
        // Specify your login credentials
		$username = "KevinMorez";
		$apiKey = "98adcd146040e2ef14ffac50d9e1ddeba22c30a332b857d8740f391e5ef0e2ae";

		// Create a new instance of our awesome gateway class
		$gateway = new AfricaStalkingGateway($username, $apiKey);
		$sms_results = $gateway -> sendMessage($sms_list, $the_message);

		if (count(@$sms_results)) {
			// These are the results if the request is well formed
			foreach ($sms_results as $result) {
				$system_message .= " Number: " . $result -> number;
				$system_message .= " Status: " . $result -> status;
				$system_message .= " Cost: " . $result -> cost . "<br/>";
			}
		} else {

			$system_message .= "Oops, No messages were sent. ErrorMessage: " . $gateway -> getErrorMessage();
		}

		 $system_message; 
        $this -> session -> set_userdata('create_poll', "4");
		redirect("poll_management/index");

	}

	public function getResponse() {
		$sessionId = @$_POST["sessionId"];
		$serviceCode = @$_POST["serviceCode"];
		$phoneNumber = @$_POST["phoneNumber"];
		$text = @$_POST["text"];
		if ($text == "") {
			// This is the first request. Note how we start the response with CON
			$response = "Welcome to Poll Kenya \n";
			header('Content-type: text/plain');
			echo @$response;
		} else if ($text != " ") {
			$poll_id = strtok($text, " #");
			$poll_choice = strtok('#');
			@$poll_answer = strtok('#');
			$poll_valid = Polls::checkValid($poll_id);
			if ($poll_valid) {
				$valid = Participants::checkValid($phoneNumber);
				if ($valid) {
					$vote_valid = Poll_Results::checkVote($poll_id, $phone);
					if ($vote_valid) {
						Poll_Results::saveResult($phoneNumber, $poll_id, $poll_choice, $poll_answer);
					} else {
						$response = "Hello you have already Voted\n";
						header('Content-type: text/plain');
						echo @$response;

					}
				} else {
					$response = "Hello you are not allowed to participate\n";
					header('Content-type: text/plain');
					echo @$response;

				}
			} else {
				$response = "Hello Poll is Closed\n";
				header('Content-type: text/plain');
				echo @$response;

			}

		}
	}

	public function resend($poll_id) {
		

		$this -> load -> database();
		$query = $this -> db -> query("SELECT IF( a.question_type =1, c.category_name, d.choice_name ) AS Choice, IF( a.question_type =1, c.category_id, d.choice_id ) AS poll_choice, a.question AS Question, b.type AS Question_Type FROM polls a, poll_type b, open_ended c, multiple_choice d WHERE a.id ='$poll_id' AND ( a.id = c.poll_id OR a.id = d.poll_id) GROUP BY IF( a.question_type =1, c.category_id, d.choice_id )");
		$results = $query -> result_array();
		$the_message = "";
		$the_message .= "Poll_id: " . $poll_id . " Question:" . $results[0]['Question'] . "\n";
		$the_message .= "Choices";
		foreach ($results as $result) {
			$data[] = $result;

			$the_message .= " \n " . $result['poll_choice'] . "." . $result['Choice'];

		}
		if ($results[0]['Question_Type'] == "Open_Ended") {
			$the_message .= "\n Simply Reply to this message with poll_id#category_no#answer e.g " . $poll_id . "#1#myreponse \n SMS are charged at KES 1 only.";
		} else {
			$the_message .= "\n Simply Reply to this message with poll_id#choice_no e.g " . $poll_id . "#1 \n SMS are charged at KES 1 only.";
		}
		$the_message;
		//The message

		//Retrieve Participants Phone Numbers
		$participants_phones = Participants::getALLPhones();
		$sms_list = "";
		$system_message="";
		$i = 0;
		$j = 1;
		foreach ($participants_phones as $participants_phone) {
			if ($j != sizeof($participants_phones)) {
				$sms_list .= $participants_phone['phone'] . ",";
				$j++;
			} else if ($j > sizeof($participants_phones) - 1) {

				$sms_list .= $participants_phone['phone'];
			}
			$i++;

		}
		//This is the sms list
		$sms_list;
        // Specify your login credentials
		$username = "KevinMorez";
		$apiKey = "98adcd146040e2ef14ffac50d9e1ddeba22c30a332b857d8740f391e5ef0e2ae";

		// Create a new instance of our awesome gateway class
		$gateway = new AfricaStalkingGateway($username, $apiKey);
		$sms_results = $gateway -> sendMessage($sms_list, $the_message);

		if (count(@$sms_results)) {
			// These are the results if the request is well formed
			foreach ($sms_results as $result) {
				$system_message .= " Number: " . $result -> number;
				$system_message .= " Status: " . $result -> status;
				$system_message .= " Cost: " . $result -> cost . "<br/>";
			}
		} else {

			$system_message .= "Oops, No messages were sent. ErrorMessage: " . $gateway -> getErrorMessage();
		}

		 $system_message; 
		$this -> session -> set_userdata('create_poll', "3");
		redirect("poll_management/index");

	}

	public function view($poll_id) {
		$this -> load -> database();
		$data['poll_id'] = $poll_id;
		$strDataURL = base_url() . "poll_management/ViewResults/" . $poll_id;
		$pie_chart = Fusioncharts(base_url() . "resources/scripts/FusionCharts/Pie3D.swf", $strDataURL, "", "PIE_POLL_RESULTS", 800, 300, false, false);
		$bar_chart = Fusioncharts(base_url() . "resources/scripts/FusionCharts/Bar2D.swf", $strDataURL, "", "BAR_POLL_RESULTS", 800, 300, false, false);
		$column_chart = Fusioncharts(base_url() . "resources/scripts/FusionCharts/Column3D.swf", $strDataURL, "", "COLUMN_POLL_RESULTS", 800, 300, false, false);
		$data['pie_graph'] = $pie_chart;
		$data['bar_graph'] = $bar_chart;
		$data['column_graph'] = $column_chart;

		$query = $this -> db -> query("SELECT IF( a.question_type =1, c.category_name, d.choice_name ) AS Choice, IF( a.question_type =1, c.category_id, d.choice_id ) AS poll_choice, a.question AS Question, b.type AS Question_Type FROM polls a, poll_type b, open_ended c, multiple_choice d WHERE a.id ='$poll_id' AND ( a.id = c.poll_id OR a.id = d.poll_id) GROUP BY IF( a.question_type =1, c.category_id, d.choice_id )");
		$results = $query -> result_array();
		$the_message = "";
		$the_message .= "<b>Question :</b>" . $results[0]['Question'] . "<br/>";
		$the_message .= "<b>Choices</b>";
		foreach ($results as $result) {
			$data[] = $result;

			$the_message .= " <br/> " . $result['poll_choice'] . ".&nbsp;" . $result['Choice'];

		}
		$data['the_message'] = $the_message;
		$this -> load -> view('Poll_Results', $data);

	}

	public function viewChart($poll_id, $chart_id) {

		$data['poll_id'] = $poll_id;
		$strDataURL = base_url() . "poll_management/ViewResults/" . $poll_id;
		$pie_chart = Fusioncharts(base_url() . "resources/scripts/FusionCharts/Pie3D.swf", $strDataURL, "", "PIE_POLL_RESULTS", 800, 300, false, false);
		$bar_chart = Fusioncharts(base_url() . "resources/scripts/FusionCharts/Bar2D.swf", $strDataURL, "", "BAR_POLL_RESULTS", 800, 300, false, false);
		$column_chart = Fusioncharts(base_url() . "resources/scripts/FusionCharts/Column3D.swf", $strDataURL, "", "COLUMN_POLL_RESULTS", 800, 300, false, false);

		if ($chart_id == 1) {
			$data['pie_graph'] = $pie_chart;
			$this -> load -> view('Poll_View', $data);
		}

		if ($chart_id == 2) {
			$data['bar_graph'] = $bar_chart;
			$this -> load -> view('Poll_View', $data);
		}

		if ($chart_id == 3) {
			$data['column_graph'] = $column_chart;
			$this -> load -> view('Poll_View', $data);
		}

	}

	public function exportResults($poll_id) {

		$this -> load -> database();
		$query = $this -> db -> query("
		SELECT b.question AS Question, a.phone AS Voter_Phone, IF( b.question_type =1, c.category_name, d.choice_name ) AS Choice, IF( a.phone = e.phone, e.name, 'N/A' ) AS Voter_Name, g.type AS Question_Type FROM poll_results a, polls b, open_ended c, multiple_choice d, participants e, poll_type g WHERE a.poll_id = b.id AND IF( b.question_type =1, b.id = c.poll_id, b.id = d.poll_id )AND a.phone = e.phone AND b.question_type = g.id AND a.poll_id ='$poll_id' AND IF( b.question_type =1, a.poll_choice = c.category_id, a.poll_choice = d.choice_id ) GROUP BY a.id");
		$results = $query -> result_array();

		$objPHPExcel = new PHPExcel();
		$objPHPExcel -> setActiveSheetIndex(0);
		$i = 1;
		foreach ($results as $result) {

			$objPHPExcel -> getActiveSheet() -> SetCellValue('A' . $i, $result["Question"]);
			$objPHPExcel -> getActiveSheet() -> SetCellValue('B' . $i, $result["Question_Type"]);
			$objPHPExcel -> getActiveSheet() -> SetCellValue('C' . $i, $result["Choice"]);
			$objPHPExcel -> getActiveSheet() -> SetCellValue('D' . $i, $result["Voter_Name"]);
			$objPHPExcel -> getActiveSheet() -> SetCellValue('E' . $i, $result["Voter_Phone"]);

			$i++;
		}

		ob_end_clean();
		$filename = "Report of poll " . $poll_id . ".xlsx";
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename=' . $filename);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		ob_end_clean();

		$objWriter -> save('php://output');

		$objPHPExcel -> disconnectWorksheets();
		unset($objPHPExcel);

		redirect("poll_management/view/" . $poll_id);

	}

}

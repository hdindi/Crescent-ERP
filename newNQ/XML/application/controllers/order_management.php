<?php
class Order_Management extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
	}

	public function index() {
		$this -> listing();
	}
	public function new_order($note=NULL) {
		if(isset($note)){
	    $facility_c=$this -> session -> userdata('news');
        $data['title'] = "New Order";
		$data['content_view'] = "new_order_v";
		$data['banner_text'] = "New Order";
		$data['link'] = "order_management";
		$data['drug_name']=Drug::get_drug_name();
		$data['facility_order'] = Facility_Transaction_Table::get_all($facility_c);
		$data['quick_link'] = "new_order";
		$this -> load -> view("template", $data);
		}
		else{
			$msg="Please confirm your stock details before placing your order";
			$this->stock_level($msg);
		}
	}
	//update the facility transaction table after a physical count.
	public function update_facility_transaction($msg=NULL){
		//setting up the variables
	    $id=$_POST['kemsaCode'];
		$open=$_POST['open'];
		$recepits=$_POST['receipts'];
		$issues=$_POST['issues'];
		$adjustments=$_POST['adjustments'];
		$losses=$_POST['losses'];
		$closing=$_POST['closing'];
		$nodays=$_POST['days'];
		$option=$_POST['option'];
		

		$j=count($id);
		//updating the facility transaction table automatically 
		for($i=0;$i<$j;$i++){
        $myobj = Doctrine::getTable('Facility_Transaction_Table')->find($id[$i]);
        $myobj->Opening_Balance =$open[$i];
        $myobj->Total_Receipts =$recepits[$i];
        $myobj->Total_Issues =$issues[$i];
		$myobj->Adj =$adjustments[$i];
		$myobj->Losses =$losses[$i];
        $myobj->Closing_Stock =$closing[$i];
        $myobj->Days_Out_Of_Stock =$nodays[$i];
        $myobj->save();
		}
		if($option=='place_order'){
		$note=TRUE;
        $this->new_order($note);	
		}
		else{
			$this->stock_level("Stock details have been updated");
		}
				
	}
	public function stock_level($msg=Null){
	    $facility_c=$this -> session -> userdata('news');
		$data['title'] = "Stock";
		$data['content_view'] = "facility/stock_level_v";
		$data['banner_text'] = "Stocks";
		$data['link'] = "order_management";
		if(isset($msg)){
			$data['msg']=$msg;
		}
		$data['facility_order'] = Facility_Transaction_Table::get_all($facility_c);
		$data['quick_link'] = "stock_level";
		$this -> load -> view("template", $data);
	}
	public function new_order2() {
		$data['title'] = "New Order";
		$data['content_view'] = "new_order_v2";
		$data['banner_text'] = "New Order";
		$data['link'] = "order_management";
		$data['drug_categories'] = Drug_Category::getAll();
		$data['quick_link'] = "new_order";
		$this -> load -> view("template", $data);
	}

   
   
		
	
public function order_now(){
     	
		$data['title'] = "New Order";
		$data['content_view'] = "new_order_v2";
		$data['banner_text'] = "New Order";
		$data['link'] = "order_management";
		$data['drug_categories'] = Drug_Category::getAll();
		$data['quick_link'] = "new_order";
		$this -> load -> view("template", $data);
			    
}

//kemsa orders
public function kemsa_order_v(){
	    $checker=$this->uri->segment(3);
		
			switch ($checker)
			{
				case 'pending':
					$data['order_list']=Ordertbl::get_pending_orders();
					break;
					case 'approved':
						$data['order_list']=Ordertbl::get_approved_orders();
					break;
						case 'dispatched':
						$data['order_list']=Ordertbl::get_dispatched_orders();
						break;
							case 'delivered':
							$data['order_list']=Ordertbl::get_delivered_orders();
							break;
								default :
								$data['order_list']=Ordertbl::get_all_orders_moh();				
			}
					
		$data['title'] = "Order View";
     	$data['content_view'] = "kemsa/kemsa_order_v";
		$data['banner_text'] = "Order View";
		$data['link'] = "home";
		$data['counties'] = Counties::getAll();
		$data['myClass'] = $this;
		$data['quick_link'] = "kemsa_order_v";
		$this -> load -> view("template", $data);
		
	}
/***********************************8temp dispatch ***************************/
public function kemsa_approve_order(){

	$this->load->helper('string');
	$delivery=$this->uri->segment(3);
	
	$order_details_array=Orderdetails::get_order($delivery);
	$count=1;
	
	$code=random_string('alnum', 6);
	$code2=random_string('alnum', 6);
	$date=date("y-m-d");
	$kemsa_order_input=array("kemsa_order_no"=>$code,"local_order_no"=>$delivery,"order_batch_no"=>$code2,"order_total"=>'50000',"facility_mfl_code"=>'17948',"dispatch_date"=>$date,"recieve_date"=>date($date,strtotime('+2 weeks')),"order_date"=>$date);
	
	    $u1 = new Kemsa_Order();
    	$u1->fromArray($kemsa_order_input);
    	$u1->save();
	
	foreach($order_details_array as $data){
	$input_array=array("kemsa_code"=>$data->kemsa_code,"kemsa_order_no"=>$code,"batch_no"=>'AB'.$count,"quantity"=>$data->quantityOrdered,"expiry_date"=>'2013-10-15',"manufacture"=>'GlaxoSmithkline');
       
	    $u = new Kemsa_Order_Details();
    	$u->fromArray($input_array);
    	$u->save();
    	
         $count++;	
}
}
	public function listing() {
		 $facility_c=$this -> session -> userdata('news');
		// echo $facility_c;
		$data['myClass'] = $this;
		$data['pending'] = Ordertbl::getPending($facility_c);
		$data['dispatched'] = Ordertbl::getDispatched($facility_c);
		$data['received']=Ordertbl::get_received($facility_c);
		$data['title'] = "All Orders";
		$data['quick_link'] = "order_listing";
		$data['content_view'] = "orders_listing_v";
		$data['banner_text'] = "All Orders";
		$data['link'] = "order_management"; 
		$this -> load -> view("template", $data);
	}
	public function drug_issue(){
		$data['title'] = "New Drug Issue";
		$data['content_view'] = "new_issue_v";
		$data['banner_text'] = "New Drug Issue";
		$data['link'] = "order_management";
		$data['drug_categories'] = Drug_Category::getAll();
		$data['quick_link'] = "drug_issue";
		$this -> load -> view("template", $data);
	}
	public function getDistrict(){
		//for ajax
		$county=$_POST['county'];
		$districts=Districts::getDistrict($county);
		$list="";
		foreach ($districts as $districts) {
			$list.=$districts->id;
			$list.="*";
			$list.=$districts->district;
			$list.="_";
		}
		echo $list;
	}
	public function getFacilities(){
		//for ajax
		$district=$_POST['district'];
		$facilities=Facilities::getFacilities($district);
		$list="";
		foreach ($facilities as $facilities) {
			$list.=$facilities->facility_code;
			$list.="*";
			$list.=$facilities->facility_name;
			$list.="_";
		}
		echo $list;
	}
	public function getHFacilities(){
		//for ajax
		$district=$_POST['district'];
		$facilities=Facilities::getFacilities($district);
		$list="";
		foreach ($facilities as $facilities) {
			$list.=$facilities->facility_code;
			$list.="*";
			$list.=$facilities->facility_name;
			$list.="_";
		}
		echo $list;
	}
	public function getAllFacilities(){
		$facilities=Facilities::getAll();
		$list="";
		foreach ($facilities as $facilities) {
			$list.=$facilities->id;
			$list.="*";
			$list.=$facilities->facility_name;
			$list.="_";
		}
		echo $list;
		
	}
	
	 public function getBatch(){
		//for ajax
		$desc=$_POST['desc'];
		$describe=Facility_Stock::getAll($desc);
		$list="";
		foreach ($describe as $describe) {
			$list.=$describe->kemsa_code;
			$list.="*";
			$list.=$describe->batch_no;
			$list.="*";
			$list.=$describe->expiry_date;
			$list.="*";
			$list.=$describe->balance;
			$list.="*";
			$list.=$describe->status;
			$list.="_";
		}
		echo $list;
		
	}
	public function potentialExpiries(){  //New
	 $facility_c=$this -> session -> userdata('news');
     $data['title'] = "Stock";
    $data['content_view'] = "potentialExp";
     $data['banner_text'] = "Potential Expiries";
     $data['link'] = "order_management";
$data['stocks']=Facility_Stock::expiries($facility_c);
//$data['tester']=Drug::getSome();
$data['quick_link'] = "stock_view";
$this -> load -> view("template", $data);
}
	public function unconfirmed(){
		$data['title'] = "Unconfirmed Orders";
     	$data['content_view'] = "moh/unconfirmed_orders_v";
		$data['banner_text'] = "Unconfirmed Orders";
		$data['link'] = "home";
		$data['counties'] = Counties::getAll();
		$data['myClass'] = $this;
		$data['quick_link'] = "unconfirmed_orders";
		$data['order_list']=Ordertbl::getUnconfirmed();
		$this -> load -> view("template", $data);
	}
	public function makeOrder(){
		
		$ids=$_POST['kemsaCode'];
		$price=$_POST['price'];
		$open=$_POST['open'];
		$recepits=$_POST['receipts'];
		$issues=$_POST['issues'];
		$adjustments=$_POST['adjustments'];
		$losses=$_POST['losses'];
		$closing=$_POST['closing'];
		$nodays=$_POST['days'];
		$quantity=$_POST['quantity'];
		$comment=$_POST['comment'];
		$s_quantity=$_POST['actual_quantity'];
		
		$orderDate=date('y/m/d'); 
		$facilityCode=$facility_c=$this -> session -> userdata('news');;
		$j=count($ids);
		
		
		$total=0;
		$count=1;
		$data_array=NULL;
		
		for($i=0;$i<$j;$i++){
		if($count==1) 
			{
		$data1=array('orderDate' => ''.$orderDate.'','facilityCode' => ''.$facilityCode.'','drawing_rights'=>6000000); 
		$o = new Ordertbl();
	    $o->fromArray($data1);
		$o->save();
		
		$lastId=Ordertbl::getNeworder($facilityCode);
		$newOrderid= $lastId->maxId;
		$count++;
		}
		if($quantity[$i]>=0){
			
		$data=array("kemsa_code"=>$ids[$i],"price"=>$price[$i],
		"quantityOrdered"=>$quantity[$i],"orderNumber"=>$newOrderid,
		't_receipts'=>$recepits[$i],'t_issues'=>$issues[$i],'adjust'=>$adjustments[$i],
		'losses'=>$losses[$i],'days'=>$nodays[$i],'c_stock'=>$closing[$i],'comment'=>$comment[$i],'s_quantity'=>$s_quantity[$i]);
		$total=$quantity[$i]*$price[$i]+$total;
		$u = new Orderdetails();
		$u->fromArray($data);
		$u->save();
		}
		}
	
		$myobj = Doctrine::getTable('Ordertbl')->find($newOrderid);
        $myobj->orderTotal = $total;
        $myobj->save();
		
		$data['popout'] = "Your order has been saved";
		 $facility_c=$this -> session -> userdata('news');
				
		$data['myClass'] = $this;
		$data['pending'] = Ordertbl::getPending($facility_c);
		$data['dispatched'] = Ordertbl::getDispatched($facility_c);
		$data['title'] = "All Orders";
		$data['content_view'] = "orders_listing_v";
		$data['banner_text'] = "All Orders";
		$data['link'] = "order_management"; 
		$this -> load -> view("template", $data);
	}
	public function moh_order_v(){
		$checker=$this->uri->segment(3);
		
			switch ($checker)
			{
				case 'pending':
					$data['order_list']=Ordertbl::get_pending_orders();
					break;
					case 'approved':
						$data['order_list']=Ordertbl::get_approved_orders();
					break;
						case 'dispatched':
						$data['order_list']=Ordertbl::get_dispatched_orders();
						break;
							case 'delivered':
							$data['order_list']=Ordertbl::get_delivered_orders();
							break;
								default :
								$data['order_list']=Ordertbl::get_all_orders_moh();				
			}
		
		$data['title'] = "Order View";
     	$data['content_view'] = "moh/moh_order_v";
		$data['banner_text'] = "Order View";
		$data['link'] = "home";
		$data['counties'] = Counties::getAll();
		$data['myClass'] = $this;
		$data['quick_link'] = "moh_order_v";
		$this -> load -> view("template", $data);
		}
	public function moh_order_details(){
		
		$delivery=$this->uri->segment(3);
		$data['title'] = "Order detail View";
     	$data['content_view'] = "moh/moh_orderdetail_v";
		$data['banner_text'] = "Order detail View";
		$data['link'] = "home";
		$data['quick_link'] = "moh_order_v";
		$data['detail_list']=Orderdetails::get_order($delivery);		
		$this -> load -> view("template", $data);
		
	}
public function kemsa_order_details(){
		
		$delivery=$this->uri->segment(3);
		$data['title'] = "Order detail View";
     	$data['content_view'] = "kemsa/moh_orderdetail_v";
		$data['banner_text'] = "Order detail View";
		$data['link'] = "home";
		$data['quick_link'] = "moh_order_v";
		$data['detail_list']=Orderdetails::get_order($delivery);		
		$this -> load -> view("template", $data);
		
	}
public function facility_order_v(){
		
		$data['title'] = "Order View";
     	$data['content_view'] = "moh_order_v";
		$data['banner_text'] = "Order View";
		$data['link'] = "home";
		$data['myClass'] = $this;
		$data['order_list']=Ordertbl::getFacilityOrder($this->uri->segment(3));
		$this -> load -> view("template", $data);
		}
public function facility_order_v2(){
		$facility_c=$this -> session -> userdata('news');
		$data['title'] = "Order View";
     	$data['content_view'] = "moh_order_v";
		$data['banner_text'] = "Order View";
		$data['link'] = "home";
		$data['myClass'] = $this;
		$data['quick_link'] = "moh_order_v";
		$data['order_list']=Ordertbl::getPendingDEtails($facility_c);
		$this -> load -> view("template", $data);
		}
		
//displays orders for the user to update them
public function all_deliveries() {
		$delivery=$this->uri->segment(3);
		//echo $delivery;
        $data['title'] = "All Deliveries";
        $data['content_view'] = "dispatched_listing_v";
        $data['banner_text'] = "Dispatched Orders";
        $data['link'] = "dispatched_listing_v";
		$data['myClass'] = $this;
        $data['order_list']=Kemsa_Order::get_facility_order($delivery);
        $data['quick_link'] = "dispatched_listing_v";
        $this -> load -> view("template", $data);
    }
//fetches the order that a user wants to update
    public function update_delivery_status() {
       
        $delivery=$this->uri->segment(3);
        $data['order']=$delivery;
        $data['order_ord']=Kemsa_Order_Details::get_order($delivery);
        $data['batch_no']=Kemsa_Order::get_batch_no($delivery);
        $data['title'] = "Update Delivery Status";
        $data['content_view'] = "update_delivery_status_v";
        $data['banner_text'] = "Update Status";
        $data['link'] = "order_management";
        $data['quick_link'] = "all_deliveries";
        $this -> load -> view("template", $data);
    }
	
	//dispatched table code
	public function dispatch_order(){
		$delivery=$this->uri->segment(3);
		$kemsa_order_no=$this->uri->segment(4);
		$data['dispatch_ord']=Facility_Dispatched_Details_View::getAll($kemsa_order_no);
		$data['batch_no']=Kemsa_Order::get_batch_no($delivery);
		$data['title'] = "Update Delivery Status";
        $data['content_view'] = "update_delivery_status_v";
        $data['banner_text'] = "Update Status";
        $data['link'] = "order_management";
		$data['order_list']=Kemsa_Order::get_facility_order($delivery);
        $data['quick_link'] = "all_deliveries";
        $this -> load -> view("template", $data);
	}
        //takes care of any discrepancy that might have occured with the order
public function discrepancy() {
		$data['title'] = "Shipment Discrepancy Report";
		$data['content_view'] = "discrepancy_v";
		$data['banner_text'] = "Discrepancy Report";
		/*$data['link'] = "order_management";
		$data['drug_categories'] = Drug_Category::getAll();*/
		$data['quick_link'] = "discrepancy_form";
		$this -> load -> view("template", $data);
	}
    function getWorkingDays($startDate,$endDate,$holidays){
    //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
    //We add one to inlude both dates in the interval.
    if($startDate!=NULL && $endDate!=NULL){
    $days = ($endDate->getTimestamp() - $startDate->getTimestamp()) / 86400 + 1;
    $no_full_weeks = floor($days / 7);
    $no_remaining_days = fmod($days, 7);
    //It will return 1 if it's Monday,.. ,7 for Sunday
    $the_first_day_of_week = date("N",$startDate->getTimestamp());
    $the_last_day_of_week = date("N",$endDate->getTimestamp());

    // echo              $the_last_day_of_week;

    //---->The two can be equal in leap years when february has 29 days, the equal sign is added here

    //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.

    if ($the_first_day_of_week <= $the_last_day_of_week){

        if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;

        if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;

    }
    else{

        if ($the_first_day_of_week <= 6) {

        //In the case when the interval falls in two weeks, there will be a Sunday for sure

            $no_remaining_days--;

        }

    }
    //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder

//---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it

   $workingDays = $no_full_weeks * 5;

    if ($no_remaining_days > 0 )

    {

      $workingDays += $no_remaining_days;

    }
    //We subtract the holidays

/*    foreach($holidays as $holiday){

        $time_stamp=strtotime($holiday);

        //If the holiday doesn't fall in weekend

        if (strtotime($startDate) <= $time_stamp && $time_stamp <= strtotime($endDate) && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)

            $workingDays--;

    }*/
    return round ($workingDays-1);
    }
return NULL;
}
// District Order
	public function dist_order(){
		$data['title'] = "Order View";
     	$data['content_view'] = "dist_order_v";
		$data['banner_text'] = "Order View";
		$data['link'] = "home";
		$data['counties'] = Counties::getAll();
		$data['myClass'] = $this;
		$data['quick_link'] = "moh_order_v";
		$data['order_list']=Ordertbl::get_all_orders_moh();
		$this -> load -> view("template", $data);
	}
	public function dist_order_details(){
		
		$delivery=$this->uri->segment(3);
		$data['title'] = "Order detail View";
     	$data['content_view'] = "dist_orderdetail_v";
		$data['banner_text'] = "Order detail View";
		$data['link'] = "home";
		$data['quick_link'] = "moh_order_v";
		$data['detail_list']=Orderdetails::get_order($delivery);		
		$this -> load -> view("template", $data);
		
	}
}

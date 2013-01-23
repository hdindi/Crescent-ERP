<?php

class Uniformity extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    public function index() {
        $data=array();        
       $data['settings_view'] = "uniformity_v";	
        $this -> base_params($data);
    }
	public function base_params($data) {
		$data['title'] = "Weights and uniformity";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");
		$data['quick_link'] = "uniformity";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "NQCL Settings";
		$data['link'] = "settings_management";

		$this -> load -> view('template', $data);
	}
        public function save_capsule_weights() {
        $tcsv1 = $this->input->post('tcsv1');
        $ecsv1 = $this->input->post('ecsv1');
        $csvc1 = $this->input->post('csvc1');

        $tcsv2 = $this->input->post('tcsv2');
        $ecsv2 = $this->input->post('ecsv2');
        $csvc2 = $this->input->post('csvc2');

        $tcsv3 = $this->input->post('tcsv3');
        $ecsv3 = $this->input->post('ecsv3');
        $csvc3 = $this->input->post('csvc3');

        $tcsv4 = $this->input->post('tcsv4');
        $ecsv4 = $this->input->post('ecsv4');
        $csvc4 = $this->input->post('csvc4');

        $tcsv5 = $this->input->post('tcsv5');
        $ecsv5 = $this->input->post('ecsv5');
        $csvc5 = $this->input->post('csvc5');

        $tcsv6 = $this->input->post('tcsv6');
        $ecsv6 = $this->input->post('ecsv6');
        $csvc6 = $this->input->post('csvc6');

        $tcsv7 = $this->input->post('tcsv7');
        $ecsv7 = $this->input->post('ecsv7');
        $csvc7 = $this->input->post('csvc7');

        $tcsv8 = $this->input->post('tcsv8');
        $ecsv8 = $this->input->post('ecsv8');
        $csvc8 = $this->input->post('csvc8');

        $tcsv9 = $this->input->post('tcsv9');
        $ecsv9 = $this->input->post('ecsv9');
        $csvc9 = $this->input->post('csvc9');

        $tcsv10 = $this->input->post('tcsv10');
        $ecsv10 = $this->input->post('ecsv10');
        $csvc10 = $this->input->post('csvc10');

        $tcsv11 = $this->input->post('tcsv11');
        $ecsv11 = $this->input->post('ecsv11');
        $csvc11 = $this->input->post('csvc11');

        $tcsv12 = $this->input->post('tcsv12');
        $ecsv12 = $this->input->post('ecsv12');
        $csvc12 = $this->input->post('csvc12');

        $tcsv13 = $this->input->post('tcsv13');
        $ecsv13 = $this->input->post('ecsv13');
        $csvc13 = $this->input->post('csvc13');

        $tcsv14 = $this->input->post('tcsv14');
        $ecsv14 = $this->input->post('ecsv14');
        $csvc14 = $this->input->post('csvc14');

        $tcsv15 = $this->input->post('tcsv15');
        $ecsv15 = $this->input->post('ecsv15');
        $csvc15 = $this->input->post('csvc15');

        $tcsv16 = $this->input->post('tcsv16');
        $ecsv16 = $this->input->post('ecsv16');
        $csvc16 = $this->input->post('csvc16');

        $tcsv17 = $this->input->post('tcsv17');
        $ecsv17= $this->input->post('ecsv17');
        $csvc17 = $this->input->post('csvc17');

        $tcsv18 = $this->input->post('tcsv18');
        $ecsv18 = $this->input->post('ecsv18');
        $csvc18 = $this->input->post('csvc18');

        $tcsv19 = $this->input->post('tcsv19');
        $ecsv19 = $this->input->post('ecsv19');
        $csvc19 = $this->input->post('csvc19');

        $tcsv20 = $this->input->post('tcsv20');
        $ecsv20 = $this->input->post('ecsv20');
        $csvc20 = $this->input->post('csvc20');
        
        $labref='NQCL/Aug/2012/13';
        
            $array = array(
                 0=>array('labref'=>$labref,'tcsv'=>$tcsv1,'ecsv'=>$ecsv1,'csvc'=>$csvc1)
                ,1=>array('labref'=>$labref,'tcsv'=>$tcsv2,'ecsv'=>$ecsv2,'csvc'=>$csvc2)
                ,2=>array('labref'=>$labref,'tcsv'=>$tcsv3,'ecsv'=>$ecsv3,'csvc'=>$csvc3)
                ,3=>array('labref'=>$labref,'tcsv'=>$tcsv4,'ecsv'=>$ecsv4,'csvc'=>$csvc4)
                ,4=>array('labref'=>$labref,'tcsv'=>$tcsv5,'ecsv'=>$ecsv5,'csvc'=>$csvc5)
                ,5=>array('labref'=>$labref,'tcsv'=>$tcsv6,'ecsv'=>$ecsv6,'csvc'=>$csvc6)
                ,6=>array('labref'=>$labref,'tcsv'=>$tcsv7,'ecsv'=>$ecsv7,'csvc'=>$csvc7)
                ,7=>array('labref'=>$labref,'tcsv'=>$tcsv8,'ecsv'=>$ecsv8,'csvc'=>$csvc8)
                ,8=>array('labref'=>$labref,'tcsv'=>$tcsv9,'ecsv'=>$ecsv9,'csvc'=>$csvc9)
                ,9=>array('labref'=>$labref,'tcsv'=>$tcsv10,'ecsv'=>$ecsv10,'csvc'=>$csvc10)
                ,10=>array('labref'=>$labref,'tcsv'=>$tcsv11,'ecsv'=>$ecsv11,'csvc'=>$csvc11)
                ,11=>array('labref'=>$labref,'tcsv'=>$tcsv12,'ecsv'=>$ecsv12,'csvc'=>$csvc12)
                ,12=>array('labref'=>$labref,'tcsv'=>$tcsv13,'ecsv'=>$ecsv13,'csvc'=>$csvc13)
                ,13=>array('labref'=>$labref,'tcsv'=>$tcsv14,'ecsv'=>$ecsv14,'csvc'=>$csvc14)
                ,14=>array('labref'=>$labref,'tcsv'=>$tcsv15,'ecsv'=>$ecsv15,'csvc'=>$csvc15)
                ,15=>array('labref'=>$labref,'tcsv'=>$tcsv16,'ecsv'=>$ecsv16,'csvc'=>$csvc16)
                ,16=>array('labref'=>$labref,'tcsv'=>$tcsv17,'ecsv'=>$ecsv17,'csvc'=>$csvc17)
                ,17=>array('labref'=>$labref,'tcsv'=>$tcsv18,'ecsv'=>$ecsv18,'csvc'=>$csvc18)
                ,18=>array('labref'=>$labref,'tcsv'=>$tcsv19,'ecsv'=>$ecsv19,'csvc'=>$csvc19)
                ,19=>array('labref'=>$labref,'tcsv'=>$tcsv20,'ecsv'=>$ecsv20,'csvc'=>$csvc20)
                
                
    );
    foreach($array as $v){
    $sql = "INSERT INTO weight_uniformity (labref,tcsv,ecsv,csvc)
    value
    ('{$v['labref']}','{$v['tcsv']}','{$v['ecsv']}','{$v['csvc']}')";
    //execute $sql here or it will overwrite on loop
    $k=mysql_query($sql);
    }
    if($k){
        echo 'was successs';
    }else{
       echo 'The error is:'. mysql_error();
    }

    }
    
    
      public function save_tablet_weights() {
        $tcsv1 = $this->input->post('tcsv1');
       // $ecsv1 = $this->input->post('ecsv1');
        //$csvc1 = $this->input->post('csvc1');

        $tcsv2 = $this->input->post('tcsv2');
       // $ecsv2 = $this->input->post('ecsv2');
        //$csvc2 = $this->input->post('csvc2');

        $tcsv3 = $this->input->post('tcsv3');
       // $ecsv3 = $this->input->post('ecsv3');
        //$csvc3 = $this->input->post('csvc3');

        $tcsv4 = $this->input->post('tcsv4');
        //$ecsv4 = $this->input->post('ecsv4');
        //$csvc4 = $this->input->post('csvc4');

        $tcsv5 = $this->input->post('tcsv5');
       // $ecsv5 = $this->input->post('ecsv5');
        //$csvc5 = $this->input->post('csvc5');

        $tcsv6 = $this->input->post('tcsv6');
        //$ecsv6 = $this->input->post('ecsv6');
        //$csvc6 = $this->input->post('csvc6');

        $tcsv7 = $this->input->post('tcsv7');
        //$ecsv7 = $this->input->post('ecsv7');
        //$csvc7 = $this->input->post('csvc7');

        $tcsv8 = $this->input->post('tcsv8');
       // $ecsv8 = $this->input->post('ecsv8');
       // $csvc8 = $this->input->post('csvc8');

        $tcsv9 = $this->input->post('tcsv9');
        //$ecsv9 = $this->input->post('ecsv9');
        //$csvc9 = $this->input->post('csvc9');

        $tcsv10 = $this->input->post('tcsv10');
       // $ecsv10 = $this->input->post('ecsv10');
        //$csvc10 = $this->input->post('csvc10');

        $tcsv11 = $this->input->post('tcsv11');
       // $ecsv11 = $this->input->post('ecsv11');
        //$csvc11 = $this->input->post('csvc11');

        $tcsv12 = $this->input->post('tcsv12');
       // $ecsv12 = $this->input->post('ecsv12');
        //$csvc12 = $this->input->post('csvc12');

        $tcsv13 = $this->input->post('tcsv13');
       // $ecsv13 = $this->input->post('ecsv13');
       // $csvc13 = $this->input->post('csvc13');

        $tcsv14 = $this->input->post('tcsv14');
        //$ecsv14 = $this->input->post('ecsv14');
       // $csvc14 = $this->input->post('csvc14');

        $tcsv15 = $this->input->post('tcsv15');
        //$ecsv15 = $this->input->post('ecsv15');
        //$csvc15 = $this->input->post('csvc15');

        $tcsv16 = $this->input->post('tcsv16');
        //$ecsv16 = $this->input->post('ecsv16');
        //$csvc16 = $this->input->post('csvc16');

        $tcsv17 = $this->input->post('tcsv17');
        //$ecsv17= $this->input->post('ecsv17');
        //$csvc17 = $this->input->post('csvc17');

        $tcsv18 = $this->input->post('tcsv18');
        //$ecsv18 = $this->input->post('ecsv18');
        //$csvc18 = $this->input->post('csvc18');

        $tcsv19 = $this->input->post('tcsv19');
        //$ecsv19 = $this->input->post('ecsv19');
       // $csvc19 = $this->input->post('csvc19');

        $tcsv20 = $this->input->post('tcsv20');
        //$ecsv20 = $this->input->post('ecsv20');
        //$csvc20 = $this->input->post('csvc20');
        
        $labref='NQCL/Aug/2012/13';
        
            $array = array(
                 0=>array('labref'=>$labref,'tcsv'=>$tcsv1)
                ,1=>array('labref'=>$labref,'tcsv'=>$tcsv2)
                ,2=>array('labref'=>$labref,'tcsv'=>$tcsv3)
                ,3=>array('labref'=>$labref,'tcsv'=>$tcsv4)
                ,4=>array('labref'=>$labref,'tcsv'=>$tcsv5)
                ,5=>array('labref'=>$labref,'tcsv'=>$tcsv6)
                ,6=>array('labref'=>$labref,'tcsv'=>$tcsv7)
                ,7=>array('labref'=>$labref,'tcsv'=>$tcsv8)
                ,8=>array('labref'=>$labref,'tcsv'=>$tcsv9)
                ,9=>array('labref'=>$labref,'tcsv'=>$tcsv10)
                ,10=>array('labref'=>$labref,'tcsv'=>$tcsv11)
                ,11=>array('labref'=>$labref,'tcsv'=>$tcsv12)
                ,12=>array('labref'=>$labref,'tcsv'=>$tcsv13)
                ,13=>array('labref'=>$labref,'tcsv'=>$tcsv14)
                ,14=>array('labref'=>$labref,'tcsv'=>$tcsv15)
                ,15=>array('labref'=>$labref,'tcsv'=>$tcsv16)
                ,16=>array('labref'=>$labref,'tcsv'=>$tcsv17)
                ,17=>array('labref'=>$labref,'tcsv'=>$tcsv18)
                ,18=>array('labref'=>$labref,'tcsv'=>$tcsv19)
                ,19=>array('labref'=>$labref,'tcsv'=>$tcsv20)
                                
    );
    foreach($array as $v){
    $sql = "INSERT INTO weight_tablets (labref,tcsv)
    value
    ('{$v['labref']}','{$v['tcsv']}')";
    //execute $sql here or it will overwrite on loop
    $k=mysql_query($sql);
    }
    if($k){
        echo 'was successs';
    }else{
       echo 'The error is:'. mysql_error();
    }

    }

}

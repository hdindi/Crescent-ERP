<?php
error_reporting(0);
class Reviews extends CI_Controller{
	function __construct() {
        parent::__construct();
        }

    public function index(){
    	$this-> load -> view('samples_uploaded_view');
    	echo "DINDI";
    }

}
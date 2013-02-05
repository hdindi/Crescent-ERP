<?php
error_reporting(0);
/**
* 
*/
class Transport extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->helper(array('form', 'url','session'));
	}
	public function Transport() {
		$this ->load -> view ('farming_view');
	}
}

?>
<?php
class Reviewer extends CI_Controller {

    function __construct() {
        parent::__construct();
        }


public function index() {
        //$data['reviewer_id']=  $this->session->userdata('user_id');
        //$data['settings_view'] = 'samples_uploaded_view';
        $this->load->view('samples_uploaded_view');
        echo "DINDI";
    }

    function elfinder_init() {
        //$reviewer_id=$this->session->userdata('user_id');
        $this->load->helper('path');
        $opts = array(
            // 'debug' => true, 
            'roots' => array(
                array(
                    'driver' => 'LocalFileSystem',
                    'path' => './files/',
                    'URL' => base_url() . '/files/',
                    'accessControl' => 'access',
                    //'disabled' => array('edit', 'rename', 'cut', 'copy','delete','trash'),
                    'dotFiles' => false,
                    'tmbDir' => '_tmb',
                    'arc' => '7za',
                    'defaults' => array('read' => true, 'write' => true, 'rm' => true)
                ),
            ),
        );
        $this->load->library('elfinder_lib', $opts);
    }









}

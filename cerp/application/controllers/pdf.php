<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdf extends CI_Controller {

 function __construct()
 {
 parent::__construct();
 }

 function index()
 {
 $this->hello_world();
 echo 'mvudfingvieursdjgmvf';
 }

 function hello_world()
 {
 $this->load->library('cezpdf');

 $this->cezpdf->ezText('Hello World', 12, array('justification' => 'center'));
 $this->cezpdf->ezSetDy(-10);

 $content = 'The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog.
 Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs.';

 $this->cezpdf->ezText($content, 10);

 $this->cezpdf->ezStream();
 }

 function tables()
 {
 $this->load->library('cezpdf');

 $db_data[] = array('name' => 'Jon Doe', 'phone' => '111-222-3333', 'email' => 'jdoe@someplace.com');
 $db_data[] = array('name' => 'Jane Doe', 'phone' => '222-333-4444', 'email' => 'jane.doe@something.com');
 $db_data[] = array('name' => 'Jon Smith', 'phone' => '333-444-5555', 'email' => 'jsmith@someplacepsecial.com');

 $col_names = array(
 'name' => 'Name',
 'phone' => 'Phone Number',
 'email' => 'E-mail Address'
 );

 $this->cezpdf->ezTable($db_data, $col_names, 'Contact List', array('width'=>550));
 $this->cezpdf->ezStream();
 }

}



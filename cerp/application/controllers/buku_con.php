<?php
class Buku_con extends CI_Controller {
public function Buku_con() {
parent::__construct();
//$this->load->model('buku_model');//load the model
$this->load->library('pagination');
}
//function to get the data from tb_book
function getBuku() {
$data['title'] = 'menampilkan isi buku';
$data['detail'] = $this->getBuku1();//call the model and save the result in $detail
$this->load->view('buku_view', $data);
}
//function to export to excel
function toExcelAll() {
$query['data1'] = $this->ToExcelAll1();
$this->load->view('excel_view',$query);
}



function getBuku1() {
$this->db->select('*');
$this->db->from('farm');
$this->db->order_by('id','DESC');
$getData = $this->db->get();
if($getData->num_rows() > 0)
return $getData->result_array();
else
return null;
}
//query for get all data
function toExcelAll1() {
$this->db->select('*');
$this->db->from('farm');
$this->db->order_by('id','desc');
$getData = $this->db->get();
if($getData->num_rows() > 0)
return $getData->result_array();
else
return null;
}
}
?>
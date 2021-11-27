<?php
/**
 * 
 */
class Procurement extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_procurement');
		// $this->lang->load('procurement',$this->language);
		$this->load->library('pagination');
	}

	public function index(){
		$this->data['title'] = 'งานพัสดุ';
		$this->middle = 'manage';
		$this->layout();
	}

	public function procurement_list(){
		$id = $this->uri->segment(4);
		$get = $this->model_procurement->fetch_procurement($id);
		echo json_encode(array('data'=>$get));
	}

	public function view(){
		$id = $this->uri->segment(5);
		$this->data['procurement_single']  = $this->model_procurement->fetch_procurement_single($id);
		$this->data['title']      = 'งานพัสดุ - '.$this->data['procurement_single']['title'];
		$this->middle = 'view';
		$this->layout();
	}
}

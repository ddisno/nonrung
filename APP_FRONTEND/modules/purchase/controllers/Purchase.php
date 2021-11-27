<?php
/**
 * 
 */
class Purchase extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_purchase');
		// $this->lang->load('purchase',$this->language);
		$this->load->library('pagination');
	}

	public function index(){
		$this->data['title'] = 'ข่าวสารจัดซื้อจัดจ้าง';
		$this->middle = 'manage';
		$this->layout();
	}

	public function purchase_list(){
		$id = $this->uri->segment(4);
		$get = $this->model_purchase->fetch_purchase($id);
		echo json_encode(array('data'=>$get));
	}

	public function view(){
		$id = $this->uri->segment(5);
		$this->data['purchase']  = $this->model_purchase->fetch_purchase_single($id);
		$this->data['title']      = 'ข่าวสารจัดซื้อจัดจ้าง - '.$this->data['purchases']['title'];
		$this->middle = 'view';
		$this->layout();
	}
}

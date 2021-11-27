<?php
/**
 * 
 */
class Otherpurchase extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_otherpurchase');
		// $this->lang->load('otherpurchase',$this->language);
		$this->load->library('pagination');
	}

	public function index(){
		$this->data['title'] = 'ข่าวสารจัดซื้อจัดจ้าง ภายนอกหน่วยงาน';
		$this->middle = 'manage';
		$this->layout();
	}

	public function otherpurchase_list(){
		$id = $this->uri->segment(4);
		$get = $this->model_otherpurchase->fetch_otherpurchase($id);
		echo json_encode(array('data'=>$get));
	}

	public function view(){
		$id = $this->uri->segment(5);
		$this->data['otherpurchase']  = $this->model_otherpurchase->fetch_otherpurchase_single($id);
		$this->data['title']      = 'ข่าวสารจัดซื้อจัดจ้าง ภายนอกหน่วยงาน - '.$this->data['otherpurchases']['title'];
		$this->middle = 'view';
		$this->layout();
	}
}

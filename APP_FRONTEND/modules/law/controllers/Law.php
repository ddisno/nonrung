<?php
/**
 * 
 */
class Law extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_law');
		// $this->lang->load('law',$this->language);
		$this->load->library('pagination');
	}

	public function index(){
		$this->data['title'] = 'กฎหมายที่น่ารู้';
		$this->middle = 'manage';
		$this->layout();
	}

	public function law_list(){
		$id = $this->uri->segment(4);
		$get = $this->model_law->fetch_law($id);
		echo json_encode(array('data'=>$get));
	}

	public function view(){
		$id = $this->uri->segment(5);
		$this->data['law_single']  = $this->model_law->fetch_law_single($id);
		$this->data['title']      = 'กฎหมายที่น่ารู้ - '.$this->data['law_single']['title'];
		$this->middle = 'view';
		$this->layout();
	}
}

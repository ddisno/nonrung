<?php
/**
 * 
 */
class Personal extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_personal');
		// $this->lang->load('personal',$this->language);
		$this->load->library('pagination');
	}

	public function index(){
		$this->data['title'] = 'ทำเนียบบุคลากร';
		$this->middle = 'manage';
		$this->layout();
	}

	public function personal_list(){
		$id = $this->uri->segment(4);
		$get = $this->model_personal->fetch_personal($id);
		echo json_encode(array('data'=>$get));
	}

	public function view(){
		$id = $this->uri->segment(5);
		$this->data['personal_single']  = $this->model_personal->fetch_personal_single($id);
		$this->data['title']      = 'ทำเนียบบุคลากร - '.$this->data['personal_single']['title'];
		$this->middle = 'view';
		$this->layout();
	}
}

<?php
/**
 * 
 */
class Budget extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_budget');
		// $this->lang->load('budget',$this->language);
		$this->load->library('pagination');
	}

	public function index(){
		$this->data['title'] = 'งบประมาณ';
		$this->middle = 'manage';
		$this->layout();
	}

	public function budget_list(){
		$id = $this->uri->segment(4);
		$get = $this->model_budget->fetch_budget($id);
		echo json_encode(array('data'=>$get));
	}

	public function view(){
		$id = $this->uri->segment(5);
		$this->data['budget_single']  = $this->model_budget->fetch_budget_single($id);
		$this->data['title']      = 'งบประมาณ - '.$this->data['budget_single']['title'];
		$this->middle = 'view';
		$this->layout();
	}
}

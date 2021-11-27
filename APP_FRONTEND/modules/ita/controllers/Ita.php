<?php
/**
 * 
 */
class ita extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_ita');
		// $this->lang->load('ita',$this->language);
		$this->load->library('pagination');
	}

	public function index(){
		$this->data['title'] = 'ข้อมูล ITA';
		$this->middle = 'manage';
		$this->layout();
	}

	public function ita_list(){
		$id = $this->uri->segment(4);
		$get = $this->model_ita->fetch_ita($id);
		echo json_encode(array('data'=>$get));
	}

	public function view(){
		$id = $this->uri->segment(5);
		$this->data['ita_single']  = $this->model_ita->fetch_ita_single($id);
		$this->data['title']      = 'ข้อมูล ITA - '.$this->data['ita_single']['title'];
		$this->middle = 'view';
		$this->layout();
	}
}

<?php
/**
 * 
 */
class Information extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_information');
		// $this->lang->load('information',$this->language);
		$this->load->library('pagination');
	}

	public function index(){
		$this->data['title'] = 'ข้อมูลพื้นฐาน';
		$this->middle = 'manage';
		$this->layout();
	}

	public function information_list(){
		$id = $this->uri->segment(4);
		$get = $this->model_information->fetch_information($id);
		echo json_encode(array('data'=>$get));
	}

	public function view(){
		$id = $this->uri->segment(5);
		$this->data['information_single']  = $this->model_information->fetch_information_single($id);
		$this->data['title']      = 'ข้อมูลพื้นฐาน - '.$this->data['information_single']['title'];
		$this->middle = 'view';
		$this->layout();
	}
}

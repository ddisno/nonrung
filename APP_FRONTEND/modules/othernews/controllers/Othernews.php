<?php
/**
 * 
 */
class othernews extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_othernews');
		// $this->lang->load('othernews',$this->language);
		$this->load->library('pagination');
	}

	public function index(){
		$this->data['title'] = 'ข่าวสารประชาสัมพันธ์ ภายนอกหน่วยงาน';
		$this->middle = 'manage';
		$this->layout();
	}

	public function othernews_list(){
		$id = $this->uri->segment(4);
		$get = $this->model_othernews->fetch_othernews($id);
		echo json_encode(array('data'=>$get));
	}

	public function view(){
		$id = $this->uri->segment(5);
		$this->data['othernews']  = $this->model_othernews->fetch_othernews_single($id);
		$this->data['title']      = 'ข่าวสารประชาสัมพันธ์ ภายนอกหน่วยงาน - '.$this->data['othernewss']['title'];
		$this->middle = 'view';
		$this->layout();
	}
}

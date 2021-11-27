<?php
/**
 * 
 */
class News extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_news');
		// $this->lang->load('news',$this->language);
		$this->load->library('pagination');
	}

	public function index(){
		$this->data['title'] = 'ข่าวสารประชาสัมพันธ์';
		$this->middle = 'manage';
		$this->layout();
	}

	public function news_list(){
		$id = $this->uri->segment(4);
		$get = $this->model_news->fetch_news($id);
		echo json_encode(array('data'=>$get));
	}

	public function view(){
		$id = $this->uri->segment(5);
		$this->data['news']  = $this->model_news->fetch_news_single($id);
		$this->data['title']      = 'ข่าวสารประชาสัมพันธ์ - '.$this->data['news']['title'];
		$this->middle = 'view';
		$this->layout();
	}
}

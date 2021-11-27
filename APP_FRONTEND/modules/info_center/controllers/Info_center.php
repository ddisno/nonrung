<?php
/**
 * 
 */
class Info_center extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_info_center');
		// $this->lang->load('info_center',$this->language);
		$this->load->library('pagination');
	}

	public function index(){
		$this->data['title'] = 'ศูนย์ข้อมูลข่าวสารฯ';
		$this->middle = 'manage';
		$this->layout();
	}

	public function info_center_list(){
		$id = $this->uri->segment(4);
		$get = $this->model_info_center->fetch_info_center($id);
		echo json_encode(array('data'=>$get));
	}

	public function category(){		
		$cat = $this->uri->segment(5);	
		$this->data['name_info_center']  = $this->model_info_center->fetch_cats_name($cat);
		$this->data['title']      = 'ศูนย์ข้อมูลข่าวสารฯ - '.$this->data['name_info_center']['name_cat_th'];

		$this->middle = 'category';
		$this->layout();
	}


	public function view(){
		$id = $this->uri->segment(5);
		$this->data['info_centers']  = $this->model_info_center->fetch_info_center_single($id);
		$this->data['title']      = 'ศูนย์ข้อมูลข่าวสารฯ - '.$this->data['info_centers']['name_th'];
		$this->middle = 'view';
		$this->layout();
	}
}

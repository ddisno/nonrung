<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Knowledge extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_knowledge');
		// $this->lang->load('knowledge',$this->language);
		$this->load->library('pagination');
	}

	public function index(){
		$this->data['title'] = 'ความรู้ทั่วไปเกี่ยวกับ อบต.';
		$this->middle = 'manage';
		$this->layout();
	}

	public function knowledge_list(){
		$id = $this->uri->segment(4);
		$get = $this->model_knowledge->fetch_knowledge($id);
		echo json_encode(array('data'=>$get));
	}

	public function view(){
		$id = $this->uri->segment(5);
		$this->data['knowledge_single']  = $this->db->where('id',$id)->get('knowledge')->row_array();
		$this->data['title']      = 'ความรู้ทั่วไปเกี่ยวกับ อบต. - '.$this->data['knowledge_single']['title'];
		$this->middle = 'view';
		$this->layout();
	}
}

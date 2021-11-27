<?php

class Seo extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('model_seo');
		$this->load->library('upload');
		$this->load->helper('file');
	}

	public function index(){
		$get_data = $this->model_seo->list(); //เรียบข้อมูลจากตาราง page data เพื่อส่งไปยัง view
		if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){
			$data = array(
				'meta_keyword' 	  => htmlspecialchars($this->input->post('keyword')),
				'meta_descrip'	  => htmlspecialchars($this->input->post('descrip')),
				'update_datetime' => $now

			);
			$response = $this->model_seo->save($data);
			if($response){
				$this->session->set_flashdata('message', 'แก้ไข SEO เรียบร้อยแล้ว');
			}else{
				$this->session->set_flashdata('message', 'เกิดปัญหากับระบบ dbs');
			}
			redirect('seo');
		}
		$this->data['data'] = $get_data;

		$this->data['title'] = 'SEO';
		$this->middle = 'seo';
		$this->layout();
	}

	public function update(){
		$now = date('Y-m-d H:i:s');
		
		
	}

}
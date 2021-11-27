<?php

class Toweb extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('model_toweb');
		$this->load->library('upload');
	}

	public function index(){

		$this->data['title'] = 'toweb';
		$this->data['header'] = 'จัดการลิ้งค์เว็บไซต์อื่น';
		$this->middle = 'toweb';
		$this->layout();
	}

	public function toweb_list(){
		$get = $this->model_toweb->toweb_list();
		echo json_encode(array('data'=>$get));
	}

	public function toweb_create(){
		$get = $this->db->insert('toweb',$this->input->post());
		
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'เพิ่มลิ้งค์เว็บไซต์เรียบร้อยแล้ว',
	          'token' => $this->token,
	          'hash' => $this->hash
	          );
	      }else{
	        $json = array(
	          'status'=>'error',
	          'info'=>'เกิดข้อผิดพลาด',
	          'token' => $this->token,
	          'hash' => $this->hash
	          );
	      }
	      
	      $this->output
	            ->set_content_type('application/json')
	            ->set_output(json_encode($json));
	}

	public function toweb_update(){
		$data = $this->input->post();
		unset($data['id']);

		$this->db->where('id',$this->input->post('id'));
		$get = $this->db->update('toweb',$data);
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'แก้ไขลิ้งค์เว็บไซต์เรียบร้อยแล้ว',
	          'token' => $this->token,
	          'hash' => $this->hash
	          );
	      }else{
	        $json = array(
	          'status'=>'error',
	          'info'=>'เกิดข้อผิดพลาด',
	          'token' => $this->token,
	          'hash' => $this->hash
	          );
	      }
	      
	      $this->output
	            ->set_content_type('application/json')
	            ->set_output(json_encode($json));
	}

	public function toweb_del(){
		$id = $this->input->post('id');
		$get = $this->model_toweb->toweb_del($id);

		if($get){
	        $json = array(
	          'status'=>'done',
	          
	          'token' => $this->token,
	          'hash' => $this->hash
	          );
	      }else{
	        $json = array(
	          'status'=>'error',
	          
	          'token' => $this->token,
	          'hash' => $this->hash
	          );
	      }
	      $this->output
	            ->set_content_type('application/json')
	            ->set_output(json_encode($json));
	}

	public function toweb_delmulti(){
		if(empty($this->input->post('chk_toweb'))){
			return false;
		}

		$id = $this->input->post('chk_toweb');
		$get = $this->model_toweb->toweb_delmulti($id);

		if($get){
	        $json = array(
	          'status'=>'done',
	          
	          'token' => $this->token,
	          'hash' => $this->hash
	          );
	      }else{
	        $json = array(
	          'status'=>'error',
	          
	          'token' => $this->token,
	          'hash' => $this->hash
	          );
	      }
	      $this->output
	            ->set_content_type('application/json')
	            ->set_output(json_encode($json));
	}

	public function toweb_order_by(){
		$id   = $this->input->post('id');
		$order_by = $this->input->post('data');

		$data = array(
			'order_by' => $order_by,
		);

		$get = $this->model_toweb->toweb_order_by($data,$id);
		if($get){
	        $json = array(
	          'status'=>'done',
	          
	          'token' => $this->token,
	          'hash' => $this->hash
	          );
	      }else{
	        $json = array(
	          'status'=>'error',
	          
	          'token' => $this->token,
	          'hash' => $this->hash
	          );
	      }
	      $this->output
	            ->set_content_type('application/json')
	            ->set_output(json_encode($json));
	}

	public function toweb_status(){
		$id   = $this->input->post('id');
		$status = $this->input->post('data');

		$data = array(
			'status' => $status,
		);

		$get = $this->model_toweb->toweb_status($data,$id);
		if($get){
	        $json = array(
	          'status'=>'done',
	          
	          'token' => $this->token,
	          'hash' => $this->hash
	          );
	      }else{
	        $json = array(
	          'status'=>'error',
	          
	          'token' => $this->token,
	          'hash' => $this->hash
	          );
	      }
	      $this->output
	            ->set_content_type('application/json')
	            ->set_output(json_encode($json));
	}

	
}
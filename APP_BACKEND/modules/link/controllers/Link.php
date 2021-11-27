<?php

class Link extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('model_link');
	}

	public function index(){

		$response = $this->model_link->get_links();
		$this->data['data'] = $response;
		$this->data['header'] = 'จัดการส่วนเชื่อมโยง';
		$this->data['title'] = 'Links';
		$this->middle = 'link';
		$this->layout();
	}

	public function update(){
		$now = date("Y-m-d H:i:s");// set date to update
		$data = array(
			array(
			  	'short_name' => 'FB',  
		      	'link' => htmlspecialchars($this->input->post('fb')),
		      	'update_datetime' => $now
		    ),
		    array(
		      	'short_name' => 'GG',  
		      	'link' => htmlspecialchars($this->input->post('gg')),
		      	'update_datetime' => $now
		    ),
		    array(
		      	'short_name' => 'IG',  
		      	'link' => htmlspecialchars($this->input->post('ig')),
		      	'update_datetime' => $now
		    ),
		    array(
		    	'short_name' => 'TW',  
		      	'link' => htmlspecialchars($this->input->post('tw')),
		      	'update_datetime' => $now
		    ),
		    array(
		    	'short_name' => 'PR',  
		      	'link' => htmlspecialchars($this->input->post('pr')),
		      	'update_datetime' => $now
		    ),
		    array(
		    	'short_name' => 'YT',  
		      	'link' => htmlspecialchars($this->input->post('yt')),
		      	'update_datetime' => $now
		    ),
		    array(
		    	'short_name' => 'VO',  
		      	'link' => htmlspecialchars($this->input->post('vo')),
		      	'update_datetime' => $now
		    ),
		    array(
		    	'short_name' => 'GH',  
		     	'link' => htmlspecialchars($this->input->post('gh')),
		     	'update_datetime' => $now
		    ),
		    array(
		    	'short_name' => 'YH',  
		      	'link' => htmlspecialchars($this->input->post('yh')),
		      	'update_datetime' => $now
		    ),
		    array(
		    	'short_name' => 'LK',  
		      	'link' => htmlspecialchars($this->input->post('lk')),
		      	'update_datetime' => $now
		    ),
		);

		$get = $this->model_link->update($data);
		if($get){
			$resp = array(
				'status'=>'done',
				'info'=>'แก้ไขข้อมูลเรียบร้อยแล้ว',
				'token' => $this->token,
				'hash' => $this->hash
		    );
		}else{
			$resp = array(
				'status'=>'error',
				'info'=>'เกิดข้อผิดพลาด',
				'token' => $this->token,
				'hash' => $this->hash
		    );
		}
		
		$this->output
			    ->set_content_type('application/json')
			    ->set_output(json_encode($resp));
	}

	public function status(){
		$id = $this->input->post('id');

		$data = array(
			'status' => $this->input->post('status')
		);

		$get = $this->model_link->status($data,$id);
		if($get){
			$resp = array(
				'status'=>'done',
				'info'=>'แก้ไขข้อมูลเรียบร้อยแล้ว',
				'token' => $this->token,
				'hash' => $this->hash
		    );
		}else{
			$resp = array(
				'status'=>'error',
				'info'=>'เกิดข้อผิดพลาด',
				'token' => $this->token,
				'hash' => $this->hash
		    );
		}
		
		$this->output
			    ->set_content_type('application/json')
			    ->set_output(json_encode($resp));
	}
}
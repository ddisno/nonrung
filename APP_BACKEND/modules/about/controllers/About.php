<?php

class About extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('model_about');
		$this->load->library('upload');
		$this->load->helper('file');
	}

	public function index(){

		$get_data = $this->model_about->list_about(); //เรียบข้อมูลจากตาราง page data เพื่อส่งไปยัง view

		$this->data['data'] = $get_data;

		$this->data['title'] = 'about';
		$this->data['header'] = 'จัดการข้อมูลบริษัท';
		$this->middle = 'about';
		$this->layout();
	}

	public function update(){
		$now = date('Y-m-d H:i:s');
		$text_th = $this->input->post('pay_th');
		$text_en = $this->input->post('pay_en');

		$data = array(
			'company' 			=> htmlspecialchars($this->input->post('company')),
			'tel'				=> htmlspecialchars($this->input->post('tel')),
			'email'				=> htmlspecialchars($this->input->post('email')),
			'text_ad' 			=> htmlspecialchars($this->input->post('text_ad')),
			'map'				=> htmlspecialchars($this->input->post('map')),
			'update_datetime' 	=> $now

		);

		$response = $this->model_about->save($data);
		if($response){
			echo 'success';
		}else{
			echo 'error';
		}
	}

   // start froala
	public function upload(){
		$config['upload_path']          = './asset/backend/uploads/froala';//พาท อัพโหลดไฟล์
        $config['allowed_types']        = '*';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;

        // call config
        $this->upload->initialize($config);
        // --------
        $path_exist = './asset/backend/uploads/froala';
	    if(!is_dir($path_exist)){
	    	mkdir($path_exist);
	    }
        //upload file
        $this->upload->do_upload('fileName');
        // --------

        // ประกาศตัวแปรให้ชื่อไฟล์
        $file_name = $this->upload->data('file_name'); 
        // ---------

        $replace_path = str_replace('./', '', $config['upload_path']); //กำหนด path ใหม่ ให้เป็น root
        $new_path = $this->config->item('root_url').$replace_path.'/'.$file_name;
  
        if ($this->upload->display_errors()) // เช็คอัพโหลดว่า error หรือเปล่า ถ้าไช่
        {
            echo $this->upload->display_errors().$config['upload_path']; //แสดง error
        }
        else
        {
             $data = array(
		        'name_uploads' => $file_name,
		        'link_uploads' => $new_path
		    );

            $link = array(
		        "link" => $new_path
		    );

		    $response = $this->model_about->upload_fl($data);
		    if($response){
		    	echo json_encode($link);
		    }else{
		    	echo $response;
		    }

        }
	}

	public function select(){
		$response = $this->model_about->select_fl();
		if($response){
			echo json_encode($response);
		}
	}

	public function delete(){
		$name = $this->input->post('name');
		$id = $this->input->post('id');
		// -------------------------------
		$path_del = './asset/backend/uploads/froala/'.$name;//พาท อัพโหลดไฟล์

		if(unlink($path_del)){
			$this->model_about->delete_fl($id);
		}
	}
}
<?php

class Logo extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_logo');
		$this->load->library('upload');
	}

	public function index(){
		$get = $this->model_logo->logo_get();
		if($get){
			$this->data['img_path_thumb'] = $this->config->item('base').$get['img_path_thumb'];
		}else{
			$this->data['img_path_thumb'] = $this->config->item('vendor').'img/no_img_sq.jpg';
		}

		$this->data['title'] = 'Logo';
		$this->data['header'] = 'จัดการโลโก้';
		$this->middle = 'logo';
		
		$this->layout();
	}

	public function update(){
		$now = date("Y-m-d H:i:s");// set date to update

	    $path_exist = './asset/backend/uploads/logo';
	    if(!is_dir($path_exist)){
	    	mkdir($path_exist);
	    }

	    $path_exist_thumb = './asset/backend/uploads/logo/thumbnail';
	    if(!is_dir($path_exist_thumb)){
	    	mkdir($path_exist_thumb);
	    }

		if(!empty($_FILES['image']['name'])){ //สำหรับ โลโก้ ไม่จำเป็นต้องมีตรงนี้ก็ได้ เพราะบังคับให้ไส่รูปมาอยู่แล้ว

			$this->model_logo->update_del_old_img();// ลบภาพเดิม

			$config['upload_path']          = './asset/backend/uploads/logo';//พาท อัพโหลดไฟล์
	        $config['allowed_types']        = 'gif|jpg|png|webp';
	        $config['max_size']             = 0;
	        $config['max_width']            = 0;
	        $config['max_height']           = 0;

	        // call config
	        $this->upload->initialize($config);
	        // --------

	        //upload file
	        $this->upload->do_upload('image');
	        // --------
	         
	        $file_name  = $this->upload->data('file_name');  // ประกาศตัวแปรให้ชื่อไฟล์
	        $image_data = $this->upload->data(); // เก็บ array upload data เพื่อส่งไป createthumbnail
	        $this->resize_image($image_data); // เรียกใช้ฟังก์ชั่น resize_image เพื่อสร้าง ภาพ thumbnail โดยส่ง image_data เป็น array ไป
	        $path_thumb = './asset/backend/uploads/logo/thumbnail'; 
	        // ---------

	        $img_path       = str_replace('./', '', $config['upload_path']).'/'.$file_name; //กำหนด path ใหม่ ให้เป็น root
	        $img_path_thumb = str_replace('./', '', $path_thumb).'/'.$file_name; // กำหนด path thumbnail

	        if ($this->upload->display_errors()) // เช็คอัพโหลดว่า error หรือเปล่า ถ้าไช่
	        {
	            echo $this->upload->display_errors().$config['upload_path']; //แสดง error
	            return false;
	        }
	    }

	    $data = array(
			'img_path'        => $img_path,
			'img_path_thumb'  => $img_path_thumb,
			'update_datetime' => $now
		);

		$get = $this->model_logo->logo_update($data);

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

	public function del(){

		$check_row = $this->model_logo->logo_get();
		if(!$check_row){
			echo 'not'; //เช็คการลบ ถ้าไม่มีภาพ จะลบเลยไม่ได้
			return true;
		}

		$get_unlink = $this->model_logo->update_del_old_img();//ลบภาพที่มีอยู่

		$get = $this->model_logo->del(); //ถ้ามีภาพหรือมี record
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

	public function resize_image($image_data){
	    $this->load->library('image_lib');
	    $w = $image_data['image_width']; // original image's width
	    $h = $image_data['image_height']; // original images's height

	    $n_w = 480; // destination image's width
	    $n_h = 360; // destination image's height

	    $source_ratio = $w / $h;
	    $new_ratio = $n_w / $n_h;
	    if($source_ratio != $new_ratio){

	        $config['image_library'] = 'gd2';
	        $config['source_image'] = './asset/backend/uploads/logo/'.$image_data['file_name'];
	        $config['maintain_ratio'] = FALSE;
	        if($new_ratio > $source_ratio || (($new_ratio == 1) && ($source_ratio < 1))){
	            $config['width'] = $w;
	            $config['height'] = round($w/$new_ratio);
	            $config['y_axis'] = round(($h - $config['height'])/2);
	            $config['x_axis'] = 0;

	        } else {

	            $config['width'] = round($h * $new_ratio);
	            $config['height'] = $h;
	            $size_config['x_axis'] = round(($w - $config['width'])/2);
	            $size_config['y_axis'] = 0;

	        }

	        $this->image_lib->initialize($config);
	        // $this->image_lib->crop();
	        $this->image_lib->clear();
	    }
	    $config['image_library'] = 'gd2';
	    $config['source_image'] = './asset/backend/uploads/logo/'.$image_data['file_name'];
	    $config['new_image'] = './asset/backend/uploads/logo/thumbnail/'.$image_data['file_name'];
	    $config['maintain_ratio'] = TRUE;
	    $config['width'] = $n_w;
	    $config['height'] = $n_h;
	    $this->image_lib->initialize($config);

	    if (!$this->image_lib->resize()){

	        echo $this->image_lib->display_errors();

	    } 
	}
}
<?php

class Slide extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('model_slide');
		$this->load->library('upload');
	}

	public function index(){

		$this->data['title'] = 'Slide';
		$this->data['header'] = 'จัดการแบนเนอร์';
		$this->middle = 'slide';
		$this->layout();
	}

	public function slide_list(){
		$get = $this->model_slide->slide_list();
		echo json_encode(array('data'=>$get));
	}

	public function slide_create(){
		$name_th    = htmlspecialchars($this->input->post('name_th'));
		$name_en    = htmlspecialchars($this->input->post('name_en'));
		$text_th    = htmlspecialchars($this->input->post('text_th'));
		$text_en    = htmlspecialchars($this->input->post('text_en'));
		$order_by   = $this->input->post('order_by');
		$status     = $this->input->post('show_slide');
		// check image

	    $path_exist = './asset/backend/uploads/slide';
	    if(!is_dir($path_exist)){
	    	mkdir($path_exist);
	    }

	    $path_exist_thumb = './asset/backend/uploads/slide/thumbnail';
	    if(!is_dir($path_exist_thumb)){
	    	mkdir($path_exist_thumb);
	    }
	    // -------------------------------------------------
	    if(!empty($_FILES['image']['name'])){
			$config['upload_path']          = './asset/backend/uploads/slide';//พาท อัพโหลดไฟล์
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
	        $img_path   = str_replace('./', '', $config['upload_path']).'/'.$file_name; //กำหนด path ใหม่ ให้เป็น root
	        $img_path_thumb = '';

	        if ($this->upload->display_errors()) // เช็คอัพโหลดว่า error หรือเปล่า ถ้าไช่
	        {
	            echo $this->upload->display_errors().$config['upload_path']; //แสดง error
	            return false;
	        }
		}else{
			$img_path = '';
			$img_path_thumb = '';
		}

		if($order_by==''){
			$get_order = $this->model_slide->slide_get_order();
			if($get_order){
				$order_by = $get_order + 1;
			}else{
				$order_by = 1;
			}
		}

		$data = array(
			'name_th'        => $name_th,
			'name_en'        => $name_en,
			'text_th'        => $text_th,
			'text_en'        => $text_en,
			'img_path' 	     => $img_path,
			'img_path_thumb' => $img_path_thumb,
			'order_by' 	     => $order_by,
			'status'     => $status
		);

		$get = $this->model_slide->slide_create($data);
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'เพิ่มแบนเนอร์เรียบร้อยแล้ว',
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

	public function slide_update(){
		$now = date("Y-m-d H:i:s");// set date to update

		$name_th    = htmlspecialchars($this->input->post('name_th'));
		$name_en    = htmlspecialchars($this->input->post('name_en'));
		$text_th    = htmlspecialchars($this->input->post('text_th'));
		$text_en    = htmlspecialchars($this->input->post('text_en'));
		$order_by   = $this->input->post('order_by');
		$status     = $this->input->post('show_slide');
		$id_slide   = $this->input->post('id');
		// check image

	    $path_exist = './asset/backend/uploads/slide';
	    if(!is_dir($path_exist)){
	    	mkdir($path_exist);
	    }

	    $path_exist_thumb = './asset/backend/uploads/slide/thumbnail';
	    if(!is_dir($path_exist_thumb)){
	    	mkdir($path_exist_thumb);
	    }

		if(!empty($_FILES['image']['name'])){
			// ลบภาพเดิม
			$this->model_slide->update_del_old_img($id_slide);

			$config['upload_path']          = './asset/backend/uploads/slide';//พาท อัพโหลดไฟล์
	        $config['allowed_types']        = 'gif|jpg|png';
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
	        $img_path   = str_replace('./', '', $config['upload_path']).'/'.$file_name; //กำหนด path ใหม่ ให้เป็น root
	        $img_path_thumb = '';

	        if ($this->upload->display_errors()) // เช็คอัพโหลดว่า error หรือเปล่า ถ้าไช่
	        {
	            echo $this->upload->display_errors().$config['upload_path']; //แสดง error
	            return false;
	        }

	        $data = array(
				'name_th'         => $name_th,
				'name_en'  		  => $name_en,
				'text_th'  		  => $text_th,
				'text_en' 		  => $text_en,
				'order_by'   	  => $order_by,
				'update_datetime' => $now,
				'status' 		  => $status,
				'img_path'        => $img_path,
				'img_path_thumb'  => $img_path_thumb
			);
		}else{
			$data = array(
				'name_th'         => $name_th,
				'name_en'         => $name_en,
				'text_th'         => $text_th,
				'text_en'         => $text_en,
				'update_datetime' => $now,
				'order_by'   	  => $order_by,
				'update_datetime' => $now,
				'status' 		  => $status,
			);
		}

		

		$get = $this->model_slide->slide_update($data,$id_slide);
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'แก้ไขแบนเนอร์เรียบร้อยแล้ว',
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

	public function slide_del(){
		$id = $this->input->post('id_slide');
		$get = $this->model_slide->slide_del($id);

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

	public function slide_delmulti(){
		if(empty($this->input->post('chk_slide'))){
			return false;
		}

		$id = $this->input->post('chk_slide');
		$get = $this->model_slide->slide_delmulti($id);

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

	public function slide_order_by(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$order_by = $this->input->post('data');

		$data = array(
			'order_by' => $order_by,
			'update_datetime' => $now
		);

		$get = $this->model_slide->slide_order_by($data,$id);
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

	public function slide_status(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$status = $this->input->post('data');

		$data = array(
			'status' => $status,
			'update_datetime' => $now
		);

		$get = $this->model_slide->slide_status($data,$id);
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
	        $config['source_image'] = './asset/backend/uploads/slide/'.$image_data['file_name'];
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
	    $config['source_image'] = './asset/backend/uploads/slide/'.$image_data['file_name'];
	    $config['new_image'] = './asset/backend/uploads/slide/thumbnail/'.$image_data['file_name'];
	    $config['maintain_ratio'] = TRUE;
	    $config['width'] = $n_w;
	    $config['height'] = $n_h;
	    $this->image_lib->initialize($config);

	    if (!$this->image_lib->resize()){

	        echo $this->image_lib->display_errors();

	    } 
	}
}
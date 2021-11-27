<?php

class Pictures extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_pictures');
		$this->load->library('upload');
	}

	public $value;

	public function index(){

		$this->data['albums'] = $this->model_pictures->album_list();

		$this->data['title'] = 'Product Manage';
		$this->data['header'] = 'จัดการรูปภาพ';
		$this->middle = 'manage';
		$this->layout();	
	}

	public function album(){

		$this->data['title'] = 'Product Manage';
		$this->data['header'] = 'จัดการอัลบั้ม';
		$this->middle = 'album';
		$this->layout();	
	}

	// command pictures
	##### fetch picture
	public function pictures_fetch_list(){
		if(null!==$this->input->get('id_album')){		
			$id = $this->input->get('id_album');
		}else{
			$id = '';
		}
		$get = $this->model_pictures->pictures_fetch_list($id);
		echo json_encode($get);
	}

	public function pictures_del(){
		$id  = $this->input->post('id_img');
		$get = $this->model_pictures->pictures_del($id);

		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'ลบข้อมูลเรียบร้อยแล้ว',
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

	public function pictures_delmulti(){
		if(empty($this->input->post('chk_pictures'))){
			return false;
		}

		$id = $this->input->post('chk_pictures');
		$del = $this->model_pictures->pictures_delmulti($id);
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'ลบข้อมูลเรียบร้อยแล้ว',
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

	public function pictures_del_soft(){
		$now = date('Y-m-d H:i:s');
		$id  = $this->input->post('id_pictures');
		
		$data = array(
			'delete_datetime' => $now
		);

		$get = $this->model_pictures->pictures_del_soft($data,$id);
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'ลบข้อมูลเรียบร้อยแล้ว',
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

	public function pictures_delmulti_soft(){
		$now = date('Y-m-d H:i:s');
		if(empty($this->input->post('chk_pictures'))){
			return false;
		}

		$data = array(
			'delete_datetime' => $now
		);

		$id = $this->input->post('chk_pictures');
		$del = $this->model_pictures->pictures_delmulti_soft($data,$id);
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'ลบข้อมูลเรียบร้อยแล้ว',
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

	public function pictures_order_by(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$order_by = $this->input->post('data');

		$data = array(
			'order_by' => $order_by,
			'update_datetime' => $now
		);

		$get = $this->model_pictures->pictures_order_by($data,$id);
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'แก้ไขข้อมูลเรียบร้อยแล้ว',
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

	public function pictures_status(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$status = $this->input->post('data');

		$data = array(
			'status' => $status,
			'update_datetime' => $now
		);

		$get = $this->model_pictures->pictures_status($data,$id);
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'แก้ไขข้อมูลเรียบร้อยแล้ว',
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

	public function pictures_img_del(){
		$id = $this->input->post('id_img');
		$get = $this->model_pictures->pictures_img_del($id);
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'แก้ไขข้อมูลเรียบร้อยแล้ว',
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

	public function pictures_img_status(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$status = $this->input->post('data');

		$data = array(
			'status_img' => $status,
			'update_datetime' => $now
		);

		$get = $this->model_pictures->pictures_img_status($data,$id);
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'แก้ไขข้อมูลเรียบร้อยแล้ว',
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

	// upload img
	public function pictures_uploads(){
		$path_exist = './asset/backend/uploads/album_pic';
	    if(!is_dir($path_exist)){
	    	mkdir($path_exist);
	    }

	    $path_exist_album = './asset/backend/uploads/album_pic/'.$this->input->post('id_album');
	    if(!is_dir($path_exist_album)){
	    	mkdir($path_exist_album);
	    }
	    // path exist
	    $path_exist_thumb = './asset/backend/uploads/album_pic/'.$this->input->post('id_album').'/thumbnail';
	    if(!is_dir($path_exist_thumb)){
	    	mkdir($path_exist_thumb);
	    }
	    // -------------------------------------------------

		if(!empty($_FILES['image']['name'])){
			$config['upload_path']          = './asset/backend/uploads/album_pic/'.$this->input->post('id_album');//พาท อัพโหลดไฟล์
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
	        $path_thumb = './asset/backend/uploads/album_pic/'.$this->input->post('id_album').'/thumbnail'; 
	        // ---------

	        $img_path        = str_replace('./', '', $config['upload_path']).'/'.$file_name; //กำหนด path ใหม่ ให้เป็น root
	        $img_path_thumb  = str_replace('./', '', $path_thumb).'/'.$file_name; // กำหนด path thumbnail

	        if ($this->upload->display_errors()) // เช็คอัพโหลดว่า error หรือเปล่า ถ้าไช่
	        {
	            echo $this->upload->display_errors().$config['upload_path']; //แสดง error
	            return false;
	        }
		}else{
			$img_path = '';
			$img_path_thumb = '';
		}

		$get_order = $this->model_pictures->pictures_get_order_img($this->input->post('id_album'));
		if($get_order){
			$order_by = $get_order + 1;
		}else{
			$order_by = 1;
		}

		$data = array(
			'name_img'  => $this->upload->data('file_name'),
			'size'  => $this->upload->data('file_size'),
			'type' => $this->upload->data('image_type'),
			'order_by_img'  => $order_by,
			'img_path' => $img_path,
			'img_path_thumb' => $img_path_thumb,
			'id_album' => $this->input->post('id_album')
		);

		$get = $this->model_pictures->pictures_img_save($data);
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'',
	          'token' => $this->token,
	          'hash' => $this->hash
	          );
	    }else{
	        $json = array(
	          'status'=>'error',
	          'info'=>'',
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
	        $config['source_image'] = './asset/backend/uploads/album_pic/'.$this->input->post('id_album').'/'.$image_data['file_name'];
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
	    $config['source_image'] = './asset/backend/uploads/album_pic/'.$this->input->post('id_album').'/'.$image_data['file_name'];
	    $config['new_image'] = './asset/backend/uploads/album_pic/'.$this->input->post('id_album').'/thumbnail/'.$image_data['file_name'];
	    $config['maintain_ratio'] = TRUE;$this->input->post('id_album');
	    $config['width'] = $n_w;
	    $config['height'] = $n_h;
	    $this->image_lib->initialize($config);

	    if (!$this->image_lib->resize()){

	        echo $this->image_lib->display_errors();

	    } 
	}

	// start album
	public function album_list(){
		$get = $this->model_pictures->album_list();
		echo json_encode(array('data'=>$get));
	}

	public function album_create(){
		$name_th = $this->input->post('name_th');
		$name_en = $this->input->post('name_en');

		$get_order = $this->model_pictures->get_order_pictures_album();
		if($get_order){
			$order_by = $get_order + 1;
		}else{
			$order_by = 1;
		}

		$data = array(
			'name_album_th' => $name_th,
			'name_album_en' => $name_en,
			'order_by_album'  => $order_by
		);

		$get = $this->model_pictures->album_create($data);
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'แก้ไขข้อมูลเรียบร้อยแล้ว',
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

	public function album_edit(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id      = $this->input->post('id');
		$name_th = $this->input->post('name_th');
		$name_en = $this->input->post('name_en');

		$data = array(
			'name_album_th'     => $name_th,
			'name_album_en' 	  => $name_en,
			'update_datetime' => $now
		);

		$get = $this->model_pictures->album_edit($data,$id);
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'แก้ไขข้อมูลเรียบร้อยแล้ว',
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

	public function album_del(){
		$id  = $this->input->post('id_album');
		$get = $this->model_pictures->album_del($id);

		if($get=='success'){
			$json = array(
	          'status'=>'done',
	          'info'=>'แก้ไขข้อมูลเรียบร้อยแล้ว',
	          'token' => $this->token,
	          'hash' => $this->hash
	          );
		}elseif($get=='already'){
			$json = array(
	          'status'=>'already',
	          'info'=>'',
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

	public function album_delmulti(){
		$id  = $this->input->post('chk_album');

		if(!empty($id)){
			$get = $this->model_pictures->album_delmulti($id);
			if($get){
		        $json = array(
		          'status'=>'done',
		          'info'=>'ลบข้อมูลเรียบร้อยแล้ว',
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
		}else{
			return false;
		}			

		$this->output
        		->set_content_type('application/json')
        		->set_output(json_encode($json));
	}

	public function album_order_by(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$order_by = $this->input->post('data');

		$data = array(
			'order_by_album' => $order_by,
			'update_datetime' => $now
		);

		$get = $this->model_pictures->order_by_album($data,$id);
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'แก้ไขข้อมูลเรียบร้อยแล้ว',
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

	public function album_status(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$status = $this->input->post('data');

		$data = array(
			'status_album' => $status,
			'update_datetime' => $now
		);

		$get = $this->model_pictures->album_status($data,$id);
		if($get){
	        $json = array(
	          'status'=>'done',
	          'info'=>'แก้ไขข้อมูลเรียบร้อยแล้ว',
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


}
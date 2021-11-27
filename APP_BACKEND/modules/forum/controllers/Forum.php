<?php
/**
 * 
 */
class Forum extends MY_Controller
{
	// start view
	public function __construct(){
		parent::__construct();
		$this->load->model('model_forum');
		$this->load->library('upload');
		$this->load->helper('file');
	}

	public function index(){
		
		$this->data['title'] = 'forum Manage';
		$this->data['header'] = 'กระทู้ถามตอบ / เรื่องร้องทุกข์';
		$this->middle = 'manage';
		$this->layout();
	}

	public function view($id=''){
		$get = $this->model_forum->fetch_edit();

		$this->data['title'] = 'forum view';
		$this->data['header'] = 'รายการแสดงความคิดเห็น';
		$this->data['data']   = $get;
		$this->middle = 'view';
		$this->layout();
	}
	// --------- end view-------------------------------

	// start model forum
	public function forum_list(){
		$get = $this->model_forum->forum_list();
		echo json_encode(array('data'=>$get));
	}

	public function forum_list_stick(){
		$get = $this->model_forum->forum_list_stick();
		echo json_encode(array('data'=>$get));
	}

	public function create_forum(){
		$name_th  = htmlspecialchars($this->input->post('name_th'));
		$name_en  = htmlspecialchars($this->input->post('name_en'));
		$para_th  = htmlspecialchars($this->input->post('para_th'));
		$para_en  = htmlspecialchars($this->input->post('para_en'));
		$text_th  = htmlspecialchars($this->input->post('text_th'));
		$text_en  = htmlspecialchars($this->input->post('text_en'));
		$category = $this->input->post('category');
		// check image

	    $path_exist = './asset/backend/uploads/forum';
	    if(!is_dir($path_exist)){
	    	mkdir($path_exist);
	    }
	    // -------------------------------------------------
	    // path exist
	    $path_exist_thumb = './asset/backend/uploads/forum/thumbnail';
	    if(!is_dir($path_exist_thumb)){
	    	mkdir($path_exist_thumb);
	    }
	    // -------------------------------------------------

		if(!empty($_FILES['image']['name'])){
			$config['upload_path']          = './asset/backend/uploads/forum';//พาท อัพโหลดไฟล์
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
	        $path_thumb = './asset/backend/uploads/forum/thumbnail'; 
	        // ---------

	        $replace_path       = str_replace('./', '', $config['upload_path']); //กำหนด path ใหม่ ให้เป็น root
	        $replace_path_thumb = str_replace('./', '', $path_thumb); // กำหนด path thumbnail
	        $img_path           = $this->config->item('root_url').$replace_path.'/'.$file_name;
	        $img_path_thumb     = $this->config->item('root_url').$replace_path_thumb.'/'.$file_name;

	        if ($this->upload->display_errors()) // เช็คอัพโหลดว่า error หรือเปล่า ถ้าไช่
	        {
	            echo $this->upload->display_errors().$config['upload_path']; //แสดง error
	            return false;
	        }
		}else{
			$img_path = '';
			$img_path_thumb = '';
		}

		$get_order = $this->model_forum->get_order_forum();
		if($get_order){
			$order_by = $get_order + 1;
		}else{
			$order_by = 1;
		}

		$data = array(
			'name_th'  => $name_th,
			'name_en'  => $name_en,
			'text_th'  => $text_th,
			'text_en'  => $text_en,
			'para_th'  => $para_th,
			'para_en'  => $para_en,
			'id_cat'   => $category,
			'img_path' => $img_path,
			'img_path_thumb' => $img_path_thumb,
			'order_by' => $order_by
		);

		$get = $this->model_forum->save_forum($data);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function forum_edit(){
		$now = date("Y-m-d H:i:s");// set date to update
		$name_th  = htmlspecialchars($this->input->post('name_th'));
		$name_en  = htmlspecialchars($this->input->post('name_en'));
		$text_th  = htmlspecialchars($this->input->post('text_th'));
		$text_en  = htmlspecialchars($this->input->post('text_en'));
		$para_th  = htmlspecialchars($this->input->post('para_th'));
		$para_en  = htmlspecialchars($this->input->post('para_en'));
		$category = $this->input->post('category');
		$id_forum  = $this->input->post('id_forum');
		// check image

		$path_exist = './asset/backend/uploads/forum';
	    if(!is_dir($path_exist)){
	    	mkdir($path_exist);
	    }

		if(!empty($_FILES['image']['name'])){
			// ลบภาพเดิม
			$this->model_forum->del_img($id_forum);

			$config['upload_path']          = './asset/backend/uploads/forum';//พาท อัพโหลดไฟล์
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

	        
	        $file_name = $this->upload->data('file_name'); // ประกาศตัวแปรให้ชื่อไฟล์
	        $image_data = $this->upload->data(); // เก็บ array upload data เพื่อส่งไป createthumbnail
	        $this->resize_image($image_data); // เรียกใช้ฟังก์ชั่น resize_image เพื่อสร้าง ภาพ thumbnail โดยส่ง image_data เป็น array ไป
	        $path_thumb = './asset/backend/uploads/forum/thumbnail'; 
	        // ---------

	        $replace_path = str_replace('./', '', $config['upload_path']); //กำหนด path ใหม่ ให้เป็น root
			$replace_path_thumb = str_replace('./', '', $path_thumb); // กำหนด path thumbnail
	        $img_path = $this->config->item('root_url').$replace_path.'/'.$file_name;
	        $img_path_thumb     = $this->config->item('root_url').$replace_path_thumb.'/'.$file_name;

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
				'para_th'         => $para_th,
				'para_en'         => $para_en,
				'id_cat'   		  => $category,
				'update_datetime' => $now,
				'img_path'        => $img_path,
				'img_path_thumb'  => $img_path_thumb
			);
		}else{
			$data = array(
				'name_th'  => $name_th,
				'name_en'  => $name_en,
				'text_th'  => $text_th,
				'text_en'  => $text_en,
				'para_th'  => $para_th,
			    'para_en'  => $para_en,
				'update_datetime' => $now,
				'id_cat'   => $category
			);
		}

		

		$get = $this->model_forum->edit_forum($data,$id_forum);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function forum_del(){
		$id = $this->input->post('id_topic');
		$get = $this->model_forum->forum_del($id);

		if($get){
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'success')));
		}else{
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'error')));
		}
	}

	public function forum_delmulti(){
		// ดักไว้สำหรับกรณีมีการเลียกใช้ แต่ไม่มีค่าเข้ามา
		if(empty($this->input->post('chk_forum'))){
			return false;
		}

		$id = $this->input->post('chk_forum');
		$get = $this->model_forum->forum_delmulti($id);

		if($get){
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'success')));
		}else{
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'error')));
		}
	}

	public function forum_order_by(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$order_by = $this->input->post('data');

		$data = array(
			'order_by' => $order_by,
			'update_datetime' => $now
		);

		$get = $this->model_forum->order_by($data,$id);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function forum_order_by_stick(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$order_by_stick = $this->input->post('data');

		$data = array(
			'order_by_stick' => $order_by_stick,
			'update_datetime' => $now
		);

		$get = $this->model_forum->order_by_stick($data,$id);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function forum_status(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$status = $this->input->post('data');

		$data = array(
			'status' => $status,
			'verify_datetime' => $now
		);

		$get = $this->model_forum->forum_status($data,$id);
		if($get){
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'success')));
		}else{
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'error')));
		}
	}

	public function forum_stick(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$stick = $this->input->post('data');

		$data = array(
			'stick' => $stick,
			'update_datetime' => $now
		);

		$get = $this->model_forum->forum_stick($data,$id);
		if($get){
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'success')));
		}else{
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'error')));
		}
	}

	// end forum


	// comment list เ
	public function comment_list(){
		$id = $this->uri->segment(3);
		$get = $this->model_forum->comment_list($id);
		echo json_encode(array('data'=>$get));
	}

	public function comment_create(){
		$name_th = $this->input->post('name_th');
		$name_en = $this->input->post('name_en');

		$get_order = $this->model_forum->get_order_forum_cat();
		if($get_order){
			$order_by = $get_order + 1;
		}else{
			$order_by = 1;
		}

		$data = array(
			'name_cat_th' => $name_th,
			'name_cat_en' => $name_en,
			'order_by_cat'  => $order_by
		);

		$get = $this->model_forum->cat_create($data);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function comment_del(){
		$id = $this->input->post('id_comment');
		$get = $this->model_forum->comment_del($id);

		if($get){
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'success')));
		}else{
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'error')));
		}
	}

	public function comment_delmulti(){
		// ดักไว้สำหรับกรณีมีการเลียกใช้ แต่ไม่มีค่าเข้ามา
		if(empty($this->input->post('chk_comment'))){
			return false;
		}

		$id = $this->input->post('chk_comment');
		$get = $this->model_forum->comment_delmulti($id);

		if($get){
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'success')));
		}else{
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'error')));
		}
	}

	public function comment_status(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id_comment   = $this->input->post('id');
		$id_topic  = $this->input->post('id_topic');
		$status = $this->input->post('data');

		$data = array(
			'status' => $status,
			'verify_datetime' => $now
		);

		$get = $this->model_forum->comment_status($data,$id_comment,$id_topic);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function comment_stick(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$stick = $this->input->post('data');
		if($stick==0){
			$number = 0;
		}else{
			$number = 0;
		}

		$data = array(
			'stick' => $stick,
			'update_datetime' => $now,
			'order_by'=> $number
		);

		$get = $this->model_forum->comment_stick($data,$id);
		if($get){
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'success')));
		}else{
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'error')));
		}
	}

	public function comment_order_by(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id_comment   = $this->input->post('id_comment');
		$id_topic  = $this->input->post('id_topic');
		$order_by = $this->input->post('data');

		$data = array(
			'order_by' => $order_by,
			'update_datetime' => $now
		);

		$get = $this->model_forum->comment_order_by($data,$id_comment,$id_topic);
		if($get){
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'success')));
		}else{
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status' => 'error')));
		}
	}




	public function cat_edit(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id      = $this->input->post('id');
		$name_th = $this->input->post('name_th');
		$name_en = $this->input->post('name_en');

		$data = array(
			'name_cat_th'     => $name_th,
			'name_cat_en' 	  => $name_en,
			'update_datetime' => $now
		);

		$get = $this->model_forum->cat_edit($data,$id);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
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
	        $config['source_image'] = './asset/backend/uploads/forum/'.$image_data['file_name'];
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
	    $config['source_image'] = './asset/backend/uploads/forum/'.$image_data['file_name'];
	    $config['new_image'] = './asset/backend/uploads/forum/thumbnail/'.$image_data['file_name'];
	    $config['maintain_ratio'] = TRUE;
	    $config['width'] = $n_w;
	    $config['height'] = $n_h;
	    $this->image_lib->initialize($config);

	    if (!$this->image_lib->resize()){

	        echo $this->image_lib->display_errors();

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

		    $response = $this->model_forum->upload_fl($data);
		    if($response){
		    	echo json_encode($link);
		    }else{
		    	echo $response;
		    }

        }
	}

	public function select(){
		$response = $this->model_forum->select_fl();
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
			$this->model_forum->delete_fl($id);
		}
	}

	
}

		
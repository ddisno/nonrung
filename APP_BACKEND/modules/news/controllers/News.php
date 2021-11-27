<?php
/**
 * 
 */
class News extends MY_Controller
{
	// start view
	public function __construct(){
		parent::__construct();
		$this->load->model('model_news');
		$this->load->library('upload');
		$this->load->helper('file');
	}

	public function index(){
		
		$this->data['title'] = 'ข่าวสารประชาสัมพันธ์ อบต.';
		$this->data['header'] = 'ข่าวสารประชาสัมพันธ์ อบต.';
		$this->middle = 'manage';
		$this->layout();
	}

	public function create($id=''){
		if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){

	     	$title  = htmlspecialchars($this->input->post('title'));
			$text  = htmlspecialchars($this->input->post('text'));

			// check image

			$get_order = $this->model_news->get_order_news();
			if($get_order){
				$order_by = $get_order + 1;
			}else{
				$order_by = 1;
			}

			$path_exist = './asset/backend/uploads/news';
		    if(!is_dir($path_exist)){
		    	mkdir($path_exist);
		    }
		    // -------------------------------------------------
		    // path exist
		    $path_exist_thumb = './asset/backend/uploads/news/thumbnail';
		    if(!is_dir($path_exist_thumb)){
		    	mkdir($path_exist_thumb);
		    }
		    // -------------------------------------------------

			if(!empty($_FILES['image']['name'])){
				$config['upload_path']          = './asset/backend/uploads/news';//พาท อัพโหลดไฟล์
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
		        $path_thumb = './asset/backend/uploads/news/thumbnail'; 
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

			$data = array(
				'title'  => $title,
				'text'  => $text,
				'img_path' => $img_path,
				'img_path_thumb' => $img_path_thumb,
				'order_by' => $order_by
			);

	        $get = $this->model_news->save_news($data);
	        if($get){
	          $this->session->set_flashdata('message', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
	        }else{
	          $this->session->set_flashdata('message', 'เกิดปัญหากับระบบ dbs');
	        }
	    }

		$this->data['title'] = 'news Create';
		$this->data['header'] = 'เพิ่มข่าวสารประชาสัมพันธ์ อบต.';
		$this->middle = 'create';
		$this->layout();
	}

	public function edit($id=''){
		if($get = $this->db->where('id',$this->uri->segment(3))->get('news')->num_rows()==''){
	      redirect('news');
	    }
    
	    // $result = $get->row_array();
	    if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){
			$now = date("Y-m-d H:i:s");// set date to update
			$title  = htmlspecialchars($this->input->post('title'));
			$text  = htmlspecialchars($this->input->post('text'));
			$category = $this->input->post('category');
			$id  = $this->input->post('id');
			// check image
			if(!empty($_FILES['image']['name'])){
				// ลบภาพเดิม
				$this->model_news->del_img($id);

				$config['upload_path']          = './asset/backend/uploads/news';//พาท อัพโหลดไฟล์
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
		        $path_thumb = './asset/backend/uploads/news/thumbnail'; 
		        // ---------

		        $img_path  		    = str_replace('./', '', $config['upload_path']).'/'.$file_name; //กำหนด path ใหม่ ให้เป็น root
				$img_path_thumb     = str_replace('./', '', $path_thumb).'/'.$file_name; // กำหนด path thumbnail

		        if ($this->upload->display_errors()) // เช็คอัพโหลดว่า error หรือเปล่า ถ้าไช่
		        {
		            echo $this->upload->display_errors().$config['upload_path']; //แสดง error
		            return false;
		        }

		        $data = array(
					'title'         => $title,
					'text'  		  => $text,
					'update_datetime' => $now,
					'img_path'		  => $img_path,
					'img_path_thumb'  => $img_path_thumb
				);
			}else{
				$data = array(
					'title'         => $title,
					'text'  		  => $text,
					'update_datetime' => $now,
				);
			}

			$get = $this->model_news->edit_news($data,$id);
			if($get){
	          $this->session->set_flashdata('message', 'แก้ไขเรียบร้อยแล้ว');
	        }else{
	          $this->session->set_flashdata('message', 'เกิดปัญหากับระบบ dbs');
	        }  
	    }

	    $this->data['info'] = $this->db->where('id',$this->uri->segment(3))->get('news')->row_array();
		$this->data['title'] = 'news Edit';
		$this->data['header'] = 'แก้ไข';
		$this->middle = 'edit';
		$this->layout();
	}
	// --------- end view-------------------------------

	// start model news
	public function news_list(){
		$val = $this->input->get('daterange-input');
		$get = $this->model_news->news_list($val);
		echo json_encode(array('data'=>$get));
	}


	public function news_del(){
		$id = $this->input->post('id');
		$this->db->select('*');
			$this->db->where('id',$id);
			$query = $this->db->get('news');
			$result = $query->row();
			if($result->img_path != ''){
				$old_path = $result->img_path;
				$old_path_thumb = $result->img_path_thumb;
				//delete file
				$new_path = './'.$old_path;
				$new_path_thumb = './'.$old_path_thumb;
				unlink($new_path);
				unlink($new_path_thumb);
				// ---------
				$get = $this->model_news->news_del($id);
				if($get){
					echo 'success';
				}else{
					echo 'error';
				}
			}else{
				$get = $this->model_news->news_del($id);
				if($get){
					echo 'success';
				}else{
					echo 'error';
				}
			}
	}

	public function news_delmulti(){
		if(empty($this->input->post('chk_news'))){
			return false;
		}

		$data = $this->input->post('chk_news');
		    for ($i = 0; $i < count($data); $i++)
		    {	        	
		        	$this->db->select('*');
					$this->db->where('id',$data[$i]);
					$query = $this->db->get('news');
					$result = $query->row();
					if($result->img_path != ''){
						$old_path = $result->img_path;
						$old_path_thumb = $result->img_path_thumb;
						//delete file
						$new_path = str_replace($this->config->item('root_url'), './', $old_path);
						$new_path_thumb = str_replace($this->config->item('root_url'), './', $old_path_thumb);
						unlink($new_path);
						unlink($new_path_thumb);
					}
			        $del = $this->db->where('id', $data[$i])->delete('news');
		    }
		if($del){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function news_order_by(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$order_by = $this->input->post('data');

		$data = array(
			'order_by' => $order_by,
			'update_datetime' => $now
		);

		$get = $this->model_news->order_by($data,$id);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}


	public function news_status(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$status = $this->input->post('data');

		$data = array(
			'status' => $status,
			'update_datetime' => $now
		);

		$get = $this->model_news->news_status($data,$id);
		if($get){
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
        $new_path = $this->config->item('base').$replace_path.'/'.$file_name;
  
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
		        "link" => $new_path,
		        // 'token' => $this->token,
          // 		'hash' => $this->hash
		    );

		    $response = $this->model_news->upload_fl($data);
		    if($response){
		    	echo json_encode($link);
		    }else{
		    	echo $response;
		    }

        }
	}

	public function select(){
		$response = $this->model_news->select_fl();
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
			$this->model_news->delete_fl($id);
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
	        $config['source_image'] = './asset/backend/uploads/news/'.$image_data['file_name'];
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
	    $config['source_image'] = './asset/backend/uploads/news/'.$image_data['file_name'];
	    $config['new_image'] = './asset/backend/uploads/news/thumbnail/'.$image_data['file_name'];
	    $config['maintain_ratio'] = TRUE;
	    $config['width'] = $n_w;
	    $config['height'] = $n_h;
	    $this->image_lib->initialize($config);

	    if (!$this->image_lib->resize()){

	        echo $this->image_lib->display_errors();

	    } 
	}
	
}

		
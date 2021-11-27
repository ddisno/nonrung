<?php
/**
 * 
 */
class Blog extends MY_Controller
{
	// start view
	public function __construct(){
		parent::__construct();
		$this->load->model('model_blog');
		$this->load->library('upload');
		$this->load->helper('file');
	}

	public function municipal_news(){
		
		$this->data['title'] = 'ข่าวประชาสัมพันธ์ของเทศบาล';
		$this->data['header'] = 'ข่าวประชาสัมพันธ์ของเทศบาล';
		$this->middle = 'municipal_news';
		$this->layout();
	}

	public function purchase($id=''){

		$this->data['title'] = 'จัดซื้อจัดจ้าง';
		$this->data['header'] = 'จัดซื้อจัดจ้าง';
		$this->middle = 'purchase';
		$this->layout();
	}

	public function other_news($id=''){

		$this->data['title'] = 'ข่าวประชาสัมพันธ์จากหน่วยงานอื่น';
		$this->data['header'] = 'ข่าวประชาสัมพันธ์จากหน่วยงานอื่น';
		$this->middle = 'other_news';
		$this->layout();
	}

	public function facilitation($id=''){

		$this->data['title'] = 'พ.ร.บ.การอำนวยความสะดวก';
		$this->data['header'] = 'พ.ร.บ.การอำนวยความสะดวก';
		$this->middle = 'facilitation';
		$this->layout();
	}

	public function create($id=''){

		$this->data['cats'] = $this->model_blog->cat_list();

		$this->data['title'] = 'Blog Create';
		$this->data['header'] = 'เพิ่มข่าวสาร';
		$this->middle = 'create';
		$this->layout();
	}

	public function sticky($id=''){

		$this->data['title'] = 'Blog Manage Sticky';
		$this->data['header'] = 'จัดการข่าวสารปักหมุด';
		$this->middle = 'sticky';
		$this->layout();
	}

	public function category($id=''){

		$this->data['title'] = 'Blog Category';
		$this->data['header'] = 'จัดการหมวดหมู่';
		$this->middle = 'category';
		$this->layout();
	}

	public function edit($id=''){
		$get = $this->model_blog->fetch_edit();
		if($get){
			$this->data['id_blog']     = $get['id_blog'];
			$this->data['name_en'] 	   = $get['name_en'];
			$this->data['name_th']     = $get['name_th'];
			$this->data['text_th']     = $get['text_th'];
			$this->data['text_en']     = $get['text_en'];
			$this->data['para_th']     = $get['para_th'];
			$this->data['para_en']     = $get['para_en'];
			$this->data['img_path']    = $get['img_path'];
			$this->data['name_cat_th'] = $get['name_cat_th'];
			$this->data['id_cat']      = $get['id_cat'];
			$this->data['cats'] 	   = $this->model_blog->cat_list();
		}else{
			redirect('blog');
		}

		$this->data['title'] = 'Blog Edit';
		$this->data['header'] = 'แก้ไข';
		$this->middle = 'edit';
		$this->layout();
	}
	// --------- end view-------------------------------

	// start model blog
	public function blog_list(){
		$id  = $this->uri->segment(3);
		$val = $this->input->get('daterange-input');
		$get = $this->model_blog->blog_list($id,$val);
		echo json_encode(array('data'=>$get));
	}

	public function blog_list_stick(){
		$id  = $this->uri->segment(3);
		$get = $this->model_blog->blog_list_stick($id);
		echo json_encode(array('data'=>$get));
	}

	public function create_blog(){
		$name_th  = htmlspecialchars($this->input->post('name_th'));
		$name_en  = htmlspecialchars($this->input->post('name_en'));
		$para_th  = htmlspecialchars($this->input->post('para_th'));
		$para_en  = htmlspecialchars($this->input->post('para_en'));
		$text_th  = htmlspecialchars($this->input->post('text_th'));
		$text_en  = htmlspecialchars($this->input->post('text_en'));
		$category = $this->input->post('category');
		// check image

	    $path_exist = './asset/backend/uploads/blog';
	    if(!is_dir($path_exist)){
	    	mkdir($path_exist);
	    }
	    // -------------------------------------------------
	    // path exist
	    $path_exist_thumb = './asset/backend/uploads/blog/thumbnail';
	    if(!is_dir($path_exist_thumb)){
	    	mkdir($path_exist_thumb);
	    }
	    // -------------------------------------------------

		if(!empty($_FILES['image']['name'])){
			$config['upload_path']          = './asset/backend/uploads/blog';//พาท อัพโหลดไฟล์
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
	        $path_thumb = './asset/backend/uploads/blog/thumbnail'; 
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

		$get_order = $this->model_blog->get_order_blog();
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

		$get = $this->model_blog->save_blog($data);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function blog_edit(){
		$now = date("Y-m-d H:i:s");// set date to update
		$name_th  = htmlspecialchars($this->input->post('name_th'));
		$name_en  = htmlspecialchars($this->input->post('name_en'));
		$text_th  = htmlspecialchars($this->input->post('text_th'));
		$text_en  = htmlspecialchars($this->input->post('text_en'));
		$para_th  = htmlspecialchars($this->input->post('para_th'));
		$para_en  = htmlspecialchars($this->input->post('para_en'));
		$category = $this->input->post('category');
		$id_blog  = $this->input->post('id_blog');
		// check image

		$path_exist = './asset/backend/uploads/blog';
	    if(!is_dir($path_exist)){
	    	mkdir($path_exist);
	    }

		if(!empty($_FILES['image']['name'])){
			// ลบภาพเดิม
			$this->model_blog->del_img($id_blog);

			$config['upload_path']          = './asset/backend/uploads/blog';//พาท อัพโหลดไฟล์
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
	        $path_thumb = './asset/backend/uploads/blog/thumbnail'; 
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

		

		$get = $this->model_blog->edit_blog($data,$id_blog);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function blog_del(){
		$id = $this->input->post('id_blog');
		$get = $this->model_blog->blog_del($id);

		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function blog_delmulti(){
		if(empty($this->input->post('chk_blog'))){
			return false;
		}

		$id = $this->input->post('chk_blog');
		$del = $this->model_blog->blog_delmulti($id);
		if($del){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function blog_order_by(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$order_by = $this->input->post('data');

		$data = array(
			'order_by' => $order_by,
			'update_datetime' => $now
		);

		$get = $this->model_blog->order_by($data,$id);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function blog_order_by_stick(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$order_by_stick = $this->input->post('data');

		$data = array(
			'order_by_stick' => $order_by_stick,
			'update_datetime' => $now
		);

		$get = $this->model_blog->order_by_stick($data,$id);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function blog_status(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$status = $this->input->post('data');

		$data = array(
			'status' => $status,
			'update_datetime' => $now
		);

		$get = $this->model_blog->blog_status($data,$id);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function blog_stick(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$stick = $this->input->post('data');

		$data = array(
			'stick' => $stick,
			'update_datetime' => $now
		);

		$get = $this->model_blog->blog_stick($data,$id);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	// end blog


	// start Category
	public function cat_list(){
		$get = $this->model_blog->cat_list();
		echo json_encode(array('data'=>$get));
	}

	public function cat_create(){
		$name_th = $this->input->post('name_th');
		$name_en = $this->input->post('name_en');

		$get_order = $this->model_blog->get_order_blog_cat();
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

		$get = $this->model_blog->cat_create($data);
		if($get){
			echo 'success';
		}else{
			echo 'error';
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

		$get = $this->model_blog->cat_edit($data,$id);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function cat_del(){
		$id  = $this->input->post('id_cat');
		$get = $this->model_blog->cat_del($id);

		if($get=='success'){
			echo 'success';
		}elseif($get=='already'){
			echo 'already';
		}else{
			echo 'error';
		}
	}

	public function cat_delmulti(){
		$id  = $this->input->post('chk_cat');

		if(!empty($id)){
			$get = $this->model_blog->cat_delmulti($id);
			if($get){
				echo 'success';
			}else{
				echo 'error';
			}
		}else{
			return false;
		}			
	}

	public function cat_order_by(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$order_by = $this->input->post('data');

		$data = array(
			'order_by_cat' => $order_by,
			'update_datetime' => $now
		);

		$get = $this->model_blog->order_by_cat($data,$id);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function blog_status_cat(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$status = $this->input->post('data');

		$data = array(
			'status_cat' => $status,
			'update_datetime' => $now
		);

		$get = $this->model_blog->blog_status_cat($data,$id);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function blog_status_home(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$status = $this->input->post('data');

		$data = array(
			'status_home' => $status,
			'update_datetime' => $now
		);

		$get = $this->model_blog->blog_status_home($data,$id);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}
	// end category

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
	        $config['source_image'] = './asset/backend/uploads/blog/'.$image_data['file_name'];
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
	    $config['source_image'] = './asset/backend/uploads/blog/'.$image_data['file_name'];
	    $config['new_image'] = './asset/backend/uploads/blog/thumbnail/'.$image_data['file_name'];
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

		    $response = $this->model_blog->upload_fl($data);
		    if($response){
		    	echo json_encode($link);
		    }else{
		    	echo $response;
		    }

        }
	}

	public function select(){
		$response = $this->model_blog->select_fl();
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
			$this->model_blog->delete_fl($id);
		}
	}

	
}

		
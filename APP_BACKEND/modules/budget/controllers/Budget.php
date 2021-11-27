<?php
/**
 * 
 */
class Budget extends MY_Controller
{
	// start view
	public function __construct(){
		parent::__construct();
		$this->load->model('model_budget');
		$this->load->library('upload');
		$this->load->helper('file');
	}

	public function index(){
		
		$this->data['title'] = 'งบประมาณ';
		$this->data['header'] = 'งบประมาณ';
		$this->middle = 'manage';
		$this->layout();
	}

	public function create($id=''){
		if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){

	     	$title  = htmlspecialchars($this->input->post('title'));
			$text  = htmlspecialchars($this->input->post('text'));

			// check image

			$get_order = $this->model_budget->get_order_budget();
			if($get_order){
				$order_by = $get_order + 1;
			}else{
				$order_by = 1;
			}

			$data = array(
				'title'  => $title,
				'text'  => $text,
				'order_by' => $order_by
			);

	        $get = $this->model_budget->save_budget($data);
	        if($get){
	          $this->session->set_flashdata('message', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
	        }else{
	          $this->session->set_flashdata('message', 'เกิดปัญหากับระบบ dbs');
	        }
	    }

		$this->data['title'] = 'budget Create';
		$this->data['header'] = 'เพิ่มงบประมาณ';
		$this->middle = 'create';
		$this->layout();
	}

	public function edit($id=''){
		if($get = $this->db->where('id',$this->uri->segment(3))->get('budget')->num_rows()==''){
	      redirect('budget');
	    }
    
	    // $result = $get->row_array();
	    if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){
			$now = date("Y-m-d H:i:s");// set date to update
			$title  = htmlspecialchars($this->input->post('title'));
			$text  = htmlspecialchars($this->input->post('text'));
			$category = $this->input->post('category');
			$id  = $this->input->post('id');
			// check image


	        $data = array(
				'title'         => $title,
				'text'  		  => $text,
				'update_datetime' => $now,
			);

			$get = $this->model_budget->edit_budget($data,$id);
			if($get){
	          $this->session->set_flashdata('message', 'แก้ไขเรียบร้อยแล้ว');
	        }else{
	          $this->session->set_flashdata('message', 'เกิดปัญหากับระบบ dbs');
	        }  
	    }

	    $this->data['info'] = $this->db->where('id',$this->uri->segment(3))->get('budget')->row_array();
		$this->data['title'] = 'budget Edit';
		$this->data['header'] = 'แก้ไข';
		$this->middle = 'edit';
		$this->layout();
	}
	// --------- end view-------------------------------

	// start model budget
	public function budget_list(){
		$val = $this->input->get('daterange-input');
		$get = $this->model_budget->budget_list($val);
		echo json_encode(array('data'=>$get));
	}


	public function budget_del(){
		$id = $this->input->post('id');
		$get = $this->model_budget->budget_del($id);

		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function budget_delmulti(){
		if(empty($this->input->post('chk_budget'))){
			return false;
		}

		$id = $this->input->post('chk_budget');
		$del = $this->model_budget->budget_delmulti($id);
		if($del){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function budget_order_by(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$order_by = $this->input->post('data');

		$data = array(
			'order_by' => $order_by,
			'update_datetime' => $now
		);

		$get = $this->model_budget->order_by($data,$id);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}


	public function budget_status(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$status = $this->input->post('data');

		$data = array(
			'status' => $status,
			'update_datetime' => $now
		);

		$get = $this->model_budget->budget_status($data,$id);
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

		    $response = $this->model_budget->upload_fl($data);
		    if($response){
		    	echo json_encode($link);
		    }else{
		    	echo $response;
		    }

        }
	}

	public function select(){
		$response = $this->model_budget->select_fl();
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
			$this->model_budget->delete_fl($id);
		}
	}

	
}

		
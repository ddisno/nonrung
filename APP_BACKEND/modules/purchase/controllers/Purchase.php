<?php
/**
 * 
 */
class Purchase extends MY_Controller
{
	// start view
	public function __construct(){
		parent::__construct();
		$this->load->model('model_purchase');
		$this->load->library('upload');
		$this->load->helper('file');
	}

	public function index(){
		
		$this->data['title'] = 'จัดซื้อจัดจ้าง';
		$this->data['header'] = 'จัดซื้อจัดจ้าง';
		$this->middle = 'manage';
		$this->layout();
	}

	public function create($id=''){
		if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){

	     	$title  = htmlspecialchars($this->input->post('title'));
			$text  = htmlspecialchars($this->input->post('text'));

			// check image

			$get_order = $this->model_purchase->get_order_purchase();
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

	        $get = $this->model_purchase->save_purchase($data);
	        if($get){
	          $this->session->set_flashdata('message', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
	        }else{
	          $this->session->set_flashdata('message', 'เกิดปัญหากับระบบ dbs');
	        }
	    }

		$this->data['title'] = 'purchase Create';
		$this->data['header'] = 'เพิ่มจัดซื้อจัดจ้าง';
		$this->middle = 'create';
		$this->layout();
	}

	public function edit($id=''){
		if($get = $this->db->where('id',$this->uri->segment(3))->get('purchase')->num_rows()==''){
	      redirect('purchase');
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

			$get = $this->model_purchase->edit_purchase($data,$id);
			if($get){
	          $this->session->set_flashdata('message', 'แก้ไขเรียบร้อยแล้ว');
	        }else{
	          $this->session->set_flashdata('message', 'เกิดปัญหากับระบบ dbs');
	        }  
	    }

	    $this->data['info'] = $this->db->where('id',$this->uri->segment(3))->get('purchase')->row_array();
		$this->data['title'] = 'purchase Edit';
		$this->data['header'] = 'แก้ไข';
		$this->middle = 'edit';
		$this->layout();
	}
	// --------- end view-------------------------------

	// start model purchase
	public function purchase_list(){
		$val = $this->input->get('daterange-input');
		$get = $this->model_purchase->purchase_list($val);
		echo json_encode(array('data'=>$get));
	}


	public function purchase_del(){
		$id = $this->input->post('id');
		$get = $this->model_purchase->purchase_del($id);

		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function purchase_delmulti(){
		if(empty($this->input->post('chk_purchase'))){
			return false;
		}

		$id = $this->input->post('chk_purchase');
		$del = $this->model_purchase->purchase_delmulti($id);
		if($del){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function purchase_order_by(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$order_by = $this->input->post('data');

		$data = array(
			'order_by' => $order_by,
			'update_datetime' => $now
		);

		$get = $this->model_purchase->order_by($data,$id);
		if($get){
			echo 'success';
		}else{
			echo 'error';
		}
	}


	public function purchase_status(){
		$now = date("Y-m-d H:i:s");// set date to update
		$id   = $this->input->post('id');
		$status = $this->input->post('data');

		$data = array(
			'status' => $status,
			'update_datetime' => $now
		);

		$get = $this->model_purchase->purchase_status($data,$id);
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

		    $response = $this->model_purchase->upload_fl($data);
		    if($response){
		    	echo json_encode($link);
		    }else{
		    	echo $response;
		    }

        }
	}

	public function select(){
		$response = $this->model_purchase->select_fl();
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
			$this->model_purchase->delete_fl($id);
		}
	}

	
}

		
<?php
/**
 * 
 */
class Forum extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_topic');
		$this->lang->load('topic',$this->language);
		$this->load->library('pagination');
		$this->load->library('upload');
		$this->load->helper('file');
		$this->load->helper('date');
	}

	public function index(){
		$this->data['title'] = 'กระดานสนทนา / ร้องทุกข์';
		$this->middle = 'topic';
		$this->layout();
	}

	public function view(){
		$config["base_url"] = base_url() . 'forum/view/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/';
        $config["total_rows"] = $this->model_topic->record_count_comment($this->uri->segment(5));
        $config["per_page"] = 12;
        $config["uri_segment"] = 6; 
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 10; //จำนวนหน้า หรือจำนวนปุ่ม pagination

        $config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul><!--pagination-->';

	    $config['first_link'] = 'First';
	    $config['first_tag_open'] = '<li class="prev page">';
	    $config['first_tag_close'] = '</li>';

	    $config['last_link'] = 'Last';
	    $config['last_tag_open'] = '<li class="next page">';
	    $config['last_tag_close'] = '</li>';

	    $config['next_link'] = '»';
	    $config['next_tag_open'] = '<li class="page-item">';
	    $config['next_tag_close'] = '</li>';

	    $config['prev_link'] = '«';
	    $config['prev_tag_open'] = '<li class="page-item">';
	    $config['prev_tag_close'] = '</li>';

	    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

	    $config['num_tag_open'] = '<li class="page-item">';
	    $config['num_tag_close'] = '</li>';

	    $config['attributes'] = array('class' => 'page-link');
 
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;

		$this->data['title'] = 'กระดานสนทนา';

		$this->data['topic']     = $this->model_topic->fetch_topic_name($this->uri->segment(5));
		$this->data['topic_comments'] = $this->model_topic->fetch_topic_comment($config["per_page"],$page,$this->uri->segment(5));
		$this->data['links']      = $this->pagination->create_links();

		$this->middle = 'view';
		$this->layout();
	}

	public function api_forum_list(){
		$get = $this->model_topic->api_forum_list();
		echo json_encode(array('data'=>$get));
	}

	public function create_comment(){
		$role = $this->input->post('check_admin');

		if($role=='admin'){
			$role=1;
			$status = 1;
		}else{
			$role=0;
			$status = 0;
		}

		$data = array(
			'id_topic' => $this->input->post('id_topic'),
			'comment'  => $this->input->post('comment'),
			'reply'    => $this->input->post('reply'),
			'id_user'  => 0,
			'role'     => $role,
			'status'   => $status,
			'fullname' => $this->input->post('fullname'),
			'email'    => $this->input->post('email'),
			'phone'    => $this->input->post('phone')
		);

		$get = $this->model_topic->create_comment($data);
		if($get){
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status'=>'success')));
		}else{
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status'=>'error')));
		}
	}

	public function create_topic(){
		$data = array(
			'subject' => $this->input->post('subject'),
			'detail'  => $this->input->post('detail'),
			'id_user'  => 0,
			'fullname' => $this->input->post('fullname'),
			'email'    => $this->input->post('email'),
			'phone'    => $this->input->post('phone')
		);

		$get = $this->model_topic->create_topic($data);
		if($get){
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status'=>'success')));
		}else{
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('status'=>'error')));
		}
	}

	public function api_forum(){
		$id = $this->input->post('id_forum');
		$data = $this->model_topic->fetch_topic_comment($id);

		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
	}

	// start froala
	public function upload(){
		$config['upload_path']          = './asset/backend/uploads/froala';//พาท อัพโหลดไฟล์
        $config['allowed_types']        = 'gif|jpg|png|mp4|webm';
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
        $new_path = $this->config->item('before_uri').$replace_path.'/'.$file_name;
  
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

		    $response = $this->model_topic->upload_fl($data);
		    if($response){
		    	echo json_encode($link);
		    }else{
		    	echo $response;
		    }

        }
	}

	public function select(){
		$response = $this->model_topic->select_fl();
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
			$this->model_topic->delete_fl($id);
		}
	}

}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_members extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_m_members'); //โหลดโมเดล
		$this->load->library('form_validation'); // โหลดไลบรารี่ form_validation ของ ci มาใช้งาน		
	}

	public function index(){
		// check permission before operator
		$this->cc_auth->_is_check_permission('admin::member_index');
		// ------------------------------------
		$this->data['roles'] = $this->model_m_members->fetch_roles();

		$this->data['title'] = 'ผู้ใช้งาน';
		$this->data['header'] = 'ผู้ใช้งาน';
		$this->middle = 'index';
		$this->layout();	
	}

	public function create(){
		// check permission before operator
		$this->cc_auth->_is_check_permission('admin::member_create');
		// ------------------------------------
		if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){
			$fname = $this->input->post('f_name');
			$lname = $this->input->post('l_name');
			$tel   = $this->input->post('phone');
			$email = $this->input->post('email');		
			$status = $this->input->post('status');	
			$role  = $this->input->post('id_role');
			$pass  = $this->input->post('password');
			$resp = array();

			$this->form_validation->set_rules('password','Password','required|trim|min_length[8]|regex_match[/^[a-z0-9]+$/]|differs[username]');
			$this->form_validation->set_rules('passconf','Password Confirmation', 'required|matches[password]|regex_match[/^[a-z0-9]+$/]|differs[username]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[m_members.email]');		

			if($this->form_validation->run()){
				$data = array(
					'f_name' => $fname,
					'l_name' => $lname,
					'phone'   => $tel,
					'email' => $email,
					'password'  => password_hash($pass, PASSWORD_BCRYPT),
					'status'	=> $status,
					'id_role'   => $role
				);

				$insert = $this->model_m_members->save($data);//insert
				if($insert){
					$this->session->set_flashdata('message', 'เพิ่มผู้ใช้งานเรียบร้อยแล้ว');
				}else{
					$this->session->set_flashdata('message', 'เกิดปัญหากับระบบ dbs');
				}
			}
		}

		$this->data['roles'] = $this->model_m_members->fetch_roles();
		$this->data['title'] = 'ผู้ใช้งาน';
		$this->data['header'] = 'ผู้ใช้งาน';
		$this->middle = 'create';
		$this->layout();	
	}

	public function edit(){
		// check permission before operator
		$this->cc_auth->_is_check_permission('admin::member_edit');
		// ------------------------------------
		if($get = $this->db->where('id_member',$this->uri->segment(3))->get('m_members')->num_rows()==''){
		    redirect('m_members','refresh');
		}
		if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){
			$id    = $this->input->post('id_member');	
			// detail
			$fname = $this->input->post('f_name');
			$lname = $this->input->post('l_name');
			$tel   = $this->input->post('phone');
			$email = $this->input->post('email');
			$pass  = $this->input->post('password');	
			$status = $this->input->post('status');	
			$role   = $this->input->post('id_role');

		    $original_email = $this->db->query("SELECT email FROM m_members WHERE id_member= ".$id)->row()->email ;
		    if($email != $original_email) {
		       $is_unique_email =  '|is_unique[m_members.email]';
		    } else {
		       $is_unique_email =  '';
		    }

			if($pass!=''){
				$this->form_validation->set_rules('password','Password','required|trim|min_length[8]|regex_match[/^[a-z0-9]+$/]|differs[username]');
				$this->form_validation->set_rules('passconf','Password Confirmation', 'required|matches[password]|regex_match[/^[a-z0-9]+$/]|differs[username]');
			}

			$this->form_validation->set_rules('email', 'Email', 'required|valid_email'.$is_unique_email);		

			if($this->form_validation->run()){
				$data = array(
					'f_name' => $fname,
					'l_name' => $lname,
					'phone'   => $tel,
					'email' => $email,
					'status'	=> $status,
					'id_role'   => $role
				);

				if($pass!=''){
					$data['password'] = password_hash($pass, PASSWORD_BCRYPT);
				}

				$update = $this->model_m_members->update($data,$id);

				if($update){
					$this->session->set_flashdata('message', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
				}else{
					$this->session->set_flashdata('message', 'เกิดปัญหากับระบบ dbs');
				}
			}
		}

		$get = $this->db->where('id_member',$this->uri->segment(3))->get('m_members')->row_array();
		$this->data['roles'] = $this->model_m_members->fetch_roles();
		$this->data['title'] = 'แก้ไขผู้ใช้งาน';
		$this->data['header'] = 'แก้ไขผู้ใช้งาน';
		$this->data['member'] = $get;
		$this->middle = 'edit';
		$this->layout();	

	}

	public function del(){

		// check permission before operator
		$this->cc_auth->_is_check_permission('admin::member_delete');
		// ------------------------------------

		$resp = array(
				'token' => $this->token,
				'hash' => $this->hash
	    );

		$id = $this->input->post('id_member');
		$del = $this->model_m_members->del($id);
		if($del){
			$resp = array(
				'status'=>'done',
				'info'=>'ลบข้อมูลเรียบร้อยแล้ว',
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

	public function delmulti(){
		// check permission before operator
		$this->cc_auth->_is_check_permission('admin::member_delete');
		// ------------------------------------
		$resp = array(
				'token' => $this->token,
				'hash' => $this->hash
	    );

		if(empty($this->input->post('chk_m_members'))){
			return false;
		}

		$id = $this->input->post('chk_m_members');
		$del = $this->model_m_members->delmulti($id);
		if($del){
			$resp['status'] = 'done';
			$resp['info']   = 'ลบข้อมูลเรียบร้อยแล้ว';
			$this->output
			        ->set_content_type('application/json')
			        ->set_output(json_encode($resp));
		}else{
			$resp['status'] = 'error';
			$resp['info']   = 'เกิดข้อผิดพลาด';
			$this->output
			        ->set_content_type('application/json')
			        ->set_output(json_encode($resp));
		}
	}

	public function list_members(){
		$get = $this->model_m_members->list_members();
		echo json_encode(array('data'=> $get));
	}

}
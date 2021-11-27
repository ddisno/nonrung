<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * 
	 */
	class Install extends MY_Controller{
		
		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->library('encryption');
			$this->load->model('model_install');
			if($this->db->table_exists('m_members')){
				redirect(base_url());
			}	
		}

		public function index(){
			$this->data['title'] = 'สำหรับผู้พัฒนา';
			$this->load->view('install',$this->data);	
		}

		public function create(){
			// for ajax csrf will have regenerate everytime when access
			$token = $this->security->get_csrf_token_name();
			$hash = $this->security->get_csrf_hash(); 

			$user  = $this->input->post('username');
			$pass  = $this->input->post('password');
			$fname = $this->input->post('f_name');
			$lname = $this->input->post('l_name');
			$tel   = $this->input->post('tel');
			$email = $this->input->post('email');		

			$json = array();

			$this->form_validation->set_rules('username','Username','required|trim|min_length[8]|regex_match[/^[a-z0-9]+$/]');
			$this->form_validation->set_rules('password','Password','required|trim|min_length[8]|regex_match[/^[a-z0-9]+$/]|differs[username]');
			$this->form_validation->set_rules('passconf','Password Confirmation', 'required|matches[password]|regex_match[/^[a-z0-9]+$/]|differs[username]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

			if($this->form_validation->run()){
				$data = array(
					'f_name' => $fname,
					'l_name' => $lname,
					'phone'   => $tel,
					'email' => $email 
				);

				$data_login = array(
					'username'  => $user,
					'password'  => password_hash($pass, PASSWORD_BCRYPT),
				);

				$get = $this->model_install->save($data,$data_login);//insert
				$this->session->set_userdata($get); // set session
				if($get){
					$json= array('status'=>'done',
								 'info'=>'สร้างโปรเจ็คเสร็จเรียบร้อยแล้ว <a href="'.base_url().'"> ไปที่่ โปรเจ็ค </a>',
								 'token' => $token,
								 'hash' => $hash);
				}else{
					$json= array('status'=>'error',
								 'info'=>'เกิดปัญหากับระบบ',
								 'token' => $token,
								 'hash' => $hash);
				}

			}else{
				$json = array(
					'status'=>'error',
					'info'=>validation_errors(),
					'token' => $token, 
					'hash' => $hash
	            );
			}

			$this->output
			        ->set_content_type('application/json')
			        ->set_output(json_encode($json));
		}
	}
?>
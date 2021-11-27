<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * 
	 */
	class Users extends MY_Controller
	{
		
		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->model('model_users');
			$this->load->helper('cookie');

			// กำหนดให้ ล็อคอินเฉพาะหน้าบ้าน
			// if($this->router->fetch_method() != 'logout'){
			// 	redirect($this->config->item('base'));
			// }
			
		}

		public function login(){
			$this->data['title'] = 'เข้าสู่ระบบ';

			// เมื่อมีการ submit เข้ามาทำในส่วนนี้
			if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){
				$this->form_validation->set_rules('email','Email','trim|required|valid_email');
				$this->form_validation->set_rules('password','Password','required');

				if($this->form_validation->run()){
					// ถ้า login ผ่าน จะเด้งไปหน้า home
					$this->cc_auth->_login($this->input->post());
				}
			}
			// แสดงหน้า login
			$this->load->view('login',$this->data);	
		}


		public function forgot(){
			$this->data['title'] = 'ลืมรหัสผ่าน';
			// เมื่อมีการ submit เข้ามาทำในส่วนนี้
			if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){
				$email = $this->input->post('email');

				$this->form_validation->set_rules('email','Email','trim|required|valid_email');

				if($this->form_validation->run()){
					$this->cc_auth->_forgot($email);
				}
			}
			
			$this->load->view('password_forgot',$this->data);
		}

		public function reset(){
			$this->data['title'] = 'ตั้งค่ารหัสผ่านใหม่';
			// check token. if have not token will not access to reset view page
			if($result = $this->model_users->checktoken($this->uri->segment(3))){
				$this->data['temp']  = $result;
				// เมื่อมีการ submit เข้ามาทำในส่วนนี้
				if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){
					// validate password
					$this->form_validation->set_rules('password','Password','required|trim|min_length[8]|regex_match[/^[a-z0-9]+$/]|differs[email]');
					$this->form_validation->set_rules('passconf','Password Confirmation', 'required|matches[password]|regex_match[/^[a-z0-9]+$/]|differs[email]');

					// validate run
					if($this->form_validation->run()){
						$this->cc_auth->_reset_password($this->input->post());
					}
				}
				$this->load->view('password_reset',$this->data);
			}else{
				redirect('home');
			}	
		}

		public function logout(){
			$this->cc_auth->_logout();
		}
		
	}
?>
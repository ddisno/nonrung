<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CC_auth
{
	protected $CI;

	public function __construct()
	{
        $this->CI =& get_instance();
	}

	public function _login($post){

		if($result = $this->CI->model_users->login($post['email'],$post['password'])){
			$this->CI->session->set_userdata($result);
			// set remember
			$this->_remember($post['remember']);
			
			redirect('home');
		}else{
			$this->CI->session->set_flashdata('message', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
		}
	}

	public function _logout(){
		// ----------------destroy
		$this->CI->session->sess_destroy();
		redirect('login','refresh');
	}

	public function _remember($remember){
		if($remember){
			$this->CI->input->set_cookie('remember', '1',31536000);
			$this->CI->input->set_cookie('email', $this->CI->input->post('email'),31536000);
	        $this->CI->input->set_cookie('password', $this->CI->input->post('password'),31536000); 
		}else{
			delete_cookie('remember');
			delete_cookie('email'); /* Delete email cookie */
	        delete_cookie('password'); /* Delete password cookie */
		}
	}
	
	public function _forgot($email){
		if($this->CI->model_users->checkmail($email)){
			if($this->CI->model_users->sendmail($email)){
				$this->CI->session->set_flashdata('message', 'เราได้ทำการส่งลิ้งค์เปลี่ยนรหัสใหม่ให้กับคุณแล้ว กรุณาเช็คกล่องข้อความ.');
			}else{
				$this->CI->session->set_flashdata('error', 'เกิดปัญหาขึ้นกับระบบ');
			}	
		}else{
			$this->CI->session->set_flashdata('error', 'ไม่มีอีเมล์นี้อยู่ในระบบ กรุณาตรวจสอบอีเมล์ใหม่อีกครั้ง');
		}
	}

	public function _reset_password($post){
		if($this->CI->model_users->reset($post['email'],$post['password'])){
			$this->CI->session->set_flashdata('message', 'Password is changed');
		}else{
			$this->CI->session->set_flashdata('error', 'Change password is problem!');
		}
	}

	public function _is_logged_in(){
		return (bool)$this->CI->session->userdata('email');
	}

	public function _is_super(){
		if ($this->CI->session->userdata('id_role')!=1) {
			redirect('home');
		}
	}

	public function _is_admin(){
		if($this->CI->session->userdata('email')!==null){
			if($this->CI->session->userdata('id_role')!=1){
				if($this->CI->db->where('id_role',$this->CI->session->userdata('id_role'))
							 ->get('m_roles')
							 ->row()->is_admin==0){
					redirect($this->CI->config->item('base'));
				}
			}
		}
	}

	public function _is_check_permission($key='',$url='home'){
		if($this->CI->session->userdata('id_role')!=1){
			if($this->CI->db->where('id_role',$this->CI->session->userdata('id_role'))
						 ->where('key_permission',$key)
						 ->get('m_roles_permission')
						 ->num_rows()==''){
				redirect($url);
			}
		}
	}
}

/* End of file Authorize.php */
/* Location: .//C/xampp/htdocs/meeting/project/mainpattern/APP_BACKEND/libraries/Authorize.php */

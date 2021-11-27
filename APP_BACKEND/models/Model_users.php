<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Model_users extends CI_Model
{
	// login method 
	function login($email,$password){
		// fetch info member
		$result = $this->db->where('email',$email)->get('m_members')->row_array();
		// fetch role for check is_admin
		$chk_admin = $this->db->where('id_role',$result['id_role'])->get('m_roles')->row_array();

    	if (!empty($result) && 
    		password_verify($password, $result['password']) && 
    		$result['status']=='active' && 
    		$chk_admin['is_admin']==1) 
    	{
        	return $result;
		}else{
			return false;
		}
	}

	// checkmail method for forgot password
	public function checkmail($email){
		$this->db->where('email',$email);
		$query = $this->db->get('m_members');
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	// checktoken for reset password
	public function checktoken($token){
		$this->db->where('token',$token);
		$query = $this->db->get('m_members_repsd');
		if($query->num_rows() > 0){
			return $query->row_array();
		}else{
			return false;
		}
	}

	// reset method
	public function reset($email,$pass){

		$this->db->set('password',password_hash($pass, PASSWORD_BCRYPT));
		$this->db->where('email',$email);
		$get = $this->db->update('m_members');
		if($get){
			$this->db->where('email',$email);
			$this->db->delete('m_members_repsd');
			return true;
		}else{
			return false;
		}
	}

	// sendmail method for send reset password link to your email in system
	public function sendmail($email){
		$this->load->library('email');
		$this->load->helper('string');
		$token = random_string('alnum',20);

		$subject = 'แก้ไขรหัสผ่าน';
		$message = 'Link to reset : <a href="'.base_url().'password/reset/'.$token.'">'.base_url().'password/reset/'.$token.'</a>';
		// config
		$config = Array(
	        'protocol' => 'smtp',
	        'smtp_host' => 'mail.codecreepy.com',
	        'smtp_port' => 25, //465,
	        'smtp_user' => 'weeradach.ch@codecreepy.com',
	        'smtp_pass' => 'tookmo0730',
	        'smtp_crypto' => 'STARTTLS',
	        'smtp_timeout' => '20',
	        'mailtype'  => 'html', 
	        'charset'   => 'utf-8'
	    );
	    $config['newline'] = "\r\n";
	    $config['crlf'] = "\r\n";

		$this->email->initialize($config);
		$this->email->from('weeradach.ch@codecreepy.com','Mr.weeradach');
		$this->email->to($email);
		$this->email->reply_to('weerdach.ch@gmail.com', 'Mr.weeradach');
		$this->email->subject($subject);
		$this->email->message($message);
        if($this->email->send()){   // คืนค่าการทำงานว่าเป็น true หรือ false  
        	$data = array(
        		'email' => $email,
        		'token' => $token,
        	);
        	// delete old token
        	$this->db->where('email',$email);
        	$this->db->delete('m_members_repsd');
        	// insert in to db
        	$this->db->insert('m_members_repsd',$data);
        	return true;
        	
		}else{
			return false;		
		}
	}
}
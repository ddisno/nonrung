<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_m_members extends CI_Model {
	
	public function save($data){
		// เพิ่มดาต้าเข้า
		$query = $this->db->insert('m_members', $data); // เพิ่มค่าแรกเข้าไป	
		if($query)return true;
	}

	public function update($data,$id){
		$this->db->where('id_member',$id);
		$response = $this->db->update('m_members',$data);

		return $response;
	}

	public function del($id){
		$this->db->where('id_member',$id);
		$query = $this->db->delete('m_members');
		
		return $query;
	}

	public function delmulti($data){
		if (!empty($data)) {
	        for ($i = 0; $i < count($data); $i++)
	        {
	        	// ป้ิงกันการลบ user login อยู่ในขณะนั้น
	        	if($data[$i]==$this->session->userdata('id_member')){
	        		continue;
	        	}
	        	// -------------------------------------  	
		        $this->db->where('id_member', $data[$i]);
		        $this->db->delete('m_members');
	        }
	        return true;
	    }else{
	    	return false;
	    }
	}

	public function list_members(){
		$this->db->select('m_members.*
						  ,m_roles.id_role
						  ,m_roles.name_role');
    	$this->db->from('m_members');
    	$this->db->join('m_roles','m_roles.id_role = m_members.id_role','left');
    	// if not adminstrator will not show Admin roles
    	if($this->session->userdata('id_role')!=1){
			$this->db->where('m_members.id_role !=',1);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		
		// ------------------------------------------------------------------------------------
		return $result;
	}

	public function fetch_roles(){
		$this->db->where('status','active');
		// if not adminstrator will not show Admin roles
		if($this->session->userdata('id_role')!=1){
			$this->db->where('id_role !=',1);
		}
		$query = $this->db->get('m_roles');

		return $result = $query->result_array();
	}

}
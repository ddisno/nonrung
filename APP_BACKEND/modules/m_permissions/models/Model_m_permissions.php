<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_m_permissions extends CI_Model{
	
	public function save($data,$roles){
		// insert permissions
		$response = $this->db->insert('m_permissions', $data);
		// insert role and permission
		if($response){
			if(!empty($roles)){
				foreach ($roles as $role) {
					$permissions_role = array(
						'id_role' => $role,
						'key_permission' => $data['key'],
					);
					$this->db->insert('m_roles_permission',$permissions_role);
				}
			}
			return true;
		}
	}

	public function fetch_roles(){
		$this->db->where('status','active');
		$query = $this->db->get('m_roles');
		$results = $query->result();
		return $results;
	}

	public function update($data,$old_key,$old_role,$new_role){
		$this->db->where('key',$old_key);
		$response = $this->db->update('m_permissions',$data);

		if(!($old_role == $new_role)) {
			 // check old_role
	        foreach ($old_role as $key) {
	            if(!in_array($key, $new_role)){
	              // ลบ
	            	$this->db->where('id_role',$key)->where('key_permission',$data['key'])->delete('m_roles_permission');
	            }
	        }
	         // check new role
	        foreach ($new_role as $key) {
	          if(!in_array($key, $old_role)){
	              // เพิ่ม
	          		$permissions_role = array(
						'id_role' => $key,
						'key_permission' => $data['key'],
					);
	          	  $this->db->insert('m_roles_permission',$permissions_role);
	          }
	        }
      	}
		return $response;
	}

	public function del($key){
		$this->db->where('key',$key);
		$query = $this->db->delete('m_permissions');
		return true;
	}

	public function delmulti($data){
		if (!empty($data)) {
		    for ($i = 0; $i < count($data); $i++)
		    {	        	
			    $this->db->where('key', $data[$i]);
			    $this->db->delete('m_permissions');
		    }
		    return true;
		}else{
		   	return false;
		}
	}

	public function list_permissions(){
		$data = [];
		
		$results = $this->db->order_by('key')->get('m_permissions')->result_array();
		foreach ($results as $key) {
			$button = '';
			$roles_permission = $this->db->where('key_permission',$key['key'])->get('m_roles_permission')->result_array();
			foreach ($roles_permission as $roles) {
				$role = $this->db->select('id_role,name_role')->where('id_role',$roles['id_role'])
								 ->get('m_roles')->result_array();
				foreach ($role as $value) {
					$button .= '<a href="#" class="btn btn-info btn-xs">'.$value['name_role'].'</a>&nbsp;';
				}

			}
			$key['in_roles'] = $button;
			array_push($data, $key);
		}

		return $data;
	}

	public function get_roles_permission($key){
		$data = [];
		$result = $this->db->where('key_permission',$key)->get('m_roles_permission')->result_array();
		if($result){
			foreach ($result as $value) {
				array_push($data, $value['id_role']);
			}
			return $data;
		}else{
			return false;
		}
	}

}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_m_menus extends CI_Model{
	
	public function save($data,$roles){
		// เพิ่มดาต้าเข้า
		$response = $this->db->insert('m_menus', $data); // เพิ่มค่าแรกเข้าไป
		$id = $this->db->insert_id();
		if($response){
			if(!empty($roles)){
				foreach ($roles as $role) {
					$roles_menu = array(
						'id_role' => $role,
						'id_menu' => $id,
					);
					$this->db->insert('m_roles_menu',$roles_menu);
				}
			}
			return true;
		}
		if($response)return true;
	}

	public function update($data,$id,$old_role,$new_role){
		$this->db->where('id_menu',$id);
		$response = $this->db->update('m_menus',$data);

		if(!($old_role == $new_role)) {
			 // check old_role
	        foreach ($old_role as $key) {
	            if(!in_array($key, $new_role)){
	              // ลบ
	            	$this->db->where('id_role',$key)->where('id_menu',$id)->delete('m_roles_menu');
	            }
	        }
	         // check new role
	        foreach ($new_role as $key) {
	          if(!in_array($key, $old_role)){
	              // เพิ่ม
	          		$roles_menu = array(
						'id_role' => $key,
						'id_menu' => $id,
					);
	          	  $this->db->insert('m_roles_menu',$roles_menu);
	          }
	        }
      	}
		return $response;
	}

	public function fetch_roles(){
		$this->db->where('status','active');
		$query = $this->db->get('m_roles');
		$results = $query->result();
		return $results;
	}

	public function del($id){
		$this->db->where('parent', $id);
		$query = $this->db->get('m_menus');
		$rows = $query->num_rows();
		$result = $query->result_array();
		if($rows > 0){
			foreach ($result as $key) {
				$this->del($key['id_menu']);
			}
		}
		
		$this->db->where('id_menu',$id);
		$query = $this->db->delete('m_menus');

		return $query;
	}

	public function list_menus(){
		$results = $this->db->order_by('sort')->get('m_menus')->result();
		return $results;
	}

	public function check_my_menu($id){
		$data = [];
		$this->db->where('id_role',$id);
		$query = $this->db->get('m_roles_menu');
		foreach ($query->result_array() as $key) {
			array_push($data, $key['id_menu']);
		}
		return $data;
	}

	public function sort_menus($data_sort){
		$i=0;
		foreach($data_sort as $row){
			$i++;
			$this->db->set('parent',$row['parentID']);
			$this->db->set('sort',$i);
			$this->db->where('id_menu',$row['id']);
			$this->db->update('m_menus');
		}
		return true;
	}

	public function get_roles_menu($id){
		$data = [];
		$result = $this->db->where('id_menu',$id)->get('m_roles_menu')->result_array();
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
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_m_roles extends CI_Model{
	
	public function save($data,$roles,$menus){
		$response = $this->db->insert('m_roles', $data);
		$id = $this->db->insert_id();
		if($response){
			// input permissions 
			if(!empty($roles)){
				foreach ($roles as $role) {
					$roles_permis = array(
						'id_role'        => $id,
						'key_permission' => $role,
					);
					$this->db->insert('m_roles_permission',$roles_permis);
				}
			}

			// input access menu
			if(!empty($menus)){
				foreach ($menus as $menu) {
					$roles_menus = array(
						'id_role' => $id,
						'id_menu' => $menu,
					);
					$this->db->insert('m_roles_menu',$roles_menus);
				}
			}

			return true;
		}
		return $response;
	}

	public function update($data,$id,$old_permis,$old_menus,$new_permis,$new_menus){
		$this->db->where('id_role',$id);
		$response = $this->db->update('m_roles',$data);

		// check permissions
		if(!($old_permis == $new_permis)) {
			 // check old_permis
	        foreach ($old_permis as $key) {
	            if(!in_array($key, $new_permis)){
	              // ลบ
	            	$this->db->where('key_permission',$key)->where('id_role',$id)->delete('m_roles_permission');
	            }
	        }
	         // check new role
	        foreach ($new_permis as $key) {
	          if(!in_array($key, $old_permis)){
	              // เพิ่ม
	          		$permissions_role = array(
						'id_role' => $id,
						'key_permission' => $key,
					);
	          	  $this->db->insert('m_roles_permission',$permissions_role);
	          }
	        }
      	}

      	// check menus
      	if(!($old_menus == $new_menus)) {
			 // check old_permis
	        foreach ($old_menus as $key) {
	            if(!in_array($key, $new_menus)){
	              // ลบ
	            	$this->db->where('id_menu',$key)->where('id_role',$id)->delete('m_roles_menu');
	            }
	        }
	         // check new role
	        foreach ($new_menus as $key) {
	          if(!in_array($key, $old_menus)){
	              // เพิ่ม
	          		$menus_role = array(
						'id_role' => $id,
						'id_menu' => $key,
					);
	          	  $this->db->insert('m_roles_menu',$menus_role);
	          }
	        }
      	}
		return $response;
	}

	public function del($id){
		$this->db->where('id_role',$id);
		$query = $this->db->get('m_members');
		if($query->num_rows() > 0){
			return 'exist';
		}

		$this->db->where('id_role',$id);
		$query = $this->db->delete('m_roles');
		return true;
	}

	public function delmulti($data){
		if (!empty($data)) {
		    for ($i = 0; $i < count($data); $i++)
		    {
		       	// ป้องกันการลบ ผู้ดูแลระบบ ==1
		        if($data[$i]==1){
		        	continue;
		        }
		        // -------------------------------------
		        // เช็คดูว่า บทบาทมีการผูกกับสมาชิกหรือไม่
		       if($this->db->where('id_role',$data[$i])->get('m_members')->num_rows()>0){
		       		continue;
		       }
		        // -------------------------------------
		        	
			    $this->db->where('id_role', $data[$i]);
			    $this->db->delete('m_roles');

		    }
		    return true;
		}else{
		   	return false;
		}
	}

	public function list_role(){
			$data = [];
			// check super_admin
			if($this->session->userdata('id_role')!=1){
				$this->db->where('id_role !=',1);
			}
			$query = $this->db->get('m_roles');
			$results = $query->result_array();


			foreach ($results as $key) {

				$key['nums'] = $this->db->where('id_role',$key['id_role'])->get('m_members')->num_rows();

				$button = '';
				$roles_permission = $this->db->where('id_role',$key['id_role'])->get('m_roles_permission')->result_array();
				$i=0;
				foreach ($roles_permission as $roles) {
					if($i==3){
						$button .= '&nbsp;&nbsp;more...';
						break;
					}

					$role = $this->db->select('key')->where('key',$roles['key_permission'])
									 ->get('m_permissions')->result_array();
					foreach ($role as $value) {
						$button .= '<a href="'.base_url().'m_permissions/edit/'.$value['key'].'" class="btn btn-info btn-xs">'.$value['key'].'</a>&nbsp;';
					}
					$i++;
				}
				$key['in_roles'] = $button;
				array_push($data, $key);
			}
			return $data;
	}

	public function fetch_menus(){
		$query = $this->db->get('m_menus');
		$results = $query->result();
		return $results;
	}

	public function fetch_permissions(){
		$query = $this->db->get('m_permissions');
		$results = $query->result();
		return $results;
	}

	public function get_roles_permission($id){
		$data = [];
		$result = $this->db->where('id_role',$id)->get('m_roles_permission')->result_array();
		if($result){
			foreach ($result as $value) {
				array_push($data, $value['key_permission']);
			}
			return $data;
		}else{
			return false;
		}
	}

	public function get_roles_menu($id){
		$data = [];
		$result = $this->db->where('id_role',$id)->get('m_roles_menu')->result_array();
		if($result){
			foreach ($result as $value) {
				array_push($data, $value['id_menu']);
			}
			return $data;
		}else{
			return false;
		}
	}

}
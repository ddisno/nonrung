<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * 
	 */
class Model_main extends CI_Model{		

	// db excute sort menus
	public function _layout_listmenus(){
		$this->db->order_by('sort');
		$query = $this->db->get('m_menus');
		$results = $query->result();

		return $results;
	}

	public function _check_permission_menu(){
		$data = [];
		$this->db->where('id_role',$this->session->userdata('id_role'));
		$query = $this->db->get('m_roles_menu');
		foreach ($query->result_array() as $key) {
			array_push($data, $key['id_menu']);
		}
		return $data;
	}

	// เอากลับค่าที่ใหญ่ที่สุด
	public function _get_role(){
		

		$this->db->select('name_role,id_role');
		$this->db->from('m_roles');
		$this->db->where('id_role',$this->session->userdata('id_role'));
		$query = $this->db->get();
		$result = $query->row_array();
		if($query->num_rows()<=0){
			return 'none';
		}else{
			return $result['name_role'];
		}
	}


}
?>
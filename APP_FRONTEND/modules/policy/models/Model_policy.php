<?php
/**
 * 
 */
class Model_policy extends CI_Model
{
	
	public function fetch_policy($id){
		$this->db->select('*');
		$this->db->where('id_page',$id);
		$query = $this->db->get('page_setting');
		$result = $query->row_array();

		return $result;

	}
}

?>
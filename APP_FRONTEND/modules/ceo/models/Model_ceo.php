<?php
/**
 * 
 */
class Model_ceo extends CI_Model
{
	
	public function fetch_ceo($id){
		$this->db->select('*');
		$this->db->where('id_page',$id);
		$query = $this->db->get('page_setting');
		$result = $query->row_array();

		return $result;

	}
}

?>
<?php
/**
 * 
 */
class Model_about extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function fetch_about(){
		$this->db->select('*');
		$this->db->limit(1);
		$query = $this->db->get('page_about');
		$result = $query->row_array();

		return $result;

	}
}

?>
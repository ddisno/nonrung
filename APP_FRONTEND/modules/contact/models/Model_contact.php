<?php
	/**
	 * 
	 */
	class Model_contact extends CI_Model
	{
		
		function __construct()
		{
			# code...
		}

		public function gmap(){
			$this->db->select('*');
			$query = $this->db->get('page_about');
			$result = $query->row_array();
			return $result;
		}

	}
?>
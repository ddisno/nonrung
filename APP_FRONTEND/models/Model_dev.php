<?php
/**
 * 
 */
class Model_dev extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->dbforge();
		// $this->check_user();
	}

	// public function check_db(){
	// 	$query = $this->db->query('CREATE DATABASE IF NOT EXISTS mt_sbdragon_test');
	// 	if (!$query) {
	//       throw new Exception($this->db->_error_message(),
	//       $this->db->_error_number());
	//       return FALSE;
	//     } else {
	//         return TRUE;
	//     }
	// }

	public function check_user(){
		if ($this->db->table_exists('staff'))
		{
		    return true;
		}else{
			return false;
		}
	}

}
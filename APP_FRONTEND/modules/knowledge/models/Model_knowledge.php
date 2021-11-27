<?php

/**
 * 
 */
class Model_knowledge extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function record_count($cat=''){
		if($cat!=''){
			$this->db->where('id_cat',$cat);
		}
		$this->db->from("knowledge");
		return $this->db->count_all_results();
	}

	public function fetch_knowledge(){
		return $this->db->where('status',1)->order_by('order_by')->get('knowledge')->result_array();
	}

}
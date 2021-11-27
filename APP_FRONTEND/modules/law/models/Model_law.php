<?php

/**
 * 
 */
class Model_law extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function record_count($cat=''){
		if($cat!=''){
			$this->db->where('id_cat',$cat);
		}
		$this->db->from("law");
		return $this->db->count_all_results();
	}

	public function fetch_law(){
		return $this->db->where('status',1)->order_by('order_by')->get('law')->result_array();
	}


	public function fetch_law_single($id){
		$result = $this->db->where('id',$id)->get('law')->row_array();
		$related = $this->fetch_law_related($result['id']);
		$result['related'] = $related;

		return $result;
	}

	public function fetch_law_related($id_law){
		$data = [];
		$result = $this->db->select('*')->where('id !=',$id_law)->limit(4)->get('law')->result_array();

		$data = $result;

		return $data;
	}
}
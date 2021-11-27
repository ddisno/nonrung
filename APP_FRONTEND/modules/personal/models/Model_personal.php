<?php

/**
 * 
 */
class Model_personal extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function record_count($cat=''){
		if($cat!=''){
			$this->db->where('id_cat',$cat);
		}
		$this->db->from("personal");
		return $this->db->count_all_results();
	}

	public function fetch_personal(){
		return $this->db->where('status',1)->order_by('order_by')->get('personal')->result_array();
	}


	public function fetch_personal_single($id){
		$result = $this->db->where('id',$id)->get('personal')->row_array();
		$related = $this->fetch_personal_related($result['id']);
		$result['related'] = $related;

		return $result;
	}

	public function fetch_personal_related($id_personal){
		$data = [];
		$result = $this->db->select('*')->where('id !=',$id_personal)->limit(4)->get('personal')->result_array();

		$data = $result;

		return $data;
	}
}
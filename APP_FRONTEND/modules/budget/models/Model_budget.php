<?php

/**
 * 
 */
class Model_budget extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function record_count($cat=''){
		if($cat!=''){
			$this->db->where('id_cat',$cat);
		}
		$this->db->from("budget");
		return $this->db->count_all_results();
	}

	public function fetch_budget(){
		return $this->db->where('status',1)->order_by('order_by')->get('budget')->result_array();
	}


	public function fetch_budget_single($id){
		$result = $this->db->where('id',$id)->get('budget')->row_array();
		$related = $this->fetch_budget_related($result['id']);
		$result['related'] = $related;

		return $result;
	}

	public function fetch_budget_related($id_budget){
		$data = [];
		$result = $this->db->select('*')->where('id !=',$id_budget)->limit(4)->get('budget')->result_array();

		$data = $result;

		return $data;
	}
}
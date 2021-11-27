<?php

/**
 * 
 */
class Model_ita extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function record_count($cat=''){
		if($cat!=''){
			$this->db->where('id_cat',$cat);
		}
		$this->db->from("ita");
		return $this->db->count_all_results();
	}

	public function fetch_ita(){
		return $this->db->where('status',1)->order_by('order_by')->get('ita')->result_array();
	}


	public function fetch_ita_single($id){
		$result = $this->db->where('id',$id)->get('ita')->row_array();
		$related = $this->fetch_ita_related($result['id']);
		$result['related'] = $related;

		return $result;
	}

	public function fetch_ita_related($id_ita){
		$data = [];
		$result = $this->db->select('*')->where('id !=',$id_ita)->limit(4)->get('ita')->result_array();

		$data = $result;

		return $data;
	}
}
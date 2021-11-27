<?php

/**
 * 
 */
class Model_information extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function record_count($cat=''){
		if($cat!=''){
			$this->db->where('id_cat',$cat);
		}
		$this->db->from("information");
		return $this->db->count_all_results();
	}

	public function fetch_information(){
		return $this->db->where('status',1)->order_by('order_by')->get('information')->result_array();
	}


	public function fetch_information_single($id){
		$result = $this->db->where('id',$id)->get('information')->row_array();
		$related = $this->fetch_information_related($result['id']);
		$result['related'] = $related;

		return $result;
	}

	public function fetch_information_related($id_information){
		$data = [];
		$result = $this->db->select('*')->where('id !=',$id_information)->limit(4)->get('information')->result_array();

		$data = $result;

		return $data;
	}
}
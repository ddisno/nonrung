<?php

/**
 * 
 */
class Model_otherpurchase extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function record_count($cat=''){
		if($cat!=''){
			$this->db->where('id_cat',$cat);
		}
		$this->db->from("otherpurchase");
		return $this->db->count_all_results();
	}

	public function fetch_otherpurchase(){
		return $this->db->where('status',1)->order_by('order_by')->get('otherpurchase')->result_array();
	}


	public function fetch_otherpurchase_single($id){
		$result = $this->db->where('id',$id)->get('otherpurchase')->row_array();
		$related = $this->fetch_otherpurchase_related($result['id']);
		$result['related'] = $related;

		return $result;
	}

	public function fetch_otherpurchase_related($id_otherpurchase){
		$data = [];
		$result = $this->db->select('*')->where('id !=',$id_otherpurchase)->limit(4)->get('otherpurchase')->result_array();

		$data = $result;

		return $data;
	}
}
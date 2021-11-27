<?php

/**
 * 
 */
class Model_purchase extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function record_count($cat=''){
		if($cat!=''){
			$this->db->where('id_cat',$cat);
		}
		$this->db->from("purchase");
		return $this->db->count_all_results();
	}

	public function fetch_purchase(){
		return $this->db->where('status',1)->order_by('order_by')->get('purchase')->result_array();
	}


	public function fetch_purchase_single($id){
		$result = $this->db->where('id',$id)->get('purchase')->row_array();
		$related = $this->fetch_purchase_related($result['id']);
		$result['related'] = $related;

		return $result;
	}

	public function fetch_purchase_related($id_purchase){
		$data = [];
		$result = $this->db->select('*')->where('id !=',$id_purchase)->limit(4)->get('purchase')->result_array();

		$data = $result;

		return $data;
	}
}
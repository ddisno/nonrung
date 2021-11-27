<?php

/**
 * 
 */
class Model_procurement extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function record_count($cat=''){
		if($cat!=''){
			$this->db->where('id_cat',$cat);
		}
		$this->db->from("procurement");
		return $this->db->count_all_results();
	}

	public function fetch_procurement(){
		return $this->db->where('status',1)->order_by('order_by')->get('procurement')->result_array();
	}


	public function fetch_procurement_single($id){
		$result = $this->db->where('id',$id)->get('procurement')->row_array();
		$related = $this->fetch_procurement_related($result['id']);
		$result['related'] = $related;

		return $result;
	}

	public function fetch_procurement_related($id_procurement){
		$data = [];
		$result = $this->db->select('*')->where('id !=',$id_procurement)->limit(4)->get('procurement')->result_array();

		$data = $result;

		return $data;
	}
}
<?php

/**
 * 
 */
class Model_othernews extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function record_count($cat=''){
		if($cat!=''){
			$this->db->where('id_cat',$cat);
		}
		$this->db->from("othernews");
		return $this->db->count_all_results();
	}

	public function fetch_othernews(){
		return $this->db->where('status',1)->order_by('order_by')->get('othernews')->result_array();
	}


	public function fetch_othernews_single($id){
		$result = $this->db->where('id',$id)->get('othernews')->row_array();
		$related = $this->fetch_othernews_related($result['id']);
		$result['related'] = $related;

		return $result;
	}

	public function fetch_othernews_related($id_othernews){
		$data = [];
		$result = $this->db->select('*')->where('id !=',$id_othernews)->limit(4)->get('othernews')->result_array();

		$data = $result;

		return $data;
	}
}
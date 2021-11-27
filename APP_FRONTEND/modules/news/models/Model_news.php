<?php

/**
 * 
 */
class Model_news extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function record_count($cat=''){
		if($cat!=''){
			$this->db->where('id_cat',$cat);
		}
		$this->db->from("news");
		return $this->db->count_all_results();
	}

	public function fetch_news(){
		return $this->db->where('status',1)->order_by('order_by')->get('news')->result_array();
	}


	public function fetch_news_single($id){
		$result = $this->db->where('id',$id)->get('news')->row_array();
		$related = $this->fetch_news_related($result['id']);
		$result['related'] = $related;

		return $result;
	}

	public function fetch_news_related($id_news){
		$data = [];
		$result = $this->db->select('*')->where('id !=',$id_news)->limit(4)->get('news')->result_array();

		$data = $result;

		return $data;
	}
}
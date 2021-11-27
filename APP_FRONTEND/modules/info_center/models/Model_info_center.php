<?php

/**
 * 
 */
class Model_info_center extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function record_count($cat=''){
		if($cat!=''){
			$this->db->where('id_cat',$cat);
		}
		$this->db->from("info_center");
		return $this->db->count_all_results();
	}

	public function fetch_info_center($cat=''){
		$this->db->select('*');
		$this->db->from('info_center');
		if($cat!=''){
			$this->db->where('id_cat',$cat);
		}
		$this->db->where('status',1);
		$this->db->order_by('info_center.create_datetime', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function fetch_cats(){
		$this->db->select('*');
		$this->db->where('status_cat',1);
		$query = $this->db->get('info_center_cat');
		if($query){
			return $result = $query->result_array();
		}else{
			return false;
		}
	}

	public function fetch_cats_name($cat){
		$this->db->select('*');
		$this->db->where('id_cat',$cat);
		$query = $this->db->get('info_center_cat');
		if($query){
			return $result = $query->row_array();
		}else{
			return false;
		}
	}

	public function fetch_info_center_single($id){
		$this->db->select('info_center.*,info_center_cat.id_cat,info_center_cat.name_cat_th,info_center_cat.name_cat_en');
		$this->db->from('info_center');
		$this->db->join('info_center_cat', 'info_center_cat.id_cat = info_center.id_cat');
		$this->db->where('info_center.id_info_center',$id);
		$query = $this->db->get();
		$result = $query->row_array();

		$related = $this->fetch_info_center_related($result['id_cat'],$result['id_info_center']);
		$result['related'] = $related;

		return $result;
	}

	public function fetch_info_center_related($id_cat,$id_info_center){
		$data = [];
		$this->db->select('*');
		$this->db->where('id_info_center !=',$id_info_center);
		$this->db->where('id_cat',$id_cat);
		$this->db->limit(4);
		$query = $this->db->get('info_center');
		$result = $query->result_array();
		$data = $result;

		return $data;
	}
}
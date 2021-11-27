<?php

/**
 * 
 */
class Model_blog extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function record_count($cat=''){
		if($cat!=''){
			$this->db->where('id_cat',$cat);
		}
		$this->db->from("blog");
		return $this->db->count_all_results();
	}

	public function fetch_blog($limit=1, $start=0,$cat=''){
		if($start>0){
			$start -= 1;
		}
		$this->db->select('blog.*,blog_cat.id_cat,blog_cat.name_cat_th,blog_cat.name_cat_en');
		$this->db->from('blog');
		$this->db->join('blog_cat', 'blog_cat.id_cat = blog.id_cat');
		if($cat!=''){
			$this->db->where('blog.id_cat',$cat);
		}
		$this->db->where('blog.status',1);
		$this->db->order_by('blog.create_datetime', 'ASC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function fetch_cats(){
		$this->db->select('*');
		$this->db->where('status_cat',1);
		$query = $this->db->get('blog_cat');
		if($query){
			return $result = $query->result_array();
		}else{
			return false;
		}
	}

	public function fetch_cats_name($cat){
		$this->db->select('*');
		$this->db->where('id_cat',$cat);
		$query = $this->db->get('blog_cat');
		if($query){
			return $result = $query->row_array();
		}else{
			return false;
		}
	}

	public function fetch_blog_single($id){
		$this->db->select('blog.*,blog_cat.id_cat,blog_cat.name_cat_th,blog_cat.name_cat_en');
		$this->db->from('blog');
		$this->db->join('blog_cat', 'blog_cat.id_cat = blog.id_cat');
		$this->db->where('blog.id_blog',$id);
		$query = $this->db->get();
		$result = $query->row_array();

		$related = $this->fetch_blog_related($result['id_cat'],$result['id_blog']);
		$result['related'] = $related;

		return $result;
	}

	public function fetch_blog_related($id_cat,$id_blog){
		$data = [];
		$this->db->select('*');
		$this->db->where('id_blog !=',$id_blog);
		$this->db->where('id_cat',$id_cat);
		$this->db->limit(4);
		$query = $this->db->get('blog');
		$result = $query->result_array();
		$data = $result;

		return $data;
	}
}
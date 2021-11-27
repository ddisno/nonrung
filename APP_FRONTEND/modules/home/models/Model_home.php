<?php

/**
 * 
 */
class Model_home extends CI_Model
{
	
	function __construct(){
	}

	public function fetch_slide(){
		return $this->db->where('status',1)->order_by('order_by','ASC')->get('slide')->result_array();
	}

	public function news_last(){
		return $this->db->where('status',1)->order_by('create_datetime', 'DESC')->get('news')->row_array();
	}

	public function news_first(){
		return $this->db->where('status',1)->order_by('create_datetime', 'DESC')->limit(3,0)->get('news')->result_array();
	}

	public function news_second(){
		return $this->db->where('status',1)->order_by('create_datetime', 'DESC')->limit(3,3)->get('news')->result_array();
	}

	public function othernews(){
		return $this->db->where('status',1)->order_by('create_datetime', 'DESC')->get('othernews')->result_array();
	}

	public function purchase(){
		return $this->db->where('status',1)->order_by('create_datetime', 'DESC')->get('purchase')->result_array();
	}

	public function otherpurchase(){
		return $this->db->where('status',1)->order_by('create_datetime', 'DESC')->get('otherpurchase')->result_array();
	}

	public function fetch_album(){
			$data = [];
			$this->db->select('*');
			$this->db->where('status_album',1);
			$this->db->order_by('order_by_album', 'ASC')->limit(4);
			$query = $this->db->get('album');
			foreach ($query->result_array() as $gallary) {
				$this->db->select('*');
				$this->db->where('id_album',$gallary['id_album']);
				$this->db->order_by('order_by_img','ASC');
				$query = $this->db->get('album_pic');
				$result_img = $query->row();
				if(($query->num_rows() > 0)){
					$gallary['img_path'] 	   = $result_img->img_path;
					$gallary['img_path_thumb'] = $result_img->img_path_thumb;
				}else{
					$gallary['img_path'] 	   = ''; 
					$gallary['img_path_thumb'] = '';
				}			
				$data[] = $gallary;	
			}	
			return $data;
	}

}
?>
<?php

/**
 * 
 */
class Model_gallary extends CI_Model
{
	
	function __construct()
	{

	}
	public function fetch_album(){
			$data = [];
			$this->db->select('*');
			$this->db->where('status_album',1);
			$this->db->order_by('order_by_album', 'ASC');
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

	public function fetch_album_name($id){
		$this->db->select('*');
		$this->db->where('id_album',$id);
		$query = $this->db->get('album');
		if($query){
			return $result = $query->row_array();
		}else{
			return false;
		}
	}

	public function fetch_gallary($id){
		$this->db->select('*');
		$this->db->where('id_album',$id);
		$query = $this->db->get('album_pic');
		if($query){
			return $result = $query->result_array();
		}else{
			return false;
		}
	}
}
?>
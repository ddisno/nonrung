<?php

/**
 * 
 */
class Model_search extends CI_Model
{

	public function requests($key){
		$data = [];

			$this->db->select('*');
			$this->db->where('status', 1);
			$this->db->where('stick', 1);
			$this->db->group_start();
				$this->db->like('subject',$key);
				$this->db->or_like('detail',$key);
			$this->db->group_end();
			$this->db->order_by('order_by', 'ASC');
			$query = $this->db->get('topic');
			$result = $query->result_array();
			foreach ($result as $val) {
				$this->db->select('*');
				$this->db->where('id_topic',$val['id_topic']);
				$this->db->where('status',0);
				$query = $this->db->get('topic_comment');
				$rows  = $query->num_rows();
				$val['number_comment'] = $rows;

				$this->db->select('*');
				$this->db->where('id_topic',$val['id_topic']);
				$this->db->where('status',1);
				$query = $this->db->get('topic_comment');
				$rows  = $query->num_rows();
				$val['number_verify'] = $rows;

				$this->db->select('*');
				$this->db->where('id_topic',$val['id_topic']);
				$query = $this->db->get('topic_comment');
				$rows  = $query->num_rows();
				$val['number_total'] = $rows;
				
				array_push($data, $val);
			}

			$this->db->select('*');
			$this->db->where('status', 1);
			$this->db->where('stick', 0);
			$this->db->group_start();
				$this->db->like('subject',$key);
				$this->db->or_like('detail',$key);
			$this->db->group_end();
			$query = $this->db->get('topic');
			$result = $query->result_array();
			foreach ($result as $val) {
				$this->db->select('*');
				$this->db->where('id_topic',$val['id_topic']);
				$this->db->where('status',0);
				$query = $this->db->get('topic_comment');
				$rows  = $query->num_rows();
				$val['number_comment'] = $rows;

				$this->db->select('*');
				$this->db->where('id_topic',$val['id_topic']);
				$this->db->where('status',1);
				$query = $this->db->get('topic_comment');
				$rows  = $query->num_rows();
				$val['number_verify'] = $rows;

				$this->db->select('*');
				$this->db->where('id_topic',$val['id_topic']);
				$query = $this->db->get('topic_comment');
				$rows  = $query->num_rows();
				$val['number_total'] = $rows;
				
				array_push($data, $val);
			}

			return $data;
	}
}
?>
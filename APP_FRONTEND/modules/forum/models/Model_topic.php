
<?php

/**
 * 
 */
class Model_topic extends CI_Model
{
	
	function __construct()
	{
		# code...
	}

	public function record_count($topic=''){
		if($topic!=''){
			$this->db->where('id_topic',$topic);
		}
		$this->db->from("topic");
		$this->db->where('status',1);
		return $this->db->count_all_results();
	}

	public function record_count_comment($topic){
		$this->db->from("topic_comment");
		$this->db->where('status',1);
		$this->db->where('id_topic',$topic);
		return $this->db->count_all_results();
	}

	public function api_forum_list(){
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
			$this->db->order_by('create_datetime','DESC');
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

	public function fetch_topic_comment($limit=1, $start=0,$topic){
		if($start>0){
			$start -= 1;
		}

		$data = [];

		$this->db->select('*');
		$this->db->where('id_topic', $topic);
		$this->db->where('status', 1);
		$this->db->order_by('stick','DESC');
		$this->db->order_by('order_by','ASC');
		$this->db->order_by('number','ASC');
		$this->db->limit($limit, $start);
		$query = $this->db->get('topic_comment');
		$result = $query->result_array();
		foreach ($result as $val) {
			if($val['reply']==0){
				$val['reply'] = null;
			}else{
				$this->db->select('*');
				$this->db->from('topic_comment');
				$this->db->where('id_comment',$val['reply']);
				$query = $this->db->get();
				$val['reply'] = $query->row_array();
			}
			array_push($data,$val);
		}

		return $data;
	}

	public function fetch_topic_name($topic){
		$this->db->select('*');
		$this->db->where('id_topic',$topic);
		$query = $this->db->get('topic');
		if($query){
			return $result = $query->row_array();
		}else{
			return false;
		}
	}

	public function fetch_topic_related($id_topic){
		$data = [];
		$this->db->select('*');
		$this->db->where('id_topic !=',$id_topic);
		$this->db->where('id_topic',$id_topic);
		$this->db->limit(4);
		$query = $this->db->get('topic');
		$result = $query->result_array();
		$data = $result;

		return $data;
	}

	public function create_comment($data){
		$query = $this->db->insert('topic_comment',$data);

		$number=0;

		$this->db->where('id_topic',$data['id_topic']);
		$this->db->where('status',1);
		$this->db->order_by('id_comment');
		$query = $this->db->get('topic_comment');
		$result = $query->result_array();
		foreach ($result as $val) {
			$this->db->set('number',$number+=1);
			$this->db->where('id_comment',$val['id_comment']);
			$this->db->update('topic_comment');
		}

		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function create_topic($data){
		$query = $this->db->insert('topic',$data);
		if($query){
			return true;
		}else{
			return false;
		}
	}

	// start froala
	public function upload_fl($data){
			$query = $this->db->insert('sys_froala',$data);
			if($query){
				return true;
			}else{
				return false;
			}
	}

	public function select_fl(){
			$out = [];
			$this->db->select('*');
			$query = $this->db->get('sys_froala');
			$result = $query->result();
			foreach ($query->result() as $row){
				$Imgdata = array(
		           'url'=>$row->link_uploads,
		           'name'=>$row->name_uploads,
		           'id'=>$row->id_uploads,
	     		);
	          array_push($out, $Imgdata);
			}
			return $out;
	}

	public function delete_fl($id){
			$this->db->where('id_uploads',$id);
			$query = $this->db->delete('sys_froala');
			if($query){
				return true;
			}else{
				return false;
			}
	}
}
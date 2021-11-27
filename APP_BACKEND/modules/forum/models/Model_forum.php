<?php
	/**
	 * 
	 */
	class Model_forum extends CI_Model
	{
		
		public function __construct(){
			// check table
			$this->load->dbforge();
			// $this->forum_table();
		}

		public function forum_list(){
			$data = [];

			$this->db->select('*');
			$this->db->where('status', 0);
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
			$this->db->where('stick', 1);
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


		public function forum_list_stick(){
			$this->db->select('*');
			$this->db->from('forum');
			$this->db->join('forum_cat', 'forum_cat.id_cat = forum.id_cat');
			$this->db->where('forum.stick',1);
			$this->db->order_by('forum.order_by_stick', 'ASC');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function fetch_edit(){
			$id = $this->uri->segment(4);
			$this->db->where('id_topic',$id);
			$query = $this->db->get('topic');
			$result = $query->row_array();
			if($query->num_rows() > 0){
				$id = $this->uri->segment(4);
				$this->db->where('id_topic',$id);
				$query = $this->db->get('topic_comment');
				$result_comments = $query->result_array();
				$result['comments'] = $result_comments;

				return $result;
			}else{
				return false;
			}
		}

		public function save_forum($data){
			$get = $this->db->insert('forum',$data);
			if($get){
				return true;
			}else{
				return false;
			}
		}

		public function edit_forum($data,$id){
			$this->db->where('id_forum',$id);
			$query = $this->db->update('forum',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		// ลบtopic--------------
		public function forum_del($id){
			$this->db->select('*');
			$this->db->where('id_topic',$id);
			$query = $this->db->get('topic');
			$num_rows = $query->num_rows();
			if($num_rows>0){
				$this->db->select('*');
				$this->db->where('id_topic',$id);
				$this->db->delete('topic_comment');
			}
			$this->db->select('*');
			$this->db->where('id_topic',$id);
			$response = $this->db->delete('topic');
			if($response){
				return true;
			}else{
				return false;
			}
		}

		public function forum_delmulti($data){
			if (!empty($data)) {
		        for ($i = 0; $i < count($data); $i++)
		        {	        	
		        	$this->db->select('*');
					$this->db->where('id_topic',$data[$i]);
					$query = $this->db->get('topic');
					$num_rows = $query->num_rows();
					if($num_rows>0){
						$this->db->select('*');
						$this->db->where('id_topic',$data[$i]);
						$this->db->delete('topic_comment');
					}

			        $this->db->where('id_topic', $data[$i]);
			        $this->db->delete('topic');
		        }
		        return true;
		    }else{
		    	return false;
		    }
		}

		public function get_order_forum(){
			$this->db->select('*');
			$this->db->order_by('order_by', 'DESC');
			$this->db->limit('1');
			$query = $this->db->get('forum');
			if($query->num_rows() > 0){
				$result = $query->row();
				return $result->order_by;
			}else{
				return false;
			}
		}

		public function get_order_forum_cat(){
			$this->db->select('*');
			$this->db->order_by('order_by_cat', 'DESC');
			$this->db->limit('1');
			$query = $this->db->get('forum_cat');
			if($query->num_rows() > 0){
				$result = $query->row();
				return $result->order_by_cat;
			}else{
				return false;
			}
		}

		public function order_by($data,$id){
			$this->db->where('id_forum',$id);
			$query = $this->db->update('forum',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function order_by_stick($data,$id){
			$this->db->where('id_forum',$id);
			$query = $this->db->update('forum',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function forum_status($data,$id){
			$this->db->where('id_topic',$id);
			$query = $this->db->update('topic',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function forum_stick($data,$id){
			$this->db->where('id_topic',$id);
			$query = $this->db->update('topic',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}




		// order by cat
		public function comment_list($id){
			$data = [];
			$this->db->select('*');
			$this->db->where('id_topic', $id);
			$this->db->where('status', 0);
			$query = $this->db->get('topic_comment');
			$result = $query->result_array();
			foreach ($result as $val) {
				array_push($data, $val);
			}

			$this->db->select('*');
			$this->db->where('id_topic', $id);
			$this->db->where('status', 1);
			$this->db->where('stick', 1);
			$this->db->order_by('order_by', 'ASC');
			$query = $this->db->get('topic_comment');
			$result = $query->result_array();
			foreach ($result as $val) {
				array_push($data, $val);
			}

			$this->db->select('*');
			$this->db->where('id_topic', $id);
			$this->db->where('status', 1);
			$this->db->where('stick', 0);
			$query = $this->db->get('topic_comment');
			$result = $query->result_array();
			foreach ($result as $val) {
				array_push($data, $val);
			}


			return $data;
		}

		public function comment_create($data){
			$get = $this->db->insert('topic_comment',$data);
			if($get){
				return true;
			}else{
				return false;
			}
		}

		// ลบtopic--------------
		public function comment_del($id){
			$this->db->select('*');
			$this->db->where('id_comment',$id);
			$response = $this->db->delete('topic_comment');
			if($response){
				return true;
			}else{
				return false;
			}
		}

		public function comment_delmulti($data){
			if (!empty($data)) {
		        for ($i = 0; $i < count($data); $i++)
		        {	        	
			        $this->db->where('id_comment', $data[$i]);
			        $this->db->delete('topic_comment');
		        }
		        return true;
		    }else{
		    	return false;
		    }
		}

		public function comment_status($data,$id_comment,$id_topic){
			$this->db->where('id_comment',$id_comment);
			$query = $this->db->update('topic_comment',$data);

			$number = 0;

			$this->db->where('id_topic',$id_topic);
			$this->db->where('status',1);
			$this->db->order_by('id_comment');
			$query = $this->db->get('topic_comment');
			$result = $query->result_array();
			foreach ($result as $val) {
				$this->db->set('number',$number+=1);
				$this->db->where('id_comment',$val['id_comment']);
				$this->db->update('topic_comment');
			}

			if($data['status']==0){
				$this->db->set('number',0);
				$this->db->where('id_comment',$id_comment);
				$this->db->update('topic_comment');
			}


			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function comment_stick($data,$id){
			$this->db->where('id_comment',$id);
			$query = $this->db->update('topic_comment',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}


		public function comment_order_by($data,$id_comment,$id_topic){
			$this->db->where('id_comment',$id_comment);
			$query = $this->db->update('topic_comment',$data);

			$order_by = $data['order_by'];

			$this->db->where('id_topic',$id_topic);
			$this->db->where('id_comment !=',$id_comment);
			$this->db->where('stick',1);
			$this->db->where('status',1);
			$this->db->where('order_by >=',$data['order_by']);
			$this->db->order_by('order_by');
			$query = $this->db->get('topic_comment');
			$result = $query->result_array();
			foreach ($result as $val) {
				$this->db->set('order_by',$order_by+=1);
				$this->db->where('id_comment',$val['id_comment']);
				$this->db->update('topic_comment');
			}

			if($query){
				return true;
			}else{
				return false;
			}
		}


		public function cat_edit($data,$id){
			$this->db->where('id_cat',$id);
			$get = $this->db->update('forum_cat',$data);
			if($get){
				return true;
			}else{
				return false;
			}
		}

		public function cat_del($id){
			// check id_cat in forum for foreignkey
			$this->db->where('id_cat',$id);
			$get = $this->db->get('forum');
			if($get->num_rows() > 0){
				return 'already';
			}
			// end check

			$this->db->where('id_cat',$id);
			$get = $this->db->delete('forum_cat');
			if($get){
				return 'success';
			}else{
				return 'error';
			}
		}

		public function cat_delmulti($data){
			if (!empty($data)) {
		        for ($i = 0; $i < count($data); $i++)
		        {
		        	// ตรวจสอบ foregnkey ก่อน ถ้ามี continue
		        	$this->db->where('id_cat',$data[$i]);
					$get = $this->db->get('forum');
					if($get->num_rows() > 0){
						continue;
					}
		        	// -------------------------------------
		        	
			        $this->db->where('id_cat', $data[$i]);
			        $this->db->delete('forum_cat');
		        }
		        return true;
		    }else{
		    	return false;
		    }
		}


		public function forum_status_cat($data,$id){
			$this->db->where('id_cat',$id);
			$query = $this->db->update('forum_cat',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function forum_status_home($data,$id){
			$this->db->where('id_cat',$id);
			$query = $this->db->update('forum_cat',$data);
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

		// --------------IF EXSIT TABLE------------------
		public function forum_table(){
			// fields cat
			$fields_cat = array(
		        'id_cat' => array(
		                'type' => 'INT',
		                'auto_increment' => TRUE
		        ),
		        'name_cat_th' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'name_cat_en' => array(
		                'type' =>'VARCHAR',
		                'constraint' => '100'
		        ),
		        'order_by_cat' => array(
		                'type' => 'INT',
		        ),
		        'status_cat' => array(
		                'type' => 'TINYINT',
		                'default' => 1
		        ),
		        'update_datetime' => array(
		                'type' => 'DATETIME',
		                'null' => TRUE
		        ),
			);
			$this->dbforge->add_key('id_cat', TRUE);
			$this->dbforge->add_field($fields_cat);
			$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
			$this->dbforge->create_table('forum_cat',TRUE,$attributes);
			// end create table cat

			// create forum table
			$fields_forum = array(
		        'id_forum' => array(
		                'type' => 'INT',
		                'auto_increment' => TRUE
		        ),
		        'name_th' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'name_en' => array(
		                'type' =>'VARCHAR',
		                'constraint' => '100'
		        ),
		        'text_th' => array(
		                'type' => 'text'
		        ),
		        'text_en' => array(
		                'type' =>'text'
		        ),
		        'para_th' => array(
		                'type' => 'text'
		        ),
		        'para_en' => array(
		                'type' =>'text'
		        ),
		        'img_path' => array(
		                'type' => 'text'
		        ),
		        'img_path_thumb' => array(
		                'type' =>'text'
		        ),
		        'order_by' => array(
		                'type' => 'INT',
		        ),
		        'status' => array(
		                'type' => 'TINYINT',
		                'default' => 1
		        ),
		        'update_datetime' => array(
		                'type' => 'DATETIME',
		                'null' => TRUE
		        ),
		        'id_cat' => array(
		        		'type' => 'INT'
		        )
			);
			$this->dbforge->add_key('id_forum', TRUE);
			$this->dbforge->add_field($fields_forum);
			$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_cat) REFERENCES forum_cat(id_cat)');
			$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
			$this->dbforge->create_table('forum',TRUE,$attributes);

			// $this->db->query('ALTER TABLE forum ADD FOREIGN KEY(id_cat) REFERENCES forum_cat(id_cat) ON DELETE RESTRICT ON UPDATE RESTRICT;');
		}
	// end exsit table
	}
?>
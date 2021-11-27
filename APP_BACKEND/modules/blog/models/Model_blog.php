<?php
	/**
	 * 
	 */
	class Model_blog extends CI_Model
	{
		
		public function __construct(){
			// check table
			$this->load->dbforge();
			$this->blog_table();
		}

		public function blog_list($id,$val){
			$this->db->select('*');
			$this->db->from('blog');
			$this->db->where('blog.id_cat',$id);

			if($val!=''){
				$date_explode = explode('/', $val);
				$date_start   = $date_explode[0];
				$date_end   = $date_explode[1];
				$this->db->where('blog.create_datetime >=',$date_start);
				$this->db->where('blog.create_datetime <=',$date_end);
			}
			
			$this->db->join('blog_cat', 'blog_cat.id_cat = blog.id_cat');
			$this->db->order_by('blog.order_by', 'ASC');
			$query = $this->db->get();
			return $query->result_array();
		}


		public function blog_list_stick($id){
			$this->db->select('*');
			$this->db->from('blog');
			$this->db->where('blog.id_cat',$id);
			$this->db->join('blog_cat', 'blog_cat.id_cat = blog.id_cat');
			$this->db->where('blog.stick',1);
			$this->db->order_by('blog.order_by_stick', 'ASC');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function fetch_edit(){
			$id = $this->uri->segment(4);
			$this->db->select('*');
			$this->db->from('blog');
			$this->db->where('id_blog',$id);
			$this->db->join('blog_cat', 'blog_cat.id_cat = blog.id_cat');
			$query = $this->db->get();
			$result = $query->row_array();
			if($query->num_rows() > 0){
				return $result;
			}else{
				return false;
			}
		}

		public function del_img($id){
			$this->db->where('id_blog',$id);
			$query = $this->db->get('blog');
			$result = $query->row();
			if($result->img_path != ''){
				$old_path = $result->img_path;
				$old_path_thumb = $result->img_path_thumb;
				//delete file
				//ใช้ base_url เพราะจะต้องตัดท้ิงลิ้งที่อยู่ในปัจจุบัน
				$new_path = str_replace($this->config->item('root_url'), './', $old_path);
				$new_path_thumb = str_replace($this->config->item('root_url'), './', $old_path_thumb);
				unlink($new_path);
				unlink($new_path_thumb);
				// ---------
				return true;
			}
		}

		public function save_blog($data){
			$get = $this->db->insert('blog',$data);
			if($get){
				return true;
			}else{
				return false;
			}
		}

		public function edit_blog($data,$id){
			$this->db->where('id_blog',$id);
			$query = $this->db->update('blog',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		// ลบบล็อก--------------
		public function blog_del($id){
			$this->db->select('*');
			$this->db->where('id_blog',$id);
			$query = $this->db->get('blog');
			$result = $query->row();
			if($result->img_path != ''){
				$old_path = $result->img_path;
				$old_path_thumb = $result->img_path_thumb;
				//delete file
				$new_path = str_replace($this->config->item('root_url'), './', $old_path);
				$new_path_thumb = str_replace($this->config->item('root_url'), './', $old_path_thumb);
				unlink($new_path);
				unlink($new_path_thumb);
				// ---------
				$get = $this->blog_del_img($id);
				if($get){
					return true;
				}else{
					return false;
				}
			}else{
				$get = $this->blog_del_img($id);
				if($get){
					return true;
				}else{
					return false;
				}
			}
		}
		// ลบ record เป้นฟังชั่นที่ทำต่อจากฟังก์ชั่น blog_del
		public function blog_del_img($id){
			$this->db->where('id_blog',$id);
			$query = $this->db->delete('blog');
			if($query){
				return true;
			}else{
				return false;
			}
		}
		// -----end blog del single

		public function get_order_blog(){
			$this->db->select('*');
			$this->db->order_by('order_by', 'DESC');
			$this->db->limit('1');
			$query = $this->db->get('blog');
			if($query->num_rows() > 0){
				$result = $query->row();
				return $result->order_by;
			}else{
				return false;
			}
		}

		public function get_order_blog_cat(){
			$this->db->select('*');
			$this->db->order_by('order_by_cat', 'DESC');
			$this->db->limit('1');
			$query = $this->db->get('blog_cat');
			if($query->num_rows() > 0){
				$result = $query->row();
				return $result->order_by_cat;
			}else{
				return false;
			}
		}

		public function order_by($data,$id){
			$this->db->where('id_blog',$id);
			$query = $this->db->update('blog',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function order_by_stick($data,$id){
			$this->db->where('id_blog',$id);
			$query = $this->db->update('blog',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function blog_status($data,$id){
			$this->db->where('id_blog',$id);
			$query = $this->db->update('blog',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function blog_stick($data,$id){
			$this->db->where('id_blog',$id);
			$query = $this->db->update('blog',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function blog_delmulti($data){
			if (!empty($data)) {
		        for ($i = 0; $i < count($data); $i++)
		        {	        	
		        	$this->db->select('*');
					$this->db->where('id_blog',$data[$i]);
					$query = $this->db->get('blog');
					$result = $query->row();
					if($result->img_path != ''){
						$old_path = $result->img_path;
						$old_path_thumb = $result->img_path_thumb;
						//delete file
						$new_path = str_replace($this->config->item('root_url'), './', $old_path);
						$new_path_thumb = str_replace($this->config->item('root_url'), './', $old_path_thumb);
						unlink($new_path);
						unlink($new_path_thumb);
					}

			        $this->db->where('id_blog', $data[$i]);
			        $this->db->delete('blog');
		        }
		        return true;
		    }else{
		    	return false;
		    }
		}


		// order by cat
		public function cat_list(){
			$this->db->select('*');
			$this->db->from('blog_cat');
			$this->db->order_by('order_by_cat', 'ASC');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function cat_create($data){
			$get = $this->db->insert('blog_cat',$data);
			if($get){
				return true;
			}else{
				return false;
			}
		}

		public function cat_edit($data,$id){
			$this->db->where('id_cat',$id);
			$get = $this->db->update('blog_cat',$data);
			if($get){
				return true;
			}else{
				return false;
			}
		}

		public function cat_del($id){
			// check id_cat in blog for foreignkey
			$this->db->where('id_cat',$id);
			$get = $this->db->get('blog');
			if($get->num_rows() > 0){
				return 'already';
			}
			// end check

			$this->db->where('id_cat',$id);
			$get = $this->db->delete('blog_cat');
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
					$get = $this->db->get('blog');
					if($get->num_rows() > 0){
						continue;
					}
		        	// -------------------------------------
		        	
			        $this->db->where('id_cat', $data[$i]);
			        $this->db->delete('blog_cat');
		        }
		        return true;
		    }else{
		    	return false;
		    }
		}

		public function order_by_cat($data,$id){
			$this->db->where('id_cat',$id);
			$query = $this->db->update('blog_cat',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function blog_status_cat($data,$id){
			$this->db->where('id_cat',$id);
			$query = $this->db->update('blog_cat',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function blog_status_home($data,$id){
			$this->db->where('id_cat',$id);
			$query = $this->db->update('blog_cat',$data);
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
		public function blog_table(){
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
			$this->dbforge->create_table('blog_cat',TRUE,$attributes);
			// end create table cat

			// create blog table
			$fields_blog = array(
		        'id_blog' => array(
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
			$this->dbforge->add_key('id_blog', TRUE);
			$this->dbforge->add_field($fields_blog);
			$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_cat) REFERENCES blog_cat(id_cat)');
			$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
			$this->dbforge->create_table('blog',TRUE,$attributes);

			// $this->db->query('ALTER TABLE blog ADD FOREIGN KEY(id_cat) REFERENCES blog_cat(id_cat) ON DELETE RESTRICT ON UPDATE RESTRICT;');
		}
	// end exsit table
	}
?>
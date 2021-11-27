<?php
	/**
	 * 
	 */
	class Model_personal extends CI_Model
	{
		
		public function __construct(){
			// check table
			$this->load->dbforge();
			$this->personal_table();
		}

		public function personal_list($val){
			$this->db->select('*');
			$this->db->from('personal');
			if($val!=''){
				$date_explode = explode('/', $val);
				$date_start   = $date_explode[0];
				$date_end   = $date_explode[1];
				$this->db->where('personal.create_datetime >=',$date_start);
				$this->db->where('personal.create_datetime <=',$date_end);
			}
			$this->db->order_by('order_by', 'ASC');
			$query = $this->db->get();
			return $query->result_array();
		}


		public function fetch_edit(){
			$id = $this->uri->segment(4);
			$this->db->select('*');
			$this->db->from('personal');
			$this->db->where('id',$id);
			$query = $this->db->get();
			$result = $query->row_array();
			if($query->num_rows() > 0){
				return $result;
			}else{
				return false;
			}
		}


		public function save_personal($data){
			$get = $this->db->insert('personal',$data);
			if($get){
				return true;
			}else{
				return false;
			}
		}

		public function edit_personal($data,$id){
			$this->db->where('id',$id);
			$query = $this->db->update('personal',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		// ลบบล็อก--------------
		public function personal_del($id){
			$this->db->where('id',$id);
			$query = $this->db->delete('personal');
			if($query){
				return true;
			}else{
				return false;
			}
			
		}

		// -----end personal del single

		public function get_order_personal(){
			$this->db->select('*');
			$this->db->order_by('order_by', 'DESC');
			$this->db->limit('1');
			$query = $this->db->get('personal');
			if($query->num_rows() > 0){
				$result = $query->row();
				return $result->order_by;
			}else{
				return false;
			}
		}


		public function order_by($data,$id){
			$this->db->where('id',$id);
			$query = $this->db->update('personal',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}


		public function personal_status($data,$id){
			$this->db->where('id',$id);
			$query = $this->db->update('personal',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function personal_delmulti($data){
			if (!empty($data)) {
		        for ($i = 0; $i < count($data); $i++)
		        {	        	
			        $this->db->where('id', $data[$i]);
			        $this->db->delete('personal');
		        }
		        return true;
		    }else{
		    	return false;
		    }
		}


		public function personal_status_home($data,$id){
			$this->db->where('id_cat',$id);
			$query = $this->db->update('personal_cat',$data);
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
		public function personal_table(){
			// create personal table
			$fields_personal = array(
		        'id' => array(
		                'type' => 'INT',
		                'auto_increment' => TRUE
		        ),
		        'title' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'text' => array(
		                'type' => 'text'
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
			);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->add_field($fields_personal);
			$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
			$this->dbforge->create_table('personal',TRUE,$attributes);

			// $this->db->query('ALTER TABLE personal ADD FOREIGN KEY(id_cat) REFERENCES personal_cat(id_cat) ON DELETE RESTRICT ON UPDATE RESTRICT;');
		}
	// end exsit table
	}
?>
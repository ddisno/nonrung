<?php

/**
 * 
 */
class Model_slide extends CI_Model
{
	
	public function __construct(){
		// check table
		$this->load->dbforge();
		$this->slide_table();
	}

	public function slide_list(){
		$this->db->select('*');
		$this->db->from('slide');
		$this->db->order_by('order_by', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function slide_get_order(){
		$this->db->select('*');
		$this->db->order_by('order_by', 'DESC');
		$this->db->limit('1');
		$query = $this->db->get('slide');
		if($query->num_rows() > 0){
			$result = $query->row();
			return $result->order_by;
		}else{
			return false;
		}
	}

	public function slide_create($data){
		$get = $this->db->insert('slide',$data);
		if($get){
			return true;
		}else{
			return false;
		}
	}

	public function slide_update($data,$id){
		$this->db->where('id_slide',$id);
		$query = $this->db->update('slide',$data);
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function update_del_old_img($id){
		$this->db->where('id_slide',$id);
		$query = $this->db->get('slide');
		$result = $query->row();
		if($result->img_path != ''){
			$old_path = $result->img_path;
			//delete file
			//ใช้ base_url เพราะจะต้องตัดท้ิงลิ้งที่อยู่ในปัจจุบัน
			$new_path = './'. $old_path;		
			unlink($new_path);
			// ---------
			return true;
		}
	}

	// ลบบล็อก--------------
	public function slide_del($id){
		$this->db->select('*');
		$this->db->where('id_slide',$id);
		$query = $this->db->get('slide');
		$result = $query->row();
		if($result->img_path != ''){
			$old_path = $result->img_path;
			//delete file
			$new_path = './'.$old_path;
		
			unlink($new_path);
			// ---------
			$get = $this->slide_del_img($id);
			if($get){
				return true;
			}else{
				return false;
			}
		}else{
			$get = $this->slide_del_img($id);
			if($get){
				return true;
			}else{
				return false;
			}
		}
	}

	public function slide_delmulti($data){
		if (!empty($data)) {
		    for ($i = 0; $i < count($data); $i++){	        	
		        $this->db->select('*');
				$this->db->where('id_slide',$data[$i]);
				$query = $this->db->get('slide');
				$result = $query->row();
				if($result->img_path != ''){
					$old_path = $result->img_path;
					//delete file
					$new_path = './'.$old_path;
					unlink($new_path);

				}
			    $this->db->where('id_slide', $data[$i]);
			    $this->db->delete('slide');
		    }
		    return true;
		}else{
		    return false;
		}
	}

	// ลบ record เป้นฟังชั่นที่ทำต่อจากฟังก์ชั่น slide_del
	public function slide_del_img($id){
		$this->db->where('id_slide',$id);
		$query = $this->db->delete('slide');
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function slide_order_by($data,$id){
		$this->db->where('id_slide',$id);
		$query = $this->db->update('slide',$data);
		if($query){
			return true;
		}else{
			return false;
		}
	}

	public function slide_status($data,$id){
		$this->db->where('id_slide',$id);
		$query = $this->db->update('slide',$data);
		if($query){
			return true;
		}else{
			return false;
		}
	}



	// --------------IF EXSIT TABLE------------------
	public function slide_table(){
		$fields = array(
	        'id_slide' => array(
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
	                'type' => 'TEXT',
	                'null' => TRUE,
	        ),
	        'text_en' => array(
	                'type' => 'TEXT',
	                'null' => TRUE
	        ),
	        'order_by' => array(
	                'type' => 'INT',
	        ),
	        'status' => array(
	                'type' => 'TINYINT',
	                'default' => 1
	        ),
	        'img_path' => array(
	                'type' => 'TEXT',
	                'null' => TRUE
	        ),
	        'img_path_thumb' => array(
	                'type' => 'TEXT',
	                'null' => TRUE
	        ),
	        'update_datetime' => array(
	                'type' => 'DATETIME',
	                'null' => TRUE
	        ),
		);
		$this->dbforge->add_key('id_slide', TRUE);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
		$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
		$this->dbforge->create_table('slide',TRUE,$attributes);
	}
	// end exsit table
}
?>
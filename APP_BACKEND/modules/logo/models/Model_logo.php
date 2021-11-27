<?php
	/**
	 * 
	 */
	class Model_logo extends CI_Model
	{
		
		function __construct(){
			$this->load->dbforge();
			$this->logo_table();
		}

		public function logo_get(){
			$this->db->select('*');
			$this->db->limit('1');
			$query = $this->db->get('logo');
			if($get = $query->num_rows() > 0){
				return $result = $query->row_array();
			}else{
				return false;
			}
		}

		public function logo_update($data){
			$query = $this->db->get('logo');
			if($get = $query->num_rows() > 0){
				$update = $this->db->update('logo',$data);
				if($update){
					return true;
				}else{
					return false;
				}
			}else{
				$insert = $this->db->insert('logo',$data);
				if($insert){
					return true;
				}else{
					return false;
				}
			}
		}

		public function del(){
			$get = $this->db->empty_table('logo');
			if($get){
				return true;
			}else{
				return false;
			}
		}

		public function update_del_old_img($id=''){
			$this->db->select('*');
			$query = $this->db->get('logo');
			$rows  = $query->num_rows();
			if($rows > 0){
				$result = $query->row();//query ออกมา ลบ
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

		public function logo_table(){
			$fields = array(
				'id_logo' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
				'img_path' => array(
					'type' => 'text',
					'null' => TRUE
				),
				'img_path_thumb' => array(
					'type' => 'text',
					'null' => TRUE
				),
			);
			$this->dbforge->add_key('id_logo',TRUE);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$this->dbforge->add_field("update_datetime datetime NULL ");
			$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
			$this->dbforge->create_table('logo',TRUE,$attributes);
		}
	}
?>
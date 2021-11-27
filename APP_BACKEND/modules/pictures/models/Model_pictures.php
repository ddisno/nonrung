<?php
	/**
	 * 
	 */
	class Model_pictures extends CI_Model
	{
		
		function __construct()
		{
			$this->load->dbforge();
			// $this->pictures_table();
		}
		// pictures----------------------------------------------
		public function pictures_get_order(){
			$this->db->select('*');
			$this->db->order_by('order_by', 'DESC');
			$this->db->limit('1');
			$query = $this->db->get('pictures');
			if($query->num_rows() > 0){
				$result = $query->row();
				return $result->order_by;
			}else{
				return false;
			}
		}

		public function pictures_get_order_img($id){
			$this->db->select('*');
			$this->db->where('id_img',$id);
			$this->db->order_by('order_by_img', 'DESC');
			$this->db->limit('1');
			$query = $this->db->get('album_pic');
			if($query->num_rows() > 0){
				$result = $query->row();
				return $result->order_by_img;
			}else{
				return false;
			}
		}

		public function pictures_create($data){
			$get = $this->db->insert('pictures',$data);
			$last_id = $this->db->insert_id();
			if($get){
				return $last_id;
			}else{
				return false;
			}
		}

		public function pictures_update($data,$id){
			$this->db->where('id_product',$id);
			$get = $this->db->update('pictures',$data);
			if($get){
				return true;
			}else{
				return false;
			}
		}

		// ลบสินค้า--------------
		public function pictures_del($id){
			$this->db->select('*');
			$this->db->where('id_img',$id);
			$query = $this->db->get('album_pic');
			if($query->num_rows() > 0){
				$key = $query->row_array();
				$old_path = $key['img_path'];
				$old_path_thumb = $key['img_path_thumb'];
				//delete file
				$new_path = $old_path;
				$new_path_thumb = $old_path_thumb;
				unlink($new_path);
				unlink($new_path_thumb);
				// ---------

				$this->db->where('id_img',$key['id_img']);
				$query = $this->db->delete('album_pic');
				return true;
			}else{
				return false;
			}
		}

		// ลบสินค้าแบบหลาย
		public function pictures_delmulti($data){
			if (!empty($data)) {
		        for ($i = 0; $i < count($data); $i++)
		        {	        	
		        	$this->db->select('*');
					$this->db->where('id_album',$data[$i]);
					$query = $this->db->get('album');
					if($query->num_rows() > 0){
						foreach ($query->result_array() as $key) {
							$old_path = $key['img_path'];
							$old_path_thumb = $key['img_path_thumb'];
							//delete file
							$new_path = str_replace($this->config->item('root_url'), './', $old_path);
							$new_path_thumb = str_replace($this->config->item('root_url'), './', $old_path_thumb);
							unlink($new_path);
							unlink($new_path_thumb);
							// ---------
							$this->db->where('id_img',$key['id_img']);
							$query = $this->db->delete('album_pic');
						}
					}
			        $this->db->where('id_product', $data[$i]);
			        $this->db->delete('pictures');
		        }
		        return true;
		    }else{
		    	return false;
		    }
		}

		// delete soft
		// ---------------
		public function pictures_del_soft($data,$id){
			$this->db->where('id_product',$id);
			$query = $this->db->update('pictures',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function pictures_delmulti_soft($data,$id){
			if (!empty($id)) {
		        for ($i = 0; $i < count($id); $i++)
		        {	        	
			        $this->db->where('id_product', $id[$i]);
			        $this->db->update('pictures',$data);
		        }
		        return true;
		    }
		}

		// ---------------
		// end delete soft

		public function pictures_order_by($data,$id){
			$this->db->where('id_product',$id);
			$query = $this->db->update('pictures',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function pictures_status($data,$id){
			$this->db->where('id_product',$id);
			$query = $this->db->update('pictures',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function pictures_img_save($data){
			$get = $this->db->insert('album_pic',$data);
			$last_id = $this->db->insert_id();
			if($get){
				return $last_id;
			}else{
				return false;
			}
		}

		public function pictures_fetch_list($id=''){
			// $id = $this->uri->segment(4);
			$this->db->select('*');
			$this->db->from('album_pic');
			$this->db->order_by('order_by_img','ASC');
			if($id!=''){
				$this->db->where('id_album',$id);
			}
			$query = $this->db->get();
			if($query->num_rows() > 0){
				return  $query->result_array();
			}else{
				return false;
			}
		}

		public function pictures_img_del($id){
			$this->db->where('id_img',$id);
			$query = $this->db->get('album_pic');
			$result = $query->row();

			$old_path = $result->img_path;
			$old_path_thumb = $result->img_path_thumb;
			//delete file
			//ใช้ base_url เพราะจะต้องตัดท้ิงลิ้งที่อยู่ในปัจจุบัน
			$new_path = str_replace($this->config->item('root_url'), './', $old_path);
			$new_path_thumb = str_replace($this->config->item('root_url'), './', $old_path_thumb);
			unlink($new_path);
			unlink($new_path_thumb);
			// ---------
			// delete in table
			$this->db->where('id_img',$id);
			$query = $this->db->delete('album_pic');
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function pictures_img_order_by($data,$id){
			$this->db->where('id_img',$id);
			$query = $this->db->update('album_pic',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function pictures_img_status($data,$id){
			$this->db->where('id_img',$id);
			$query = $this->db->update('album_pic',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function pictures_list(){
			$data = [];
			$this->db->select('pictures.*,pictures_cat.id_cat,pictures_cat.name_cat_th,pictures_cat.name_cat_en');
			$this->db->from('pictures');
			$this->db->join('pictures_cat', 'pictures_cat.id_cat = pictures.id_cat','left');
			$this->db->where('pictures.delete_datetime IS NULL');
			$this->db->group_by("pictures.id_product");
			$this->db->order_by('order_by', 'ASC');
			$query = $this->db->get();
			foreach ($query->result_array() as $product) {
				$this->db->select('*');
				$this->db->where('id_product',$product['id_product']);
				$this->db->order_by('order_by_img','ASC');
				$query = $this->db->get('pictures_img');
				$result_img = $query->row();
				if(($query->num_rows() > 0)){
					$product['img_path'] 	   = $result_img->img_path;
					$product['img_path_thumb'] = $result_img->img_path_thumb;
				}else{
					$product['img_path'] 	   = ''; 
					$product['img_path_thumb'] = '';
				}			
				$data[] = $product;	
			}	
			return $data;
		}

		// end pictures------------------------------------------

		// album----------------------------------------------
		public function album_list(){
			$this->db->select('*');
			$this->db->from('album');
			$this->db->order_by('order_by_album', 'ASC');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function album_create($data){
			$get = $this->db->insert('album',$data);
			if($get){
				return true;
			}else{
				return false;
			}
		}

		public function album_edit($data,$id){
			$this->db->where('id_album',$id);
			$get = $this->db->update('album',$data);
			if($get){
				return true;
			}else{
				return false;
			}
		}

		public function album_del($id){
			// check id_album in album_pic for foreignkey
			$this->db->where('id_album',$id);
			$get = $this->db->get('album_pic');
			if($get->num_rows() > 0){
				return 'already';
			}
			// end check

			$this->db->where('id_album',$id);
			$get = $this->db->delete('album');
			if($get){
				return 'success';
			}else{
				return 'error';
			}
		}

		public function album_delmulti($data){
			if (!empty($data)) {
		        for ($i = 0; $i < count($data); $i++)
		        {
		        	// ตรวจสอบ foregnkey ก่อน ถ้ามี continue
		        	$this->db->where('id_album',$data[$i]);
					$get = $this->db->get('album_pic');
					if($get->num_rows() > 0){
						continue;
					}
		        	// -------------------------------------
		        	
			        $this->db->where('id_album', $data[$i]);
			        $this->db->delete('album');
		        }
		        return true;
		    }else{
		    	return false;
		    }
		}

		public function get_order_pictures_album(){
			$this->db->select('*');
			$this->db->order_by('order_by_album', 'DESC');
			$this->db->limit('1');
			$query = $this->db->get('album');
			if($query->num_rows() > 0){
				$result = $query->row();
				return $result->order_by_album;
			}else{
				return false;
			}
		}

		public function order_by_album($data,$id){
			$this->db->where('id_album',$id);
			$query = $this->db->update('album',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function album_status($data,$id){
			$this->db->where('id_album',$id);
			$query = $this->db->update('album',$data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		// end category------------------------------------------

		// create table
		// public function pictures_table(){
		// 	$fields_cat = array(
		//         'id_cat' => array(
		//                 'type' => 'INT',
		//                 'auto_increment' => TRUE
		//         ),
		//         'name_cat_th' => array(
		//                 'type' => 'VARCHAR',
		//                 'constraint' => '100'
		//         ),
		//         'name_cat_en' => array(
		//                 'type' =>'VARCHAR',
		//                 'constraint' => '100'
		//         ),
		//         'order_by_cat' => array(
		//                 'type' => 'INT',
		//         ),
		//         'status_cat' => array(
		//                 'type' => 'TINYINT',
		//                 'default' => 1
		//         ),
		//         'update_datetime' => array(
		//                 'type' => 'DATETIME',
		//                 'null' => TRUE
		//         ),
		// 	);
		// 	$this->dbforge->add_key('id_cat', TRUE);
		// 	$this->dbforge->add_field($fields_cat);
		// 	$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
		// 	$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
		// 	$this->dbforge->create_table('pictures_cat',TRUE,$attributes);

		// 	$fields_pictures = array(
		// 		'id_product' => array(
		// 			'type' => 'INT',
		// 			'auto_increment' => TRUE
		// 		),
		// 		'name_th' => array(
		// 			'type' => 'varchar',
		// 			'constraint' => '100'
		// 		),
		// 		'name_en' => array(
		//                 'type' =>'VARCHAR',
		//                 'constraint' => '100'
		//         ),
		//         'para_th' => array(
		//                 'type' => 'text',
		//         ),
		//         'para_en' => array(
		//                 'type' =>'text',
		//         ),
		//         'text_th' => array(
		//                 'type' => 'text',
		//         ),
		//         'text_en' => array(
		//                 'type' =>'text',
		//         ),
		//         'order_by' => array(
		//                 'type' => 'INT',
		//         ),
		//         'status' => array(
		//                 'type' => 'TINYINT',
		//                 'default' => 1
		//         ),
		//         'id_cat' => array(
		//                 'type' => 'INT'
		//         ),
		//         'update_datetime' => array(
		//                 'type' => 'DATETIME',
		//                 'null' => TRUE
		//         ), 
		//         'delete_datetime' => array(
		//                 'type' => 'DATETIME',
		//                 'null' => TRUE
		//         ),     
		// 	);
		// 	$this->dbforge->add_key('id_product', TRUE);
		// 	$this->dbforge->add_field($fields_pictures);
		// 	$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
		// 	$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_cat) REFERENCES pictures_cat(id_cat)');
		// 	$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
		// 	$this->dbforge->create_table('pictures',TRUE,$attributes);

		// 	$fields_img = array(
		//         'id_img' => array(
		//                 'type' => 'INT',
		//                 'auto_increment' => TRUE
		//         ),
		//         'name_img' => array(
		//                 'type' => 'VARCHAR',
		//                 'constraint' => '100'
		//         ),
		//         'img_path' => array(
		//                 'type' =>'text'
		//         ),
		//         'img_path_thumb' => array(
		//                 'type' =>'text'
		//         ),
		//         'size' => array(
		//                 'type' => 'float'
		//         ),
		//         'type' => array(
		//                 'type' => 'VARCHAR',
		//                 'constraint' => '100'
		//         ),
		//         'order_by_img' => array(
		//                 'type' => 'INT'
		//         ),
		//         'status_img' => array(
		//                 'type' => 'TINYINT',
		//                 'default' => 1
		//         ),
		//         'id_product' => array(
		//         		'type' => 'INT'
		//         )
		// 	);
		// 	$this->dbforge->add_key('id_img', TRUE);
		// 	$this->dbforge->add_field($fields_img);
		// 	$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
		// 	$this->dbforge->add_field("update_datetime datetime NULL");
		// 	$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_product) REFERENCES pictures(id_product)');
		// 	$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
		// 	$this->dbforge->create_table('pictures_img',TRUE,$attributes);
		// }

		// froala
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
?>
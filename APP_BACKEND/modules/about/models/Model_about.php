<?php

/**
 * 
 */
class Model_about extends CI_Model
{

	public function __construct(){
		$this->load->dbforge();
		$this->about_table();
	}

	public function save($data){
		$this->db->where('id_about',1);
		$response = $this->db->update('page_about',$data);
		return($response);
	}

	public function list_about(){
		$this->db->where('id_about',1);
		$query = $this->db->get('page_about');
		$result = $query->row_array();
		return $result;
	}

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
	public function about_table(){
		$fields = array(
	        'id_about' => array(
	                'type' => 'INT',
	                'auto_increment' => TRUE
	        ),
	        'text_pg_th' => array(
	                'type' => 'text',
	                'null' => TRUE
	        ),
	        'text_pg_en' => array(
	                'type' =>'text',
	                'null' => TRUE,
	        ),
	        'text_th' => array(
	                'type' => 'TEXT',
	                'null' => TRUE
	        ),
	        'text_en' => array(
	                'type' => 'TEXT',
	                'null' => TRUE
	        ),
	        'text_ad_th' => array(
	                'type' => 'TEXT',
	                'null' => TRUE
	        ),
	        'text_ad_en' => array(
	                'type' => 'TEXT',
	                'null' => TRUE
	        ),
	        'gg_ltt' => array(
	                'type' => 'varchar',
	                'constraint' => '100'
	        ),
	        'gg_lgt' => array(
	                'type' => 'varchar',
	                'constraint' => '100'
	        ),
	        'tel' => array(
	                'type' => 'varchar',
	                'constraint' => '100'
	        ),
	        'email' => array(
	                'type' => 'varchar',
	                'constraint' => '100'
	        ),
	        'company' => array(
	                'type' => 'text',
	                'constraint' => '100'
	        ),
		);
		$this->dbforge->add_key('id_about', TRUE);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
		$this->dbforge->add_field("update_datetime datetime NULL");
		$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
		$this->dbforge->create_table('page_about',TRUE,$attributes);
		$query = $this->db->get('page_about');
		if($query->num_rows() == 0){
			$data = array(
				'company' => 'SB DRAGON'
			);
			$this->db->insert('page_about',$data);
		}
	}
}
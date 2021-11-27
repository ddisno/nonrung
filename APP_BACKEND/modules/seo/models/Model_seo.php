<?php

/**
 * 
 */
class Model_seo extends CI_Model
{
	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
		$this->seo_table();
	}

	public function save($data){
		$this->db->where('id_seo',1);
		$response = $this->db->update('seo',$data);
		return($response);
	}

	public function list(){
		$this->db->where('id_seo',1);
		$query = $this->db->get('seo');
		$result = $query->row_array();
		return $result;
	}

	// create table if exist
	public function seo_table(){
		$fields = array(
			'id_seo' => array(
				'type' => 'INT',
				'auto_increment' => TRUE
			),
			'meta_keyword' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
			'meta_descrip' => array(
				'type' => 'TEXT',
				'null' => TRUE
			),
		);
		$this->dbforge->add_key('id_seo', TRUE);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
		$this->dbforge->add_field("update_datetime datetime NULL");
		$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
		$this->dbforge->create_table('seo',TRUE,$attributes);
		$query = $this->db->get('seo');
		if($query->num_rows() == 0){
			$data = array(
				'meta_keyword' => '',
				'meta_descrip' => ''
			);

			$this->db->insert('seo',$data);
		}
	}
}
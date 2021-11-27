<?php

/**
 * 
 */
class Model_link extends CI_Model
{
	
	public function __construct(){
		$this->load->dbforge();
		$this->link_table();
	}

	public function get_links(){
		$this->db->select('*');
		$query = $this->db->get('links');
		$result = $query->result_array();
		return $result;
	}

	public function update($data){
		$get = $this->db->update_batch('links',$data,'short_name');
		if($get){
			return true;
		}else{
			return false;
		}
	}

	public function status($data,$id){
		$this->db->where('id_link',$id);
		$get = $this->db->update('links',$data);
		if($get){
			return $this->db->last_query();    
		}else{
			return false;
		}
	}

	// --------------IF EXSIT TABLE------------------
	public function link_table(){
		$fields = array(
	        'id_link' => array(
	                'type' => 'INT',
	                'auto_increment' => TRUE
	        ),
	        'short_name' => array(
	                'type' => 'VARCHAR',
	                'constraint' => '100'
	        ),
	        'link' => array(
	                'type' =>'text'
	        ),
	        'status' => array(
	                'type' =>'tinyint',
	                'default' => 1
	        )  
		);
		$this->dbforge->add_key('id_link', TRUE);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
		$this->dbforge->add_field("update_datetime datetime NULL ");
		$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
		$this->dbforge->create_table('links',TRUE,$attributes);

		$query = $this->db->get('links');
		if($query->num_rows() == 0){
			$data = array(
			       	array(
			                'short_name' => 'FB',
			                'link' => '#',
			        ),
			        array(
			                'short_name' => 'GG',
			                'link' => '#',
			        ),
			        array(
			                'short_name' => 'IG',
			                'link' => '#',
			        ),
			        array(
			                'short_name' => 'TW',
			                'link' => '#',
			        ),
			        array(
			                'short_name' => 'PR',
			                'link' => '#',
			        ),
			        array(
			                'short_name' => 'YT',
			                'link' => '#',
			        ),
			        array(
			                'short_name' => 'VO',
			                'link' => '#',
			        ),
			        array(
			                'short_name' => 'GH',
			                'link' => '#',
			        ),
			        array(
			                'short_name' => 'YH',
			                'link' => '#',
			        ),
			        array(
			                'short_name' => 'LK',
			                'link' => '#',
			        ),
			);
			$this->db->insert_batch('links',$data);
		}
	}
	// end exsit table
}


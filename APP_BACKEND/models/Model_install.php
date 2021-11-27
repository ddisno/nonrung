<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * 
	 */
	class model_install extends CI_Model
	{
		
		function __construct()
		{
			$this->load->dbforge();
		}

		public function save($data,$data_login){

			// สร้าง members
			$fields = array(
				'id_member' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
		        'f_name' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'l_name' => array(
		                'type' =>'VARCHAR',
		                'constraint' => '100'
		        ),
		        'phone' => array(
		                'type' =>'VARCHAR',
		                'constraint' => '100'
		        ),
		        'email' => array(
		                'type' =>'VARCHAR',
		                'constraint' => '100'
		        ),
		        'update_datetime' => array(
		                'type' => 'DATETIME',
		                'null' => TRUE
		        ),
			);
			$this->dbforge->add_key('id_member', TRUE);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
			$this->dbforge->create_table('m_members',TRUE,$attributes);

			// สร้าง m_members_login
			$fields = array(
				'id_member_login' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
		        'username' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'password' => array(
		                'type' =>'VARCHAR',
		                'constraint' => '100'
		        ),
		        'status' => array(
		        	'type' => 'ENUM("active","inactive")',
					'default' => 'active',
					'null' => FALSE,
		        ),
		        'id_role' => array(
		                'type' =>'VARCHAR',
		                'constraint' => '100'
		        ),
		        'id_member' => array(
		                'type' => 'INT',
		        ),
		        'log_login' => array(
		                'type' => 'DATETIME',
		                'null' => TRUE
		        ),
		        'log_logout' => array(
		                'type' => 'DATETIME',
		                'null' => TRUE
		        ),
			);
			$this->dbforge->add_key('id_member_login', TRUE);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
			$this->dbforge->create_table('m_members_login',TRUE,$attributes);

			// สร้าง m_members_role
			$fields = array(
				'id_role' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
		        'name_role' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'status' => array(
		                'type' =>'ENUM("active","inactive")',
		                'null' => FALSE
		        ),
		        'update_datetime' => array(
		                'type' => 'DATETIME',
		                'null' => TRUE
		        ),
		        'delete_datetime' => array(
		                'type' => 'DATETIME',
		                'null' => TRUE
		        ),
			);
			$this->dbforge->add_key('id_role', TRUE);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
			$this->dbforge->create_table('m_members_role',TRUE,$attributes);

			// สร้าง m_modules
			$fields = array(
				'id_module' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
		        'label' => array(
		            'type' => 'VARCHAR',
		            'constraint' => '100'
		        ),
		        'link' => array(
		            'type' => 'VARCHAR',
		            'constraint' => '100'
		        ),
		        'icon' => array(
		            'type' => 'VARCHAR',
		            'constraint' => '100'
		        ),
		        'parent' => array(
					'type' => 'INT'
				),
				'sort' => array(
					'type' => 'INT'
				),
				'target' => array(
		                'type' => 'VARCHAR',
		                'constraint' => '100'
		        ),
		        'update_datetime' => array(
		                'type' => 'DATETIME',
		                'null' => TRUE
		        ),
			);
			$this->dbforge->add_key('id_module', TRUE);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
			$this->dbforge->create_table('m_modules',TRUE,$attributes);

			// สร้าง m_permissions
			$fields = array(
				'id_permission' => array(
					'type' => 'INT',
					'auto_increment' => TRUE
				),
				'id_role' => array(
					'type' => 'INT',
				),
				'id_module' => array(
					'type' => 'INT',
				),
		        'level' => array(
		                'type' =>'ENUM("manage","write","read","none")',
		                'null' => FALSE
		        ),
		        'update_datetime' => array(
		                'type' => 'DATETIME',
		                'null' => TRUE
		        ),
			);
			$this->dbforge->add_key('id_permission', TRUE);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_field("create_datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_role) REFERENCES m_members_role(id_role) ON DELETE CASCADE ON UPDATE CASCADE');
			$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_module) REFERENCES m_modules(id_module) ON DELETE CASCADE ON UPDATE CASCADE');
			$attributes = array('ENGINE' => 'InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');
			$this->dbforge->create_table('m_permissions',TRUE,$attributes);


			// เพิ่มดาต้า user role ก่อน 1 ระดับ
			$data_role = array(
				'name_role' => 'ผู้ดูแลระบบ',
			);
			$this->db->insert('m_members_role', $data_role); 

			// เพิ่มดาต้าเข้า
			$this->db->insert('m_members', $data); // เพิ่มค่าแรกเข้าไป
			$id = $this->db->insert_id(); // คิวรี่ค่าแรกออกมา
			

			// เพิ่ม user_name surname สำหรับ login
			$data_login['id_member'] = $id;
			$data_login['id_role']	 = 1;
			$data_login['log_login'] = date('Y-m-d H:i:s');
			$this->db->insert('m_members_login', $data_login); // เพิ่มค่าแรกเข้าไป
			$id = $this->db->insert_id(); // คิวรี่ค่าแรกออกมา
			

			//คิวรี่ค่าล่าสุดออกมา เพื่อกำหนด session
			$this->db->where('id_member',$id); 
			$query = $this->db->get('m_members_login');
			$result = $query->row_array();

			$this->db->where('id_member',$id); 
			$query_member = $this->db->get('m_members');
			$result_member = $query_member->row_array();

			$this->db->where('id_role',$result['id_role']); 
			$query_role = $this->db->get('m_members_role');
			$result_role = $query_role->row_array();

			$result['info'] = $result_member;
			$result['role'] = $result_role;

			return $result;
		}
	}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_roles extends MY_Controller
{

  public function __construct(){
    parent::__construct();
    $this->load->model('model_m_roles');
    $this->load->library('form_validation'); // โหลดไลบรารี่ form_validation ของ ci มาใช้งาน   
  }

	public function index() {
	  // check permission before operator
    $this->cc_auth->_is_check_permission('admin::roles_index');
    // ------------------------------------
		$this->data['title'] = 'จัดการบทบาท';
    $this->middle = 'index'; // passing middle to function. change this for different views.
    $this->layout();
  }

  public function create(){
    // check permission before operator
    $this->cc_auth->_is_check_permission('admin::roles_create');
    // ------------------------------------
     if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){
      $this->form_validation->set_rules('name_role', 'Name role', 'trim|required|min_length[5]');

      if ($this->form_validation->run() == TRUE) {
        // implement roles
        $roles = $this->input->post('id_permis');
        $menus = $this->input->post('id_menu');
        $data = array(
          'name_role'   => $this->input->post('name_role'),
          'description' => $this->input->post('description'),
          'status'      => $this->input->post('status'),
          'is_admin'    => $this->input->post('is_admin')
        );
        
       $insert = $this->model_m_roles->save($data,$roles,$menus);//insert
        if($insert){
          $this->session->set_flashdata('message', 'เพิ่มบทบาทเรียบร้อยแล้ว');
        }else{
          $this->session->set_flashdata('message', 'เกิดปัญหากับระบบ dbs');
        }
      } 
    }

    $this->data['title']       = 'เพิ่มบทบาท';
    $this->data['menus']       = $this->model_m_roles->fetch_menus();
    $this->data['permissions'] = $this->model_m_roles->fetch_permissions();
    $this->middle              = 'create';
    $this->layout();
  }

  public function edit(){
    // check permission before operator
    $this->cc_auth->_is_check_permission('admin::roles_edit');
    // ------------------------------------
    if($get = $this->db->where('id_role',$this->uri->segment(3))->get('m_roles')->num_rows()==''){
      redirect('m_roles');
    }

    if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){
      $this->form_validation->set_rules('name_role', 'Name role', 'trim|required|min_length[5]');

      if ($this->form_validation->run() == TRUE) {
        // implement roles
        $id_role = $this->input->post('id_role');
        // permiss check
        $old_permis = (null!==$this->input->post('old_permis')) ? $this->input->post('old_permis') : [];
        $new_permis = (null!==$this->input->post('new_permis')) ? $this->input->post('new_permis') : [];
        // menus check
        $old_menus  = (null!==$this->input->post('old_menus')) ? $this->input->post('old_menus') : [];
        $new_menus  = (null!==$this->input->post('new_menus')) ? $this->input->post('new_menus') : [];
        // info general
        $data = array(
          'name_role'   => $this->input->post('name_role'),
          'description' => $this->input->post('description'),
          'status'      => $this->input->post('status'),
          'is_admin'    => $this->input->post('is_admin')
        );
        
       $update = $this->model_m_roles->update($data,$id_role,$old_permis,$old_menus,$new_permis,$new_menus);//insert
        if($update){
          $this->session->set_flashdata('message', 'แก้ไขบทบาทเรียบร้อยแล้ว');
        }else{
          $this->session->set_flashdata('message', 'เกิดปัญหากับระบบ dbs');
        }
      } 
    }

    $this->data['title']       = 'แก้ไขบทบาท';
    // about this role
    $this->data['role']        = $this->db->where('id_role',$this->uri->segment(3))->get('m_roles')->row_array(); 
    // all the menus
    $this->data['menus']       = $this->model_m_roles->fetch_menus();  
    // all the permissions
    $this->data['permissions'] = $this->model_m_roles->fetch_permissions();
    // all the menus
    $roles_menu = $this->model_m_roles->get_roles_menu($this->uri->segment(3));
    $this->data['roles_menu'] = $roles_menu = ($roles_menu) ? $roles_menu : []; 
    // all the permissions
    $roles_permission = $this->model_m_roles->get_roles_permission($this->uri->segment(3));
    $this->data['roles_permission'] = $roles_permission = ($roles_permission) ? $roles_permission : []; 
    $this->middle              = 'edit';
    $this->layout();
  }

      // deleate menu
  public function del(){
    // check permission before operator
    $this->cc_auth->_is_check_permission('admin::roles_delete');
    // ------------------------------------
      $id = $this->input->post('id');
      $del = $this->model_m_roles->del($id);

      $json = array('token' => $this->token,'hash' => $this->hash);

      if($del===true){
        $json['status'] = 'done';
        $json['info']   = 'ลบข้อมูลเรียบร้อยแล้ว'; 
      }elseif($del=='exist'){
        $json['status'] = $del;
        $json['info']   = 'ไม่สามารถลบได้เนื่องจากมีบทบาทนี้ผูกกับสมาชิกอยู่';
      }else{
        $json['status'] = 'error';
        $json['info']   = 'เกิดปัญหากับระบบ dbs';  
      }
      
      $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
  }


  public function delmulti(){
    // check permission before operator
    $this->cc_auth->_is_check_permission('admin::roles_delete');
    // ------------------------------------

    $json = array(
        'token' => $this->token,
        'hash' => $this->hash
      );

    if(empty($this->input->post('chk_role'))){
      return false;
    }

    $id = $this->input->post('chk_role');
    $del = $this->model_m_roles->delmulti($id);
    if($del){
      $json['status'] = 'done';
      $json['info']   = 'ลบข้อมูลเรียบร้อยแล้ว';
      $json['text']   = '***ข้อมูลบางตัวอาจไม่สามารถลบเนื่องจากมีสมาชิกผูกอยู่';
      $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($json));
    }else{
      $json['status'] = 'error';
      $json['info'] = 'เกิดปัญหากับระบบ dbs';
      $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($json));
    }
  }

  // command role
    public function list_role(){
    // check permission before operator
    $this->cc_auth->_is_check_permission('admin::roles_index');
    // ------------------------------------
      $get = $this->model_m_roles->list_role();
      echo json_encode(array('data'=>$get));
    }


}

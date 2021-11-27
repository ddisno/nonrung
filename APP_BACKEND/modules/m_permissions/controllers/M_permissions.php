<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_permissions extends MY_Controller
{

  public function __construct(){
    parent::__construct();
    $this->load->model('model_m_permissions');
    $this->load->library('form_validation');
     // menu or module for super admin 
    $this->cc_auth->_is_super();
    // -----------------------------------------------------
  }

	public function index() {
	
		$this->data['title'] = 'จัดการสิทธิ์การใช้งาน';
    $this->middle = 'index'; // passing middle to function. change this for different views.
    $this->layout();
  }

  public function create(){

    if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){
      $this->form_validation->set_rules('key', 'Key', 'trim|required|min_length[5]|is_unique[m_permissions.key]');

      if ($this->form_validation->run() == TRUE) {
        // implement roles
        $roles = $this->input->post('id_role');
        $data = array(
        'key' => $this->input->post('key'),
        'description'  => $this->input->post('description'),
        );
        
        
        $insert = $this->model_m_permissions->save($data,$roles);//insert
        if($insert){
          $this->session->set_flashdata('message', 'เพิ่มสิทธิ์การใช้งานเรียบร้อยแล้ว');
        }else{
          $this->session->set_flashdata('message', 'เกิดปัญหากับระบบ dbs');
        }
      } 
    }
    $this->data['title'] = 'เพิ่มสิทธิ์การใช้งาน';
    $this->data['roles'] = $this->model_m_permissions->fetch_roles();
    $this->middle = 'create';
    $this->layout();

  }

  public function edit(){
    if($get = $this->db->where('key',$this->uri->segment(3))->get('m_permissions')->num_rows()==''){
        redirect('m_permissions');
    }
    if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){

      $original_key = $this->db->where('key',$this->uri->segment(3))->get('m_permissions')->row()->key ;
      if($this->input->post('key') != $original_key) {
        $is_unique_key =  '|is_unique[m_permissions.key]';
      } else {
        $is_unique_key =  '';
      }
      $this->form_validation->set_rules('key', 'Key', 'trim|required|min_length[5]'.$is_unique_key);

      if ($this->form_validation->run() == TRUE) {
        // implement roles
        $old_role = (null!==$this->input->post('old_role')) ? $this->input->post('old_role') : [];
        $new_role = (null!==$this->input->post('new_role')) ? $this->input->post('new_role') : [];
        $data = array(
        'key' => $this->input->post('key'),
        'description'  => $this->input->post('description'),
        );
        
        
        $update = $this->model_m_permissions->update($data,$this->input->post('old_key'),$old_role,$new_role);//insert
        if($update){
          $this->session->set_flashdata('message', 'แก้ไขสิทธิ์การใช้งานเรียบร้อยแล้ว');
          redirect('m_permissions/edit/'.$this->input->post('key'));
        }else{
          $this->session->set_flashdata('message', 'เกิดปัญหากับระบบ dbs');
        }
      }
    }
    
    $this->data['title'] = 'แก้ไขสิทธิ์การใช้งาน';
    $this->data['roles'] = $this->model_m_permissions->fetch_roles();
    $this->data['permission'] = $this->db->where('key',$this->uri->segment(3))->get('m_permissions')->row_array();
    // only id_role for check in_array
    $roles_permission = $this->model_m_permissions->get_roles_permission($this->uri->segment(3));
    $this->data['roles_permission'] = $roles_permission = ($roles_permission) ? $roles_permission : []; 
    $this->middle = 'edit';
    $this->layout();
  }


  public function del(){

      $key = $this->input->post('key');
      $del = $this->model_m_permissions->del($key);

      $json = array('token' => $this->token,'hash' => $this->hash);

      if($del===true){
        $json['status'] = 'done';
        $json['info']   = 'ลบข้อมูลเรียบร้อยแล้ว'; 
      }else{
        $json['status'] = 'error';
        $json['info']   = 'เกิดปัญหากับระบบ dbs';  
      }
      
      $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
  }


  public function delmulti(){

    $json = array(
        'token' => $this->token,
        'hash' => $this->hash
      );

    if(empty($this->input->post('chk_permission'))){
      $json['status'] = 'error';
      $json['info'] = 'ไม่มีข้อมูลเข้ามา';
      $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($json));
      exit;
    }

    $keys = $this->input->post('chk_permission');
    $del = $this->model_m_permissions->delmulti($keys);
    if($del){
      $json['status'] = 'done';
      $json['info'] = 'ลบข้อมูลเรียบร้อยแล้ว';
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

  // Ajax
    public function list_permissions(){
      $get = $this->model_m_permissions->list_permissions();
      $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array('data'=>$get)));
    }
}

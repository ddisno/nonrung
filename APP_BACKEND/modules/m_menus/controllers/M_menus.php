<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_menus extends MY_Controller
{

  public function __construct(){
    parent::__construct();
    $this->load->model('model_m_menus');
    $this->load->library('form_validation'); // โหลดไลบรารี่ form_validation ของ ci มาใช้งาน   
    // menu or module for super admin 
    $this->cc_auth->_is_super();
    // -----------------------------------------------------
  }

	public function index() {
	
		$this->data['title'] = 'จัดการเมนู';
    $this->data['roles'] = $this->db->where('status','active')->where('is_admin',1)->get('m_roles')->result_array();
    $this->middle = 'index'; // passing middle to function. change this for different views.
    $this->layout();
  }

  public function create(){

    if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){
      $this->form_validation->set_rules('label','Label','required');
      $this->form_validation->set_rules('link','Link', 'required');

      if($this->form_validation->run()){
        $roles = $this->input->post('id_role');
        $data = array(
          'label' => $this->input->post('label'),
          'link'  => $this->input->post('link'),
          'icon'  => $this->input->post('icon'),
          'target' => $this->input->post('target'),
          'type'  => $this->input->post('type')
        );

        $insert = $this->model_m_menus->save($data,$roles);//insert
        if($insert){
          $this->session->set_flashdata('message', 'เพิ่มเมนูเรียบร้อยแล้ว');
        }else{
          $this->session->set_flashdata('message', 'เกิดปัญหากับระบบ dbs');
        }
      }
    }

    $this->data['title'] = 'เพิ่มเมนู';
    $this->middle = 'create'; // passing middle to function. change this for different views.
    $this->data['roles'] = $this->model_m_menus->fetch_roles();
    $this->layout();
  }

  public function edit(){
    
    if($get = $this->db->where('id_menu',$this->uri->segment(3))->get('m_menus')->num_rows()==''){
      redirect('m_menus');
    }
    
    // $result = $get->row_array();
    if(null!==$this->input->server('REQUEST_METHOD') && $this->input->server('REQUEST_METHOD') == 'POST'){
      $this->form_validation->set_rules('label','Label','required');
      $this->form_validation->set_rules('link','Link', 'required');
       if($this->form_validation->run()){
        // implement roles
        $old_role = (null!==$this->input->post('old_role')) ? $this->input->post('old_role') : [];
        $new_role = (null!==$this->input->post('new_role')) ? $this->input->post('new_role') : [];
        $data = array(
          'label' => $this->input->post('label'),
          'link'  => $this->input->post('link'),
          'icon'  => $this->input->post('icon'),
          'target' => $this->input->post('target'),
          'type'  => $this->input->post('type')
        );
        $update = $this->model_m_menus->update($data,$this->input->post('id_menu'),$old_role,$new_role);//insert
        if($update){
          $this->session->set_flashdata('message', 'แก้ไขเมนูเรียบร้อยแล้ว');
        }else{
          $this->session->set_flashdata('message', 'เกิดปัญหากับระบบ dbs');
        }
      }
    }

    $this->data['title'] = 'แก้ไขเมนู';
    $this->data['roles'] = $this->model_m_menus->fetch_roles();
    $this->data['menu'] = $this->db->where('id_menu',$this->uri->segment(3))->get('m_menus')->row_array();
     // only id_role for check in_array
    $roles_menu = $this->model_m_menus->get_roles_menu($this->uri->segment(3));
    $this->data['roles_menu'] = $roles_menus = ($roles_menu) ? $roles_menu : []; 
    $this->middle = 'edit';
    $this->layout();
  }

  // menus sort ------------------------------------------------------------------------
    // intregate with getmenu()
    public function list_menus(){
      
      $results = $this->model_m_menus->list_menus();
      
      $ref   = [];
      $items = [];

      foreach ($results as $data) {
        $thisRef = &$ref[$data->id_menu];

          $thisRef['parent'] = $data->parent;
          $thisRef['label'] = $data->label;
          $thisRef['link'] = $data->link;
          $thisRef['id'] = $data->id_menu;
          $thisRef['icon'] = $data->icon;
          $thisRef['target'] = $data->target;

         if($data->parent == 0) {
              $items[$data->id_menu] = &$thisRef;
         } else {
              $ref[$data->parent]['child'][$data->id_menu] = &$thisRef;
         }
      }

      $class = 'dd-list';
      $id_role = $this->input->get('id');
      $html = $this->get_menu($items,$class,$id_role);
      echo $html;
    }
    
    public function get_menu($items,$class,$id_role) {

     $html = "<ol class=\"".$class."\" id=\"menu-id\">";

      foreach($items as $key=>$value) {
        if($id_role!='' && $id_role != 1){
          if (!in_array($value['id'], $this->model_m_menus->check_my_menu($id_role))) {
            continue;
          }
        }
        
        $html.= '<li class="dd-item dd3-item" data-id="'.$value['id'].'" >
                      <div class="dd-handle dd3-handle"><span><i id="icon_show'.$value['id'].'" class="'.$value['icon'].'"></i></span></div>
                      <div class="dd3-content dd-handle">
                        <span id="label_show'.$value['id'].'">'.$value['label'].'</span> 
                        <span class="span-right dd-nodrag">
                          <a class="edit-button" href="'.base_url().'m_menus/edit/'.$value['id'].'">
                            <i class="fa fa-pencil"></i>
                          </a>
                          <a class="del-button" id="'.$value['id'].'" data-name="'.$value['label'].'"><i class="fa fa-trash"></i>
                          </a>
                        </span> 
                      </div>
                      ';
          if(array_key_exists('child',$value)) {
              $html .= $this->get_menu($value['child'],'child',$id_role);
          }
              $html .= "</li>";
      }
      $html .= "</ol>";

      return $html;
    }

    // intregate with parseJsonArray()
    public function sort_menus(){
      $json = array(
        'token' => $this->token,
        'hash' => $this->hash
      );

      $data = json_decode($this->input->get('data'));

      if (empty($data)) {
        $json['status'] = 'done';
        $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($json));
        exit;
      }

      $readbleArray = $this->parseJsonArray($data);

      $sort_db = $this->model_m_menus->sort_menus($readbleArray);
      if($sort_db){
        $json['status'] = 'done';
      }else{
        $json['status'] = 'error';
      }
      
      $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($json));
    }
    public function parseJsonArray($jsonArray, $parentID = 0) {

      $return = array();
      foreach ($jsonArray as $subArray) {
        $returnSubSubArray = array();
        if (isset($subArray->children)) {
        $returnSubSubArray = $this->parseJsonArray($subArray->children, $subArray->id);
        }

        $return[] = array('id' => $subArray->id, 'parentID' => $parentID);
        $return = array_merge($return, $returnSubSubArray);
      }
      return $return;
    }

    // deleate menu
    public function del(){
      $id = $this->input->post('id');
      $del = $this->model_m_menus->del($id);
      if($del){
        $json = array(
          'status'=>'done',
          'info'=>'ลบข้อมูลเรียบร้อยแล้ว',
          'token' => $this->token,
          'hash' => $this->hash
          );
      }else{
        $json = array(
          'status'=>'error',
          'info'=>'เกิดข้อผิดพลาด',
          'token' => $this->token,
          'hash' => $this->hash
          );
      }
      
      $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
    }

}

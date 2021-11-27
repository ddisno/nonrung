<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends MX_Controller 
 { 

  public $language;
  public function __construct(){
    // set language
    parent::__construct();
    $this->config->set_item('base_url', $this->currentUrl());
    $this->config->set_item('vendor',  base_url().'asset/frontend/');
    // -------------------------------------------------------------------------------------------------------
    $this->config->set_item('before_uri',base_url()); // สำหรับเปลี่ยนภาษา ก่ินหน้า th or en
    $after = $this->uri->uri_string();

    $num = $this->uri->total_segments(); //หาค่ามากสุดของ uri
    $cut_after = explode('/', $after);//ตัดสตริงให้เป็น อาร์เรย์

    $after_uri = '';
    for ($i=1; $i < $num ; $i++) { 
      if($i==$num-1){
        $after_uri .= $cut_after[$i];
        
      }else{
        $after_uri .= $cut_after[$i].'/';
      }
      
    }
     $this->config->set_item('after_uri', $after_uri); // สำหรับเปลี่ยนภาษา หลัง th or en

    $this->language = (!empty($this->uri->segment(1))) ? $this->uri->segment(1) : null;

    if($this->language != 'th' ){
      $this->config->set_item('base_url', base_url(). 'th'); //สำหรับภาษาเดียว
       redirect(base_url().'home','location', 301);
    }
    // --------------------------------------------------------------------------
    
    if($this->language == 'th' || $this->language == 'en'){
      $this->config->set_item('base_url', base_url(). $this->language); 

      $this->lang->load('header', $this->language);

    }elseif(empty($this->language)){   
      redirect(base_url().'home','location', 301);
    }else{
      $this->config->set_item('base_url',base_url().$this->config->item('language'));  

      if($this->language != 'th' || $this->language != 'en'){
        redirect(base_url().$this->language,'location',301);
      }

    }
    
    if($this->uri->segment(2)=='backend'){
      redirect($this->config->item('before_uri').'backend');     
    }

  }
  // end----set language

   //set the class variable.
   var $template  = array();
   var $data      = array();
   //Load layout    
   public function layout() {
      // logo
      $no_img = 'asset/backend/img/no_img_sq.jpg';
      $this->db->select('*');
      $query = $this->db->get('logo');
      $result = $query->row_array();
      if($query->num_rows() >0){
        $this->data['logo'] = $this->config->item('before_uri').$result['img_path'];
      }else{
        $this->data['logo'] = $this->config->item('before_uri').$no_img;
      }
      // end logo

      // links footer
      $this->db->select('*');
      $this->db->where('status',1);
      $query_icon = $this->db->get('links');
      $result_icon = $query_icon->result_array();
      $this->data['icons'] = $result_icon;
      // end footer----------------------------------------------------------------------

      // fetch about
      $this->db->select('*');
      $query_about = $this->db->get('page_about');
      $result_about = $query_about->row_array();
      $this->data['abouts'] = $result_about;
      // end fetch about-----------------------------------------------------------------

      // fetch seo
      $this->db->select('*');
      $query_seo = $this->db->get('seo');
      $result_seo = $query_seo->row_array();
      $this->data['seo'] = $result_seo;

      // fetch law
      $this->data['law']         = $this->db->get('law')->result_array();

      // fetch law
      $this->data['information'] = $this->db->get('information')->result_array();

      // fetch law
      $this->data['personal']    = $this->db->get('personal')->result_array();

      // fetch law
      $this->data['knowledge']   = $this->db->limit(10)->get('knowledge')->result_array();

      // fetch law
      $this->data['toweb']   = $this->db->get('toweb')->result_array();

      // fetch law
      $this->data['budget']   = $this->db->limit(10)->get('budget')->result_array();

      // fetch law
      $this->data['procurement']   = $this->db->limit(10)->get('procurement')->result_array();

      // making temlate and send data to view.
      $this->template['header'] = $this->load->view('layout/header', $this->data, true);
      $this->template['middle'] = $this->load->view($this->middle, $this->data, true);
      $this->template['right']  = $this->load->view('layout/right', $this->data, true);
      $this->template['footer'] = $this->load->view('layout/footer', $this->data, true);
      $this->load->view('layout/index', $this->template);
   }

   public function covert_language(){

   }

   // set currentUrl
    private function currentUrl()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $current  = $_SERVER['HTTP_HOST'] . '';
        return $protocol . $current;
    }

}

/**
 * 
 */
class Menu extends MX_Controller
{
  public function active($value=''){
    $page_url = $this->uri->segment(2);
    if($page_url == $value){
      return 'current';
    }else{
      return '';
    }
  }
}
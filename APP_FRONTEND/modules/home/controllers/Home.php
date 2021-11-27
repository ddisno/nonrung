<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('model_home');
		$this->lang->load('home',$this->language);
	}

	public function index() {

		  $this->data['slide_head']           = $this->model_home->fetch_slide();
      $this->data['albums']               = $this->model_home->fetch_album();
		  // -------------ข่าวประชาสัมพันธ์
      $this->data['news_last']            = $this->model_home->news_last();
      $this->data['news_first']           = $this->model_home->news_first();
      $this->data['news_second']          = $this->model_home->news_second();
      
		  $this->data['title'] = 'ยินดีต้อนรับ';
    	$this->middle = 'home'; // passing middle to function. change this for different views.
    	$this->layout();
  }

  public function othernews(){
      // -------------ข่าวประชาสัมพันธ์ภายนอก
      $data = $this->data['othernews']     = $this->model_home->othernews();

      $json = array('data'=>$data,);

      $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
  }

  public function purchase(){
      // -------------ข่าวสารจัดซื้อจัดจ้าง
      $data = $this->data['purchase']      = $this->model_home->purchase();

      $json = array('data'=>$data,);

      $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
  }

  public function otherpurchase(){
      // -------------ข่าวสารจัดซื้อจัดจ้างภายนอก
      $data = $this->data['otherpurchase'] = $this->model_home->otherpurchase();

      $json = array('data'=>$data,);

      $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($json));
  }

}

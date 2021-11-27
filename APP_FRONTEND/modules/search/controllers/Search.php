<?php

class Search extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_search');
		$this->lang->load('home',$this->language);
	}

	public function index() {

		$this->data['title'] = lang('lang_title');
    	$this->middle = 'search'; // passing middle to function. change this for different views.
    	$this->layout();
  	}


  	public function requests(){
  		$key = $this->input->get('word'); 
  		$get = $this->data['requests'] = $this->model_search->requests($key);
  		echo json_encode(array('data'=>$get));
  	}

    public function news(){
      $get = $this->db->where('status',1)->like('title',$this->input->get('word'))->order_by('create_datetime', 'DESC')->get('news')->result_array();
      echo json_encode(array('data'=>$get));
    }

    public function othernews(){
      $get = $this->db->where('status',1)->like('title',$this->input->get('word'))->order_by('create_datetime', 'DESC')->get('othernews')->result_array();
      echo json_encode(array('data'=>$get));
    }

    public function purchase(){
      $get = $this->db->where('status',1)->like('title',$this->input->get('word'))->order_by('create_datetime', 'DESC')->get('purchase')->result_array();
      echo json_encode(array('data'=>$get));
    }

    public function otherpurchase(){
      $get = $this->db->where('status',1)->like('title',$this->input->get('word'))->order_by('create_datetime', 'DESC')->get('otherpurchase')->result_array();
      echo json_encode(array('data'=>$get));
    }

    public function budget(){
      $get = $this->db->where('status',1)->like('title',$this->input->get('word'))->order_by('create_datetime', 'DESC')->get('budget')->result_array();
      echo json_encode(array('data'=>$get));
    }

    public function information(){
      $get = $this->db->where('status',1)->like('title',$this->input->get('word'))->order_by('create_datetime', 'DESC')->get('information')->result_array();
      echo json_encode(array('data'=>$get));
    }

    public function procurement(){
      $get = $this->db->where('status',1)->like('title',$this->input->get('word'))->order_by('create_datetime', 'DESC')->get('procurement')->result_array();
      echo json_encode(array('data'=>$get));
    }

    public function law(){
      $get = $this->db->where('status',1)->like('title',$this->input->get('word'))->order_by('create_datetime', 'DESC')->get('law')->result_array();
      echo json_encode(array('data'=>$get));
    }
}

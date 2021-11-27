<?php

class Gallary extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_gallary');
		$this->lang->load('gallary',$this->language);
		$this->load->library('pagination');
	}

	public function index() {

		$this->data['title']     = lang('lang_title');
		$this->data['albums']    = $this->model_gallary->fetch_album();

		$this->middle = 'album';
		$this->layout();
  	}

  	public function pictures() {
  		$id = $this->uri->segment(5);

		$this->data['title']       = lang('lang_title');
		$this->data['gallary']     = $this->model_gallary->fetch_gallary($id);
		$this->data['name_album']  = $this->model_gallary->fetch_album_name($id);
    	$this->middle = 'gallary'; // passing middle to function. change this for different views.
    	$this->layout();
  	}
}

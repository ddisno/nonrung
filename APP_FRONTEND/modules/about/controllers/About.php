<?php

class About extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_about');
		$this->lang->load('about',$this->language);
	}

	public function index(){
		$this->data['title'] = lang('lang_title');
		$this->data['about']     = $this->model_about->fetch_about();

		$this->middle = 'about';
		$this->layout();
	}
}
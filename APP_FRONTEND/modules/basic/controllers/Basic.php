<?php
	/**
	 * 
	 */
class Basic extends MY_Controller
	{
		public function __construct()
	{
		parent::__construct();
		$this->load->model('model_basic');
		// $this->lang->load('basic',$this->language);
	}

	public function view(){
		$id = $this->uri->segment(5);

		
		$this->data['basic']     = $this->model_basic->fetch_basic($id);
		$this->data['title']    = 'ข้อมูลพื้นฐาน - '.$this->data['basic']['name'];
		$this->data['header']    = $this->data['basic']['name'];
 
		$this->middle = 'basic';
		$this->layout();
	}
}
?>
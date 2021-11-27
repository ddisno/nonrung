<?php
	/**
	 * 
	 */
class Policy extends MY_Controller
	{
		public function __construct()
	{
		parent::__construct();
		$this->load->model('model_policy');
		// $this->lang->load('policy',$this->language);
	}

	public function view(){
		$id = $this->uri->segment(5);

		
		$this->data['policy']     = $this->model_policy->fetch_policy($id);
		$this->data['title']    = 'ผู้บริหาร - '.$this->data['policy']['name'];
		$this->data['header']    = $this->data['policy']['name'];

		$this->middle = 'policy';
		$this->layout();
	}
}
?>
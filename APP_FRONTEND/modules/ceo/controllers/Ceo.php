<?php
	/**
	 * 
	 */
class ceo extends MY_Controller
	{
		public function __construct()
	{
		parent::__construct();
		$this->load->model('model_ceo');
		// $this->lang->load('ceo',$this->language);
	}

	public function view(){
		$id = $this->uri->segment(5);

		
		$this->data['ceo']     = $this->model_ceo->fetch_ceo($id);
		$this->data['title']    = 'ผู้บริหาร - '.$this->data['ceo']['name'];
		$this->data['header']    = $this->data['ceo']['name'];

		$this->middle = 'ceo';
		$this->layout();
	}
}
?>
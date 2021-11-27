<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{

  public function __construct(){
    parent::__construct();
    $this->load->model('model_home');
  }

	public function index() {

		  $this->data['title'] = 'หน้าแรก';
    	$this->middle = 'home'; // passing middle to function. change this for different views.
    	$this->layout();
  	}

  	public function dashboard() {
		  redirect(base_url());
  	}
}

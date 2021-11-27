<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

//
//
//
class MY_Controller extends MX_Controller
{
    //set the class variable.
    public $language;
    public $template = array();
    public $data     = array();

    /*---------------------------*/
    public $token; //ส่งชื่อ token name กลับไป
    public $hash; //เข้ารหัส token name
    public $resp = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_main');
        $this->load->library('CC_auth');
        $this->load->library('CC_layout');
        // security set defalut for request pass Ajax
        $this->token = $this->security->get_csrf_token_name();
        $this->hash  = $this->security->get_csrf_hash();
        $this->resp  = array(
            'token' => $this->token,
            'hash'  => $this->hash,
        );
        // set base_url and vendor
        $path_vendor = str_replace('backend/', '', $this->currentUrl());
        // set access to css js and file in backend
        $this->config->set_item('vendor',  $path_vendor  . 'asset/backend/');
        // set access to user page
        $this->config->set_item('base',  $path_vendor);
        $this->config->set_item('base_url', $this->currentUrl());

        // Ignore any controllers not to be effected
        $route  = $this->router->directory . $this->router->fetch_class();
        $ignore = array(
            'users',
            'install',
        );
        // check user admin
        $this->cc_auth->_is_admin();


        // 1.
        // check session ----------------------------------------------------------
        // ถ้าไม่ได้ล็อคอิน และ class ไม่มีอยู่ในข้อยกเว้น กลับไปหน้า login
        if (!$this->cc_auth->_is_logged_in() && !in_array($route, $ignore)) {
            $this->session->sess_destroy();
            redirect('login');
        }

        // 2
        // check logout ------------------------------------------------------------
        // ถ้าล็อคอิน และ class อยู่ในข้อยกเว้น เช็ค ต่อ ว่า ถ้า class ไม่ไช่ logout ให้ กลับไปหน้าแรก
        // !!เหตุผล เพื่อไม่ให้ขณะที่เราล็อคอินอยู่ ไปหน้า ล็อคอินได้
        if ($this->cc_auth->_is_logged_in() && in_array($route, $ignore)) {
            if ($this->router->fetch_method() !== 'logout') {
                redirect('home');
            }
        }

    }

    // set currentUrl
    private function currentUrl()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $current  = $_SERVER['HTTP_HOST'] . '/backend/';
        return $protocol . $current;
    }

    //Load layout
    public function layout()
    {
        // กำหนด session url เพื่อนำไปตรวจสอบ permission method
        $this->session->set_userdata('link', $this->uri->uri_string());

        // call function in CC_layout library
        $this->data['_get_menus']      = $this->cc_layout->_layout_listmenus();
        $this->data['_get_role'] = $this->model_main->_get_role();
        // making temlate and send data to view.
        $this->template['header'] = $this->load->view('layout/header', $this->data, true);
        $this->template['left']   = $this->load->view('layout/left', $this->data, true);
        $this->template['right']  = $this->load->view('layout/right', $this->data, true);
        $this->template['middle'] = $this->load->view($this->middle, $this->data, true);
        $this->template['footer'] = $this->load->view('layout/footer', $this->data, true);
        $this->load->view('layout/index', $this->template);
    }



}

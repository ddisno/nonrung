<?php
/**
 * 
 */
class Blog extends MY_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('model_blog');
		$this->lang->load('blog',$this->language);
		$this->load->library('pagination');
	}

	public function index(){
		$config["base_url"] = base_url() . "blog/index";
        $config["total_rows"] = $this->model_blog->record_count();
        $config["per_page"] = 9;
        $config["uri_segment"] = 4; 
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 10; //จำนวนหน้า หรือจำนวนปุ่ม pagination

        $config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul><!--pagination-->';

	    $config['first_link'] = 'First';
	    $config['first_tag_open'] = '<li class="prev page">';
	    $config['first_tag_close'] = '</li>';

	    $config['last_link'] = 'Last';
	    $config['last_tag_open'] = '<li class="next page">';
	    $config['last_tag_close'] = '</li>';

	    $config['next_link'] = '»';
	    $config['next_tag_open'] = '<li class="page-item">';
	    $config['next_tag_close'] = '</li>';

	    $config['prev_link'] = '«';
	    $config['prev_tag_open'] = '<li class="page-item">';
	    $config['prev_tag_close'] = '</li>';

	    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

	    $config['num_tag_open'] = '<li class="page-item">';
	    $config['num_tag_close'] = '</li>';

	    $config['attributes'] = array('class' => 'page-link');
 
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$this->data['title'] = lang('lang_title');
		$this->data['blogs']     = $this->model_blog->fetch_blog($config["per_page"], $page);
		$this->data['cats']		= $this->model_blog->fetch_cats();	
		$this->data['links']      = $this->pagination->create_links();

		$this->middle = 'blog';
		$this->layout();
	}

	public function category(){
		$page = ($this->uri->segment(7)) ? $this->uri->segment(7) : 0;
  		$cat  = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

		$config["base_url"] = base_url() . 'blog/category/'.$this->uri->segment(4).'/'.$cat.'/page';
        $config["total_rows"] = $this->model_blog->record_count($cat);
        $config["per_page"] = 9;
        $config["uri_segment"] = 7; 
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 10; //จำนวนหน้า หรือจำนวนปุ่ม pagination

        $config['full_tag_open'] = '<ul class="pagination">';
	    $config['full_tag_close'] = '</ul><!--pagination-->';

	    $config['first_link'] = 'First';
	    $config['first_tag_open'] = '<li class="prev page">';
	    $config['first_tag_close'] = '</li>';

	    $config['last_link'] = 'Last';
	    $config['last_tag_open'] = '<li class="next page">';
	    $config['last_tag_close'] = '</li>';

	    $config['next_link'] = '»';
	    $config['next_tag_open'] = '<li class="page-item">';
	    $config['next_tag_close'] = '</li>';

	    $config['prev_link'] = '«';
	    $config['prev_tag_open'] = '<li class="page-item">';
	    $config['prev_tag_close'] = '</li>';

	    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

	    $config['num_tag_open'] = '<li class="page-item">';
	    $config['num_tag_close'] = '</li>';

	    $config['attributes'] = array('class' => 'page-link');
  		
        $this->pagination->initialize($config);
		$this->data['title']      = lang('lang_title');
		$this->data['name_blog']  = $this->model_blog->fetch_cats_name($cat);
		$this->data['blogs']   	  = $this->model_blog->fetch_blog($config["per_page"], $page,$cat);
		$this->data['cats'] = $this->model_blog->fetch_cats();
		$this->data['links']      = $this->pagination->create_links();

		$this->middle = 'category';
		$this->layout();
	}



	public function view(){
		$this->data['title'] = lang('lang_title');
		$id = $this->uri->segment(5);
		$this->data['blog']     = $this->model_blog->fetch_blog_single($id);
		$this->middle = 'view';
		$this->layout();
	}
}

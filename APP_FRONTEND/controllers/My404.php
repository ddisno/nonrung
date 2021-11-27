<?php
class My404 extends MY_Controller
 
{

   public function __construct(){
   		parent::__construct();
   }
 
   public function index()
 
   {
 		 
 	   $this->data['title'] = 'Page 404';
       $this->middle = 'errors/err404';    
       $this->layout();
   }
 
}
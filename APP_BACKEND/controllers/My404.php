<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My404 extends MY_Controller
 
{
   public function __construct(){
   	parent::__construct(); 
   }
 
   public function index()
 
   {	 
       $this->middle = 'errors/err404';    
       $this->layout();
   }
 
}
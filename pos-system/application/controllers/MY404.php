<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY404 extends CI_Controller {
    public function __construct()
   {
       parent::__construct();
   }
   
   function index()
   {
       //echo "check 404 Error.!";die;
       $this->output->set_status_header('404');
       $this->load->view('404');
   }






















/*Main Class End*/
}
?>
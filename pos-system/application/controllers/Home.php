<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('common','objcom');
    }
    
    public function index()
	{
	    if(!empty($this->session->userdata('admin_session')))
        {
            redirect("admin-dashboard");
        }else{
            $this->load->view('ADMIN/admin-login');
        }
		
	}
	
	
	
/*MAin Class Ended*/	
}

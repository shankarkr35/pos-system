<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlogin extends CI_Controller {
    
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
	
	public function admin_login_check()
	{
	    $email = $this->input->post('email');
	    $password = $this->input->post('password');
	    $data = $this->objcom->get_single_record('admin',$where=array('email'=>$email));
	    if(!empty($data))
	    {
	       if($data->password==$password)
	       {
	            $session_data = array('admin_id' =>$data->id,'admin_type' =>$data->type, 'admin_name' =>$data->name, 'logged_in' => true);
                $this->session->set_userdata('admin_session', $session_data);
                echo "logginSCS"; 
	           
	       }else{
	           echo "WRONGPASS";
	       }
	    }else{
	        echo "account404";
	    }
	}
	
	function logout()
	{
	    $this->session->unset_userdata('admin_session');
        $this->session->sess_destroy();
        redirect('admin-login');
	}
	
	
/*MAin Class Ended*/	
}

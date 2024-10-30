<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kuwait');
        $this->load->model('common','objcom');
        if(!$this->session->userdata('admin_session'))
        {
            return redirect('admin-login');
        }
       
    }  
    
    public function index()
	{
		$this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/dashboard');
		$this->load->view('ADMIN/include/footer');
	}
	
	function pages()
	{
	    $data_array['pages'] = $this->objcom->get_all_where('pages',$where="",$ord="id");
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/pages/index',$data_array);
		$this->load->view('ADMIN/include/footer');    
	}
	
	function add_new_page()
	{
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/pages/add');
		$this->load->view('ADMIN/include/footer');    
	}
	
	function create_new_page()
	{
        date_default_timezone_set('Asia/Kuwait');
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        $postData['title_en'] = $inputData['name'];
        $postData['title_ar'] = $inputData['ar_name'];
        $postData['page_url'] = $this->removeSpecialChapr($inputData['name']);
        $postData['en_desc'] = $inputData['en_desc'];
        $postData['ar_desc'] = $inputData['ar_desc'];
        $url = $postData['page_url'];
        $qry = $this->db->query("SELECT * FROM `pages` WHERE `page_url` = '$url'");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->insert_data('pages',$postData))
            {
                $responseData['responseData'] = "new record inserted successfully";        
            }
        }else{
            $responseData['responseData'] = "page name already exist";    
        }
        
        echo json_encode($responseData);
        die();  
	}
	
	function edit_page($id)
    {
        $data_array['page'] = $this->objcom->get_single_record('pages',array('id'=>$id));
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/pages/edit',$data_array);
		$this->load->view('ADMIN/include/footer');        
    }
    
    function update_page()
    {
        date_default_timezone_set('Asia/Kuwait');
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        $postData['title_en'] = $inputData['name'];
        $postData['title_ar'] = $inputData['ar_name'];
        $postData['page_url'] = $this->removeSpecialChapr($inputData['name']);
        $postData['en_desc'] = $inputData['en_desc'];
        $postData['ar_desc'] = $inputData['ar_desc'];
        $id = $inputData['id'];
        $url = $postData['page_url'];
        $resData = $this->objcom->get_single_record('pages',array('page_url'=>$url,'id !='=>$id));
        if(empty($resData))
        {
            if($this->objcom->update_records('pages',$postData,array('id'=>$id)))
            {
                $responseData['responseData'] = "page updated";        
            }
        }else{
            $responseData['responseData'] = "page name already exist";    
        }
        
        echo json_encode($responseData);
        die();    
    }
	
	function categories()
	{
	    $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
	    if($admin_type != 1)
        {
            return redirect('admin-login');
        }
	    $data_array['categories'] = $this->objcom->get_all_where('categories',$where="",$ord="id");
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/categories/index',$data_array);
		$this->load->view('ADMIN/include/footer');    
	}
	
	function addCategories()
	{
	    $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
	    if($admin_type != 1)
        {
            return redirect('admin-login');
        }
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/categories/add');
		$this->load->view('ADMIN/include/footer');    
	}
	
	function createCategories()
	{
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        if(!empty($_FILES) && !empty($_FILES['file']['type'])){
           if(($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/png')){    
            $file = $this->objcom->updateMedia('file','categories','catgories');
            $imagedata['image'] = $file; 
           }
        }
        if(!empty($imagedata['image'])){
            $postData['image'] = $imagedata['image'];
        }else{
            $postData['image'] = 'default-image.png';
        }
        
        $postData['name'] = $inputData['name'];
        $postData['nameUrl'] = $this->removeSpecialChapr($inputData['name']);
        $postData['createdby'] = $admin_id;
        $postData['create_date'] = date("Y-m-d H:i:s");
        $url = $postData['nameUrl'];
        $qry = $this->db->query("SELECT * FROM `categories` WHERE `nameUrl` = '$url'");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->insert_data('categories',$postData))
            {
                $responseData['responseData'] = "new record inserted successfully";        
            }
        }else{
            $responseData['responseData'] = "category name already exist";    
        }
        
        echo json_encode($responseData);
        die();  
	}
	
	public function removeSpecialChapr($value)
	{
		$title = str_replace( array( '\'', '"', ',' , ';', '<', '>','!', '@', '#' , '$', '%', '^', '&', '*' , '(', ')', '_', '-', '=' , '+', ':', '?', '.', '`', '~', '[', ']', '{', '}', '|' , '/' , '\\' , '‘' , '’' , '“', '”' , '…', '‰' ), '', $value);
		$post_title1 = str_replace( array("  "), array(" "), $title);	
		$post_title = str_replace( array(" ","'"), array("-",""), $post_title1);
		$postTitle = strtolower($post_title);
		return $postTitle;
    }
    
    function editCategories($id)
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $data_array['category'] = $this->objcom->get_single_record('categories',array('id'=>$id));
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/categories/edit',$data_array);
		$this->load->view('ADMIN/include/footer');        
    }
    
    function updateCategories()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        if(!empty($_FILES) && !empty($_FILES['file']['type'])){
           if(($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/png')){    
            $file = $this->objcom->updateMedia('file','categories','catgories');
            $imagedata['image'] = $file; 
           }
        }
        if(!empty($imagedata['image']))
        {
            $postData['image'] = $imagedata['image'];
        }
        
        $postData['name'] = $inputData['name'];

        $postData['nameUrl'] = $this->removeSpecialChapr($inputData['name']);
        $id = $inputData['id'];
        $url = $postData['nameUrl'];
        $qry = $this->db->query("SELECT * FROM `categories` WHERE `nameUrl` = '$url' AND `id`!='$id' ");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->update_records('categories',$postData,$where=array('id'=>$id)))
            {
                $responseData['responseData'] = "record updated successfully";        
            }
        }else{
            $responseData['responseData'] = "category name already exist";    
        }
        
        echo json_encode($responseData);
        die();     
    }
    
    function deleteFromany()
    {
        $table = $this->input->post('table');
        $id = $this->input->post('id');
        if($this->objcom->delete_record($table,array('id'=>$id)))
        {
            echo "deleted";    
        }
    }
    
    function order_status_mange()
    {
        $table = $this->input->post('table');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data['status']=$status;
        if($this->objcom->update_records($table,$data,$where=array('id'=>$id)))
        {
            $order_data = $this->common->get_all_where('order_details',array('order_id'=>$id),'id');
            if(!empty($order_data))
            {
                foreach($order_data as $key=>$order)
                {
                    $data1 = array();
                    $product_data = $this->common->get_single_record('products',array('id'=>$order->product_id));
                    if($status == 1){
                        $data1['product_qty'] = $product_data->product_qty + $order->quantity;
                    }else if($status == 2){
                        $data1['product_qty'] = $product_data->product_qty - $order->quantity;
                    }
                    $this->objcom->update_records('products',$data1,$where=array('id'=>$order->product_id));
                }
                
            }

            echo "updated";    
        }
    }
    function status_mange()
    {
        $table = $this->input->post('table');
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data['status']=$status;
        if($this->objcom->update_records($table,$data,$where=array('id'=>$id)))
        {
            echo "updated";    
        }
    }
    
    function order_status_management()
    {
        $table = 'order_details';
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $data['order_status']=$status;
        if($this->objcom->update_records($table,$data,$where=array('id'=>$id)))
        {
            echo "updated";    
        }
    }
    
    function subcategories()
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $scateg_arr = array();
        $scateg = $this->objcom->get_all_where('sub_categories',$where="",$ord="id");
        foreach($scateg as $key=>$row)
        {
            $categ_id = $row->category_id;
            $categ_arr = $this->objcom->get_single_record('categories',array('id'=>$categ_id));
            if(!empty($categ_arr))
            {
                $scateg_arr[$key]['category'] = $categ_arr->name;
            }else{
                $scateg_arr[$key]['category'] = '';    
            }
            $scateg_arr[$key]['id'] = $row->id; 
            $scateg_arr[$key]['name'] = $row->name; 
         
            $scateg_arr[$key]['status'] = $row->status;
            
        }
        $data_array['subcategories'] = $scateg_arr;
	    $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/sub-categories/index',$data_array);
		$this->load->view('ADMIN/include/footer');      
    }
    
    function addsubCategories()
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $data_array['categories'] = $this->objcom->get_all_where('categories',$where=array('status'=>1),$ord="id");
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/sub-categories/add',$data_array);
		$this->load->view('ADMIN/include/footer');      
    }
    
    function createsubCategories()
    {
        $inputData = $this->input->post();
        date_default_timezone_set('Asia/Kuwait');
        $postData = array();
        $responseData = array();
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $postData['name'] = $inputData['name'];
        $postData['name_url'] = $this->removeSpecialChapr($inputData['name']);
        $postData['category_id'] = $inputData['category'];
        $postData['createdby'] = $admin_id;
        $postData['create_date'] = date("Y-m-d H:i:s");
        
        $url = $postData['name_url'];
        $cat = $postData['category_id'];
        $qry = $this->db->query("SELECT * FROM `sub_categories` WHERE `name_url` = '$url' AND category_id = '$cat'");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->insert_data('sub_categories',$postData))
            {
                $responseData['responseData'] = "new record inserted successfully";        
            }
        }else{
            $responseData['responseData'] = "already exist";    
        }
       
        echo json_encode($responseData);
        die();
    }
    
    function editsubCategories($id)
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $data_array['categories'] = $this->objcom->get_all_where('categories',$where=array('status'=>1),$ord="id");
        $data_array['subcategory'] = $this->objcom->get_single_record('sub_categories',array('id'=>$id));
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/sub-categories/edit',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    function updatesubCategories()
    {
        $inputData = $this->input->post();
        $postData = array();
        $postData['name'] = $inputData['name'];
        $postData['name_url'] = $this->removeSpecialChapr($inputData['name']);
        $postData['category_id'] = $inputData['category'];
        $id = $inputData['id'];
        $url = $postData['name_url'];
        $qry = $this->db->query("SELECT * FROM `sub_categories` WHERE `name_url` = '$url' AND `id`!='$id' ");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->update_records('sub_categories',$postData,$where=array('id'=>$id)))
            {
                $responseData['responseData'] = "record updated successfully";        
            }
        }else{
            $responseData['responseData'] = "already exist";    
        }
        echo json_encode($responseData);
        die();
    }
    
    function brands()
    {
        $data_array['brands'] = $this->objcom->get_all_where('brands',$where="",$ord="id");
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/brands/index',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    function editBrands($id)
    {
        $data_array['categories'] = $this->objcom->get_all_where('categories',array('status'=>1),$ord="id");
        $data_array['brand'] = $this->objcom->get_single_record('brands',array('id'=>$id));
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/brands/edit',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    function addBrands()
    {
        $data_array['categories'] = $this->objcom->get_all_where('categories',array('status'=>1),$ord="id");
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/brands/add',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    function createNewBrand()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        if(!empty($_FILES) && !empty($_FILES['file']['type'])){
           if(($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/png')){    
            $file = $this->objcom->updateMedia('file','brands','brand');
            $imagedata['image'] = $file; 
           }
        }
        if(!empty($imagedata['image'])){
            $postData['image'] = $imagedata['image'];
        }else{
            $postData['image'] = 'default-image.png';
        }
        
        $postData['name'] = $inputData['name'];
        $postData['ar_name'] = $inputData['ar_name'];
        $postData['nameUrl'] = $this->removeSpecialChapr($inputData['name']);
        $postData['categories'] = $this->input->post('categories'); 
        $postData['createdby'] = $admin_id;
        $postData['create_date'] = date("Y-m-d H:i:s");
        $url = $postData['nameUrl'];
        $qry = $this->db->query("SELECT * FROM `brands` WHERE `nameUrl` = '$url'");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->insert_data('brands',$postData))
            {
                $responseData['responseData'] = "new record inserted successfully";        
            }
        }else{
            $responseData['responseData'] = "already exist";    
        }
        
        echo json_encode($responseData);
        die();     
    }
    
    function updateBrand()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $inputData = $this->input->post();
        $postData = array();
        $imagedata = array();  
        $responseData = array();
        if(!empty($_FILES) && !empty($_FILES['file']['type'])){
           if(($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/png')){    
            $file = $this->objcom->updateMedia('file','brands','brand');
            $imagedata['image'] = $file; 
           }
        }
        
        if(!empty($imagedata['image']))
        {
            $postData['image'] = $imagedata['image'];
        }
        
        $postData['name'] = $inputData['name'];
        $postData['ar_name'] = $inputData['ar_name'];
        $postData['categories'] = $this->input->post('categories');
        $postData['nameUrl'] = $this->removeSpecialChapr($inputData['name']);
        $id = $inputData['id'];
        $url = $postData['nameUrl'];
        $qry = $this->db->query("SELECT * FROM `brands` WHERE `nameUrl` = '$url' AND `id`!='$id' ");
        $resData = $qry->row();
        if(empty($resData))
        {
            if($this->objcom->update_records('brands',$postData,$where=array('id'=>$id)))
            {
                $responseData['responseData'] = "record updated successfully";        
            }
        }else{
            $responseData['responseData'] = "already exist";    
        }
        
        echo json_encode($responseData);
        die();     
    }
    
    function colorsList()
    {
        $data_array['colors'] = $this->objcom->get_all_where('colors',$where="",$ord="id");
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/colors/index',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    
    function addColor()
    {
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/colors/add');
		$this->load->view('ADMIN/include/footer');    
    }
    
    function createNewColors()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $input = $this->input->post();
        $postData['name'] = $input['name'];
        $postData['titleUrl'] = $this->removeSpecialChapr($input['name']);
        $postData['ar_name'] = $input['ar_name'];
        $postData['colorpicker'] = $input['color'];
        $postData['createdby'] = $admin_id;
        $postData['create_date'] = date("Y-m-d H:i:s");
        $url = $postData['titleUrl'];
        $qury = $this->db->query("SELECT * FROM `colors` WHERE `titleUrl` = '$url'");
        $data = $qury->row();
        if(empty($data))
        {
            if($this->objcom->insert_data('colors',$postData))
            {
                $responseData['responseData'] = "new record inserted successfully";        
            }    
        }else{
            $responseData['responseData'] = "already exist";     
        }
        echo json_encode($responseData);
        die();
    }
    
    function editColor($id)
    {
        $data_array['color'] = $this->objcom->get_single_record('colors',array('id'=>$id)); 
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/colors/edit',$data_array);
		$this->load->view('ADMIN/include/footer');  
    }
    
    function updateColor()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $input = $this->input->post();
        $postData['name'] = $input['name'];
        $postData['titleUrl'] = $this->removeSpecialChapr($input['name']);
        $postData['ar_name'] = $input['ar_name'];
        $postData['colorpicker'] = $input['color'];
        $url = $postData['titleUrl'];
        $id = $input['id'];
        $qury = $this->db->query("SELECT * FROM `colors` WHERE `titleUrl` = '$url' AND `id`!='$id'");
        $data = $qury->row();
        if(empty($data))
        {
            if($this->objcom->update_records('colors',$postData,array('id'=>$id)))
            {
                $responseData['responseData'] = "record updated successfully";        
            }    
        }else{
            $responseData['responseData'] = "already exist";     
        }
        echo json_encode($responseData);
        die();    
    }
    
    function sizesList()
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $data_array['sizes'] = $this->objcom->get_all_where('sizes',$where='',$ord="id");
        $data_array['categories'] = $this->objcom->get_all_where('categories',$where=array('status'=>1),$ord="id");
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/sizes/index',$data_array);
		$this->load->view('ADMIN/include/footer');      
    }
    
    function addSize()
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $data_array['categories'] = $this->objcom->get_all_where('categories',$where=array('status'=>1),$ord="id");
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/sizes/add',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    function createNewSize()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $input = $this->input->post();
        $postData['titleUrl'] = $this->removeSpecialChapr($input['name']);
        $postData['name'] = $input['name'];
        $postData['categories'] = $input['categories'];
        $postData['createdby'] = $admin_id;
        $postData['create_date'] = date("Y-m-d H:i:s");
        $url = $postData['titleUrl'];
        $qury = $this->db->query("SELECT * FROM `sizes` WHERE `titleUrl` = '$url'");
        $data = $qury->row();
        if(empty($data))
        {
            if($this->objcom->insert_data('sizes',$postData))
            {
                $responseData['responseData'] = "new record inserted successfully";        
            }    
        }else{
            $responseData['responseData'] = "already exist";     
        }
        echo json_encode($responseData);
        die();
    }
    
    function editSize($id)
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $data_array['categories'] = $this->objcom->get_all_where('categories',$where=array('status'=>1),$ord="id");
        $data_array['size'] = $this->objcom->get_single_record('sizes',array('id'=>$id)); 
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/sizes/edit',$data_array);
		$this->load->view('ADMIN/include/footer');  
    }
    
    function updateSize()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $input = $this->input->post();
        $postData['name'] = $input['name'];
        $postData['titleUrl'] = $this->removeSpecialChapr($input['name']);
        $postData['categories'] = $input['categories'];
        $url = $postData['titleUrl'];
        $id = $input['id'];
        $qury = $this->db->query("SELECT * FROM `sizes` WHERE `titleUrl` = '$url' AND `id`!='$id'");
        $data = $qury->row();
        if(empty($data))
        {
            if($this->objcom->update_records('sizes',$postData,array('id'=>$id)))
            {
                $responseData['responseData'] = "record updated successfully";        
            }    
        }else{
            $responseData['responseData'] = "already exist";     
        }
        echo json_encode($responseData);
        die();    
    }
    
    function measurementList()
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $data_array['units'] = $this->objcom->get_all_where('measurement_units',$where='',$ord="id");
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/measurement_units/index',$data_array);
		$this->load->view('ADMIN/include/footer');      
    }
    
    function addMeasurement()
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/measurement_units/add');
		$this->load->view('ADMIN/include/footer');    
    }
    
    function createNewMeasurement()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $input = $this->input->post();
        $postData['titleUrl'] = $this->removeSpecialChapr($input['name']);
        $postData['name'] = $input['name'];
        $postData['createdby'] = $admin_id;
        $postData['create_date'] = date("Y-m-d H:i:s");
        $url = $postData['titleUrl'];
        $qury = $this->db->query("SELECT * FROM `measurement_units` WHERE `titleUrl` = '$url'");
        $data = $qury->row();
        if(empty($data))
        {
            if($this->objcom->insert_data('measurement_units',$postData))
            {
                $responseData['responseData'] = "new record inserted successfully";        
            }    
        }else{
            $responseData['responseData'] = "already exist";     
        }
        echo json_encode($responseData);
        die();
    }
    
    function editMeasurement($id)
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $data_array['unit'] = $this->objcom->get_single_record('measurement_units',array('id'=>$id)); 
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/measurement_units/edit',$data_array);
		$this->load->view('ADMIN/include/footer');  
    }
    
    function updateMeasurement()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $input = $this->input->post();
        $postData['name'] = $input['name'];
        $postData['titleUrl'] = $this->removeSpecialChapr($input['name']);

        $url = $postData['titleUrl'];
        $id = $input['id'];
        $qury = $this->db->query("SELECT * FROM `measurement_units` WHERE `titleUrl` = '$url' AND `id`!='$id'");
        $data = $qury->row();
        if(empty($data))
        {
            if($this->objcom->update_records('measurement_units',$postData,array('id'=>$id)))
            {
                $responseData['responseData'] = "record updated successfully";        
            }    
        }else{
            $responseData['responseData'] = "already exist";     
        }
        echo json_encode($responseData);
        die();    
    }
    
    function get_subcategory()
    {
        $catid = $this->input->post('category');
        $data = $this->objcom->get_all_where('sub_categories',$where=array('category_id'=>$catid),$ord="id");
        if(!empty($data))
        {
            foreach($data as $row)
            {
                echo "<option value='".$row->id."'>".$row->name."</option>";
            }   
        }else{
            echo "<option value=''>sub category not found</option>";    
        }
    }
    
    function productsList()
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $data_array['products'] = $this->objcom->get_all_where('products','','id');
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/products/index',$data_array);
		$this->load->view('ADMIN/include/footer');     
    }
    
    function addProduct()
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $data_array['categories'] = $this->objcom->get_all_where('categories',$where=array('status'=>1),$ord="id");
        $data_array['raw'] = $this->objcom->get_all_where('raw_material',$where=array('status'=>1),$ord="id");
        $data_array['units'] = $this->objcom->get_all_where('measurement_units',$where=array('status'=>1),$ord="id");
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/products/add',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    function createProduct()
    {
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $input = $this->input->post();
        $raw_id = $input['raw_name'];
        $raw_qty = $input['quantity'];
        
        $raw_name = json_encode($input['raw_name']);
        $quantity = json_encode($input['quantity']);
       
        $url_slug = strtolower(url_title($input['name']));
        if (isUrlExists('products', $url_slug , 'titleUrl')) 
        {
            $url_slug = $url_slug . '-' . time();
        } 
        
        $data['titleUrl'] = $url_slug;
        $data['name'] = $input['name'];
        $data['sort_description'] = $input['sortDescription'];
        
        $data['categories'] = $input['categories'];
        $data['subcategory'] = $input['sub-categories'];
        $data['raw_name'] = $raw_name;
        $data['raw_quantity'] = $quantity;
        $data['product_qty'] = $input['productQuantity'];
        $data['measure_unit'] = $input['units'];
        
        $data['createdby'] = $admin_id;
        $data['create_date'] = date("Y-m-d H:i:s");
        
        for($i=0; $i<count($raw_id); $i++){
            $rawId = $raw_id[$i];
            $rawQty = $raw_qty[$i];
            $currentQty = 0;
            $rawData = $this->objcom->get_single_record('raw_material',array('id'=>$rawId));
            if(!empty($rawData)){
                if($rawData->quantity < $rawQty){
                    $responseData['responseData'] = "quantity is less";  
                    $responseData['name'] = $rawData->name;  
                    echo json_encode($responseData);
                    die();
                }
                    
            }
        }
         
        if($this->objcom->insert_data('products',$data))
        {
           
            for($i=0; $i<count($raw_id); $i++){
                $rawId = $raw_id[$i];
                $rawQty = $raw_qty[$i];
                $currentQty = 0;
                $rawData = $this->objcom->get_single_record('raw_material',array('id'=>$rawId));
                if(!empty($rawData)){
                    $currentQty = $rawData->quantity -$rawQty;
                    $updateQty['quantity'] = $currentQty;
                    $res = $this->objcom->update_records('raw_material',$updateQty,array('id'=>$rawId));
                    
                }
            }
        
            $responseData['responseData'] = "new record inserted successfully";        
        }
        echo json_encode($responseData);
        die();
    }
    
    function editProduct($id)
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $data_array['categories'] = $this->objcom->get_all_where('categories',$where=array('status'=>1),$ord="id");
        $data_array['subcategories'] = $this->objcom->get_all_where('sub_categories',$where=array('status'=>1),$ord="id");
        $data_array['product'] = $this->objcom->get_single_record('products',array('id'=>$id)); 
        $data_array['raw'] = $this->objcom->get_all_where('raw_material',$where=array('status'=>1),$ord="id");
        
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/products/edit',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    function updateProduct()
    {
        $input = $this->input->post();
      //echo"<pre>";print_r($input);die;
        $url_slug = strtolower(url_title($input['name']));
        if (isUrlExists('products', $url_slug , 'titleUrl')) 
        {
            $url_slug = $url_slug . '-' . time();
        } 
        $raw_id = $input['raw_name'];
        $raw_qty = $input['quantity'];
        
        $raw_name = json_encode($input['raw_name']);
        $quantity = json_encode($input['quantity']);

        $id = $input['pId'];
        $data['titleUrl'] = $url_slug;
        $data['name'] = $input['name'];
        $data['sort_description'] = $input['sortDescription'];
        $data['categories'] = $input['categories'];
        $data['subcategory'] = $input['sub-categories'];
        $data['product_qty'] = $input['productQuantity'];
        $data['raw_name'] = $raw_name;
        $data['raw_quantity'] = $quantity;
        $data['update_date'] = date("Y-m-d H:i:s");
        
        $proData = $this->objcom->get_single_record('products',array('id'=>$id));
        $rawName = '';
        $rawQtyData = '';
        if(!empty($proData->raw_name)){
            $rawName = json_decode($proData->raw_name);
        }
        if(!empty($proData->raw_quantity)){
            $rawQtyData = json_decode($proData->raw_quantity);
        }
        
        for($i=0; $i<count($raw_id); $i++){
            $rawId = $raw_id[$i];
            $rawQty = $raw_qty[$i];
            $currentQty = 0;
            $rawData = $this->objcom->get_single_record('raw_material',array('id'=>$rawId));
            if(!empty($rawData)){
                if($rawData->quantity < $rawQty){
                    $responseData['responseData'] = "quantity is less";  
                    $responseData['name'] = $rawData->name;  
                    echo json_encode($responseData);
                    die();
                }
                    
            }
        }

        if($this->objcom->update_records('products',$data,array('id'=>$id)))
        {
            for($i=0; $i<count($raw_id); $i++){ 
                $rawId = $raw_id[$i]; 
                $rawQty = $raw_qty[$i]; 
                $currentQty = 0;
                $proQty = 0;
                for($j=0; $j<count($rawName); $j++){
                    if($rawName[$j] == $rawId){
                        $proQty = $rawQtyData[$j];
                    }
                    
                }
                $rawData = $this->objcom->get_single_record('raw_material',array('id'=>$rawId));
                if(!empty($rawData)){
                    // $currentQty = ($rawData->quantity + $proQty) - $rawQty;
                    $currentQty = ($rawData->quantity) - $rawQty;
                    $updateQty['quantity'] = $currentQty;
                    $res = $this->objcom->update_records('raw_material',$updateQty,array('id'=>$rawId));
                    
                }
            }
            $responseData['responseData'] = "record updated successfully";        
        } 
        echo json_encode($responseData);
        die();    
    }
    
    function productsVariationsList($product_id)
    {
        $data_array['product_id'] = $product_id;
        $data_array['variations'] = $this->objcom->get_products_variation($product_id);
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/products/variations/index',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    function addProductVariation($product_id)
    {
        $product_info = $this->objcom->get_single_record('products',array('id'=>$product_id));
        $categories = $product_info->categories;
        $categs = explode(',', $categories);
        $categstr ='';
        
        $categs = explode(',', $categories);
        foreach ($categs as $categ) {
            if($categ)
            {
                $categstr.= "OR FIND_IN_SET('$categ',`categories`) ";
            }    
        }
        
        $categstr = ltrim($categstr,"OR");
        
        $query = "SELECT * FROM sizes WHERE status = '1' AND $categstr"; 
        $qry = $this->db->query($query);
        $cdata = $qry->result();
        if(!empty($cdata))
        {
            $data_array['sizes'] = $cdata;    
        }else{
            $data_array['sizes'] = array();    
        }
        
        $data_array['product_id'] = $product_id;
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/products/variations/add',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    function editProductVariation($productv_id)
    {
        $var_info = $this->objcom->get_single_record('product_variations',array('id'=>$productv_id));
        $product_id = $var_info->product_id;
        $pro_info = $this->objcom->get_single_record('products',array('id'=>$product_id));
        $category = $pro_info->category;
        $data_array['sizes'] = $this->objcom->get_all_where('sizes',$where=array('category_id'=>$category),$ord="id");
        $data_array['variation'] = $var_info;
        $data_array['variation_id'] = $productv_id;
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/products/variations/edit',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    function customersList()
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $data_array['customers'] = $this->objcom->get_all_where('customers',$where="",$ord="id");
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/customers/index',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    function add_new_customer()
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/customers/add');
		$this->load->view('ADMIN/include/footer');      
    }
    
    function edit_customer($id)
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $data_arr['customer'] = $this->objcom->get_single_record('customers',array('id'=>$id));  
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/customers/edit',$data_arr);
		$this->load->view('ADMIN/include/footer');
    }
    
    function create_new_customer()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $input = $this->input->post();
        
        if(!empty($_FILES) && !empty($_FILES['file']['type'])){
           if(($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/png')){    
            $file = $this->objcom->updateMedia('file','members','members');
            $imagedata['image'] = $file; 
           }
        }
        if(!empty($imagedata['image'])){
            $postData['image'] = $imagedata['image'];
        }else{
            $postData['image'] = 'default-image.png';
        }
        
        $postData['customer_name'] = $input['name'];
        $postData['email'] = $input['email'];
        $postData['mobile_number'] = $input['mobile'];
        $postData['password'] = $input['password'];
        $postData['address'] = $input['address'];
        
        $email = $postData['email'];
        $qury = $this->db->query("SELECT * FROM `customers` WHERE `email` = '$email'");
        $data = $qury->row();
        if(empty($data))
        {
            if($this->objcom->insert_data('customers',$postData))
            {
                $responseData['responseData'] = "new record inserted successfully";        
            }    
        }else{
            $responseData['responseData'] = "already exist";     
        }
        echo json_encode($responseData);
        die();    
    }
    
    function update_customer_details()
    {
        $input = $this->input->post();
        
         if(!empty($_FILES) && !empty($_FILES['file']['type'])){
           if(($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/png')){    
            $file = $this->objcom->updateMedia('file','members','members');
            $imagedata['image'] = $file; 
           }
        }
        if(!empty($imagedata['image'])){
            $postData['image'] = $imagedata['image'];
        }else{
            $postData['image'] = 'default-image.png';
        }
        
        $postData['customer_name'] = $input['name'];
        $postData['email'] = $input['email'];
        $postData['mobile_number'] = $input['mobile'];
        $postData['password'] = $input['password'];
        $postData['address'] = $input['address'];
        $email = $input['email'];
        $id = $input['id'];
        $qury = $this->db->query("SELECT * FROM `customers` WHERE `email` = '$email' AND `id`!='$id'");
        $data = $qury->row();
        if(empty($data))
        {
            if($this->objcom->update_records('customers',$postData,array('id'=>$id)))
            {
                $responseData['responseData'] = "record updated successfully";        
            }    
        }else{
            $responseData['responseData'] = "already exist";     
        }
        echo json_encode($responseData);
        die();     
    }
    
    /*------END Customers-----*/
    
    function area_management()
    {
        $data_array['areas'] = $this->objcom->get_all_where('area_table',$where="",$ord="id");
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/locations/area/index',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    function add_new_area()
    {
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/locations/area/add');
		$this->load->view('ADMIN/include/footer');      
    }
    
    function edit_area($id)
    {
        $data_arr['area'] = $this->objcom->get_single_record('area_table',array('id'=>$id));  
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/locations/area/edit',$data_arr);
		$this->load->view('ADMIN/include/footer');
    }
    
    function create_new_area()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $input = $this->input->post();
        
        if(!empty($_FILES) && !empty($_FILES['file']['type'])){
           if(($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/png')){    
            $file = $this->objcom->updateMedia('file','flags','flags');
            $imagedata['flag_image'] = $file; 
           }
        }
        if(!empty($imagedata['flag_image'])){
            $postData['flag_image'] = $imagedata['flag_image'];
        }else{
            $postData['flag_image'] = 'default-image.png';
        }
        
        $postData['name'] = $input['name'];
        $postData['ar_name'] = $input['ar_name'];
        $postData['createdby'] = $admin_id;
        $postData['create_date'] = date("Y-m-d H:i:s");
        $name = $postData['name'];
        $qury = $this->db->query("SELECT * FROM `area_table` WHERE `name` = '$name'");
        $data = $qury->row();
        if(empty($data))
        {
            if($this->objcom->insert_data('area_table',$postData))
            {
                $responseData['responseData'] = "new record inserted successfully";        
            }    
        }else{
            $responseData['responseData'] = "already exist";     
        }
        echo json_encode($responseData);
        die();    
    }
    
    function update_area_details()
    {
        $input = $this->input->post();
        
        if(!empty($_FILES) && !empty($_FILES['file']['type'])){
           if(($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/png')){    
            $file = $this->objcom->updateMedia('file','flags','flags');
            $postData['flag_image'] = $file; 
           }
        }
        $postData['name'] = $input['name'];
        $postData['ar_name'] = $input['ar_name'];
        $name = $input['name'];
        $id = $input['id'];
        $qury = $this->db->query("SELECT * FROM `area_table` WHERE `name` = '$name' AND `id`!='$id'");
        $data = $qury->row();
        if(empty($data))
        {
            if($this->objcom->update_records('area_table',$postData,array('id'=>$id)))
            {
                $responseData['responseData'] = "record updated successfully";        
            }    
        }else{
            $responseData['responseData'] = "already exist";     
        }
        echo json_encode($responseData);
        die();     
    }
    
    function coupons_list()
    {
        $data_array['coupons'] = $this->objcom->get_all_where('coupons_table','','');
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/coupons/index',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    function add_new_coupon()
    {
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/coupons/add');
		$this->load->view('ADMIN/include/footer');    
    }
    
    function edit_coupon($id)
    {
        $data_array['coupon'] = $this->objcom->get_single_record('coupons_table',array('id'=>$id));
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/coupons/edit',$data_array);
		$this->load->view('ADMIN/include/footer');   
    }
    
    function create_new_coupon()
    {
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $input = $this->input->post();
        $name = $input['name'];
        $qury = $this->db->query("SELECT * FROM `coupons_table` WHERE `coupon_name` = '$name'");
        $data = $qury->row();
        if(empty($data))
        {
            $post_array['coupon_name'] = $input['name'];
            $post_array['coupon_value'] = $input['value'];
            $post_array['coupon_type'] = $input['type'];
            $post_array['coupon_expiry'] = $input['expdate'];
            $post_array['createddby'] = $admin_id;
            if($this->objcom->insert_data('coupons_table',$post_array))
            {
                $res['response'] = 'coupon created';    
            }
        }else{
            $res['response'] = "Coupon Name already Exist.";    
        }
        echo json_encode($res);
        die(); 
    }
    
    function update_coupon_details()
    {
        $input = $this->input->post(); 
        
        $name = $input['name'];
        $id = $input['id'];
        $qury = $this->db->query("SELECT * FROM `coupons_table` WHERE `coupon_name` = '$name' AND `id`!='$id'");
        $data = $qury->row();
        if(empty($data))
        {
            $post_array['coupon_name'] = $input['name'];
            $post_array['coupon_value'] = $input['value'];
            $post_array['coupon_type'] = $input['type'];
            $post_array['coupon_expiry'] = $input['expdate'];
            if($this->objcom->update_records('coupons_table',$post_array,array('id'=>$id)))
            {
                $res['response'] = 'coupon updated';    
            }
        }else{
            $res['response'] = "Coupon Name already Exist.";    
        }
        echo json_encode($res);
        die(); 
    }
    
    function get_brands_sub_categ()
    {
        $str = '';
        $str1 = '';
        $categories = $this->input->post('categories');
        $categories_id = explode(',', $categories);
        foreach ($categories_id as $row) 
        {
            if($row)
            {
                $str1.= "OR category_id IN('$row') ";
            }    
        }
        $querystr1 = ltrim($str1,"OR");
        
        foreach ($categories_id as $ids) 
        {
            if($ids)
            {
                $str.= "OR FIND_IN_SET('$ids',categories) ";
            }    
        }
        $querystr = ltrim($str,"OR");
        $query = $this->db->query("SELECT * FROM `brands` WHERE status = 1 AND $querystr");
        $brand = $query->result();
        $brand_res = '';
        foreach($brand as $brnd)
        {
            $brand_res .= '<option value="'.$brnd->id.'">'.$brnd->name.'</option>';    
        }
        
        $query1 = $this->db->query("SELECT * FROM `sub_categories` WHERE `status` = '1' AND $querystr1");
        $scateg = $query1->result();
        $scateg_res = '';
        foreach($scateg as $sc)
        {
            $scateg_res .= '<option value="'.$sc->id.'">'.$sc->name.'</option>';    
        }
        $outputs = array(
        'brands'=>$brand_res,
        'subcategories'=>$scateg_res
        ); 
        echo json_encode($outputs);
        die();
    }
    
    function orders_list()
    {
        $data_array['orders'] = $this->objcom->get_all_where('orders','',"id");
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/orders/index',$data_array);
		$this->load->view('ADMIN/include/footer');             
    }
    
    function order_details($order_id)
    {
        $ordProducts = array();
        $order = $this->objcom->get_single_record('orders',array('order_unique_id'=>$order_id));
        $data_array['order'] = $order;
        
        $order_data = $this->common->get_all_where('order_details',array('order_id'=>$order->id),'id');
	        
        foreach($order_data as $key=>$row)
        {
            $crtProductsarr = $this->common->get_cart_products($row->product_id, $row->variation_id);
            $arrayTotal[] = $row->price*$row->quantity;
            $size_id = $crtProductsarr->size;
            
            if(!empty($size_id))
            {
                $size_arr = $this->common->get_single_record('sizes',array('id'=>$size_id)); 
                if(!empty($size_arr)){
                    $ordProducts[$key]['size_name'] = $size_arr->name;
                }else{
                    $ordProducts[$key]['size_name'] = '';
                }
            
            }else{
                $ordProducts[$key]['size_name'] = '';
            }
            $ordProducts[$key]['name'] = $crtProductsarr->name;
            $ordProducts[$key]['titleUrl'] = $crtProductsarr->titleUrl;
            $ordProducts[$key]['price'] = $row->price;
            $ordProducts[$key]['quantity'] = $row->quantity;
            $ordProducts[$key]['image'] = $crtProductsarr->image;
            $ordProducts[$key]['status'] = $row->order_status;
            $ordProducts[$key]['id'] = $row->id;
        }
        
        if(!empty($arrayTotal))
        {
            $data_array['order_s_total'] = number_format(array_sum($arrayTotal), 2);
        }else{
            $data_array['order_s_total'] = '0.00';
        }
        $data_array['products'] = $ordProducts;
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/orders/order-details',$data_array);
		$this->load->view('ADMIN/include/footer');          
    }
    
     public function invoice($order_id) 
    {
        $ordProducts = array();
        $order = $this->objcom->get_single_record('orders',array('order_unique_id'=>$order_id));
        $data_array['order'] = $order;
        
        $order_data = $this->common->get_all_where('order_details',array('order_id'=>$order->id),'id');
	        
        foreach($order_data as $key=>$row)
        {
            $crtProductsarr = $this->common->get_cart_products($row->product_id, $row->variation_id);
            $arrayTotal[] = $row->price*$row->quantity;
            $size_id = $crtProductsarr->size;
            
            if(!empty($size_id))
            {
                $size_arr = $this->common->get_single_record('sizes',array('id'=>$size_id)); 
                if(!empty($size_arr)){
                    $ordProducts[$key]['size_name'] = $size_arr->name;
                }else{
                    $ordProducts[$key]['size_name'] = '';
                }
        
            }else{
                $ordProducts[$key]['size_name'] = '';
            }
            $ordProducts[$key]['name'] = $crtProductsarr->name;
            $ordProducts[$key]['titleUrl'] = $crtProductsarr->titleUrl;
            $ordProducts[$key]['price'] = $row->price;
            $ordProducts[$key]['quantity'] = $row->quantity;
            $ordProducts[$key]['image'] = $crtProductsarr->image;
            $ordProducts[$key]['status'] = $row->order_status;
            $ordProducts[$key]['id'] = $row->id;
        }
        
        if(!empty($arrayTotal))
        {
            $data_array['order_s_total'] = number_format(array_sum($arrayTotal), 2);
        }else{
            $data_array['order_s_total'] = '0.00';
        }
        $data_array['products'] = $ordProducts;
    
		$this->load->view('ADMIN/orders/orderinvoice',$data_array);
	
    }

    public function invoiceprint($order_id) 
    {
        $ordProducts = array();
        $order = $this->objcom->get_single_record('orders',array('order_unique_id'=>$order_id));
        $data_array['order'] = $order;
        
        $order_data = $this->common->get_all_where('order_details',array('order_id'=>$order->id),'id');
	        
        foreach($order_data as $key=>$row)
        {
            $crtProductsarr = $this->common->get_cart_products($row->product_id, $row->variation_id);
            $arrayTotal[] = $row->price*$row->quantity;
            $size_id = $crtProductsarr->size;
            
            if(!empty($size_id))
            {
            $size_arr = $this->common->get_single_record('sizes',array('id'=>$size_id)); 
            if(!empty($size_arr)){
                    $ordProducts[$key]['size_name'] = $size_arr->name;
                }else{
                    $ordProducts[$key]['size_name'] = '';
                }
            }else{
                $ordProducts[$key]['size_name'] = '';
            }
            $ordProducts[$key]['name'] = $crtProductsarr->name;
            $ordProducts[$key]['titleUrl'] = $crtProductsarr->titleUrl;
            $ordProducts[$key]['price'] = $row->price;
            $ordProducts[$key]['quantity'] = $row->quantity;
            $ordProducts[$key]['image'] = $crtProductsarr->image;
            $ordProducts[$key]['status'] = $row->order_status;
            $ordProducts[$key]['id'] = $row->id;
        }
        
        if(!empty($arrayTotal))
        {
            $data_array['order_s_total'] = number_format(array_sum($arrayTotal), 2);
        }else{
            $data_array['order_s_total'] = '0.00';
        }
        $data_array['products'] = $ordProducts;
    
		$this->load->view('ADMIN/orders/orderinvoiceprint',$data_array);
	
    }
    
    function shops_management()
    {
        $data_array['shops'] = $this->common->get_all_where('shops','','id');
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/shops/index',$data_array);
		$this->load->view('ADMIN/include/footer');   
    }
    
    function add_new_shop()
    {
        $data_array['categoreis'] = $this->common->get_all_where('categories',array('status'=>1),'id');
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/shops/add',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    function insert_new_shop()
    {
        $response = array();
        $input = $this->input->post();
        $url_slug = strtolower(url_title($input['name']));
        if (isUrlExists('shops', $url_slug , 'url')) 
        {
            $url_slug = $url_slug . '-' . time();
        } 

        if(!empty($_FILES) && !empty($_FILES['logo']['type'])){
           if(($_FILES['logo']['type'] == 'image/jpeg') || ($_FILES['logo']['type'] == 'image/png')){    
            $file = $this->objcom->updateMedia('logo','shop','shop');
            $data['logo'] = $file; 
           }
        }else{
            $data['logo'] = '200x200.png';
        }

        if(!empty($_FILES) && !empty($_FILES['banner']['type'])){
           if(($_FILES['banner']['type'] == 'image/jpeg') || ($_FILES['banner']['type'] == 'image/png')){    
            $file = $this->objcom->updateMedia('banner','shop','shop');
            $data['banner'] = $file; 
           }
        }else{
            $data['banner'] = '500x250.png';
        }

        $data_array = $this->objcom->get_single_record('shops',array('email'=>$input['email'])); 

        if(empty($data_array))
        {
            $data['url'] = $url_slug;
            $data['name_en'] = $input['name'];
            $data['name_ar'] = $input['name_ar'];
            $data['categories'] = $input['categories'];
            $data['email'] = $input['email'];
            $data['mobile'] = $input['mobile'];
            $data['password'] = $input['password'];
            $data['create_date'] = date("Y-m-d H:i:s");
            $data['status'] = 1; 

            if($this->objcom->insert_data('shops',$data))
            {
                $response['response'] = "new record inserted successfully";        
            }
            echo json_encode($response);
            die();  
        }else{
            $response['response'] = "already exist"; 
            echo json_encode($response);
            die(); 
        }
        

            
    }
    
    function edit_shop_details($id)
    {
        $data_array['categoreis'] = $this->common->get_all_where('categories','','id');
        $data_array['shop'] = $this->common->get_single_record('shops',array('id'=>$id)); 
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/shops/edit',$data_array);
		$this->load->view('ADMIN/include/footer'); 
    }
    
    function upadte_shop_details()
    {
        $response = array();
        $input = $this->input->post();
        $url_slug = strtolower(url_title($input['name']));
        if (isUrlExists('shops', $url_slug , 'url')) 
        {
            $url_slug = $url_slug . '-' . time();
        } 

        if(!empty($_FILES) && !empty($_FILES['logo']['type'])){
           if(($_FILES['logo']['type'] == 'image/jpeg') || ($_FILES['logo']['type'] == 'image/png')){    
            $file = $this->objcom->updateMedia('logo','shop','shop');
            $data['logo'] = $file; 
           }
        }

        if(!empty($_FILES) && !empty($_FILES['banner']['type'])){
           if(($_FILES['banner']['type'] == 'image/jpeg') || ($_FILES['banner']['type'] == 'image/png')){    
            $file = $this->objcom->updateMedia('banner','shop','shop');
            $data['banner'] = $file; 
           }
        }

        $data_array = $this->objcom->get_single_record('shops',array('email'=>$input['email'],'id!='=>$input['id'])); 

        if(empty($data_array))
        {
            $data['url'] = $url_slug;
            $data['name_en'] = $input['name'];
            $data['name_ar'] = $input['name_ar'];
            $data['categories'] = $input['categories'];
            $data['email'] = $input['email'];
            $data['mobile'] = $input['mobile'];
            $data['password'] = $input['password'];

            if($this->objcom->update_records('shops',$data,array('id'=>$input['id'])))
            {
                $response['response'] = "updated";        
            }
            echo json_encode($response);
            die();  
        }else{
            $response['response'] = "already exist"; 
            echo json_encode($response);
            die(); 
        }          
    }
    
    
  
    function get_categories()
    {
        $shop = $this->input->post('shop_id');
        $shop_array = $this->common->get_single_record('shops',array('id'=>$shop));
        $cats = $shop_array->categories;
        $cats_arr = explode(',',$cats);
        //$cates_array['cats'] = explode(',',$this->input->post('cats'));
        $cates_array['data'] = $this->common->select_where_in_array('categories','id',$cats_arr,'id');
        $view = $this->load->view('ADMIN/ajax/categories',$cates_array,TRUE);
        $response['response'] = $view;
        echo json_encode($response);
        die();
    }

    function get_subcategories()
    {
        $agestr = "";
        $ages_grp = "";
        $incategories = explode(',',$this->input->post('category')); 
        foreach ($incategories as $key=>$ages) 
        {
            if($ages)
            {
                $agestr.= "OR FIND_IN_SET('$ages',`categories`) ";
            }    
        }
        $ages_grp = ltrim($agestr,"OR");

        $incategories1 = explode(',',$this->input->post('category')); 
        $scat_array['data'] = $this->common->select_where_in_array('sub_categories','category_id',$incategories,'id');
        if(!empty($scat_array['data']))
        {
            $view = $this->load->view('ADMIN/ajax/scategories',$scat_array,TRUE);
            $response['response'] = $view;    
        }else{
            $response['response'] = '';
        }
        echo json_encode($response);
        die();
    }

    function get_brands()
    {
        $agestr = "";
        $ages_grp = "";
        $incategories = explode(',',$this->input->post('ages')); 
        foreach ($incategories as $key=>$ages) 
        {
            if($ages)
            {
                $agestr.= "OR FIND_IN_SET('$ages',`categories`) ";
            }    
        }
        $ages_grp = ltrim($agestr,"OR");

        $cid = $this->input->post('category');
        $scat_array['data'] = $this->common->get_brands($ages_grp);
        $view = $this->load->view('ADMIN/ajax/brands',$scat_array,TRUE);
        $response['response'] = $view;
        echo json_encode($response);
        die();
    }
    
    
    /*Raw material-----*/
    function rawList()
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $response = array();
        $raws = $this->objcom->get_all_where('raw_material',$where='',$ord="id");
        if(!empty($raws)){
            foreach($raws as $key=>$data){
                $units = $this->objcom->get_single_record('measurement_units',array('id'=>$data->measure_unit));
                $response[$key]['id'] = $data->id;
                $response[$key]['name'] = $data->name;
                $response[$key]['quantity'] = $data->quantity;
                $response[$key]['status'] = $data->status;
                if(!empty($units)){
                    $response[$key]['measure_unit'] = $units->name;
                }
            }
        }
        $data_array['raws'] = $response;
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/raw-material/index',$data_array);
		$this->load->view('ADMIN/include/footer');      
    }
    
    function addRaw()
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $data_array['units'] = $this->objcom->get_all_where('measurement_units',$where=array('status'=>1),$ord="id");
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/raw-material/add',$data_array);
		$this->load->view('ADMIN/include/footer');    
    }
    
    function createNewRaw()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $input = $this->input->post();
        $postData['titleUrl'] = $this->removeSpecialChapr($input['name']);
        $postData['name'] = $input['name'];
        $postData['quantity'] = $input['quantity'];
        $postData['measure_unit'] = $input['units'];
        $postData['createdby'] = $admin_id;
        $postData['create_date'] = date("Y-m-d H:i:s");
        $url = $postData['titleUrl'];
        $qury = $this->db->query("SELECT * FROM `raw_material` WHERE `titleUrl` = '$url'");
        $data = $qury->row();
        if(empty($data))
        {
            if($this->objcom->insert_data('raw_material',$postData))
            {
                $responseData['responseData'] = "new record inserted successfully";        
            }    
        }else{
            $responseData['responseData'] = "already exist";     
        }
        echo json_encode($responseData);
        die();
    }
    
    function editRaw($id)
    {
        $admin_session = $this->session->userdata('admin_session');
        $admin_type = $admin_session['admin_type'];
        if($admin_type != 1)
        {
            return redirect('admin-login');
        }
        $data_array['units'] = $this->objcom->get_all_where('measurement_units',$where=array('status'=>1),$ord="id");
        $data_array['raw'] = $this->objcom->get_single_record('raw_material',array('id'=>$id)); 
        $this->load->view('ADMIN/include/header');
		$this->load->view('ADMIN/include/sidebar');
		$this->load->view('ADMIN/raw-material/edit',$data_array);
		$this->load->view('ADMIN/include/footer');  
    }
    
    function updateRaw()
    {
        date_default_timezone_set('Asia/Kuwait');
        $admin_sess = $this->session->userdata('admin_session');
        $admin_id = $admin_sess['admin_id'];
        $input = $this->input->post();
        $postData['name'] = $input['name'];
        $postData['quantity'] = $input['quantity'];
        $postData['measure_unit'] = $input['units'];
        $postData['titleUrl'] = $this->removeSpecialChapr($input['name']);
        $url = $postData['titleUrl'];
        $id = $input['id'];
        $qury = $this->db->query("SELECT * FROM `raw_material` WHERE `titleUrl` = '$url' AND `id`!='$id'");
        $data = $qury->row();
        if(empty($data))
        {
            if($this->objcom->update_records('raw_material',$postData,array('id'=>$id)))
            {
                $responseData['responseData'] = "record updated successfully";        
            }    
        }else{
            $responseData['responseData'] = "already exist";     
        }
        echo json_encode($responseData);
        die();    
    }
    
    function check_raw_quantity()
    {
        $input = $this->input->post();
        $postData['raw_id'] = $input['raw_id'];
        $postData['quantity'] = $input['quantity'];
        $action = $input['action'];
        //echo"<pre>";print_r($input);die;
    
        $data = $this->objcom->get_single_record('raw_material',array('id'=>$input['raw_id']));
        
        if(!empty($data))
        {
            if($action != 'update'){
                if($data->quantity !='' && $data->quantity < $input['quantity'])
                {
                    $responseData['responseData'] = "not available"; 
                }
                // else if($data->unit !='' && $data->unit < $input['quantity'])
                // {
                //      $responseData['responseData'] = "not available";
                // }
                else
                {
                    $responseData['responseData'] = "available";        
                }
                
            }else{
                $pData = $this->objcom->get_single_record('products',array('id'=>$input['pId']));
                $rawName = '';
                $rawQtyData = '';
                if(!empty($pData->raw_name)){
                    $rawName = json_decode($pData->raw_name);
                }
                if(!empty($pData->raw_quantity)){
                    $rawQtyData = json_decode($pData->raw_quantity);
                }
                $proQty = 0;
                for($j=0; $j<count($rawName); $j++){
                    if($rawName[$j] == $input['raw_id']){
                        $proQty = $rawQtyData[$j];
                    }
                }
                
                
                if($data->quantity !='' && (($data->quantity) < $input['quantity']))
                {
                    $responseData['responseData'] = "not available"; 
                }
                // else if($data->unit !='' && (($data->unit + $proQty) < $input['quantity']))
                // {
                //      $responseData['responseData'] = "not available";
                // }
                else
                {
                    $responseData['responseData'] = "available";        
                }
            }
              
        }else{
            $responseData['responseData'] = "Raw material not available";
            $responseData['data'] = $data;
        }
        echo json_encode($responseData);
        die();    
    }
    
    /*###############  POS SYSTEM HERE...######################*/
    
    public function pos_system()
    {
       $this->load->view('ADMIN/pos/index'); 
       
    }
    public function productsCollection()
    {
        $response = array();
        $categories = array();
        $products = array();
        $id = '';
        if(!empty($this->input->post('id'))){
            $id = $this->input->post('id');
        }
        $response['categories'] = $this->objcom->get_all_where('categories','','');
        $response['users'] = $this->objcom->get_all_where('customers','','');
        
        $category_array = $this->objcom->get_single_record('categories',array('id'=>$id));
        if(!empty($category_array)){
            $response['id'] = $category_array->id;
            $response['background'] = base_url('uploads/categories/').$category_array->image;
            $response['name'] = $category_array->name;
        }
        
        $products_array = $this->objcom->get_products_by_collection($id,'');
        foreach ($products_array as $key => $value) {
            $size = $value->size;
            $size_array = $this->objcom->get_single_record('sizes',array('id'=>$size));
            $products[$key]['product_id'] = $value->product_id; 
            $products[$key]['variation_id'] = $value->variation_id;
            $products[$key]['name'] = $value->name;
            $products[$key]['image'] = base_url('uploads/products/').$value->image;
            if(!empty($size_array)){
                $products[$key]['size'] = $size_array->name;
            }else{
                $products[$key]['size'] = '';
            }
            
            $products[$key]['mrp_price'] = $value->mrp_price; 
            $products[$key]['sale_price'] = $value->sale_price; 
            $products[$key]['url'] = $value->titleUrl; 
        }
        $response['products'] = $products;
        echo"<pre>";print_r($response['products']);die;
        $this->load->view('ADMIN/pos/index',$response);
    } 
    public function quick_view()
    {
       $response = array();
        $gallery = array();
        $variations = array();
        $variation_str = "";
        
        $id = $this->input->post('product_id');
        $varid = $this->input->post('variation_id');
        
        $productID = '';
        $category = '';
        $products = array();
        if($varid!=""){
            $variation_str = " AND `product_variations`.`id` = '$varid' ";    
        }
        $product_array = $this->objcom->get_product_data($id,$variation_str);
        
        if(!empty($product_array)){
            $size = $product_array->size;
            $productID = $id;
            $category = $product_array->categories;;
            $size_array = $this->objcom->get_single_record('sizes',array('id'=>$size));
            
            $response['product_id'] = $product_array->product_id; 
            $response['variation_id'] = $product_array->variation_id;
            $response['name'] = $product_array->name;
            $response['image'] = base_url('uploads/products/').$product_array->image;
            if(!empty($size_array)){
                $response['size'] = $size_array->name;
            }else{
                $response['size'] = '';
            }
        
            $response['mrp_price'] = $product_array->mrp_price;
            $response['price'] = $product_array->sale_price; 
            $response['quantity'] = $product_array->quantity;
            $response['discount'] = number_format($this->discount($product_array->mrp_price,$product_array->sale_price),2);
            $response['url'] = $product_array->titleUrl;
            $response['description'] = strip_tags($product_array->description);
            
        }
        $pro_array['response'] = $response;
        
        $filter_data = $this->load->view('ADMIN/pos/quick_view',$pro_array,true);
        echo json_encode($filter_data);
        die();
       
        
    }
    
    public function variant_price()
    {
        $inputs = $this->input->post();
        $productID = $inputs['id'];
        $variationId = $inputs['variationId'];
        $quantity = $inputs['quantity'];
        $price = 0;
        if($variationId!=""){
            $variation_str = " AND `product_variations`.`id` = '$variationId' ";    
        }
        $product_array = $this->objcom->get_product_data($productID,$variation_str);

        if(!empty($product_array)){
            $price = $price + ($product_array->sale_price*$quantity);
        }
        $filter_data = $price;
        echo json_encode($filter_data);
        die();
        
    }
    
    public function addtocart()
    {
        $response = array();
        $inputs = $this->input->post();
        $productID = $inputs['id'];
        $variationId = $inputs['variationId'];
        $quantity = $inputs['quantity'];
       

        if($variationId!=""){
            $variation_str = " AND `product_variations`.`id` = '$variationId' ";    
        }
        $check_qty = $this->objcom->get_product_data($productID,$variation_str);
        
        if(!empty($check_qty) && $check_qty->product_qty >= $quantity){
            $post_array['product_id']   = $productID;
            $post_array['variation_id'] = $variationId;
            $post_array['quantity']     = $quantity;
            $post_array['size']     = $check_qty->size;
            //check for already product in cart
            $check_data = $this->objcom->get_single_record('user_cart',array('product_id'=>$productID, 'variation_id'=>$variationId));
            if(empty($check_data))    
            {   
                if($this->objcom->insert_data('user_cart',$post_array))
                {
                    $output = "added";
                    echo json_encode($output);
                    
                }else{
                   $output = "not added";
                    echo json_encode($output);
                }
                
            }else{
              $output = 1;
                echo json_encode($output);
            }
        }else{
            $output = 0;
            echo json_encode($output);
        }
  
    }
    
    public function cartitems()
    {
        $response = array();
        $cart     = array();
        $inputs   = $this->input->post();
        //$user_id  = $inputs['user_id']; 
        //$where    = array('user_id'=>$user_id,'user_type'=>$type);
        $cart_array = $this->objcom->get_all_where('user_cart','','id');
        if(!empty($cart_array))
        {
            $totalprice = 0;
            $unitprice  = 0;
            foreach($cart_array as $key=>$row)
            {
                $cart_products = $this->common->get_cart_products($row->product_id, $row->variation_id);
                $cart[$key]['cart_id'] = $row->id;
                $cart[$key]['product_name'] = $cart_products->name;
                $cart[$key]['product_image'] = base_url('uploads/products/medium/').$cart_products->image;
                $total = number_format($cart_products->sale_price,2);
                $cart[$key]['product_price'] = $total;
                $cart[$key]['quantity'] = $row->quantity;
                $variations = $this->objcom->get_all_where('product_variations',array('id'=>$row->variation_id),'id');
                foreach($variations as $k=>$v)
                {
                    $size_arr = $this->objcom->get_single_record('sizes',array('id'=>$v->size));
                    $cart[$key]['size_name']    = ((!empty($size_arr))?$size_arr->name:'');
                } 
                $unitprice = floatval(str_replace(',', '', $total))*$row->quantity;
                //$unitprice = ($total*($row->quantity)); 
                $totalprice += $unitprice;
            }  
            
            $response['totalproduct'] = count($cart_array);
            $response['totalprice'] = number_format($totalprice,2);
            $response['list'] = $cart;
            $data['records'] = $response;
            $filter_data = $this->load->view('ADMIN/pos/cart',$data,true);
            echo json_encode($filter_data);
            die();
            
        }else{
            
        }
    }
    
    public function removefromcart()
    {
        $response = array();
        $inputs   = $this->input->post();
        $cart_id  = $inputs['cart_id'];
        
        if($this->objcom->delete_record('user_cart',array('id'=>$cart_id)))
        {
          $response['responseData'] = 1;  
        }else{
           $response['responseData'] = 0;
        }  
        echo json_encode($response);
        die();
    }
    public function removeAllCart()
    {
        $response = array();
        $inputs   = $this->input->post();
        if($this->objcom->deleteAllRecords('user_cart'))
        {
          $response['responseData'] = 1;  
        }else{
           $response['responseData'] = 0;
        }  
        echo json_encode($response);
        die();
    }
     /*############################### order Details ########################*/
    function placeorder()
    {
        $order_ret    = array();
        $date_time    = date('Y-m-d H:i:s');
        $response     = array();
        $ordProducts  = array();
        $inputs       = $this->input->post();
        //echo"<pre>";print_r($inputs);die;
        $user_id      = $inputs['user_id'];
        $paymode      = $inputs['type'];
        $discount     = $inputs['discount'];
        $amount       = number_format((floatval(str_replace(',', '', $inputs['amount']))-$discount),2);
        $price        = '';
        $address_array= '';
        $username     = '';
        $email        = '';
        $mobile       = '';
        $address      = '';
        $outputs      = '';
        $wherecart      = array('user_id'=>$user_id);
        $user_cart_data = $this->objcom->get_all_where('user_cart','','id');
        
        $user_array    = $this->objcom->get_single_record('customers',array('id'=>$user_id));
        if(!empty($user_array)){
            // $address_array = $this->objcom->get_single_record('customer_addresses',array('id'=>$address_id));
            // $address       = $address_array->address1.','.$address_array->address2.','.$address_array->city.','.$address_array->state.'-'.$address_array->pincode;
            $username      = $user_array->customer_name;
            $email         = $user_array->email;
            $mobile        = $user_array->mobile_number;
            
        }
        
        $order_data['order_unique_id'] = 'ORD-'.date('dmy').rand();;
        $order_data['user_id']         = $user_id;
        $order_data['user_name']       = $username;
        $order_data['email']           = $email;
        $order_data['address']         = $address;
        $order_data['phone']           = $mobile;
        $order_data['coupon_amt']      = $discount;
        $order_data['total_amount']    = $amount;
        $order_data['payment_status '] = 1;
        $order_data['payment_method '] = $paymode;
        $order_data['status ']         = 0;
        $order_data['create_date']     = $date_time;
         
        //$wherecart      = array('user_id'=>$user_id,'user_type'=>$inputs['user_type']);
        $user_cart_data = $this->common->get_all_where('user_cart','','id');
        $order_ret['user_cart_data'] = $user_cart_data;
        
        $order_id = $this->common->insert_and_return_id('orders',$order_data);
        
        $order_ret['order_id']       = $order_id;
        
        if(!empty($user_cart_data))
        {
            if(!empty($order_id))
            {
                $order_data = $this->common->get_single_record('orders',array('id'=>$order_id));
                $order_ret['order'] = $order_data;
                $order_unique_id = $order_data->order_unique_id;
                
                if(!empty($user_cart_data))
                {
                    foreach($user_cart_data as $key=>$row)
                    {
                        if($row->variation_id!='')
                        {
                            $crtPrdts = $this->common->get_cart_products($row->product_id, $row->variation_id); 
                            if(!empty($crtPrdts->sale_price) && ($crtPrdts->sale_price!= '0.00'))
                            {
                                $price = $crtPrdts->sale_price;
                            }else{ 
                                $price = 0.00;
                            }
                                
                        }
                        
                        $order_product_data[] = array(
                            'order_id'      => $order_data->id,
                            'user_id'       => $user_id,
                            'orderUniqid'   => $order_data->order_unique_id,
                            'product_id'    => $crtPrdts->product_id,
                            'variation_id'  => $crtPrdts->variation_id,
                            'product_name'  => $crtPrdts->name,
                            'product_image' => $crtPrdts->image,
                            'quantity'      => $row->quantity,
                            'price'         => $price,
                            'order_status ' => 0,
                            'create_date'   => $date_time,
                            'payment_mode'  => (($paymode=='cash')?0:1) 
                        );
                        
                        $pro_infor = $this->objcom->get_single_record('products',array('id'=>$crtPrdts->product_id));
                        $postData['product_qty'] = $pro_infor->product_qty - $row->quantity;
                        $this->objcom->update_records('products',$postData,array('id'=>$crtPrdts->product_id));
                    }
                    
                    if($this->common->insert_batch_data('order_details',$order_product_data))
                    {
                        if($this->common->deleteAllRecords('user_cart')){
                            $this->session->unset_userdata('discount_session');
                            $this->session->unset_userdata('cust_id_session');
                            // $this->session->set_flashdata('ordersuccess', 'Order placed successfully');
                            // return redirect('pos');
                            $outputs = array(
                              'response' =>'success',
                              'paymethod'=>$paymode,
                              'booking_id'=>$order_unique_id
                            ); 

                        }else{

                        }

                    }

                }else{
                
            }

        }else{
            $outputs = array(
                'response' =>'failed',
                'paymethod'=>$paymode,
            ); 
        
        }
        
    }
    
    echo json_encode($outputs);
    die();
}

public function store_keys()
{
    $inputs = $this->input->post();
    $key = $inputs['key'];
    $value = $inputs['value'];
    $session_data = array($key =>$value);
    $this->session->set_userdata('cust_id_session', $session_data);
    echo json_encode($session_data);
    die();
    
}

    public function category_filter()
    {
        $response = array();
        $categories = array();
        $products = array();
        $category_id = '';
        if(!empty($this->input->post('category_id'))){
            $category_id = $this->input->post('category_id');
        }
        $response['categories'] = $this->objcom->get_all_where('categories','','');
        
        $category_array = $this->objcom->get_single_record('categories',array('id'=>$category_id));
        if(!empty($category_array)){
            $response['id'] = $category_array->id;
            $response['background'] = base_url('uploads/categories/').$category_array->image;
            $response['name'] = $category_array->name;
        }
        
        $products_array = $this->objcom->get_products_by_collection($category_id,'');
        foreach ($products_array as $key => $value) {
            $size = $value->size;
            $size_array = $this->objcom->get_single_record('sizes',array('id'=>$size));
            $products[$key]['product_id'] = $value->product_id; 
            $products[$key]['variation_id'] = $value->variation_id;
            $products[$key]['name'] = $value->name;
            $products[$key]['image'] = base_url('uploads/products/').$value->image;
            if(!empty($size_array)){
                $products[$key]['size'] = $size_array->name;
            }else{
                $products[$key]['size'] = '';
            }
            
            $products[$key]['mrp_price'] = $value->mrp_price; 
            $products[$key]['sale_price'] = $value->sale_price; 
            $products[$key]['url'] = $value->titleUrl; 
        }
            $response['products'] = $products;
        
            $filter_data = $this->load->view('ADMIN/pos/ajax_category_filter',$response,true);
            echo json_encode($filter_data);
            die();
    }
    
    public function product_filter()
    {
        $response = array();
        $categories = array();
        $products = array();
        
        $category_id = '';
        $keyword = '';
        if(!empty($this->input->post('category_id'))){
            $category_id = $this->input->post('category_id');
        }
        if(!empty($this->input->post('keyword'))){
            $keyword = $this->input->post('keyword');
        }
       
        $response['categories'] = $this->objcom->get_all_where('categories','','');
        
        $category_array = $this->objcom->get_single_record('categories',array('id'=>$category_id));
        if(!empty($category_array)){
            $response['id'] = $category_array->id;
            $response['background'] = base_url('uploads/categories/').$category_array->image;
            $response['name'] = $category_array->name;
        }
        
        if(!empty($category_id)){
            $products_array = $this->objcom->get_products_by_collection($category_id,'');
        }else if(!empty($keyword)){
            $products_array = $this->objcom->get_search_products($keyword);
        }else{
            $products_array = $this->objcom->get_products_by_collection($category_id,'');
        }
        
        foreach ($products_array as $key => $value) {
            $size = $value->size;
            $size_array = $this->objcom->get_single_record('sizes',array('id'=>$size));
            $products[$key]['product_id'] = $value->product_id; 
            $products[$key]['variation_id'] = $value->variation_id;
            $products[$key]['name'] = $value->name;
            $products[$key]['image'] = base_url('uploads/products/').$value->image;
            if(!empty($size_array)){
                $products[$key]['size'] = $size_array->name;
            }else{
                $products[$key]['size'] = '';
            }
            
            $products[$key]['mrp_price'] = $value->mrp_price; 
            $products[$key]['sale_price'] = $value->sale_price; 
            $products[$key]['url'] = $value->titleUrl; 
        }
            $response['products'] = $products;
            $filter_data = $this->load->view('ADMIN/pos/ajax_category_filter',$response,true);
            echo json_encode($filter_data);
            die();
    }
    
    public function update_discount()
    {
        $inputs = $this->input->post();
        
        $amount = $inputs['amount'];
        $discount = $inputs['discount'];
        $type = $inputs['type'];
        $discountAmt = '';
         if ($type == 'percent' && $discount > 0) {
            $discountAmt = ($discount/100)*$amount;
        } elseif ($type == 'amount' && $discount > 0) {
            $discountAmt = $discount;
        }
 
        $discount_data = array('discountAmt' =>number_format((floatval($discountAmt)),2),'type'=>$type,'discount'=>$discount);
        $this->session->set_userdata('discount_session', $discount_data);
        return redirect('pos');

    }
    
    
    
    
    public function discount($mrp_price,$sale_price){
        $percent = (($mrp_price - $sale_price)*100) /$mrp_price ;
        return $percent;
    }
	function order_invoince($order_id)
	{
	    $this->data['page_title'] = "THANK YOU FOR TRUSTING US | Order Successfully Placed LOAD Gym";
        $orders = $this->objcom->get_single_record('orders',array('order_unique_id'=>$order_id));
        $orderdata = array();
        if(!empty($orders)){
            
            // $orderdata['order_unique_id'] = $orders->order_unique_id;
            //     $orderdata['user_name'] = $orders->user_name;
            //     $orderdata['total_amount'] = $orders->total_amount;
            //     $orderdata['book_date'] = $orders->book_date;
            //     $ordDetails = $this->objcom->get_all_where('order_details',array('orderUniqid'=>$orders->order_unique_id),'id');
            //     $course_name = '';
            //     $subs_name = '';
            //     $duration = '';
            //     if(!empty($ordDetails)){
            //         for($i=0; $i<count($ordDetails); $i++){
            //             $course_data = $this->objcom->get_single_record('courses',array('id'=>$ordDetails[$i]->course_id)); 
            //             $course_name = $course_name.$course_data->name.',';
            //             $subs_data = $this->objcom->get_single_record('prime_members',array('id'=>$ordDetails[$i]->subscription_id)); 
            //             $subs_name = $subs_name.$subs_data->name.',';
                      
            //             $duration = $duration.date('d/m/Y H:i:s',strtotime($ordDetails[$i]->start_date)).'- '.date('d/m/Y H:i:s',strtotime($ordDetails[$i]->end_date)).',';
            //         }
            //     }
                
        }
        //$data_array['orders'] = $orderdata ;
        $data_array['order'] = $orders;
        //echo"<pre>";print_r($data_array['order']);die;
	    $this->load->view('ADMIN/pos/order_invoice');
	}
/*MAin Class Ended*/	
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Variations extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('common','objcom');
        /*if(!$this->session->userdata('admin_session'))
        {
            return redirect('admin-login');
        }*/
    }
    

    public function index(){
        $inputData = $this->input->get();
        $id = $inputData['pid'];
        $this->load->model('productsmodel', 'objposts');
        $postProduct = $this->objposts->getPost($id);
        $this->data['postProduct'] = $postProduct['res'];

        $variations = $this->objposts->getVariations($id);
        $this->data['variations'] = $variations['res'];

        $getColorList = $this->objposts->getColorList();
        $this->data['getColorList'] = $getColorList['res'];

        $getSizeList = $this->objposts->getSizeList();
        $this->data['getSizeList'] = $getSizeList['res'];

        $this->load->view('admin/products/variations/index');
    }

    public function add(){
        $inputData = $this->input->get();
        $id = $inputData['pid'];
        $this->load->model('productsmodel', 'objposts');
        
        $postProduct = $this->objposts->getPost($id);
        $this->data['postProduct'] = $postProduct['res'];

        $getColorList = $this->objposts->getColorList();
        $this->data['getColorList'] = $getColorList['res'];

        $getSizeList = $this->objposts->getSizeList();
        $this->data['getSizeList'] = $getSizeList['res'];
        
        $this->load->view('admin/products/variations/add');
    }

    public function create(){
        $this->load->model('productsmodel', 'objposts');
        $inputData = $this->input->post();
        if (!empty($inputData['productId'])) {
            //$product_info = $this->objcom->get_single_record('products',array('id'=>$inputData['productId']));
            date_default_timezone_set('Asia/Kuwait');
            $userData = array();
            $imagedata = array();  
            if(!empty($_FILES) && !empty($_FILES['file']['type'])){
               if(($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/png')){    
                $file = $this->objposts->updateMedia('file','products');
                $imagedata['image'] = $file; 
               }
            }
            if(!empty($imagedata['image'])){
                $userData['image'] = $imagedata['image'];
            }else{
                $userData['image'] = 'default-image.png';
            }
            if(!empty($_FILES) && !empty($_FILES['files'])){
                $galleryImages = $this->objposts->uploadImages('files','products');
                if(!empty($galleryImages['filenames'])){
                    $userData['gallery'] = json_encode($galleryImages['filenames']); 
                }
            } 
            
           
            $userData['product_id'] = $inputData['productId'];
            $userData['mrp_price'] = $inputData['productPrice'];
            $userData['sale_price'] = $inputData['productSalePrice'];

            $userData['size'] = $inputData['productSize'];
            $userData['status'] = '1';
            $userData['create_date'] = date("Y-m-d H:i:s");
            
            $saveUserRes = $this->objposts->insertVariationData($userData);
            
            $responseData = array();
            if (!empty($saveUserRes['id'])) {
                $responseData['responseData'] = 'variation created successfully';
            } else {
                $responseData['responseData'] = 'error';
            }
            echo json_encode($responseData);
            die();
        }
    }

    public function view($id){
        $this->load->model('productsmodel', 'objposts');

        $getColorList = $this->objposts->getColorList();
        $this->data['getColorList'] = $getColorList['res'];

        $getSizeList = $this->objposts->getSizeList();
        $this->data['getSizeList'] = $getSizeList['res'];

        $productVariation = $this->objposts->getProductVariation($id);
        $this->data['productVariation'] = $productVariation['res'];

        if(!empty($productVariation['res'][0]['product_id'])){
            $productId = $productVariation['res'][0]['product_id'];
            $postProduct = $this->objposts->getPost($productId);
            $this->data['postProduct'] = $postProduct['res'];
        }
        $this->load->view('admin/products/variations/view');
    }

    public function edit($id){
        $this->load->model('productsmodel', 'objposts');
        
        $getColorList = $this->objposts->getColorList();
        $this->data['getColorList'] = $getColorList['res'];

        $getSizeList = $this->objposts->getSizeList();
        $this->data['getSizeList'] = $getSizeList['res'];

        $productVariation = $this->objposts->getProductVariation($id);
        $prid = $productVariation['res'][0]['product_id'];
        
        $vdata = $this->objcom->get_single_record('products',array('id'=>$prid));
        
        $this->data['pcreatedby'] = $vdata->createdby;
        
        $this->data['productVariation'] = $productVariation['res'];

        if(!empty($productVariation['res'][0]['product_id'])){
            $productId = $productVariation['res'][0]['product_id'];
            $postProduct = $this->objposts->getPost($productId);
            $this->data['postProduct'] = $postProduct['res'];
        }

        $this->load->view('admin/products/variations/edit');
    }

    public function update(){
        $this->load->model('productsmodel', 'objposts');
        $inputData = $this->input->post();
        if (!empty($inputData['productId']) && !empty($inputData['variationId'])) {
            date_default_timezone_set('Asia/Kuwait');
            $userData = array();
            $imagedata = array();  
            if(!empty($_FILES) && !empty($_FILES['file']['type'])){
               if(($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/png')){    
                $file = $this->objposts->updateMedia('file','products');
                $imagedata['image'] = $file; 
               }
            }
            if(!empty($imagedata['image'])){
                $userData['image'] = $imagedata['image'];
            }
            if(!empty($_FILES) && !empty($_FILES['files'])){
                $deleted_file = $inputData['deleted_file_ids'];
                $galleryImages = $this->objposts->uploadImages('files','products', $deleted_file);
                if(!empty($galleryImages['filenames'])){
                    $productVariation = $this->objposts->getProductVariation($inputData['variationId']);
                    $productVariationImages = $productVariation['res'];
                    if(!empty($productVariationImages[0]['gallery'])){
                        $gallery = json_decode($productVariationImages[0]['gallery']);
                        $userData['gallery'] = json_encode(array_merge($gallery,$galleryImages['filenames']));
                    }else{
                        $userData['gallery'] = json_encode($galleryImages['filenames']);
                    }
                    
                }
            }
            
            
            $userData['id'] = $inputData['variationId'];
            $userData['product_id'] = $inputData['productId'];
            $userData['mrp_price'] = $inputData['productPrice'];
            $userData['sale_price'] = $inputData['productSalePrice'];
            $userData['color'] = $inputData['productColor'];
            $userData['size'] = $inputData['productSize'];
            $userData['update_date'] = date("Y-m-d H:i:s");

            $saveUserRes = $this->objposts->updateVariationData($userData);
            $responseData = array();
            if (!empty($saveUserRes['id'])) {
                $responseData['responseData'] = 'variation update successfully';
            } else {
                $responseData['responseData'] = 'error';
            }
            echo json_encode($responseData);
            die();
        }
    }

    public function delete($id){
        $this->load->model('productsmodel', 'objposts');

        $productVariation = $this->objposts->getProductVariation($id);
        $this->data['productVariation'] = $productVariation['res'];

        if(!empty($productVariation['res'][0]['product_id'])){
            $productId = $productVariation['res'][0]['product_id'];
            $postProduct = $this->objposts->getPost($productId);
            $this->data['postProduct'] = $postProduct['res'];
        }
        $productID = '';
        if(!empty($this->data['postProduct'])){ 
            $productData = $this->data['postProduct']; 
            $productID = $productData[0]['id'];
        } 

        $userData = array();
        $userData['id'] = $id;
        $saveUserRes = $this->objposts->deleteVariationData($userData);
        if (!empty($saveUserRes['status'])) {
            redirect('/variations/?pid='.$productID, 'refresh');
        } else {
            redirect('/variations/?pid='.$productID, 'refresh');
        }
    }

    public function productVariationStatus(){
        $this->load->model('productsmodel', 'objposts');
        $inputData = $this->input->post();
        date_default_timezone_set('Asia/Kuwait');
        $userData = array();
        $userData['id'] = $inputData['postId'];
        $userData['status'] = $inputData['postStatus'];
        $userData['update_date'] = date("Y-m-d H:i:s");
        $saveUserRes = $this->objposts->updateVariationDataStatus($userData);
        $responseData = array();
        if (!empty($saveUserRes['id'])) {
            $responseData['responseData'] = 'post update successfully';
        } else {
            $responseData['responseData'] = 'error';
        }
        echo json_encode($responseData);
        die();
    }

    public function imageGallery(){
        $this->load->model('productsmodel', 'objposts');
        $inputData = $this->input->post();
        $image = $inputData['image'];
        $saveUserRes = $this->objposts->updateVariationGallery($inputData['variationId']);
        $responseData = array();
        if (!empty($saveUserRes['res'])) {
            $gallery = json_decode($saveUserRes['res'][0]['gallery']);
            if (($key = array_search($image, $gallery)) !== false) {
                unset($gallery[$key]);
            }

            if(!empty($gallery)){ 
                $updateIMg = array();
                foreach($gallery as $img){
                    $updateIMg[] = $img;
                }
                $arrPostedData = array();
                $arrPostedData['id'] = $inputData['variationId'];
                $arrPostedData['gallery'] = json_encode($updateIMg);
                $this->objposts->updateVariationData($arrPostedData);
            }

            $responseData['responseData'] = 'variation image gallery';
        } else {
            $responseData['responseData'] = 'error';
        }
        echo json_encode($responseData);
        die();
    }
    
    public function removeSpecialChapr($value){
		$title = str_replace( array( '\'', '"', ',' , ';', '<', '>','!', '@', '#' , '$', '%', '^', '&', '*' , '(', ')', '_', '-', '=' , '+', ':', '?', '.', '`', '~', '[', ']', '{', '}', '|' , '/' , '\\' , '‘' , '’' , '“', '”' , '…', '‰' ), '', $value);
		$post_title1 = str_replace( array("  "), array(" "), $title);	
		$post_title = str_replace( array(" ","'"), array("-",""), $post_title1);
		$postTitle = strtolower($post_title);
		return $postTitle;
    }
}
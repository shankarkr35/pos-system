<?php
class Productsmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
        error_reporting(0);
        ini_set('display_errors', 0);
    }

    public function insertData($arrPostedData){
        $arrResult = array();
        if ($arrPostedData['name']) {
            $where = "name ='" . $arrPostedData['name'] . "'";
            $this->db->select('*');
            $this->db->where($where);
            $this->db->from('products');
            $result = $this->db->get()->result_array();
            if (!empty($result)) {
                $arrResult['id'] = $result[0]['id'];
            } else {
                $this->db->insert('products', $arrPostedData);
                $id = $this->db->insert_id();
                if (!empty($id)) {
                    $where = "id ='" . $id . "'";
                    $this->db->select('*');
                    $this->db->where($where);
                    $this->db->from('products');
                    $result = $this->db->get()->result_array();
                    if (!empty($result)) {
                        $arrResult['id'] = $result[0]['id'];
                        $arrResult['name'] = $result[0]['name'];
                    }
                }
            }
        } 
        return $arrResult;
    }

    public function getPublishPostList(){
        $arrResult = array();
        $this->db->select('*');
        $where = "status = '1'";
        $this->db->where($where);
        $this->db->from('products');
        $this->db->order_by("name", "asc");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult['res'] = $query;
        }else{
            $arrResult['res'] = '';
        }
        return $arrResult;
    }
    
    public function getPostList1(){
        $arrResult = array();
        $this->db->select('*');
        $this->db->from('products');
        $this->db->order_by("id", "desc");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult['res'] = $query;
        }else{
            $arrResult['res'] = '';
        }
        return $arrResult;
    }
    
    public function getPostList(){
        $arrResult = array();
        $this->db->select('products.*,count(DISTINCT product_variations.color) as color,count(DISTINCT product_variations.size) as size');
        $this->db->from('products');
        $this->db->join('product_variations','products.id = product_variations.product_id','LEFT');
        $this->db->group_by('product_variations.product_id');
        $this->db->order_by("id", "desc");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult['res'] = $query;
        }else{
            $arrResult['res'] = '';
        }
        return $arrResult;
    }

    /*public function getAllPostList(){
        $arrResult = array();
        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('product_variations','product_variations.product_id = products.id');
        $this->db->where('product_variations.status', '1');
        $this->db->group_by('product_variations.product_id');
        $this->db->order_by("product_variations.product_id", "DESC");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult['res'] = $query;
        }else{
            $arrResult['res'] = '';
        }
        return $arrResult;
    }*/

    public function getPost($id){
        $condition = array();
        $arrResult = array();
        $this->db->select('*');
        $this->db->from('products');
        $condition['products.id'] = $id;
        $this->db->where($condition);
        $this->db->order_by("name", "asc");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult['res'] = $query;
        }else{
            $arrResult['res'] = '';
        }
        return $arrResult;
    }

    public function updateData($arrPostedData){
        $arrResult = array();
        $this->db->where('id', $arrPostedData['id']);
        $this->db->update('products', $arrPostedData);
        if ($this->db->affected_rows() > 0){
            $arrResult['id'] = $arrPostedData['id'];
            $arrResult['name'] = $arrPostedData['name'];
        }else{
           $arrResult['id'] = '';
        }
       return $arrResult;
    }

    public function updateImagesData($arrPostedData){
        $arrResult = array();
        $this->db->where('id', $arrPostedData['id']);
        $this->db->update('products', $arrPostedData);
        if ($this->db->affected_rows() > 0){
            $arrResult['id'] = $arrPostedData['id'];
        }else{
           $arrResult['id'] = '';
        }
       return $arrResult;
    }

    public function updateDataStatus($arrPostedData){
        $arrResult = array();
        $this->db->where('id', $arrPostedData['id']);
        $this->db->update('products', $arrPostedData);
        if ($this->db->affected_rows() > 0){
            $arrResult['id'] = $arrPostedData['id'];
        }else{
           $arrResult['id'] = '';
        }
       return $arrResult;
    }

    public function deleteData($arrPostedData){
        $condition = array();
        $arrResult = array();
        $condition['id'] = $arrPostedData['id'];
        $this->db->where($condition);
        $result = $this->db->delete('products');
        if(!empty($result)){
           $arrResult['status'] = true;
        }else{
           $arrResult['status'] = false;
        }
        return $arrResult;
    }

    public function getCategoryList(){
        $arrResult = array();
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('status','1');
        $this->db->order_by("name", "asc");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult['res'] = $query;
        }else{
            $arrResult['res'] = '';
        }
        return $arrResult;
    }

    public function getParentCategoryList(){
        $arrResult = array();
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('parentcategory','0');
        $this->db->where('status','1');
        $this->db->order_by("name", "asc");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult['res'] = $query;
        }else{
            $arrResult['res'] = '';
        }
        return $arrResult;
    }

    public function getProductBrandList(){
        $arrResult = array();
        $this->db->select('*');
        $where = "status = '1'";
        $this->db->where($where);
        $this->db->from('productbrands');
        $this->db->order_by("name", "asc");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult['res'] = $query;
        }else{
            $arrResult['res'] = '';
        }
        return $arrResult;
    }
    
    public function getColorList(){
        $arrResult = array();
        $this->db->select('*');
        $this->db->from('productcolor');
        $this->db->where('status','1');
        $this->db->order_by("id", "asc");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult['res'] = $query;
        }else{
            $arrResult['res'] = '';
        }
        return $arrResult;
    }

    public function getSizeList(){
        $arrResult = array();
        $this->db->select('*');
        $this->db->from('productsize');
        $this->db->where('status','1');
        $this->db->order_by("id", "asc");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult['res'] = $query;
        }else{
            $arrResult['res'] = '';
        }
        return $arrResult;
    }
    //==========================product variations start========================================
    public function getVariations($id){
        $condition = array();
        $arrResult = array();
        $this->db->select('*');
        $this->db->from('product_variations');
        $condition['product_variations.product_id'] = $id;
        $this->db->where($condition);
        $this->db->order_by("id", "asc");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult['res'] = $query;
        }else{
            $arrResult['res'] = '';
        }
        return $arrResult;
    }

    public function insertVariationData($arrPostedData){
        $arrResult = array();
        if ($arrPostedData['product_id']) {
            $this->db->insert('product_variations', $arrPostedData);
            $id = $this->db->insert_id();
            if (!empty($id)) {
                $where = "id ='" . $id . "'";
                $this->db->select('*');
                $this->db->where($where);
                $this->db->from('product_variations');
                $result = $this->db->get()->result_array();
                if (!empty($result)) {
                    $arrResult['id'] = $result[0]['id'];
                }
            }
        } 
        return $arrResult;
    }

    public function updateVariationData($arrPostedData){
        $arrResult = array();
        $this->db->where('id', $arrPostedData['id']);
        $this->db->update('product_variations', $arrPostedData);
        if ($this->db->affected_rows() > 0){
            $arrResult['id'] = $arrPostedData['id'];
        }else{
           $arrResult['id'] = '';
        }
       return $arrResult;
    }

    public function updateVariationDataStatus($arrPostedData){
        $arrResult = array();
        $this->db->where('id', $arrPostedData['id']);
        $this->db->update('product_variations', $arrPostedData);
        if ($this->db->affected_rows() > 0){
            $arrResult['id'] = $arrPostedData['id'];
        }else{
           $arrResult['id'] = '';
        }
       return $arrResult;
    }

    public function updateVariationGallery($id){
        $condition = array();
        $arrResult = array();
        $this->db->select('*');
        $this->db->from('product_variations');
        $condition['product_variations.id'] = $id;
        $this->db->where($condition);
        $this->db->order_by("id", "asc");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult['res'] = $query;
        }else{
            $arrResult['res'] = '';
        }
        return $arrResult;
    }

    public function deleteVariationData($arrPostedData){
        $condition = array();
        $arrResult = array();
        $condition['id'] = $arrPostedData['id'];
        $this->db->where($condition);
        $result = $this->db->delete('product_variations');
        if(!empty($result)){
           $arrResult['status'] = true;
        }else{
           $arrResult['status'] = false;
        }
        return $arrResult;
    }

    public function getProductVariation($id){
        $condition = array();
        $arrResult = array();
        $this->db->select('*');
        $this->db->from('product_variations');
        $condition['product_variations.id'] = $id;
        $this->db->where($condition);
        $this->db->order_by("id", "asc");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult['res'] = $query;
        }else{
            $arrResult['res'] = '';
        }
        return $arrResult;
    }

    public function getProductsVData($productID, $variationId){
        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('product_variations','product_variations.product_id = products.id');
        $this->db->where('products.id', $productID);
        $this->db->where('product_variations.id', $variationId);
        $this->db->group_by('product_variations.product_id');
        $this->db->order_by("product_variations.product_id", "DESC");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult = $query[0];
        }else{
            $arrResult = '';
        }
        return $arrResult;
    }

    public function getVUsersData($productID, $variationId){
        $this->db->select('*');
        $this->db->from('notifyme');
        $this->db->where('product_id', $productID);
        $this->db->where('variation_id', $variationId);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            $arrResult['res'] = $query;
        }else{
            $arrResult['res'] = '';
        }
        return $arrResult;
    }
    
    //==========================product variations end========================================
    public function updateMedia($image, $folder, $height = 768, $width = 1024, $path = FALSE){
        $this->makedirs($folder);
        $realpath = $path ? '../uploads/' : 'uploads/';
        $allowed_types = "*";
        $img_name = $this->authToken();
        $img_sizes_arr = $this->image_sizes($folder); 
        $min_width = $img_sizes_arr['thumbnail']['width'];
        $min_height = $img_sizes_arr['thumbnail']['height'];
        $config = array('upload_path' => $realpath . $folder, 'allowed_types' => $allowed_types,'file_name' => $img_name, 'overwrite' => FALSE, 'remove_spaces' => TRUE, 'quality' => '100%',);
        $this->load->library('upload');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($image)) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        }
        $image_data = $this->upload->data();
        $this->load->library('image_lib');
        $thumb_img = '';
        foreach ($img_sizes_arr as $k => $v) {
            $sub_folder = $folder . $v['folder'];
            $this->makedirs($sub_folder);
            $real_path = realpath(FCPATH . $realpath . $folder);
            $resize['image_library'] = 'gd2';
            $resize['source_image'] = $image_data['full_path'];
            $resize['new_image'] = $real_path . $v['folder'] . '/' . $image_data['file_name'];
            $resize['maintain_ratio'] = TRUE; 
            $resize['width'] = $v['width'];
            $resize['height'] = $v['height'];
            $resize['quality'] = '100%';
            $dim = (intval($image_data["image_width"]) / intval($image_data["image_height"])) - ($v['width'] / $v['height']);
            $resize['master_dim'] = ($dim > 0) ? "height" : "width";
            $this->image_lib->initialize($resize);
            $is_resize = $this->image_lib->resize();
            $source_img = $real_path . $v['folder'] . '/' . $image_data['file_name'];
            if ($is_resize && file_exists($source_img)) {
                $source_image_arr = getimagesize($source_img);
                $source_image_width = $source_image_arr[0];
                $source_image_height = $source_image_arr[1];
                $source_ratio = $source_image_width / $source_image_height;
                $new_ratio = $v['width'] / $v['height'];
                if ($source_ratio != $new_ratio) {
                    $crop_config['image_library'] = 'gd2';
                    $crop_config['source_image'] = $source_img;
                    $crop_config['new_image'] = $source_img;
                    $crop_config['quality'] = "100%";
                    $crop_config['maintain_ratio'] = TRUE;
                    $crop_config['width'] = $v['width'];
                    $crop_config['height'] = $v['height'];
                    if ($new_ratio > $source_ratio || (($new_ratio == 1) && ($source_ratio < 1))) {
                        $crop_config['y_axis'] = round(($source_image_width - $crop_config['width']) / 2);
                        $crop_config['x_axis'] = 0;
                    } else {
                        $crop_config['x_axis'] = round(($source_image_height - $crop_config['height']) / 2);
                        $crop_config['y_axis'] = 0;
                    }
                    $this->image_lib->initialize($crop_config);
                    $this->image_lib->crop();
                    $this->image_lib->clear();
                }
            }
        }
        if (empty($thumb_img)) $thumb_img = $image_data['file_name'];
        return $thumb_img;
    }

    public function makedirs($folder = '', $mode = DIR_WRITE_MODE, $defaultFolder = 'uploads/') {
        if (!@is_dir(FCPATH . $defaultFolder)) {
            mkdir(FCPATH . $defaultFolder, $mode);
        }
        if (!empty($folder)) {
            if (!@is_dir(FCPATH . $defaultFolder . '/' . $folder)) {
                mkdir(FCPATH . $defaultFolder . '/' . $folder, $mode, true);
            }
        }
    } 

    public function authToken() {
        return 'products_' . strtoupper(md5(base64_encode(rand())));
    }

    public function image_sizes($folder) {
        $img_sizes = array();
        switch ($folder) {
            case 'admin':
                $img_sizes['thumbnail'] = array('width' => 50, 'height' => 50, 'folder' => '/thumb');
                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');
            break;
            case 'category':
                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');
                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');
            break;
            case 'subcategory':
                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');
                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');
            break;
            case 'banner':
                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');
                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');
            break;
            case 'posts':
                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');
                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');
            break;
            case 'products':
                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');
                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');
            break;
            case 'fcat':
                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');
                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');
            break;
            case 'gallery':
                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');
                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');
            break;
            case 'NoticesDoc':
                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');
                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');
            break;
        }
        return $img_sizes;
    }

    public function uploadPDF($profile_image, $folder) {
        $this->makedirs($folder);
        $config = array('upload_path' => 'uploads/products/' . $folder, 'allowed_types' => "*", 'overwrite' => false, 'max_size' => "1024000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
        'encrypt_name' => TRUE, 'remove_spaces' => TRUE);
        $this->load->library('upload');
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($profile_image)) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $pdf = $this->upload->data(); //upload the image
            return $pdf['file_name'];
        }
    }

    public function uploadImages($audiofile, $folder) {
        $this->makedirs($folder);
        $data = array();
        $countfiles = count($_FILES['files']['name']);
        for($i=0;$i<$countfiles;$i++){
            if(!empty($_FILES['files']['name'][$i])){
                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                // Set preference
                $config['upload_path'] = 'uploads/' . $folder; 
                $config['allowed_types'] = '*';
                $config['max_size'] = '1024000'; 
                $config['file_name'] = $_FILES['files']['name'][$i];

                $this->load->library('upload',$config); 
                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $filename = $uploadData['file_name'];
                    $data['filenames'][] = $filename;
                }else{
                    $data['error'][] = array('error' => $this->upload->display_errors());
                }
            }
        }
        return $data;
    }

}
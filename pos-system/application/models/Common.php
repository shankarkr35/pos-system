<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');



class Common extends CI_Model {

    public function __construct() {

        parent::__construct();

    }

    function insert_data($tbl,$data)
    {
        if($this->db->insert($tbl,$data))
        {
            return TRUE;
        }
    }

    function insert_batch_data($tbl,$data)
    {
        if($this->db->insert_batch($tbl, $data))
        {
            return TRUE;

        }

    }
    
    function insert_and_return_id($tbl,$data)
    {
        $this->db->insert($tbl, $data);
        return $this->db->insert_id();

    }

    

    function add_new_customer($data)
    {
        $this->db->insert('customers', $data);
        return $this->db->insert_id();
    }

    

    function get_single_record($table,$where)
    {
        $query = $this->db->get_where($table,$where);
        return $query->row();
    }

    function select_where_in_array($table,$col,$where,$oderBy)
    {
        $this->db->select('*');
        $this->db->from($table);
        if (!empty($where)) 
        {
            $this->db->where_in($col,$where);
        }
        if (!empty($oderBy)) 
        {
            $this->db->order_by($oderBy, 'DESC');
        }
        $query = $this->db->get(); 
        return $query->result();

    }

    function get_all_where($table,$where,$oderBy)

    {

        $this->db->select('*');

        $this->db->from($table);

        if (!empty($where)) 

        {

            $this->db->where($where);

        }

        if (!empty($oderBy)) 

        {

            $this->db->order_by($oderBy, 'DESC');

        }

        $query = $this->db->get(); 

        return $query->result();

    }

    

    function update_records($tbl,$data,$where)

    {

        $this->db->where($where);

        if($this->db->update($tbl,$data))

        {

            return TRUE;

        }

    }

    

    function delete_record($tbl,$where)
    {
        if($this->db->delete($tbl,$where))
        {
            return TRUE;
        }
    }
    function deleteAllRecords($tbl)
    {
        $this->db->empty_table($tbl);
        return true;
    }

    

    public function updateMedia($image, $folder,$file_prefix, $height = 768, $width = 1024, $path = FALSE)

    {

        $this->makedirs($folder);

        $realpath = $path ? '../uploads/' : 'uploads/';

        $allowed_types = "*";

        $img_name = $this->authToken($file_prefix);

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



    public function makedirs($folder = '', $mode = DIR_WRITE_MODE, $defaultFolder = 'uploads/') 
    {

        if (!@is_dir(FCPATH . $defaultFolder)) {

            mkdir(FCPATH . $defaultFolder, $mode);

        }

        if (!empty($folder)) {

            if (!@is_dir(FCPATH . $defaultFolder . '/' . $folder)) {

                mkdir(FCPATH . $defaultFolder . '/' . $folder, $mode, true);

            }

        }

    } 



    public function authToken($file_prefix) 

    {

        return $file_prefix.'_'.strtoupper(md5(base64_encode(rand())));

    }



    public function image_sizes($folder) 

    {

        $img_sizes = array();

        switch ($folder) {

            case 'admin':

                $img_sizes['thumbnail'] = array('width' => 50, 'height' => 50, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'categories':

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

            case 'brands':

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

            case 'Events':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'blogs':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'aboutus':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'members':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'homesliders':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;
            
            case 'flags':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;
            
            case 'adv':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;
            
            case 'homebanners':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

            case 'shop':

                $img_sizes['thumbnail'] = array('width' => 100, 'height' => 100, 'folder' => '/thumb');

                $img_sizes['medium'] = array('width' => 250, 'height' => 250, 'folder' => '/medium');

            break;

        }

        return $img_sizes;

    }

    

    function get_products_list()

    {

        $query = "SELECT `products`.`id` AS product_id,`products`.`name`,`products`.`ar_name`,`products`.`status`, `categories`.`name` as category_name FROM `products` JOIN `categories` ON `categories`.`id` = `products`.`category` ORDER BY `products`.`id` DESC";

        $qry = $this->db->query($query);

        return $qry->result();

    }

    

    function get_products_variation($proid)

    {

        $query = "SELECT `product_variations`.`id`,`product_variations`.`image`,`product_variations`.`sale_price`,`product_variations`.`status`,`sizes`.`name` as size_name FROM `product_variations` lEFT JOIN `sizes` ON `sizes`.`id` = `product_variations`.`size` WHERE `product_variations`.`product_id` = '$proid'";

        $qry = $this->db->query($query);

        return $qry->result();

    }

    

    function test_query($perpage,$start,$categories,$sizes,$colors,$price)

    {

        $qry = "SELECT `products`.*, `product_variations`.`id` as `variation_id`, `product_variations`.* FROM `products` 

        JOIN `product_variations` ON `product_variations`.`product_id` = `products`.`id` WHERE `products`.`status` = '1' 

        AND `product_variations`.`status` = '1' $categories $sizes $colors $price

        GROUP BY `product_variations`.`product_id` ORDER BY `product_variations`.`product_id` DESC LIMIT $start $perpage";

        $query = $this->db->query($qry);

        $data = $query->result();

        echo $this->db->last_query();die;

    }

    

    function count_filtered_products($discount_str,$ptype_str,$categories,$scategories,$sizes,$colors,$price,$genders,$uses_pro)

    {
        

        $qry = "SELECT `products`.*, `product_variations`.`id` as `variation_id`, `product_variations`.* FROM `products` 

        JOIN `product_variations` ON `product_variations`.`product_id` = `products`.`id` WHERE `products`.`status` = '1' 

        AND `product_variations`.`status` = '1' $discount_str $ptype_str $categories $scategories $sizes $colors $genders $uses_pro $price

        GROUP BY `product_variations`.`product_id` ORDER BY `product_variations`.`product_id`";

        $query = $this->db->query($qry);
        
        return $query->num_rows();
    

    }

    

    function get_filtered_products($perpage,$start,$categories,$scategories,$sizes,$colors,$price,$sort_by,$genders,$uses_pro,$ptype_str,$discount_str)
    {

        $qry = "SELECT `products`.*, `product_variations`.`id` as `variation_id`, `product_variations`.* FROM `products` 

        JOIN `product_variations` ON `product_variations`.`product_id` = `products`.`id` WHERE `products`.`status` = '1' 

        AND `product_variations`.`status` = '1' $discount_str $ptype_str $categories $scategories $sizes $colors $genders $uses_pro $price

        GROUP BY `product_variations`.`product_id` $sort_by LIMIT $start $perpage";

        $query = $this->db->query($qry);

        $data = $query->result();

        $output = '';

        $lang = $this->session->userdata('site_lang');

        $user_sess = $this->session->userdata('user_session');

        if(!empty($data))

        {
            foreach($data as $key=>$each_pro)

            {   

                

                $incart = check_product_incart($user_sess['user_id'],$user_sess['type'],$each_pro->product_id,$each_pro->variation_id);

                $inwish = check_product_inwish($user_sess['user_id'],$each_pro->product_id,$each_pro->variation_id);

                $output .= '<div class="col-6 col-sm-4 col-md-3">';

                $output .= '<div class="product-default inner-quickview inner-icon">';

                $output .= '<figure>';

                $output .= '<a href="'.base_url().'shop/'.$each_pro->titleUrl.'"><img src="'.base_url().'uploads/products/medium/'.$each_pro->image.'"></a>';

                $output .= '</figure>';
                
                $output .= '<div class="custom-product-details">';

                $output .= '<div class="product-details">';

                $output .= '<h3 class="product-title"><a href="'.base_url().'shop/'.$each_pro->titleUrl.'" title="'.(($lang=="english")?$each_pro->name:$each_pro->ar_name).'">'.(($lang=="english")?text_limit($each_pro->name,5):text_limit($each_pro->ar_name,5)).'</a></h3>';

                $output .= '<div class="price-box">';

                if($each_pro->mrp_price!='0.00')
                {
                    $output .= '<span class="old-price">'.number_format($each_pro->mrp_price,2).' KD</span>';
    
                    $output .= '<span class="product-price">'.number_format($each_pro->sale_price,2).' KD</span>';
                }else{
                    $output .= '<span class="product-price">'.number_format($each_pro->sale_price,2).' KD</span>';    
                }
                
                $output .= '</div>';

                $output .= '</div>';
                

                $output .= '<div class="btn-icon-group">';

                $output .= '<button class="btn-icon btn-add-cart '.(($incart==0)?'add-to-cart-custom':'').'" id="cart-btn'.$each_pro->product_id.$each_pro->variation_id.'" pid="'.$each_pro->product_id.'" varid="'.$each_pro->variation_id.'">'.(($incart==0)?$this->lang->line('Addtocart'):$this->lang->line('Incart')).'</button>';

                if($user_sess['type']=='user')

                {

                $output .= '<a href="javascript:void(0)" class="add-wishlist custom-add-wish '.(($inwish==1)?'in-wishlist':'').'" data-key="shop-wish-" id="shop-wish-'.$each_pro->product_id.$each_pro->variation_id.'" pid="'.$each_pro->product_id.'" varid="'.$each_pro->variation_id.'"></a>';

                }else{

                $output .= '<a href="javascript:void(0)" class="add-wishlist add-wish-logout-custom"></a>';    

                }

                $output .= '</div>';
                
                $output .= '</div>';

                $output .= '</div>';

                $output .= '</div>';    

            }

        }

        return $output;

    }
    
    function get_variations_sizes($product_id)

    {

        $this->db->distinct('size');

        $this->db->select('size');

        $this->db->from('product_variations');

        $this->db->where('product_variations.product_id', $product_id);

        $query = $this->db->get()->result();

        return $query;

    }

    

    function get_products_sizes($sizes)

    {

        $this->db->select('id,name,ar_name');

        $this->db->from('sizes');

        $this->db->where_in('sizes.id', $sizes);

        $query = $this->db->get()->result();

        return $query;

    }

    

    function get_related_products($productID, $category)

    {

        $this->db->select('products.*,product_variations.*,product_variations.id as variation_id');

        $this->db->from('products');

        $this->db->join('product_variations','product_variations.product_id = products.id');

        $this->db->where('products.id !=', $productID);

        $this->db->where('products.category', $category);

        $this->db->where('products.status', '1');

        $this->db->where('product_variations.status', '1');

        $this->db->group_by('product_variations.product_id');

        $this->db->order_by("product_variations.product_id", "DESC");

        $query = $this->db->get()->result();   

        return $query;

    }

    

    function get_random_products()
    {

        $this->db->select('products.*,product_variations.*,product_variations.id as variation_id');

        $this->db->from('products');

        $this->db->join('product_variations','product_variations.product_id = products.id');

        $this->db->where('products.status', '1');

        $this->db->where('product_variations.status', '1');

        $this->db->group_by('product_variations.product_id');

        $this->db->order_by("products.id", "random");

        $this->db->limit(5);

        $query = $this->db->get()->result();   

        return $query;

    }

    

    function get_cart_products($productID, $variationId)

    {

        $this->db->select('products.*,product_variations.id as variation_id,product_variations.*');

        $this->db->from('products');

        $this->db->join('product_variations','product_variations.product_id = products.id');

        $this->db->where('products.id', $productID);

        $this->db->where('product_variations.id', $variationId);

        $this->db->group_by('product_variations.product_id');

        $this->db->order_by("product_variations.product_id", "DESC");

        $query = $this->db->get()->row();

        return $query;

    }
    
    function products_name_filter($keyword)
    {
        $qry = "SELECT `products`.*, `product_variations`.`id` as `variation_id`, `product_variations`.* FROM `products` 
        JOIN `product_variations` ON `product_variations`.`product_id` = `products`.`id` WHERE `products`.`status` = '1' 
        AND `product_variations`.`status` = '1' $keyword
        GROUP BY `product_variations`.`product_id`";
        $query = $this->db->query($qry);
        $data = $query->result();
        return $data;
    }

    function get_brands($cats)
    {
        $qry = "SELECT * FROM `brands` WHERE $cats"; 
        $query = $this->db->query($qry);
        $data = $query->result();
        return $data; 
    }

    function get_products_by_types($type,$limittxt)
    {
        $query = "SELECT `products`.*, `product_variations`.`id` as `variation_id`, `product_variations`.* FROM `products` 
                JOIN `product_variations` ON `product_variations`.`product_id` = `products`.`id` WHERE `products`.`status` = '1' 
                AND `product_variations`.`status` = '1' AND FIND_IN_SET('$type',`products`.`product_type`) GROUP BY `product_variations`.`product_id` ORDER BY `product_variations`.`product_id` $limittxt";
        $qry = $this->db->query($query);
        $data = $qry->result();
        return $data;
        
    }
    
    function get_single_product2($id,$str)
    {
        $query = "SELECT `products`.*, `product_variations`.`id` as `variation_id`, `product_variations`.* FROM `products` 
                JOIN `product_variations` ON `product_variations`.`product_id` = `products`.`id` WHERE `products`.`id` = '$id' $str";
        $qry = $this->db->query($query);
        $data = $qry->row();
        return $data;
    }
    
    function get_variations_colors($product_id)
    {
        $this->db->select('DISTINCT(color), id');
        $this->db->group_by('color');
        $this->db->from('product_variations');
        $this->db->where('product_variations.product_id', $product_id);

        $query = $this->db->get()->result();
        return $query;
    }
    
    function get_shops_by_category($category)
    {
        $sql = "SELECT * FROM `shops` WHERE `status` = 1 AND FIND_IN_SET('$category',`categories`) ORDER BY `id` DESC";
        $qry = $this->db->query($sql);
        $data = $qry->result();
        return $data;
    }
    
    function get_shop_products($shop,$cat,$scat)
    {
        $query = "SELECT `products`.*, `product_variations`.`id` as `variation_id`, `product_variations`.* FROM `products` 
                JOIN `product_variations` ON `product_variations`.`product_id` = `products`.`id` WHERE `products`.`status` = '1' AND `products`.`shop` = '$shop' 
                AND `product_variations`.`status` = '1' $cat $scat GROUP BY `product_variations`.`product_id` ORDER BY `product_variations`.`product_id`";
        $qry = $this->db->query($query);
        $data = $qry->result();
        return $data;
    }
    function get_products_by_collection($cats,$limittxt)
    {
        $query = '';
        if(!empty($cats)){
            $query = "SELECT `products`.*, `product_variations`.`id` as `variation_id`, `product_variations`.* FROM `products` 
                JOIN `product_variations` ON `product_variations`.`product_id` = `products`.`id` WHERE `products`.`status` = '1' 
                AND `product_variations`.`status` = '1' AND FIND_IN_SET('$cats',`products`.`categories`) GROUP BY `product_variations`.`product_id` ORDER BY `product_variations`.`product_id` $limittxt";
        }else{
            $query = "SELECT `products`.*, `product_variations`.`id` as `variation_id`, `product_variations`.* FROM `products` 
                JOIN `product_variations` ON `product_variations`.`product_id` = `products`.`id` WHERE `products`.`status` = '1' 
                AND `product_variations`.`status` = '1' GROUP BY `product_variations`.`product_id` ORDER BY `product_variations`.`product_id` $limittxt";
        }
        
        $qry = $this->db->query($query);
        $data = $qry->result();
        return $data;
        
    }
    
    function get_product_data($id,$varstr)
    {
        $query = "SELECT `products`.*, `product_variations`.`id` as `variation_id`, `product_variations`.* FROM `products` 
                JOIN `product_variations` ON `product_variations`.`product_id` = `products`.`id` WHERE `products`.`status` = '1' 
                AND `product_variations`.`status` = '1' AND `products`.`id` = '$id' $varstr GROUP BY `product_variations`.`product_id` ORDER BY `product_variations`.`product_id`";
        $qry = $this->db->query($query);
        $data = $qry->row();
        return $data;
        
    }
    function get_search_products($keyword)
    {
        $this->db->select('products.*,product_variations.*,product_variations.id as variation_id');
        $this->db->from('products');
        $this->db->join('product_variations','product_variations.product_id = products.id');
        $this->db->where('products.status', '1');
        $this->db->where('product_variations.status', '1');
        $this->db->like('products.name', $keyword);
        $this->db->group_by('product_variations.product_id');
        $query = $this->db->get()->result();   

        return $query;

    }

    



/*Main Class Ended*/    

}
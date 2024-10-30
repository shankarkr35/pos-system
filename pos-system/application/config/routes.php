<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['404_override'] = 'MY404';
$route['translate_uri_dashes'] = FALSE;
$route['switch-language'] = 'LanguageSwitcher/switchLang';
$route['delete-user-account'] = 'Home/delete_user_account';

/*Admin Section*/
$route['admin-login'] = 'admin/Adminlogin/index';
$route['admin-sign-signout'] = 'admin/Adminlogin/logout';
$route['admin-login-auth'] = 'admin/Adminlogin/admin_login_check';
$route['admin-dashboard'] = 'admin/admin/index';

/*Categoreis*/
$route['categories-list'] = 'admin/admin/categories';
$route['add-new-category'] = 'admin/admin/addCategories';
$route['create-new-category'] = 'admin/admin/createCategories';
$route['edit-category/(:any)'] = 'admin/admin/editCategories/$1';
$route['update-category'] = 'admin/admin/updateCategories';

/*Delete & Status*/
$route['delete-record-from'] = 'admin/admin/deleteFromany';
$route['status-management'] = 'admin/admin/status_mange';

/*Sub Categories*/
$route['sub-categories-list'] = 'admin/admin/subcategories';
$route['add-new-sub-category'] = 'admin/admin/addsubCategories';
$route['create-new-sub-category'] = 'admin/admin/createsubCategories';
$route['edit-sub-category/(:any)'] = 'admin/admin/editsubCategories/$1';
$route['update-sub-category'] = 'admin/admin/updatesubCategories';

/*Size*/
$route['sizes-list'] = 'admin/admin/sizesList';
$route['edit-size/(:any)'] = 'admin/admin/editSize/$1';
$route['add-new-size'] = 'admin/admin/addSize';
$route['create-new-size'] = 'admin/admin/createNewSize';
$route['update-size'] = 'admin/admin/updateSize';


/*Measurement*/
$route['unit-list'] = 'admin/admin/measurementList';
$route['edit-unit/(:any)'] = 'admin/admin/editMeasurement/$1';
$route['add-new-unit'] = 'admin/admin/addMeasurement';
$route['create-new-unit'] = 'admin/admin/createNewMeasurement';
$route['update-unit'] = 'admin/admin/updateMeasurement';

/*Products*/
$route['products-management'] = 'admin/admin/productsList';
$route['edit-product/(:any)'] = 'admin/admin/editProduct/$1';
$route['add-new-product'] = 'admin/admin/addProduct';
$route['create-new-product'] = 'admin/admin/createProduct';
$route['update-product'] = 'admin/admin/updateProduct';
$route['product-comments/(:any)'] = 'admin/admin/product_comments/$1';

/*Products Variations*/
$route['product-variations/(:any)'] = 'admin/admin/productsVariationsList/$1';
$route['edit-product-variation/(:any)'] = 'admin/admin/editProductVariation/$1';
$route['add-new-product-variation/(:any)'] = 'admin/admin/addProductVariation/$1';
$route['create-new-product-variation'] = 'admin/admin/createProductVariation';
$route['update-product-variation'] = 'admin/admin/updateProductVariation';

/*Customers*/
$route['customers-list'] = 'admin/admin/customersList';
$route['add-new-customer'] = 'admin/admin/add_new_customer';
$route['create-new-customer'] = 'admin/admin/create_new_customer';
$route['update-customer'] = 'admin/admin/update_customer_details';
$route['edit-customer/(:any)'] = 'admin/admin/edit_customer/$1';

/*Area Management*/
$route['area-list'] = 'admin/admin/area_management';
$route['add-new-area'] = 'admin/admin/add_new_area';
$route['create-new-area'] = 'admin/admin/create_new_area';
$route['upadte-area-details'] = 'admin/admin/update_area_details';
$route['edit-area/(:any)'] = 'admin/admin/edit_area/$1';

/*Coupon Management*/
$route['coupons-list'] = 'admin/admin/coupons_list';
$route['add-new-coupon'] = 'admin/admin/add_new_coupon';
$route['create-new-coupon'] = 'admin/admin/create_new_coupon';
$route['upadte-coupon-details'] = 'admin/admin/update_coupon_details';
$route['edit-coupon/(:any)'] = 'admin/admin/edit_coupon/$1';

/*Orders Management*/
$route['orders-list'] = 'admin/admin/orders_list';
$route['order-details/(:any)'] = 'admin/admin/order_details/$1';
$route['order-invoice/(:any)'] = 'admin/admin/invoice/$1';
$route['order-invoiceprint/(:any)'] = 'admin/admin/invoiceprint/$1';


/*Raw Material*/
$route['raw-management'] = 'admin/admin/rawList';
$route['edit-raw/(:any)'] = 'admin/admin/editRaw/$1';
$route['add-new-raw'] = 'admin/admin/addRaw';
$route['create-new-raw'] = 'admin/admin/createNewRaw';
$route['update-raw'] = 'admin/admin/updateRaw';

$route['check-quantity'] = 'admin/admin/check_raw_quantity';

/*--------Route POS -  -----*/
$route['pos-system'] = 'admin/admin/pos_system';
$route['pos'] = 'admin/admin/productsCollection';
$route['quick-view'] = 'admin/admin/quick_view';
$route['add-to-cart'] = 'admin/admin/addtocart';
$route['cart-items'] = 'admin/admin/cartitems';
$route['remove-from-cart'] = 'admin/admin/removefromcart';
$route['empty-cart'] = 'admin/admin/removeAllCart';
$route['placeorder'] = 'admin/admin/placeorder';
$route['store-keys'] = 'admin/admin/store_keys';
$route['update-discount'] = 'admin/admin/update_discount';
$route['order-success/(:any)'] = 'admin/admin/order_invoince/$1';
























<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->
    <title>POS </title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo base_url('assets/pos/css/vendor.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/pos/css/style.css') ?>">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="<?php echo base_url('assets/pos/css/theme.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/pos/admin/vendor/icon-set/style.css');?>">
    
    <style>
        .scroll-bar {
            max-height: calc(100vh - 100px);
            overflow-y: auto !important;
        }

        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 1px #cfcfcf;
            /*border-radius: 5px;*/
        }

        ::-webkit-scrollbar {
            width: 3px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            /*border-radius: 5px;*/
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #FC6A57;
        }
        .deco-none {
            color: inherit;
            text-decoration: inherit;
        }
        .qcont{
            text-transform: lowercase;
        }
        .qcont:first-letter {
            text-transform: capitalize;
        }
        .navbar-vertical .nav-link {
            color: #ffffff;
        }

        .navbar .nav-link:hover {
            color: #C6FFC1;
        }

        .navbar .active > .nav-link, .navbar .nav-link.active, .navbar .nav-link.show, .navbar .show > .nav-link {
            color: #C6FFC1;
        }

        .navbar-vertical .active .nav-indicator-icon, .navbar-vertical .nav-link:hover .nav-indicator-icon, .navbar-vertical .show > .nav-link > .nav-indicator-icon {
            color: #C6FFC1;
        }

        .nav-subtitle {
            display: block;
            color: #fffbdf91;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .03125rem;
        }

        .navbar-vertical .navbar-nav.nav-tabs .active .nav-link, .navbar-vertical .navbar-nav.nav-tabs .active.nav-link {
            border-left-color: #C6FFC1;
        }
        .item-box{
            height:250px;
            width:150px;
            padding:3px;
        }

        .header-item{
            width:10rem;
        }
        a.navbar-brand img {
            width: 62px;
        }
    </style>

    <script src="<?php echo base_url('assets/pos/admin/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js');?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/pos/admin/css/toastr.css');?>">
</head>

<body class="footer-offset">


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="loading" style="display: none;">
                <div style="position: fixed;z-index: 9999; left: 40%;top: 37% ;width: 100%">
                    <img width="200" src="<?php echo base_url('assets/pos/admin/img/loader.gif');?>">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS Preview mode only -->
    <header id="header"
            class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-flush navbar-container navbar-bordered">
        <div class="navbar-nav-wrap">
            <div class="navbar-brand-wrapper">
                <!-- Logo Div-->
                <a class="navbar-brand" href="<?php echo base_url('admin-dashboard')?>" aria-label="Front" style="padding-top: 0!important;padding-bottom: 0!important;">
                         <!--               <img class="navbar-brand-logo"-->
                         <!--style="border-radius: 50%;height: 55px;width: 55px!important; border: 5px solid #80808012"-->
                         <!--onerror="this.src='<?php echo base_url('assets/admin/')?>dist/img/user2-160x160.jpg'"-->
                         <!--src="<?php echo base_url('assets/admin/')?>images/logo1.png"-->
                         <!--alt="Logo">-->
                         <img src="https://wxites.com/pos-system/assets/admin/images/logoav.png">
                </a>
                
            </div>
            <?php if($this->session->flashdata('ordersuccess1')){?>
                <div class="alert alert-success mb-4" role="alert"> <i class="flaticon-cancel-12 close" data-dismiss="alert"></i> <strong>Success!</strong> <?php  echo $this->session->flashdata('msg');?>  </div>
            <?php } ?>

            <!-- Secondary Content -->
            <div class="navbar-nav-wrap-content-right">
                <!-- Navbar -->
                <ul class="navbar-nav align-items-center flex-row">
                    <li class="nav-item d-none d-sm-inline-block">
                        <!-- Notification -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                               href="#">
                                <i class="tio-shopping-cart-outlined"></i>
                                
                            </a>
                        </div>
                        <!-- End Notification -->
                    </li>

                    <li class="nav-item">
                        <!-- Account -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker navbar-dropdown-account-wrapper" href="javascript:;"
                               data-hs-unfold-options='{
                                     "target": "#accountNavbarDropdown",
                                     "type": "css-animation"
                                   }'>
                                <div class="avatar avatar-sm avatar-circle">
                                    <img class="avatar-img"
                                         onerror="this.src='<?php echo base_url('assets/admin/')?>dist/img/user2-160x160.jpg'"
                                         src="<?php echo base_url('assets/admin/')?>dist/img/user2-160x160.jpg"
                                         alt="Image">
                                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                                </div>
                            </a>

                            <div id="accountNavbarDropdown"
                                 class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account"
                                 style="width: 16rem;">
                                <div class="dropdown-item-text">
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-sm avatar-circle mr-2">
                                            <img class="avatar-img"
                                                 onerror="this.src='<?php echo base_url('assets/admin/')?>dist/img/user2-160x160.jpg'"
                                                 src="<?php echo base_url('assets/admin/')?>dist/img/user2-160x160.jpg"
                                                 alt="Owner image">
                                        </div>
                                        <div class="media-body">
                                            <span class="card-title h5"></span>
                                            <span class="card-text">admin@gmail.com</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="javascript:" onclick="Swal.fire({
                                    title: 'Do you want to logout?',
                                    showDenyButton: true,
                                    showCancelButton: true,
                                    confirmButtonColor: '#FC6A57',
                                    cancelButtonColor: '#363636',
                                    confirmButtonText: 'Yes',
                                    denyButtonText: `Do not Logout`,
                                    }).then((result) => {
                                    if (result.value) {
                                    location.href='<?php echo base_url('admin-sign-signout')?>';
                                    } else{
                                    Swal.fire('Canceled', '', 'info')
                                    }
                                    })">
                                    <span class="text-truncate pr-2" title="Sign out">Sign out</span>
                                </a>
                            </div>
                        </div>
                        <!-- End Account -->
                    </li>
                </ul>
                <!-- End Navbar -->
            </div>
            <!-- End Secondary Content -->
        </div>
    </header>
<!-- END ONLY DEV -->

<main id="content" role="main" class="main pointer-event">
<!-- Content -->
	<!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-content padding-y-sm bg-default mt-1">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 card padding-y-sm card ">
                    <div class="card-header d-flex flex-wrap justify-content-between ">
                        <div class="col-lg-6">
                            <form id="search-form" class="header-item w-100 w-lg-50 mb-2 mb-lg-0">
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input id="datatableSearch" type="search" value="" name="search" class="form-control" placeholder="Search here" aria-label="Search here">
                                </div>
                                <!-- End Search -->
                            </form>
                        </div>
                        <div class="input-group header-item col-lg-6 w-100 w-lg-50" style="width: auto">
                            <select name="category" id="category" class="form-control js-select2-custom mx-1" title="select category" onchange="set_category_filter(this.value)">
                                <option value="">All Category</option>
                                <?php foreach($categories as $key=>$cat){ ?>
                                    <option value="<?php echo $cat->id; ?>"><?php echo $cat->name; ?></option>
                                <?php } ?>
                                
                            </select>
                        </div>

                    </div>
					<div class="card-body itemList" id="items">
                        <div class="d-flex flex-wrap mt-2 mb-3" style="justify-content: space-around;">
                            <?php foreach($products as $key=>$product){ $data['product'] = $product;  ?>
                                <div class="item-box">
                                        <?php $this->load->view('ADMIN/pos/single_product',$data) ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-12" style="overflow-x: scroll;">
                                <!--{!!$products->withQueryString()->links()!!}-->
                            </div>
                        </div>
                    </div>
				</div>
				<?php $customer_id = ''; if($this->session->userdata('cust_id_session')){$cust_id_session = $this->session->userdata('cust_id_session'); $customer_id = $cust_id_session['customer_id']; } ?>
				<div class="col-md-4 mt-4 px-0">
                    <div class="card">
                        <div class="row m-0 p-2">
                            <div class="col-12 p-1">
                                <select onchange="store_key('customer_id',this.value)" id='customer' name="customer_id" data-placeholder="Walk In Customer" class="js-data-example-ajax1 form-control">
                                   <option selected value="">Select Customer</option>
                                   <?php if(!empty($users)){ foreach($users as $user){ ?>
                                   <option <?php echo (($user->id==$customer_id)?'selected':'')?> value="<?php echo $user->id ?>"><?php echo $user->customer_name .' ('. $user->mobile_number .')' ?></option>
                                   <?php }} ?>
                                </select>
                                <!-- <button class="btn btn-sm btn-white btn-outline-primary ml-1" type="button" title="Add Customer">
                                    <i class="tio-add-circle text-dark"></i>
                                </button> -->
                            </div>
                        </div>
                        <div class='w-100' id="cart">
                            <div class="d-flex flex-row" style="max-height: 300px; overflow-y: scroll;">
                                <table class="table table-bordered">
                                    <thead class="text-muted">
                                        <tr>
                                            <th scope="col">Item</th>
                                            <th scope="col" class="text-center">Qty</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                            <div class="box p-3">
                                <dl class="row text-sm-right">
                        
                                    <dt  class="col-sm-6">Sub total : </dt>
                                    <dd class="col-sm-6 text-right">00.00$</dd>
                        
                                    <dt  class="col-sm-6">Extra Discount :</dt>
                                    <dd class="col-sm-6 text-right"><button class="btn btn-sm" type="button" data-toggle="modal" data-target="#add-discount"><i class="tio-edit"></i></button>- 0.00$</dd>
                        
                                    <dt  class="col-sm-6">Total : </dt>
                                    <dd class="col-sm-6 text-right h4 b">00.00$</dd>
                                </dl>
                                <div class="row">
                                    <div class="col-md-6 pb-1 pb-md-0">
                                        <a href="#" class="btn btn-danger btn-sm btn-block" onclick="emptyCart()"><i
                                                class="fa fa-times-circle "></i> Cancel </a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn  btn-success btn-sm btn-block" data-toggle="modal" data-target="#paymentModal"><i class="fa fa-shopping-bag"></i>
                                            Order</button>
                                    </div>
                                </div>
                            </div>
                           <!--<//?php $this->load->view('ADMIN/pos/cart') ?>-->
                        </div>
                    </div>
				</div>
			</div>
		</div><!-- container //  -->
	</section>

    <!-- End Content -->
    <div class="modal fade" id="quick-view" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="quick-view-modal">

            </div>
        </div>
    </div>
   <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <!--<div class="modal fade" id="successOrder" tabindex="-1">-->
    <!--    <div class="modal-dialog">-->
    <!--        <div class="modal-content">-->
    <!--            <div class="modal-header">-->
    <!--                <h5 class="modal-title">Invoice</h5>-->
    <!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
    <!--                <span aria-hidden="true">&times;</span>-->
    <!--                </button>-->
    <!--            </div>-->
    <!--            <div class="modal-body">-->
                    
    <!--                <form method="post" class="row">-->
                        
    <!--                    <div class="form-group col-12">-->
    <!--                        <label class="input-label" for="">Type</label>-->
    <!--                        <select id="type" name="type" class="form-control">-->
    <!--                            <option value="cash">Cash</option>-->
    <!--                            <option value="card">Card</option>-->
    <!--                        </select>-->
    <!--                        <span class="text-danger font-weight-bold" id="type-err"></span>-->
    <!--                    </div>-->
    <!--                    <div class="form-group col-12">-->
    <!--                        <button class="btn btn-sm btn-primary" type="submit" id="confirm-order-user-direct">Submit</button>-->
    <!--                    </div>-->
    <!--                </form>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
   

</main>
<!-- ========== END MAIN CONTENT ========== -->

<!-- ========== END SECONDARY CONTENTS ========== -->

<!-- JS Implementing Plugins -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<!-- JS Front -->
<script src="<?php echo base_url('assets/pos/js/vendor.min.js') ?>"></script>
<script src="<?php echo base_url('assets/pos/js/theme.min.js') ?>"></script>
<script src="<?php echo base_url('assets/pos/js/sweet_alert.js') ?>"></script>
<script src="<?php echo base_url('assets/pos/js/toaster.js') ?>"></script>
<script type="text/javascript"></script>

<script>
    $(document).ready(function(){
        $(document).on('click','#confirm-order-user-direct',function(){
            var baseUrl = '<?php echo base_url(); ?>';
            var amount = $('#amount').val();
            var user_id = $('#user_id').val();
            var discount = $('#discount').val();
            var type = $('#type').val();
            alert('okay');
            if(amount=="")
            {
                $('#amount').addClass('is-invalid');
                $('#amount-err').text('Amount is Mandatory');
            }else{
                $('#amount').removeClass('is-invalid');
                $('#amount-err').text('');
            }
            if(type=="")
            {
                $('#type').addClass('is-invalid');
                $('#type-err').text('Please Select Payment Mode.*');
            }else{
                $('#type').removeClass('is-invalid');
                $('#type-err').text('');
            }
	        if(amount !='' && type !='' && discount!=''){
    			var fd = new FormData();
    			
    			fd.append('amount',amount);
    			fd.append('user_id',user_id);
    			fd.append('type',type);
    			fd.append('discount',discount);
    			$.ajax({
    				url:"<?php echo base_url('admin/Admin/placeorder')?>",
    				type: "POST",
    				data: fd,
    				contentType: false,
    				processData: false,
    				dataType: "JSON",
    				
    				success: function(jsonStr,status) 
    				{      
    					var res_data = JSON.stringify(jsonStr);
    					var response = JSON.parse(res_data);
    					var res_msg = response['response'];
    					var paymethod = response['paymethod'];
    					var responseOUID = response['booking_id'];
    					console.log(res_msg);
    					if(res_msg=='success' && paymethod=='cash'){
    					    //$('#successOrder').modal('show');
    						toastr.success('Order placed Successfully!', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                            window.location.href = baseUrl+'order-success/'+responseOUID;
    					}
    					
    				},
    				complete:function(data){
    					
    				}
            	});  
    		}else{
    		    
                sessionStorage.setItem('loginfirst',true);
                window.location.href = baseUrl+'user-login';
    		}
        })
    })
</script>

<script>
    $(document).on('ready', function () {
        // INITIALIZATION OF UNFOLD
        // =======================================================
        $('.js-hs-unfold-invoker').each(function () {
            var unfold = new HSUnfold($(this)).init();
        });
    });
</script>
<!-- JS Plugins Init. -->
<script>
    $(document).on('ready', function () {
     });
    updateCart();
    var baseUrl = '<?php echo base_url(); ?>';
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }

    function set_category_filter(category_id) {
        $.ajax({
            url: baseUrl + "admin/admin/product_filter",
            type: 'POST',
            data: {
                category_id: category_id,
            },
            dataType: 'json', // added data type
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                console.log("success...");
                $('.itemList').empty().html(data);
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    }

    $('#search-form').on('submit', function (e) {
        e.preventDefault();
        var keyword= $('#datatableSearch').val();
        
        $.ajax({
            url: baseUrl + "admin/admin/product_filter",
            type: 'POST',
            data: {
                keyword: keyword,
            },
            dataType: 'json', // added data type
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                console.log("success...");
                $('.itemList').empty().html(data);
            },
            complete: function () {
                $('#loading').hide();
            },
        });
    });

    function addon_quantity_input_toggle(e)
    {
        var cb = $(e.target);
        if(cb.is(":checked"))
        {
            cb.siblings('.addon-quantity-input').css({'visibility':'visible'});
        }
        else
        {
            cb.siblings('.addon-quantity-input').css({'visibility':'hidden'});
        }
    }
    function quickView(product_id,variation_id) {
        $.ajax({
            url: baseUrl + "quick-view",
            type: 'POST',
            data: {
                product_id: product_id,
                variation_id: variation_id
            },
            dataType: 'json', // added data type
            beforeSend: function () {
                $('#loading').show();
            },
            success: function (data) {
                console.log("success...");
                $('#quick-view').modal('show');
                $('#quick-view-modal').empty().html(data);
            },
            complete: function () {
                $('#loading').hide();
            },
        });
   
    }

    function checkAddToCartValidity() {
        var names = {};
        $('#add-to-cart-form input:radio').each(function () { // find unique names
            names[$(this).attr('name')] = true;
        });
        var count = 0;
        $.each(names, function () { // then count them
            count++;
        });
        if ($('input:radio:checked').length == count) {
            return true;
        }
        return false;
    }

    function cartQuantityInitialize() {
        $('.btn-number').click(function (e) {
            e.preventDefault();

            var fieldName = $(this).attr('data-field');
            var type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());

            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });

        $('.input-number').focusin(function () {
            $(this).data('oldValue', $(this).val());
        });

        $('.input-number').change(function () {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            var name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                Swal.fire({
                    icon: 'error',
                    title:'Cart',
                    text: 'Sorry  the minimum value was reached'
                });
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                Swal.fire({
                    icon: 'error',
                    title:'Cart',
                    confirmButtonText:'Ok',
                    text: 'Sorry  stock limit exceeded.'
                });
                $(this).val($(this).data('oldValue'));
            }
        });
        $(".input-number").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }

    function getVariantPrice() {
        if ($('#add-to-cart-form input[name=quantity]').val() > 0 && checkAddToCartValidity()) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: baseUrl + "admin/admin/variant_price",
                data: $('#add-to-cart-form').serializeArray(),
                success: function (data) {
                    $('#add-to-cart-form #chosen_price_div').removeClass('d-none');
                    $('#add-to-cart-form #chosen_price_div #chosen_price').html(data);
                }
            });
        }
    }

    function addToCart(form_id = 'add-to-cart-form') {
        if (checkAddToCartValidity()) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
                url: baseUrl + "add-to-cart",
                //url: 'https://webrestaurant.betadevteam.com/restaurant/admin/pos/add-to-cart',
                data: $('#' + form_id).serializeArray(),
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    console.log(data)
                    if (data == 1) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Cart',
                            confirmButtonText:'Ok',
                            text: "Product already added in cart"
                        });
                        return false;
                    } else if (data == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Cart',
                            confirmButtonText:'Ok',
                            text: 'Sorry  product out of stock.'
                        });
                        return false;
                    }
                    // else if (data == "added") {
                        $('.call-when-done').click();
                        toastr.success('Item has been added in your cart!', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    //}
                    

                    updateCart();
                },
                complete: function () {
                    $('#loading').hide();
                }
            });
        } else {
            Swal.fire({
                type: 'info',
                title: 'Cart',
                confirmButtonText:'Ok',
                text: 'Please choose all the options'
            });
        }
    }
    function removeFromCart(cart_id) {
        $.ajax({
            url: '<?php echo base_url('remove-from-cart'); ?>',
            type: 'POST',
            data: {
                action: "cart",
                cart_id: cart_id
            },
            dataType: 'json', // added data type
            success: function (data) {
                console.log(data.responseData);
                if(data.responseData ==1){
                    toastr.info('Item has been removed from cart', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    window.location.reload();
                }else{
                    toastr.info('Item has not been removed from cart', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    window.location.reload();
                }
                 updateCart();
                
            },
        });
    }


    function emptyCart() {
        $.ajax({
            url: '<?php echo base_url('empty-cart'); ?>',
            type: 'POST',
            data: {
                action: "cart",
            },
            dataType: 'json', // added data type
            success: function (data) {
                console.log(data.responseData);
                if(data.responseData ==1){
                    toastr.info('Item has been removed from cart', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    window.location.reload();
                }else{
                    toastr.info('Item has not been removed from cart', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    window.location.reload();
                }
                updateCart();
                
            },
        });
    }

    // function emptyCart() {
    //     $.post('<//?php echo base_url('empty-cart'); ?>', {_token: 'WvbGPy3nJv2obFJJSBXlMWqhhPTXNDaO4DTv8hd5'}, function (data) {
    //         updateCart();
    //         toastr.info('Item has been removed from cart', {
    //             CloseButton: true,
    //             ProgressBar: true
    //         });
    //     });
    // }

    function updateCart() {
        $.ajax({
            url: '<?php echo base_url('cart-items'); ?>',
            type: 'POST',
            data: {
                action: "cart"
            },
            dataType: 'json', // added data type
            success: function (data) {
                console.log("success...");
                $('#cart').empty().html(data);;
            },
        });
    }

   $(function(){
        $(document).on('click','input[type=number]',function(){ this.select(); });
    });


    function updateQuantity(e){
        var element = $( e.target );
        var minValue = parseInt(element.attr('min'));
        // maxValue = parseInt(element.attr('max'));
        var valueCurrent = parseInt(element.val());

        var key = element.data('key');
        if (valueCurrent >= minValue) {
            $.post('https://webrestaurant.betadevteam.com/restaurant/admin/pos/update-quantity', {_token: 'WvbGPy3nJv2obFJJSBXlMWqhhPTXNDaO4DTv8hd5', key: key, quantity:valueCurrent}, function (data) {
                updateCart();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Cart',
                confirmButtonText:'Ok',
                text: 'Sorry  the minimum value was reached'
            });
            element.val(element.data('oldValue'));
        }
        
        // Allow: backspace, delete, tab, escape, enter and .
        if(e.type == 'keydown')
        {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        }

    };



    // INITIALIZATION OF SELECT2
    // =======================================================
    $('.js-select2-custom').each(function () {
        var select2 = $.HSCore.components.HSSelect2.init($(this));
    });

    $('.branch-data-selector').select2();
    $('.js-data-example-ajax1').select2();


    $('.js-data-example-ajax').select2({
        ajax: {
            url: 'https://webrestaurant.betadevteam.com/restaurant/admin/pos/customers',
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data) {
                return {
                results: data
                };
            },
            __port: function (params, success, failure) {
                var $request = $.ajax(params);

                $request.then(success);
                $request.fail(failure);

                return $request;
            }
        }
    });


    $('#order_place').submit(function(eventObj) {
        alert('okay')
        if($('#customer').val())
        {
            $(this).append('<input type="hidden" name="user_id" value="'+$('#customer').val()+'" /> ');
        }
        return true;
    });

    function store_key(key, value) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "WvbGPy3nJv2obFJJSBXlMWqhhPTXNDaO4DTv8hd5"
            }
        });
        $.post({
            url: '<?php echo base_url('store-keys'); ?>',
            data: {
                key:key,
                value:value,
            },
            success: function (data) {
                toastr.success(key+' '+'Selected!', {
                    CloseButton: true,
                    ProgressBar: true
                });
                window.location.reload();
            },
        });
    }

</script>
<script type="text/javascript">
<?php if($this->session->flashdata('ordersucces')){ ?>
    toastr.success("<?php echo $this->session->flashdata('ordersuccess'); ?>");
<?php }else if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
<?php }else if($this->session->flashdata('warning')){  ?>
    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
<?php }else if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
<?php } ?>


</script>
<!-- IE Support -->
<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="https://webrestaurant.betadevteam.com/restaurant/public/assets/admin/vendor/babel-polyfill/polyfill.min.js"><\/script>');
</script>
</body>
</html>


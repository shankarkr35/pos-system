
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
        
        
         table {
            width: 50%;
            margin: auto;
            color: black;
            border: 2px solid black;
        }
        
        
        
        <style>
        table {
            width: 450px;
            margin: auto;
        }
        tr.Pragya_Saree.sareee th {
            font-size: 20px;
        }
        tr.saree th {
            font-weight: 600;
        }
        .SALES th {
            font-weight: 700;
        }
        tr.Pragya_Saree.branc th {
            font-size: 18px;
        }
         td{
            text-align: center;
        }
        tr.pragye td {
            border: none;
            border-left: 1px solid;
        }
        .saree th {
            text-align: left;
        }
        .saree td {
            text-align: left;
        }
        th.Grand {
            border-bottom: none;
            border-top: none;
        }
        th.Signature {
            border-bottom: none;
            padding-top: 30px;
            text-align: center;
        }
        
        th.Signature span {
            border-bottom: none;
            border-top: 1px solid black;
            padding-top: 5px;
        }
        
        .SALES{
            background: #ffc107;
            text-align: center;
            font-size: 15px;
            font-weight: 700;
        }
        .print_button button {
            border: none;
            background: orange;
            padding: 10px;
            margin: 10px;
            width: 150px;
            font-size: 15px;
            font-weight: 600;
        }
        .print_button button a{
            color:black;
        }
          .print_button_print {
            text-align: center;
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }
        tr.Pragya_Saree {
            background: #f1bb8dc7;
            text-align: center;
        }
        tr.Pragya_Saree th {
            font-weight: 700;
        }
        th.sar {
            text-align: left;
        }
        a.navbar-brand h2 {
            font-size: 18px;
            font-family: initial;
        }
    </style>
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
                         
                         <!--<img src="<?php echo base_url('assets/admin/images/logo-pragya.png');?>">-->
                         <h2>Pragya Saree</h2>
                </a>
                
            </div>
            

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
			    <table cellspacing=0 cellpadding=5 border="1"> 
                    <tr class="Pragya_Saree sareee"><th  colspan=8>Pragya Saree</th></tr>
                    <tr class="Pragya_Saree"><th  colspan=8>Pandit Deendayal Chouraha Near Bus Stand Sarangpur</th></tr>
                    <tr class="Pragya_Saree branc" ><th  colspan=8>A Pragya Garment Branch (989328188)</th></tr>
                    <th  colspan=8 class="SALES">SALES INVOICE</th>
                    <tr class="saree">
                        <th  colspan=2>Email No.</th>
                        <th  colspan=2>ES1002</th>
                        <th  colspan=2>Date</th>
                        <th  colspan=2>02/03/2023</th>
                    </tr>
                    <tr class="saree">
                        <th colspan=4>Customer Name:</th>  
                        
                        <th colspan=4>RADHESHYAM JI PATIDAR</th>          
                    </tr class="saree">
                    <tr class="saree">
                        <th colspan=4>Address:</th>
                        <td colspan=6>BADLIPURA SARNGPUR</td>          
                    </tr>
                    <tr class="saree">
                        <th  colspan=2>Contact:</th>
                        <th  colspan=2></th>
                        <th  colspan=2>GSTIN:</th>
                        <td colspan=2>23BIZP R6777BZZl</td>
                    </tr>
                    <tr class="SALES">
                        <th colspan=2>S.no</th>
                        <th colspan=2>Particulars</th>
                        <th colspan=2>Rate</th>
                        <th colspan=1>Qua ntity</th>
                        <th colspan=1>Amount</th>
                    </tr>
                    <tr class="pragye">
                        <td colspan=2>1</td>
                        <td colspan=2>Dhoom</td>
                        <td colspan=2>380</td>
                        <td>1</td>
                        <td >380</td>
                    </tr>
                    <tr  class="pragye">
                        <td colspan=2>2</td>
                        <td colspan=2></td>
                        <td colspan=2></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr  class="pragye">
                        <td colspan=2>3</td>
                        <td colspan=2>Karishma</td>
                        <td colspan=2>440</td>
                        <td>4</td>
                        <td >1760</td>
                    </tr>
                    <tr  class="pragye">
                        <td colspan=2>4</td>
                        <td colspan=2></td>
                        <td colspan=2></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr  class="pragye">
                        <td colspan=2>5</td>
                        <td colspan=2>jalpari</td>
                        <td colspan=2>425</td>
                        <td>2</td>
                        <td >850</td>
                    </tr>
                    <tr  class="pragye">
                        <td colspan=2>6</td>
                        <td colspan=2></td>
                        <td colspan=2></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr  class="pragye">
                        <td colspan=2>7</td>
                        <td colspan=2></td>
                        <td colspan=2></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr  class="pragye">
                        <td colspan=2>8</td>
                        <td colspan=2></td>
                        <td colspan=2></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr  class="pragye">
                        <td colspan=2>9</td>
                        <td colspan=2></td>
                        <td colspan=2></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="pragye">
                        <td colspan=2>10</td>
                        <td colspan=2>Karina</td>
                        <td colspan=2>890</td>
                        <td>2</td>
                        <td>780</td>
                    </tr>
                    <tr>
                        <th colspan=4 class="Signature">
                           <span> Authorizrd Signature</span>
                        </th>
                        <th  colspan=3 class="sar">Total Amount</th>
                        <td>3770</td>
                        
                        <tr>
                            <th colspan=4 class="Grand"></th>
                            <th  colspan=3 class=" sar">GST 5%</th>
                            <td>188.5</td>
                        </tr>
                        <th colspan=4 class="Grand"></th>
                        <th  class="SALES sar" colspan=3>Grand Total</th>
                        <td class="SALES">3958.5</td>
                    </tr>
                </table>
			    
			    
			</div>
			<div class="print_button_print">
			        <div class="print_button">
			            <button><a href="#">Download</a></button>
			        </div>
			        <div class="print_button">
			            <button><a href="#">Print</a></button>
			           
			        </div>
			    </div>
		</div>
	</section>
</main>
<!-- ========== END MAIN CONTENT ========== -->

<!-- ========== END SECONDARY CONTENTS ========== -->
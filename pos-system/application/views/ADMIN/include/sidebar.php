<?php
$url = $this->uri->segment(1);
$admin_session = $this->session->userdata('admin_session');
$admin_type = $admin_session['admin_type'];
$admin_id = $admin_session['admin_id'];
$admin_name = $admin_session['admin_name'];

?>

<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url('assets/admin/')?>images/logoav.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('assets/admin/')?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $admin_name; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo base_url('admin-dashboard')?>" class="nav-link <?php echo (($url=="admin-dashboard")?'active':'')?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
         <?php if($admin_type == 2 || $admin_type == 1){   ?>
          <li class="nav-item">
            <a href="" class="nav-link <?php echo (($url=="pos"||$url=="pos-orders")?'active':'')?>">
              <i class="fas fa-photo-video nav-icon"></i>
              <p>
                POS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('pos')?>" class="nav-link <?php echo (($url=="pos")?'active':'')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>POS System</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('orders-list')?>" class="nav-link <?php echo (($url=="orders-list")?'active':'')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <?php if($admin_type != 2 && $admin_type == 1){   ?>
          <li class="nav-item">
            <a href="" class="nav-link <?php echo (($url=="edit-brand"||$url=="add-new-brand"||$url=="brands-list"||$url=="edit-sub-category"||$url=="add-new-sub-category"||$url=="sub-categories-list"||$url=="categories-list"||$url=="add-new-category"||$url=="edit-category")?'active':'')?>">
              <i class="fas fa-code-branch nav-icon"></i>
              <p>
                Categories
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('categories-list')?>" class="nav-link <?php echo (($url=="edit-category"||$url=="categories-list"||$url=="add-new-category")?'active':'')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('sub-categories-list')?>" class="nav-link <?php echo (($url=="edit-sub-category"||$url=="add-new-sub-category"||$url=="sub-categories-list")?'active':'')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub Categories</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link <?php echo (($url=="sizes-list"||$url=="edit-size"||$url=="add-new-size"||$url=="colors-list"||$url=="edit-color"||$url=="add-new-color")?'active':'')?>">
              <i class="fas fa-palette nav-icon"></i>
              <p>
                Sizes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('sizes-list')?>" class="nav-link <?php echo (($url=="sizes-list"||$url=="edit-size"||$url=="add-new-size")?'active':'')?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sizes</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('unit-list')?>" class="nav-link <?php echo (($url=="unit-list"||$url=="edit-unit"||$url=="add-new-measurement")?'active':'')?>">
              <i class="fas fa-weight nav-icon"></i>
              <p>
                Measurement Unit
              </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="<?php echo base_url('products-management')?>" class="nav-link <?php echo (($url=="product-comments"||$url=="add-new-product-variation"||$url=="product-variations"||$url=="edit-product-variation"||$url=="add-new-product"||$url=="edit-product"||$url=="products-management")?'active':'')?>">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Products
              </p>
            </a>
          </li>
          <li style="display:none;" class="nav-item">
            <a href="<?php echo base_url('orders-list')?>" class="nav-link <?php echo (($url=="orders-list"||$url=="order-details")?'active':'')?>">
              <i class="nav-icon fas fa-shipping-fast"></i>
              <p>
                Orders
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('raw-management')?>" class="nav-link <?php echo (($url=="raw-management"||$url=="edit-raw"||$url=="add-new-raw"||$url=="create-new-raw")?'active':'')?>">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Raw material
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('customers-list')?>" class="nav-link <?php echo (($url=="customers-list")?'active':'')?>">
              <i class="fas fa-users nav-icon"></i>
              <p>
                Customers
              </p>
            </a>
          </li>
          <?php } ?>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
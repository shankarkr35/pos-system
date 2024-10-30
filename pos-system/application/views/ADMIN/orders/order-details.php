<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin-dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Order Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                    <div class="card-header">
                      <div class="col-sm-12 col-md-6"><h3 class="card-title">Order Details</h3></div>
                      <div class="col-sm-12 col-md-6" style="float: right;">
                        <a href="<?php echo base_url().'order-invoice/'.$order->order_unique_id;?>" target="_blank" class="btn btn-primary" style="float: right;">View Invoice</a>
                        <a href="<?php echo base_url().'order-invoiceprint/'.$order->order_unique_id;?>" target="_blank" class="btn btn-primary" style="float: right;">Print</a>
                      </div>
                    </div><br>
                    <!-- /.card-header -->
                  <h4>
                    <?php echo $order->order_unique_id;?>
                    <small class="float-right">Date : <?php echo date('h:i A', strtotime($order->create_date)).' '.date('d/m/Y', strtotime($order->create_date));?></small>
                  </h4>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <address>
                    <strong style="font-size: 20px;"><?php echo $order->user_name;?></strong><br>
                    <?php echo $order->address?><br>
                    Phone : <?php echo $order->phone?><br>
                    Email : <?php echo $order->email?><br>
                  </address>
                </div>
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Qty</th>
                      <th>Price</th>
                      <th>Total</th>
                      <!--<th>Status</th>-->
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $row):?>
                        <tr>
                          <td>
                              <img src="<?php echo base_url('uploads/products/medium/').$row['image']?>" style="width: 90px;height: 90px;">
                          </td>
                          <td>
                                <div class="d-flex flex-column">
                                  <div class=""><?php echo text_limit($row['name'],8);?></div>
                                  <?php if($row['size_name']!=""):?>
                                  <div class=""><b>Size</b> : <?php echo $row['size_name'];?></div>
							      <?php endif?>
							      
                                </div>
                          </td>
                          <td><?php echo $row['quantity']?></td>
                          <td><?php echo $row['price']." KD";?></td>
                          <td><?php echo number_format($row['quantity']*$row['price'],2)." KD";?></td>
                          <!--<td>
                                <select class="form-control form-control-sm status-change" id="<?php echo $row['id'];?>">
                                    <option value="0" <?php echo (($row['status']==0)?'selected':'')?>>Confirmed</option> 
                                    <option value="1" <?php echo (($row['status']==1)?'selected':'')?>>Processing</option> 
                                    <option value="3" <?php echo (($row['status']==3)?'selected':'')?>>Shipped</option> 
                                    <option value="4" <?php echo (($row['status']==4)?'selected':'')?>>Delivered</option> 
                                </select>
                          </td>-->
                        </tr>
                        <?php endforeach?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-8">
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <div class="table-responsive">
                    <table class="table">
                      <tbody><tr>
                        <th style="width:50%">Subtotal :</th>
                        <td><?php echo $order_s_total." KD";?></td>
                      </tr>
                      <?php if($order->coupon_amt!="0.00"):?>
                      <tr>
                        <th>Discount :</th>
                        <td>- <?php echo $order->coupon_amt." KD";?></td>
                      </tr>
                      <?php endif?>
                      
                      <tr>
                        <th>Total :</th>
                        <td><?php echo $order->total_amount." KD";?></td>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print d-none">
                <div class="col-12">
                  <button type="button" class="btn btn-danger float-right" style="margin-right: 5px;">
                    <i class="fas fa-print"></i> Print
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
<script>
  $(function () {
    $("#custom-data-table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"],
      'columnDefs': [ {
        'targets': [1,2,3,4,5], /* column index */
        'orderable': false, /* true or false */
     }]
    }).buttons().container().appendTo('#custom-data-table_wrapper .col-md-6:eq(0)');
  });
</script>

<script>
    $(document).on('change','.status-change',function(){
        const id = $(this).attr('id');
        const status = $(this).val();
        $.post("<?=base_url('admin/admin/order_status_management')?>",
          {
            id:id,
            status:status
          },
          function(data, status){
            if(data=="updated")
            {   
                $(this).val(status);
                 swal({
                  title: "Status Updated.",
                  text: "Status Updated successfully.!",
                  type: "success",
                  confirmButtonClass: 'btn-primary btn-sm',
                  confirmButtonText: 'OK'
                });
            }
        });
    });
</script>




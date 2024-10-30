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
              <li class="breadcrumb-item active">Orders List</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Orders List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="custom-data-table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="w-20">SR No.</th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Order Amount</th>
                    <th>Order Date</th>
                    <th>Order Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody> 
                  <?php $sr=0; foreach($orders as $row):?>
                  <tr>
                      <td><?php echo $sr=$sr+1;?></td>
                      <td><?php echo $row->order_unique_id?></td>
                      <td><?php echo $row->user_name?></td>
                      <td><?php echo $row->total_amount." KD";?></td>
                      <td><?php echo date('h:i A', strtotime($row->create_date))." ".date("d/m/Y", strtotime($row->create_date));?></td>
                      <td>
                          <select class="form-control form-control-sm status-change" id="<?php echo $row->id;?>">
                                <option value="0" <?php echo (($row->status==0)?'selected':'')?> disabled>Confirmed</option> 
                                <option value="1" <?php echo (($row->status==1)?'selected':'')?>>Returned</option>
                                <option value="2" <?php echo (($row->status==2)?'selected':'')?>>Re-Confirmed</option>
                                <!--<option value="1" <?php echo (($row->status==1)?'selected':'')?>>Processing</option> -->
                                <!--<option value="3" <?php echo (($row->status==3)?'selected':'')?>>Shipped</option> -->
                                <!--<option value="4" <?php echo (($row->status==4)?'selected':'')?>>Delivered</option> -->
                                <!--<option value="5" <?php echo (($row->status==5)?'selected':'')?> disabled>Cancel Rrequest</option> -->
                                <!--<option value="6" <?php echo (($row->status==6)?'selected':'')?>>Cancelled</option> -->
                            </select>
                      </td>
                      <td>
                          <a href="<?php echo base_url('order-details/').$row->order_unique_id?>" class="btn btn-info btn-sm" title="view order details"><i class="far fa-eye"></i></a>
                      </td>
                  </tr>
                  <?php endforeach?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
<script>
  $(function () {
    $("#custom-data-table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"],
      'columnDefs': [ {
        'targets': [1,2,3,4,5,6], /* column index */
        'orderable': false, /* true or false */
     }]
    }).buttons().container().appendTo('#custom-data-table_wrapper .col-md-6:eq(0)');
  });
</script>

<script>
    $(document).on('change','.status-change',function(){
        const id = $(this).attr('id');
        const status = $(this).val();
        $.post("<?=base_url('admin/admin/order_status_mange')?>",
          {
            id:id,
            table:'orders',
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
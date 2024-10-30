<style>
    .color-view {
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }
</style>

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
              <li class="breadcrumb-item active">Products</li>
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
                <h3 class="card-title">Products List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="custom-data-table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SR No.</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <?php
                  $sr=0;
                  foreach($products as $row):
                  ?>
                  <tr id="row<?php echo $row->id?>">
                        <td><?php echo $sr=$sr+1?></td>
                        <td title="<?php echo $row->name;?>"><?php echo text_limit($row->name,8)?></td>
                        <td>
                            <select class="form-control form-control-sm status-change" id="<?php echo $row->id?>">
                                <option value="1" <?php echo (($row->status==1)?'selected':'')?>>Published</option>
                                <option value="0" <?php echo (($row->status==0)?'selected':'')?>>Draft</option>
                            </select>
                        </td>
                        <td class="text-center">
                            <a href="<?php echo base_url('product-variations/').$row->id?>" title="product variations" class="btn btn-success btn-sm">
                                <i class="fa fa-sitemap"></i>
                            </a>
                            <a href="<?php echo base_url('edit-product/').$row->id?>" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" onclick="checkdelete(<?php echo $row->id?>)">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                  </tr>
                  <?php endforeach?>
                  <tbody>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>SR No.</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
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
      "buttons": ["csv", "excel", "pdf", "print"],
      'columnDefs': [ {
        'targets': [1,2,3], /* column index */
        'orderable': false, /* true or false */
     }]
    }).buttons().container().appendTo('#custom-data-table_wrapper .col-md-6:eq(0)');
  });
</script>

<script>
    $(document).ready(function(){
        var html='';
            html+='<div class="" id="action-btns" style="display: contents;">';
            html+='<button type="button" title="add new category" class="ml-1 btn btn-outline-success btn-sm cust-btns" id="add-new-btn">New <i class="fas fa-plus-circle"></i></button>';
            html+='</div>';
        $("#custom-data-table_filter").append(html);
    });
    
    $(document).on('click','#add-new-btn',function(){
        const base_url = "<?php echo base_url()?>"; 
        window.location.replace(base_url+"add-new-product");
    });
</script> 

<script>
    $(function(){
        
        if ( sessionStorage.getItem('statusupdated') ) {
           swal({
              title: "Status Updated.",
              text: "Status updated successfully.!",
              type: "success",
              confirmButtonClass: 'btn-primary btn-sm',
              confirmButtonText: 'OK'
            });
            sessionStorage.removeItem('statusupdated');
        }
        
        if ( sessionStorage.getItem('updated') ) {
           swal({
              title: "Product Updated.",
              text: "Product Details updated successfully.!",
              type: "success",
              confirmButtonClass: 'btn-primary btn-sm',
              confirmButtonText: 'OK'
            });
            sessionStorage.removeItem('updated');
        }
        
        if ( sessionStorage.getItem('saved') ) {
           swal({
              title: "New Product Added",
              text: "Product added successfully.!",
              type: "success",
              confirmButtonClass: 'btn-primary btn-sm',
              confirmButtonText: 'OK'
            });
            sessionStorage.removeItem('saved');
        }
    });
</script>

<script>
    $(document).on('change','.status-change',function(){
        const id = $(this).attr('id');
        const status = $(this).val();
        $.post("<?=base_url('status-management')?>",
          {
            id:id,
            table:'products',
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

<script>
    function checkdelete(id)
   {
       swal({
          title: "Are you sure.?",
          text: "You want to delete this record.",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: 'btn-danger btn-sm',
          cancelButtonClass: 'btn-dark btn-sm',
          confirmButtonText: 'Yes, delete it!',
          closeOnConfirm: false
        },
        function(){
              $.post("<?=base_url('delete-record-from')?>",
              {
                id:id,
                table:'products'
              },
              function(data, status){
                 if(data=="deleted")
                 {
                     $("#row"+id).remove();
                     swal({
                      title: "Deleted.",
                      text: "Record has been deleted successfully.!",
                      type: "success",
                      confirmButtonClass: 'btn-primary btn-sm',
                      confirmButtonText: 'OK'
                    });
                 }
              });
        });
   }
</script>
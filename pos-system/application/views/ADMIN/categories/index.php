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
              <li class="breadcrumb-item active">Categories List</li>
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
                <h3 class="card-title">Categories List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="custom-data-table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="w-20">SR No.</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $sr=0;
                    foreach($categories as $row):
                    ?>
                    <tr id="row<?php echo $row->id?>">
                        <td><?php echo $sr=$sr+1;?></td>
                        <td>
                            <img src="<?php echo base_url('uploads/categories/medium/').$row->image?>" width="50">
                        </td>
                        <td><?php echo $row->name?></td>
                        <td>
                            <select class="form-control status-change" id="<?php echo $row->id?>">
                                <option value="1" <?php echo (($row->status==1)?'selected':'')?>>Published</option>
                                <option value="0" <?php echo (($row->status==0)?'selected':'')?>>Draft</option>
                            </select>
                        </td>
                        <td>
                            <a href="<?php echo base_url('edit-category/').$row->id?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" onclick="checkdelete(<?php echo $row->id?>)"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php endforeach?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th class="w-20">SR No.</th>
                    <th>Image</th>
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
      "buttons": ["copy", "csv", "excel", "pdf", "print"],
      'columnDefs': [ {
        'targets': [1,2,3,4], /* column index */
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
        window.location.replace(base_url+"add-new-category");
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
              title: "Category Updated.",
              text: "Category Details updated successfully.!",
              type: "success",
              confirmButtonClass: 'btn-primary btn-sm',
              confirmButtonText: 'OK'
            });
            sessionStorage.removeItem('updated');
        }
        
        if ( sessionStorage.getItem('saved') ) {
           swal({
              title: "New Category Added",
              text: "Category added successfully.!",
              type: "success",
              confirmButtonClass: 'btn-primary btn-sm',
              confirmButtonText: 'OK'
            });
            sessionStorage.removeItem('saved');
        }
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
                table:'categories'
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

<script>
    $(document).on('change','.status-change',function(){
        const id = $(this).attr('id');
        const status = $(this).val();
        $.post("<?=base_url('status-management')?>",
          {
            id:id,
            table:'categories',
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
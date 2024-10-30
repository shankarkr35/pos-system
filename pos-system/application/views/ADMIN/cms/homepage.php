
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin-dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Homepage Contents Management</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Homepage Contents Management</h3>
              </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Instagram Post :</label>
                                <textarea id="instagram-post" class="form-control" rows="15"><?php echo $data->instagram_post;?></textarea>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="card-footer" id="save-btn-conatiner">
                  <button type="button" class="btn btn-danger" id="save-btn-custom">Update</button>
                </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<script>
    $(document).on('click','#save-btn-custom',function(){
        var why_head_en = $('#instagram-post').val();
        var baseUrl = '<?php echo base_url(); ?>';
        var fd = new FormData();
        fd.append('instagram_post',why_head_en);
        
        $.ajax({
            url: baseUrl + "admin/admin/update_homepage_cms",
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            dataType: "JSON",
            beforeSend: function(){
            $("#save-btn-conatiner").html('<div class="spinner-border text-danger text-right"></div>');
           },
            success: function(jsonStr) {
              var res_data = JSON.stringify(jsonStr);
              var response = JSON.parse(res_data);
              var responseData = response['responseData'];
              if ((responseData != null) && (responseData == 'record updated')) 
              {
                sessionStorage.setItem('updated',true);
                document.location.reload(true);
              } 
            },complete:function(data){
             $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Update</button>');
           }
        });
        
    });
</script>

<script>
    $(function(){
        
        if ( sessionStorage.getItem('updated') ) {
           swal({
              title: "Data Updated.",
              text: " Details updated successfully.!",
              type: "success",
              confirmButtonClass: 'btn-primary btn-sm',
              confirmButtonText: 'OK'
            });
            sessionStorage.removeItem('updated');
        }
    });
</script>
  
  
  
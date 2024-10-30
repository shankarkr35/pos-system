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
              <li class="breadcrumb-item active">Footer Management</li>
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
                <h3 class="card-title">Footer Social Links Management</h3>
              </div>
                <div class="card-body">  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Instagram :</label>
                    <input type="text" class="form-control" id="instagram" placeholder="http://www.example.com/" value="<?php echo $data->instagram?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Facebook :</label>
                    <input type="text" class="form-control" id="facebook" placeholder="http://www.example.com/" value="<?php echo $data->facebook?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Twitter :</label>
                    <input type="text" class="form-control" id="twitter" placeholder="http://www.example.com/" value="<?php echo $data->twitter?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Linkedin :</label>
                    <input type="text" class="form-control" id="linkedin" placeholder="http://www.example.com/" value="<?php echo $data->linkedin?>">
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
        var instagram = $('#instagram').val();
        var facebook = $('#facebook').val();
        var twitter = $('#twitter').val();
        var linkedin = $('#linkedin').val();
        
        var baseUrl = '<?php echo base_url(); ?>';
        var fd = new FormData();
        fd.append('instagram',instagram);
        fd.append('facebook',facebook);
        fd.append('twitter',twitter);
        fd.append('linkedin',linkedin);
        $.ajax({
            url: baseUrl + "admin/admin/update_footer_links",
            type: "POST",
            data: fd,
            contentType: false,
            processData: false,
            dataType: "JSON",
            beforeSend: function(){
            $('#name-en').removeClass('is-invalid');
            $('#name-err').text('');
            
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
  
  
  
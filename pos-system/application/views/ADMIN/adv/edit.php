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
              <li class="breadcrumb-item active">Edit Advertisement</li>
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
                <h3 class="card-title">Edit Advertisement</h3>
              </div>
                <div class="card-body"> 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Position :</label>
                    <input type="text" class="form-control" id="name-en" value="<?php echo $data->position?>" readonly>
                    <span class="text-danger font-weight-bold" id="name-err"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Link :</label>
                    <input type="text" class="form-control" id="link" value="<?php echo $data->link?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Adv Image :</label>
                    <div class="white-box">
                        <input type="file" id="file" name="file" class="dropify" data-default-file="<?php echo base_url(); ?>uploads/adv/<?php echo $data->image ?>" /> 
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
    $(document).ready(function() 
    {
        $('.dropify').dropify();
        $('.select2').select2()
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        });
    });
</script>

<script>
    $(document).on('click','#save-btn-custom',function(){
        var url_link = $('#link').val();
        
        var baseUrl = '<?php echo base_url(); ?>';
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('image',files);
        fd.append('id',"<?php echo $data->id?>");
        fd.append('url_link',url_link);
        fd.append('current_image',"<?php echo $data->image?>");
        $.ajax({
            url: baseUrl + "update-advertisement",
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
              var responseData = response['response'];
              //console.log(responseData);return;
              if ((responseData != null) && (responseData == 'record updated successfully')) 
              {
                sessionStorage.setItem('updated',true);
                window.location.href = baseUrl+'advertisements';
              } 
            },complete:function(data){
             $("#save-btn-conatiner").html('<button type="button" class="btn btn-danger" id="save-btn-custom">Update</button>');
           }
        });
        
    });
</script>
  
  
  
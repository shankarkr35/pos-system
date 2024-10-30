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
              <li class="breadcrumb-item active">Homepage Banners Management</li>
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
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Homepage Banner : 1</h3>
                  </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="white-box">
                                        <input type="file" id="file1" key="1" name="file" class="dropify" data-default-file="<?php echo base_url('uploads/homebanners/').$data->banner_1;?>" data="<?php echo $data->banner_1?>" accept="image/png, image/gif, image/jpeg"/> 
                                    </div>
                                    <span class="mt-2" id="image-err1" style="color:red;font-style:italic"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" id="save-btn-conatiner1">
                      <button type="button" class="btn btn-danger" id="save-btn-custom" data-key="1">Update</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Homepage Banner : 2</h3>
                  </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="white-box">
                                        <input type="file" id="file2" key="2" name="file" class="dropify" data-default-file="<?php echo base_url('uploads/homebanners/').$data->banner_2;?>" data="<?php echo $data->banner_2?>" accept="image/png, image/gif, image/jpeg"/> 
                                    </div>
                                    <span class="mt-2" id="image-err2" style="color:red;font-style:italic"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" id="save-btn-conatiner2">
                      <button type="button" class="btn btn-danger" id="save-btn-custom" data-key="2">Update</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Homepage Banner : 3</h3>
                  </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="white-box">
                                        <input type="file" id="file3" name="file"  key="3" class="dropify" data-default-file="<?php echo base_url('uploads/homebanners/').$data->banner_3;?>" data="<?php echo $data->banner_3?>" accept="image/png, image/gif, image/jpeg"/> 
                                    </div>
                                    <span class="mt-2" id="image-err3" style="color:red;font-style:italic"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" id="save-btn-conatiner3">
                      <button type="button" class="btn btn-danger" id="save-btn-custom" data-key="3">Update</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Homepage Banner : 4</h3>
                  </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="white-box">
                                        <input type="file" id="file4" key="4" name="file" class="dropify" data-default-file="<?php echo base_url('uploads/homebanners/').$data->banner_4;?>" data="<?php echo $data->banner_4?>" accept="image/png, image/gif, image/jpeg"/> 
                                    </div>
                                    <span class="mt-2" id="image-err4" style="color:red;font-style:italic"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" id="save-btn-conatiner4">
                      <button type="button" class="btn btn-danger" id="save-btn-custom" data-key="4">Update</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Homepage Banner : 5</h3>
                  </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="white-box">
                                        <input type="file" id="file5" key="5" name="file" class="dropify" data-default-file="<?php echo base_url('uploads/homebanners/').$data->banner_5;?>" data="<?php echo $data->banner_5?>" accept="image/png, image/gif, image/jpeg"/> 
                                    </div>
                                    <span class="mt-2" id="image-err5" style="color:red;font-style:italic"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" id="save-btn-conatiner5">
                      <button type="button" class="btn btn-danger" id="save-btn-custom" data-key="5">Update</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Homepage Banner : 6</h3>
                  </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="white-box">
                                        <input type="file" id="file6" key="6" name="file" class="dropify" data-default-file="<?php echo base_url('uploads/homebanners/').$data->banner_6;?>" data="<?php echo $data->banner_6?>" accept="image/png, image/gif, image/jpeg"/> 
                                    </div>
                                    <span class="mt-2" id="image-err6" style="color:red;font-style:italic"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" id="save-btn-conatiner6">
                      <button type="button" class="btn btn-danger" id="save-btn-custom" data-key="6">Update</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Homepage Banner : 7</h3>
                  </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="white-box">
                                        <input type="file" id="file8" key="8" name="file" class="dropify" data-default-file="<?php echo base_url('uploads/homebanners/').$data->banner_8;?>" data="<?php echo $data->banner_8?>" accept="image/png, image/gif, image/jpeg"/> 
                                    </div>
                                    <span class="mt-2" id="image-err8" style="color:red;font-style:italic"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" id="save-btn-conatiner8">
                      <button type="button" class="btn btn-danger" id="save-btn-custom" data-key="8">Update</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Footer Image</h3>
                  </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="white-box">
                                        <input type="file" id="file7" name="file" class="dropify" data-default-file="<?php echo base_url('uploads/homebanners/').$data->banner_7;?>" data="<?php echo $data->banner_7?>" accept="image/png, image/gif, image/jpeg"/> 
                                    </div>
                                    <span class="mt-2" id="image-err" style="color:red;font-style:italic"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" id="save-btn-conatiner7">
                      <button type="button" class="btn btn-danger" id="save-btn-custom" data-key="7">Update</button>
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
        $('.select2').select2()
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        });
    });
</script>   
<script>
    $(document).ready(function() 
    {
        $('.dropify').dropify();
    });
    $(document).on('change','.dropify',function(){
        var ky = $(this).attr('key');
        $('#image-err'+ky).text('');    
    });
</script>

<script>
    $(document).on('click','#save-btn-custom',function(){
        var key = $(this).attr('data-key');
        var img = $('#file'+key).val();
        var curimg = $('#file'+key).attr('data');
        if(img=="")
        {
            $('#image-err'+key).text('Please select slider image.*');
        }else{
            $('#image-err'+key).text('');
        }
        if(img!="")
        {
            var baseUrl = '<?php echo base_url(); ?>';
            var fd = new FormData();
            var files = $('#file'+key)[0].files[0];
            fd.append('image',files);
            fd.append('banner','banner_'+key);
            fd.append('current_image',curimg);
            
            $.ajax({
                url: baseUrl + "admin/admin/update_home_banners",
                type: "POST",
                data: fd,
                contentType: false,
                processData: false,
                dataType: "JSON",
                beforeSend: function(){
                $('#image-err').text('');    
                $("#save-btn-conatiner"+key).html('<div class="spinner-border text-danger text-right"></div>');
               },
                success: function(jsonStr) {
                  var res_data = JSON.stringify(jsonStr);
                  var response = JSON.parse(res_data);
                  var res = response['response'];
                  //console.log(res);return;
                  if(res=="banner updated")
                  {
                    sessionStorage.setItem('saved',true);
                    window.location.reload();   
                  }
                },complete:function(data){
                 $("#save-btn-conatiner"+key).html('<button type="button" class="btn btn-danger" id="save-btn-custom" data-key="'+key+'">Save</button>');
               }
            });
        }
        
    });
</script>
  
  
  
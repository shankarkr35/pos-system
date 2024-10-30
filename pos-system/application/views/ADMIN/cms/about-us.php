
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
              <li class="breadcrumb-item active">About Us Contents Management</li>
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
                <h3 class="card-title">About Us Contents Management</h3>
              </div>
                <div class="card-body">
                    <div class="form-group">
                      <label for="postImage">Banner Image :</label><!--<span style="color: red"> ( Recommended image size <b>width : 500px</b> and <b>height : 500px</b> )</span>-->
                      <div class="white-box">
                        <input type="file" id="main-banner-image" name="file" class="dropify" data-default-file="<?php echo base_url(); ?>uploads/aboutus/medium/<?php echo $data->main_banner; ?>"/> 
                        <div id="fileInfo1" style="color: red;"></div>
                      </div>
                      <span class="text-danger font-weight-bold font-italic" id="banner-err"></span>
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Why Trails Heading (en) :</label>
                                <input type="text" class="form-control" id="why-trails-en" placeholder="" value="<?php echo $data->why_head_en?>">
                                <span class="text-danger font-weight-bold" id="name-err"></span>
                            </div>    
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Why Trails Heading (ar) :</label>
                                <input type="text" class="arabic-input form-control" id="why-trails-ar" placeholder="" value="<?php echo $data->why_head_ar?>">
                                <span class="text-danger font-weight-bold" id="name-err"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Why Trails Description (en) :</label>
                                <textarea type="text" class="form-control" id="why-trails-desc-en" rows="4" cols="50"><?php echo $data->why_desc_en?></textarea>
                                <span class="text-danger font-weight-bold" id="name-err"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Why Trails Description (ar) :</label>
                                <textarea type="text" class="arabic-input form-control" id="why-trails-desc-ar" rows="4" cols="50"><?php echo $data->why_desc_ar?></textarea>
                                <span class="text-danger font-weight-bold" id="name-err"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">What do we do Heading (en) :</label>
                                <input type="text" class="form-control" id="what-we-en" placeholder="" value="<?php echo $data->what_head_en?>">
                                <span class="text-danger font-weight-bold" id="name-err"></span>
                            </div>    
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">What do we do Heading (ar) :</label>
                                <input type="text" class="arabic-input form-control" id="what-we-ar" placeholder="" value="<?php echo $data->what_head_ar?>">
                                <span class="text-danger font-weight-bold" id="name-err"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">What do we do Description (en) :</label>
                                <textarea type="text" class="form-control" id="what-we-desc-en" rows="4" cols="50"><?php echo $data->what_desc_en?></textarea>
                                <span class="text-danger font-weight-bold" id="name-err"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">What do we do Description (ar) :</label>
                                <textarea type="text" class="arabic-input form-control" id="what-we-desc-ar" rows="4" cols="50"><?php echo $data->what_desc_ar?></textarea>
                                <span class="text-danger font-weight-bold" id="name-err"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="postImage">Why Trails Banner Image :</label><!--<span style="color: red"> ( Recommended image size <b>width : 500px</b> and <b>height : 500px</b> )</span>-->
                      <div class="white-box">
                        <input type="file" id="why-banner-image" name="file" class="dropify" data-default-file="<?php echo base_url(); ?>uploads/aboutus/medium/<?php echo $data->why_banner; ?>"/> 
                        <div id="fileInfo1" style="color: red;"></div>
                      </div>
                      <span class="text-danger font-weight-bold font-italic" id="banner-err"></span>
                    </div>
                    <div class="form-group">
                      <label for="postImage">What do we do Banner Image :</label><!--<span style="color: red"> ( Recommended image size <b>width : 500px</b> and <b>height : 500px</b> )</span>-->
                      <div class="white-box">
                        <input type="file" id="what-banner-image" name="file" class="dropify" data-default-file="<?php echo base_url(); ?>uploads/aboutus/medium/<?php echo $data->what_banner; ?>"/> 
                        <div id="fileInfo1" style="color: red;"></div>
                      </div>
                      <span class="text-danger font-weight-bold font-italic" id="banner-err"></span>
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
  $(function () {
    $('.dropify').dropify();  
    $('.select2').select2()
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
        
    $('#postDescription').summernote({
      height: 300,
    });
    
    $('#arpostDescription').summernote({
      height: 300
    });
    $('#arpostDescription').summernote('justifyRight');
  })
</script>   
<script>
    $(document).ready(function() 
    {
        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });
        $('#datetimepicker4').datetimepicker({
            format: 'LT'
        });
        
    });
</script>

<script>
    $(document).on('click','#save-btn-custom',function(){
        var why_head_en = $('#why-trails-en').val();
        var why_head_ar = $('#why-trails-ar').val();
        var why_desc_en = $('#why-trails-desc-en').val();
        var why_desc_ar = $('#why-trails-desc-ar').val();
        
        var what_head_en = $('#what-we-en').val();
        var what_head_ar = $('#what-we-ar').val();
        var what_desc_en = $('#what-we-desc-en').val();
        var what_desc_ar = $('#what-we-desc-ar').val();
        
        var baseUrl = '<?php echo base_url(); ?>';
        var fd = new FormData();
        var main_image = $('#main-banner-image')[0].files[0];
        var why_image = $('#why-banner-image')[0].files[0];
        var what_image = $('#what-banner-image')[0].files[0];
        fd.append('why_head_en',why_head_en);
        fd.append('why_head_ar',why_head_ar);
        fd.append('why_desc_en',why_desc_en);
        fd.append('why_desc_ar',why_desc_ar);
        fd.append('what_head_en',what_head_en);
        fd.append('what_head_ar',what_head_ar);
        fd.append('what_desc_en',what_desc_en);
        fd.append('what_desc_ar',what_desc_ar);
        fd.append('main_image',main_image);
        fd.append('why_image',why_image);
        fd.append('what_image',what_image);
        
        $.ajax({
            url: baseUrl + "admin/admin/update_about_us_cms",
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
  
  
  